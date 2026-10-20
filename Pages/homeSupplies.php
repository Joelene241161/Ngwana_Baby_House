<?php
require_once '../config.php';

// handle received action
if (isset($_GET['action']) && $_GET['action'] === 'receive' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt =$conn->prepare("UPDATE supplyrequest SET received = 1 WHERE supplyAsk_id = ?");
    $stmt->bind_param("i", $id);$stmt->execute();
    header("Location: homeSupplies.php");
    exit();
}

// handle delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt =$conn->prepare("DELETE FROM supplyrequest WHERE supplyAsk_id = ?");
    $stmt->bind_param("i", $id);$stmt->execute();
    header("Location: homeSupplies.php");
    exit();
}

// Fetch active requests where received = 0/False
$result =$conn->query("SELECT * FROM supplyrequest WHERE received = 0 ORDER BY created_at DESC");
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
        Supply requests
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

    <!-- nav links -->
  <div style="display: flex">
    <div> <a href="home.php" class="linkText">
        <h5 class="navLinks">Tasks</h5>
    </a></div>
    <div> <a href="#" class="linkText">
        <h5 class="navLinks activeLink">Supplies</h5>
    </a></div>
</div>
            <h3 class="minionPro"> Create care requests to inform volunteers </h3>


<div style="display: flex; flex-wrap: wrap;">
    <div class="col-4">
    <div class="selectRequests">
        <h4> Select a category </h4>

        <div class="row" style="display: flex; gap: 10px">
        <!-- nappies -->
        <button style="display: flex" class="supplyCategory" data-bs-toggle="modal" data-bs-target="#supplies" data-category="Nappies">
        <div><img src="../Assets/diaper.png" alt="diapers" style="width: 44px"></div>
        <div> <p class="pLight">Nappies</p> </div>
        </button>

        <!-- wet wipes -->
          <button style="display: flex" class="supplyCategory" data-bs-toggle="modal" data-bs-target="#supplies" data-category="Wipes">
        <div><img src="../Assets/wipes.png" alt="wet wipes" style="width: 44px"></div>
        <div> <p class="pLight">Wipes</p> </div>
        </button>

        </div>

        <div class="row" style="display: flex; gap: 10px">
        <!-- toys -->
          <button style="display: flex" class="supplyCategory" data-bs-toggle="modal" data-bs-target="#supplies" data-category="Toys">
        <div><img src="../Assets/toys.png" alt="toys" style="width: 44px"></div>
        <div> <p class="pLight">Toys</p> </div>
        </button>

        <!-- formula -->
          <button style="display: flex" class="supplyCategory" data-bs-toggle="modal" data-bs-target="#supplies" data-category="Formula">
        <div><img src="../Assets/formula.png" alt="formula" style="width: 44px"></div>
        <div> <p class="pLight">Formula</p> </div>
        </button>

    </div>
    
    </div>
</div>

<div class="supplyRequests col-7">
    <h4 class="h4Bold"> Active care requests </h4>
    <div>
        
<?php if ($result &&$result->num_rows > 0): ?>
    <?php while ($row =$result->fetch_assoc()): ?>
        
        <?php
            // Map category to the correct image and display name
            $category = strtolower($row['category']);$imgPath = '../Assets/wipes.png'; // default
            $displayName = ucfirst($category);
            
            if ($category === 'nappies') {$imgPath = '../Assets/diaper.png';
                $displayName = "Nappies (Size " . htmlspecialchars($row['size']) . ")";
            } elseif ($category === 'wipes') {$imgPath = '../Assets/wipes.png';
                $displayName = "Wipes (" . htmlspecialchars($row['wipe']) . ")";
            } elseif ($category === 'toys') {
                $imgPath = '../Assets/toys.png';$displayName = "Toys (" . htmlspecialchars($row['toy']) . ", Age " . htmlspecialchars($row['age']) . ")";
            } elseif ($category === 'formula') {
                $imgPath = '../Assets/formula.png';$displayName = "Formula (Stage " . htmlspecialchars($row['stage']) . ", " . htmlspecialchars($row['formula']) . ")";
            }
        ?>

        <!-- One care request row -->
        <div style="display: flex; align-items: center; justify-content: space-between">
            <div style="display: flex; align-items: center; gap: 12px;">
                <img src="<?php echo $imgPath; ?>" alt="<?php echo $category; ?>" style="width: 44px">
                <div> 
                    <p class="pLight careSuppliesText"><?php echo $displayName; ?></p>
                </div>
            </div>

            <div style="display: flex; gap: 8px;">
                <!-- Received request button -->
                <a href="homeSupplies.php?action=receive&id=<?php echo $row['supplyAsk_id']; ?>" class="goodSemanticButton" title="Mark as received" style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                    <img src="../Assets/icons/received.png" alt="received supply" style="width: 20px">
                </a>
                
                <!-- Remove request button (triggers modal) -->
                <button type="button" class="goodSemanticButton badSemanticButton" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" data-id="<?php echo $row['supplyAsk_id']; ?>" style="display: flex; align-items: center; justify-content: center;">
                    <img src="../Assets/icons/trash-2.png" alt="delete request" style="width: 20px">
                </button>
            </div>
        </div>

    <?php endwhile; ?>
<?php else: ?>
    <p class="pLight" style="color: #6b7280; margin-top: 10px;">No active care requests found.</p>
<?php endif; ?>

    </div>
</div>

    </div>

</div> <!-- flex container -->


    </div> <!-- main -->
    
   <?php include "../Components/supplyModal.php";?>

   <!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="padding: 10px;">
      <div class="modal-header border-0">
        <h5 class="modal-title h4Bold" id="deleteModalLabel">Are you sure?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="pLight">Do you really want to delete this supply request? This action cannot be undone.</p>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="primaryButton buttonText primaryGhost" data-bs-dismiss="modal">Cancel</button>
        <a href="#" id="confirmDeleteBtn" class="primaryButton buttonText invisibleLink">Yes, Delete</a>
      </div>
    </div>
  </div>
</div>

<script>
  // Passes the correct request ID into the delete modal link when clicked
  const deleteModal = document.getElementById('deleteConfirmModal');
  if (deleteModal) {
    deleteModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const requestId = button.getAttribute('data-id');
      const confirmBtn = deleteModal.querySelector('#confirmDeleteBtn');
      
      // Update the href to point to the delete action with the correct item ID
      confirmBtn.href = `homeSupplies.php?action=delete&id=${requestId}`;
    });
  }
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>