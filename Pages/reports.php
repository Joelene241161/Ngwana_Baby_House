<?php
require_once '../config.php';

// total received donated items
$totalResult = $conn->query("SELECT COUNT(*) AS total FROM supplyrequest WHERE received = 1");
$totalRow = $totalResult->fetch_assoc();
$totalItems = $totalRow['total'] ?? 0;

// supply category counts
$counts = [
    'nappies' => 0,
    'wipes'   => 0,
    'formula' => 0,
    'toys'    => 0
];

// supply counts grouped by category where received is true
$sql = "SELECT category, COUNT(*) as count FROM supplyrequest WHERE received = 1 GROUP BY category";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cat = strtolower($row['category']);
        if (array_key_exists($cat, $counts)) {
            $counts[$cat] = $row['count'];
        }
    }
}

// map task enum's to display names
function getTaskDisplayName($taskKey) {
    $map = [
        'cuddle'  => 'Cuddle therapy',
        'tummy'   => 'Tummy time',
        'feed'    => 'Feeding support',
        'play'    => 'Play time',
        'reading' => 'Reading & stories'
    ];
    return isset($map[$taskKey]) ? $map[$taskKey] : ucfirst($taskKey);
}

// format activity dates
function formatActivityDate($dateTimeStr) {
    $timestamp = strtotime($dateTimeStr);
    if (date('Y-m-d', $timestamp) === date('Y-m-d')) {
        return 'Today, ' . date('g:i A', $timestamp);
    } elseif (date('Y-m-d', $timestamp) === date('Y-m-d', strtotime('-1 day'))) {
        return 'Yesterday, ' . date('g:i A', $timestamp);
    }
    return date('F j, g:i A', $timestamp);
}

// Recent volunteer activity (bookings with check-in and check-out)
$activitySql = "SELECT b.*, u.username, 
                ROUND(TIMESTAMPDIFF(SECOND, b.CheckIn_at, b.CheckOut_at) / 3600, 1) AS hours_worked 
                FROM bookings b 
                JOIN users u ON b.user_id = u.user_id 
                WHERE b.CheckIn_at IS NOT NULL AND b.CheckOut_at IS NOT NULL 
                ORDER BY b.CheckIn_at DESC 
                LIMIT 5";
$activityResult = $conn->query($activitySql);
$recentActivities = [];
if ($activityResult) {
    while ($row = $activityResult->fetch_assoc()) {
        $recentActivities[] = $row;
    }
}

// calculate total volunteer hours
$totalHoursSql = "SELECT SUM(TIMESTAMPDIFF(SECOND, CheckIn_at, CheckOut_at)) / 3600 AS total_hours 
                  FROM bookings 
                  WHERE CheckIn_at IS NOT NULL AND CheckOut_at IS NOT NULL";
$totalHoursResult = $conn->query($totalHoursSql);
$totalHoursRow = $totalHoursResult->fetch_assoc();
$totalVolunteerHours = round($totalHoursRow['total_hours'] ?? 0, 1);

// calculate task hours for Chart.js
$taskHoursMap = [
    'cuddle'  => 0,
    'tummy'   => 0,
    'feed'    => 0,
    'play'    => 0,
    'reading' => 0
];

$taskSql = "SELECT task, SUM(TIMESTAMPDIFF(SECOND, CheckIn_at, CheckOut_at)) / 3600 AS task_hours 
            FROM bookings 
            WHERE CheckIn_at IS NOT NULL AND CheckOut_at IS NOT NULL 
            GROUP BY task";
$taskResult = $conn->query($taskSql);
if ($taskResult) {
    while ($row = $taskResult->fetch_assoc()) {
        $tKey = strtolower($row['task']);
        if (array_key_exists($tKey, $taskHoursMap)) {
            $taskHoursMap[$tKey] = round($row['task_hours'], 1);
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../Components/googleAnalytics.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">

    <meta name="author" content="Joelene du Toit 241161">
    <meta name="keywords" content="Ngwana Baby House NGO">
    <title>Ngwana Baby House</title>

    <link rel="icon" type="image/x-icon" href="../Assets/favicon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.typekit.net/jep6hre.css">
    <link rel="stylesheet" href="../main.css">
</head>   

<body class="background">

    <!-- Desktop sidebar -->
    <div class="d-none d-md-block">
        <?php include "../Components/sidebar.php";?>
    </div>

    <!-- Mobile navbar -->
    <div class="d-block d-md-none">
        <?php include "../Components/mobileNav.php";?>
    </div>

    <div class="main">

     <h3 class="minionPro paddingTopMedium"> Reporting hub </h3>

    <!-- table start -->
    <div class="recentActivityContainer" style="flex: 1 1 280px; min-width: 280px;">
        <h4>Recent volunteer activity</h4>
        <p class="pLight">Latest activity logged by volunteers</p>
        <table class="tablePadding">
            <thead>
                <tr>
                    <th>Volunteer</th>
                    <th>Activity</th>
                    <th>Date & Time</th>
                    <th> Hours Logged </th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($recentActivities)): ?>
                    <tr><td colspan="4" class="text-center pLight">No completed activity logged yet.</td></tr>
                <?php else: ?>
                    <?php foreach ($recentActivities as $act): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($act['username']); ?></td>
                            <td><label class="tertiaryButton tertiaryGhost"><?php echo htmlspecialchars(getTaskDisplayName($act['task'])); ?></label></td>
                            <td><?php echo formatActivityDate($act['CheckIn_at']); ?></td>
                            <td><?php echo $act['hours_worked']; ?> hrs</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div> <!-- table end -->

<div style="display: flex; gap: 40px; flex-wrap: wrap;">
    <!-- graph -->
    <div class="hoursGraphContainer col-4" style="flex: 1 1 280px; min-width: 200px;">
        <h4 class="paddingBottomTiny">Volunteer hours counted</h4>
        <div class="hoursCounter">
            <h3 class="marginBottom0"><?php echo $totalVolunteerHours; ?> hrs</h3>
        </div>

        <?php include "../Components/graph.php";?>
    </div>

<div class="col-6 materialsSourced" style="flex: 1 1 280px; min-width: 280px;">
    <h4>Donated items</h4>
    <p class="pLight marginBottom0">Automatically updated </p>

    <div style="display: flex; gap: 10%; align-items: center">
        <div>
            <img src="../Assets/basket.png" alt="basket of donated items" style="width: 90px">
        </div>
        <div>
            <h3 class="pLight"><strong><?php echo $totalItems; ?></strong> items</h3>
        </div>
        <div>
            <table class="custom-grid-table">
                <tr>
                    <td>Nappies</td>
                    <td><?php echo $counts['nappies']; ?></td>
                </tr>
                <tr>
                    <td>Wipes</td>
                    <td><?php echo $counts['wipes']; ?></td>
                </tr>
                <tr>
                    <td>Formula</td>
                    <td><?php echo $counts['formula']; ?></td>
                </tr>
                <tr>
                    <td>Toys</td>
                    <td><?php echo $counts['toys']; ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
    <div class="row marginTopMedium">
        <button class="primaryButton buttonText" style="width: 200px"><a href="homeSupplies.php" class="invisibleLink">Request items &#10140;</a></button>
    </div>

    <div class="row marginTopMedium">
        <button class="secondaryButton buttonText" style="width: 200px" onclick="window.print()">Download a report</button>
    </div>
</div>
</div> <!-- end of flex container -->



</div> <!-- flex container -->

    </div> <!-- main -->

    <div style="margin-bottom: 75px"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>