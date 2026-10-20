<?php
// logic file
include "../Components/manageSchedule.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">

    <meta name="author" content="Joelene du Toit 241161">
    <meta name="keywords" content="Ngwana Baby House NGO">
    <meta property="og:description" content="Ngwana Baby House volunteer dashboard. Volunteers can see real-time needs and volunteer to help. Staff can manage their volunteers and get insights.">
    <title>
        Bookings
    </title>

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
        <h3 class="minionPro paddingTopMedium">Manage volunteer bookings</h3>

        <div style="display: flex; gap: 40px;flex-wrap: wrap;"">
            <!-- Left: Schedule controls panel -->
            <div class="col-5">
                <div class="calendar-container" style="flex: 1 1 280px; min-width: 280px;">
                    <label for="event-date"><h4>Select a date</h4></label>
                    <input type="date" id="event-date" class="marginTopTiny" value="<?php echo $selectedDate; ?>" onchange="location.href='?date='+this.value+'&slot=<?php echo $activeSlotTable; ?>'">
                </div>

                <div class="scheduleControls" style="flex: 1 1 280px; min-width: 280px;">
                    <h4 class="paddingBottomTiny">Schedule Controls</h4>
                    <h6 class="pLight">Manage bookings for the selected time block</h6>

                    <div class="selectedTime">
                        <h6><?php echo $slotTables[$activeSlotTable]; ?> - <?php echo $allSlotsData[$activeSlotTable]['status']; ?></h6>
                    </div>

                    <form method="POST" action="bookings.php?date=<?php echo $selectedDate; ?>&slot=<?php echo $activeSlotTable; ?>">
                    <input type="hidden" name="action_slot" value="<?php echo $activeSlotTable; ?>">
                    <input type="hidden" name="selected_date" value="<?php echo $selectedDate; ?>">
                        
                        <div style="display: flex">
                            <div class="marginRightTiny">
                                <h6 class="marginTopMedium">Capacity limit</h6>
                                <button type="button" class="capacity-btn" onclick="changeQty(-1)"><h3>&minus;</h3></button>
                                <input type="number" id="qty" name="new_capacity_limit" value="<?php echo $activeData['capacityLimit']; ?>" min="1" max="20" class="smallInput">
                                <button type="button" class="capacity-btn" onclick="changeQty(1)"><h3>&plus;</h3></button>
                                <p class="pLight marginRightTiny">Maximum visitors</p>
                            </div>

                            <button type="submit" name="toggle_lock" value="1" style="display: flex" class="blockSlotButton marginLeftSmall">
                                <div class="marginRightTiny"><span style='font-size:33px;'>&#10754;</span></div>
                                <div>
                                    <h6 class="marginBottom0"><?php echo $activeData['locked'] ? 'Unlock Slot' : 'Block Slot'; ?></h6>
                                    <p class="pLight marginBottom0"><?php echo $activeData['locked'] ? 'Allow bookings again' : 'Prevent further bookings'; ?></p>
                                </div>
                            </button>
                        </div>
                        
                        <button type="submit" class="primaryButton buttonText col-12 mt-2">Save changes</button>
                    </form>

                    <button class="tertiaryButton buttonText col-12 mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        View who is booked
                    </button>
                </div>
            </div>

            <!-- Right: Time slots table -->
            <div class="timeSlotsContainer col-6" style="margin-bottom: 40px; flex: 1 1 280px; min-width: 280px;"">
                <div style="display: flex; gap: 20%;">
                    <div><h4><?php echo date('l, F j', strtotime($selectedDate)); ?></h4></div>
                    <div>
                        <p class="pLight">Daily capacity: <?php echo "$totalDailyCurrent / $totalDailyCapacity"; ?></p>
                    </div>
                </div>

                <div>
                    <table class="bookingsTable">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Capacity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($slotTables as $table => $label): 
                                $slot = $allSlotsData[$table];
                                $isLocked = $slot['locked'] == 1;
                                $capacityText = $isLocked ? 'Nap time / Locked' : "{$slot['capacity']} / {$slot['capacityLimit']}";
                                $actionText = ($table === $activeSlotTable) ? 'Selected' : 'View';
                                $btnClass = ($isLocked) ? 'tertiaryButton tertiaryGhostDisabled buttonText' : 'tertiaryButton tertiaryGhost buttonText';
                            ?>
                                <tr>
                                    <td><?php echo $label; ?></td>
                                    <td><?php echo $slot['status']; ?></td>
                                    <td><?php echo $capacityText; ?></td>
                                    <td>
                                        <a href="?date=<?php echo $selectedDate; ?>&slot=<?php echo $table; ?>">
                                            <button type="button" class="<?php echo $btnClass; ?>"><?php echo $actionText; ?></button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 75px"></div>

    <script>
    function changeQty(delta) {
        let qty = document.getElementById('qty');
        let newVal = parseInt(qty.value) + delta;
        if (newVal >= parseInt(qty.min) && newVal <= parseInt(qty.max)) {
            qty.value = newVal;
        }
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>