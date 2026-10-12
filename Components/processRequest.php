<?php
require_once '../config.php';

//for supply request modal

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // capture category
    $category     = strtolower(trim($_POST['category'] ?? '')); // 'nappies', 'wipes', 'toys', 'formula'
    $quantity     = intval($_POST['quantity'] ?? 1);
    $urgencyInput = $_POST['urgency'] ?? 'Today';

    // map form urgency values to the table's ENUM ('red', 'yellow', 'green')
    $urgency = 'red'; // default for 'Today'
    if ($urgencyInput === 'This Week') {
        $urgency = 'yellow';
    } elseif ($urgencyInput === 'Stock Up') {
        $urgency = 'green';
    }

    // initialise empty fields to 'none'
    $wipe    = 'none';
    $size    = 'none';
    $age     = 'none';
    $toy     = 'none';
    $stage   = 'none';
    $formula = 'none';

    // map category-specific inputs based on what the modal submitted
    if ($category === 'nappies') {
        $size = $_POST['size'] ?? 'none';
    } 
    elseif ($category === 'wipes') {
        $type = $_POST['type'] ?? '';
        if ($type === 'Sensitive') $wipe = 'sensitive';
        elseif ($type === 'Fragrance Free') $wipe = 'fragranceFree';
        elseif ($type === 'Regular') $wipe = 'regular';
    } 
    elseif ($category === 'toys') {
        // Map age ('0-3m' -> '0-3', etc.)
        $ageRaw = $_POST['age'] ?? '';
        if ($ageRaw === '0-3m') $age = '0-3';
        elseif ($ageRaw === '3-6m') $age = '3-6';
        elseif ($ageRaw === '12-24m') $age = '12-24';

        // Map toy type
        $type = $_POST['type'] ?? '';
        if ($type === 'Soft toys') $toy = 'soft';
        elseif ($type === 'Blocks') $toy = 'blocks';
        elseif ($type === 'Books') $toy = 'books';
    } 
    elseif ($category === 'formula') {
        $stage = $_POST['stage'] ?? 'none';

        $type = $_POST['type'] ?? '';
        if ($type === 'Standard') $formula = 'standard';
        elseif ($type === 'Lactose free') $formula = 'lactoseFree';
        elseif ($type === 'Anti-reflux') $formula = 'antiReflux';
    }

    // prepare the statement once outside the loop
    $stmt = $conn->prepare("INSERT INTO supplyrequest (received, category, urgency, wipe, size, age, toy, stage, formula, created_at) VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssss", $category, $urgency, $wipe, $size, $age, $toy, $stage, $formula);

    // loop and execute once for each unit in the quantity (eg; quantity = 2 inserts 2 rows)
    $allSuccessful = true;
    for ($i = 0; $i < $quantity; $i++) {
        if (!$stmt->execute()) {
            $allSuccessful = false;
            break;
        }
    }

    if ($allSuccessful) {
        $_SESSION['success'] = "Successfully created {$quantity} care request entries!";
        header("Location: ../Pages/homeSupplies.php");
        exit();
    } else {
        $error = "Failed to create requests: " . $stmt->error;
    }
}
?>