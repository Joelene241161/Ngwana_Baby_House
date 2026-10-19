<?php
require_once '../config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Adjust path to your login page
    exit();
}

// Fetch current user's role and designation
$currentUserId = $_SESSION['user_id'];
$accessStmt = $conn->prepare("SELECT role, designation FROM users WHERE user_id = ?");
$accessStmt->bind_param("i", $currentUserId);
$accessStmt->execute();
$accessResult = $accessStmt->get_result();
$currentUser = $accessResult->fetch_assoc();
$accessStmt->close();

// Only admins have access
if (!$currentUser || $currentUser['role'] !== 'staff' || $currentUser['designation'] !== 'admin') {
    die('
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Access Denied - Ngwana Baby House</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../main.css">
        </head>
        <body class="background d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="text-center p-5 bg-white rounded shadow-sm" style="max-width: 500px;">
                <h3 class="minionPro text-danger mb-3">Access Denied</h3>
                <p class="pLight mb-4">You do not have permission to view or manage staff access. This page is restricted to Administrators only.</p>
                <a href="home.php" class="primaryButton text-decoration-none buttonText d-inline-block">Return to Dashboard</a>
            </div>
        </body>
        </html>
    ');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user_id'])) {
    $userId = intval($_POST['update_user_id']);
    
    // Check if the revoke action was triggered
    if (isset($_POST['action']) && $_POST['action'] === 'revoke') {
        $stmt = $conn->prepare("UPDATE users SET role = 'volunteer', designation = 'none' WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->close();
    } else {
        $designation = $_POST['designation'];

        $stmt = $conn->prepare("UPDATE users SET role = 'staff', designation = ? WHERE user_id = ?");
        $stmt->bind_param("si", $designation, $userId);
        $stmt->execute();
        $stmt->close();
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


$volunteersQuery = "SELECT * FROM users WHERE role = 'volunteer' OR designation = 'none' ORDER BY joined_at DESC";
$volunteersResult = $conn->query($volunteersQuery);
$volunteers = [];
if ($volunteersResult) {
    while ($row = $volunteersResult->fetch_assoc()) {
        $volunteers[] = $row;
    }
}


$staffQuery = "SELECT * FROM users WHERE role = 'staff' ORDER BY joined_at DESC";
$staffResult = $conn->query($staffQuery);
$staffMembers = [];
if ($staffResult) {
    while ($row = $staffResult->fetch_assoc()) {
        $staffMembers[] = $row;
    }
}

// Get selected users details
$selectedUser = null;
if (isset($_GET['edit_id'])) {
    $editId = intval($_GET['edit_id']);
    $editStmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $editStmt->bind_param("i", $editId);
    $editStmt->execute();
    $editResult = $editStmt->get_result();
    if ($editResult && $editResult->num_rows > 0) {
        $selectedUser = $editResult->fetch_assoc();
    }
    $editStmt->close();
}

// Default to the first volunteer if none selected, or leave blank
if (!$selectedUser && !empty($volunteers)) {
    $selectedUser = $volunteers[0];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../Components/googleAnalytics.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
     <h3 class="minionPro paddingTopMedium"> Staff & Access </h3>
     <p class="pLight">Manage who can access the internal Ngwana Huis staff dashboard.</p>

<!-- start of flex container -->
<div style="display: flex; gap: 40px; flex-wrap: wrap;">
    
    <!-- Table: volunteers -->
    <div class="recentActivityContainer staffTable">
        <h4>Recent Sign Up’s</h4>
        <table class="tablePadding">
            <thead>
                <tr>
                    <th>Volunteer</th>
                    <th>Email</th>
                    <th>Staff dashboard</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($volunteers)): ?>
                    <tr><td colspan="3" class="text-center pLight">No recent volunteer sign ups.</td></tr>
                <?php else: ?>
                    <?php foreach ($volunteers as $v): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($v['username']); ?></td>
                            <td><?php echo htmlspecialchars($v['email']); ?></td>
                            <td>
                                <a href="?edit_id=<?php echo $v['user_id']; ?>" class="primaryButton primaryGhost buttonText text-decoration-none d-inline-block text-center" style="padding: 6px 12px;">
                                    Give Access
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div> <!-- table end -->

    <!-- Control panel -->
    <div class="staffAccess">
        <h4><?php echo ($selectedUser && $selectedUser['role'] === 'staff') ? 'Edit staff access' : 'Grant staff access'; ?></h4>

        <form action="" method="POST" id="staffAccessForm">
            <input type="hidden" name="update_user_id" value="<?php echo $selectedUser ? $selectedUser['user_id'] : ''; ?>">
            <input type="hidden" name="action" id="formAction" value="update">

            <div style="display: flex; gap: 20px" class="userDetails">
                <div>
                    <img src="../uploads/<?php echo !empty($selectedUser['profilePicture']) ? htmlspecialchars($selectedUser['profilePicture']) : 'default.png'; ?>" alt="profile picture" class="icon" style="width: 50px; height: 50px; border-radius: 20px; object-fit: cover; padding-left: 0">
                </div>
                <div>
                    <h5><?php echo $selectedUser ? htmlspecialchars($selectedUser['username']) : 'Select a user'; ?></h5>
                    <p class="pLight marginBottom0"><?php echo $selectedUser ? htmlspecialchars($selectedUser['email']) : 'email@address.com'; ?></p>
                    <div style="display: flex; gap: 10px">
                        <div class="marginTopMedium">
                            <span class="accessCategory"><?php echo $selectedUser ? ucfirst(htmlspecialchars($selectedUser['role'])) : 'Public View'; ?></span>
                        </div>
                        <div>
                            <p class="pLight marginTop15">Current designation: <strong><?php echo $selectedUser ? ucfirst(htmlspecialchars($selectedUser['designation'])) : 'None'; ?></strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="marginTopMedium">Assign staff role</h5>
            <p class="pLight">Choose the role they will fulfill</p>

            <div class="radio-group">
                <label class="radio-button">
                    <input type="radio" name="designation" value="nursery" <?php echo ($selectedUser && $selectedUser['designation'] === 'nursery') ? 'checked' : ''; ?>>
                    <span class="radio-icon"></span>
                    <span class="radio-label">Nursery caregiver</span>
                </label>

                <label class="radio-button">
                    <input type="radio" name="designation" value="volunteers" <?php echo ($selectedUser && $selectedUser['designation'] === 'volunteers') ? 'checked' : ''; ?>>
                    <span class="radio-icon"></span>
                    <span class="radio-label">Volunteer coordinator</span>
                </label>

                <label class="radio-button">
                    <input type="radio" name="designation" value="admin" <?php echo ($selectedUser && $selectedUser['designation'] === 'admin') ? 'checked' : ''; ?>>
                    <span class="radio-icon"></span>
                    <span class="radio-label">Administrator</span>
                </label>
            </div>

            <div style="display: flex; gap: 10px; flex-wrap: wrap;" class="marginTopMedium">
                <div><a href="<?php echo strtok($_SERVER["REQUEST_URI"], '?'); ?>" class="primaryButton primaryGhost buttonText text-decoration-none d-inline-block">Cancel</a></div>
                <div><button type="submit" class="primaryButton buttonText"><?php echo ($selectedUser && $selectedUser['role'] === 'staff') ? 'Update Access' : 'Grant staff access'; ?></button></div>
                <?php if ($selectedUser && $selectedUser['role'] === 'staff'): ?>
                    <div><button type="button" class="goodSemanticButton badSemanticButton buttonText"  style="margin-top: 0px" onclick="document.getElementById('formAction').value='revoke'; document.getElementById('staffAccessForm').submit();">Revoke Staff Access</button></div>
                <?php endif; ?>
            </div>
        </form>
    </div>

</div> <!-- end of flex container -->

    <!-- Table: staff -->
    <div class="recentActivityContainer staffTable paddingBottomSmall marginTopMedium">
        <h4>Your staff</h4>
        <table class="tablePadding">
            <thead>
                <tr>
                    <th>Staff Member</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Staff dashboard</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($staffMembers)): ?>
                    <tr><td colspan="4" class="text-center pLight">No staff members assigned yet.</td></tr>
                <?php else: ?>
                    <?php foreach ($staffMembers as $s): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($s['username']); ?></td>
                            <td><?php echo htmlspecialchars($s['email']); ?></td>
                            <td><span><?php echo ucfirst(htmlspecialchars($s['designation'])); ?></span></td>
                            <td>
                                <a href="?edit_id=<?php echo $s['user_id']; ?>" class="primaryButton primaryGhost buttonText text-decoration-none d-inline-block text-center" style="padding: 6px 12px;">
                                    Edit Access
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div> <!-- table end -->

    </div> <!-- main -->

    <div style="margin-bottom: 75px"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>