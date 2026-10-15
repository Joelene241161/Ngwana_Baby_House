<?php
require_once '../config.php';

$user_id =$_SESSION['user_id'] ?? 1;  

// Fetch user data from database
$stmt =$conn->prepare("SELECT username, email, role, telephoneNumber, profilePicture FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);$stmt->execute();
$result =$stmt->get_result();
$user =$result->fetch_assoc();

$stmt->close();$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">

    <meta name="author" content="Joelene du Toit 241161">
    <meta name="keywords" content="Ngwana Baby House NGO">
    <title>
        Ngwana Baby House
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
        <?php 

        $role = $user['role'] ?? $_SESSION['role'] ?? 'volunteer';

        if ($role === 'staff') {
            include "../Components/sidebar.php";
        } else {
            include "../Components/sidebarVolunteer.php";
        }
        ?>
    </div>

    <!-- Mobile navbar -->
    <div class="d-block d-md-none">
        <?php 

        $role = $user['role'] ?? $_SESSION['role'] ?? 'volunteer';

        if ($role === 'staff') {
            include "../Components/mobileNav.php";
        } else {
            include "../Components/mobileNavVolunteer.php";
        }
        ?>
    </div>

    <div class="main">
        <div class="accountContainer">
            <h3 class="minionPro">Account information</h3>

      <!-- Profile picture upload -->
      <form id="accountForm" enctype="multipart/form-data">
          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
          
          <div class="profile-upload-row">
              <div class="profile-avatar-container">
                  <?php if (!empty($user['profilePicture']) &&$user['profilePicture'] !== 'default.jpg'): ?>
                      <img src="../uploads/<?php echo htmlspecialchars($user['profilePicture']); ?>" alt="Profile picture" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                  <?php else: ?>
                      <span class="avatar-placeholder">Photo</span>
                  <?php endif; ?>
              </div>
              <div class="profile-action-container">
                  <label for="avatar-input" class="custom-upload-btn">Upload profile picture</label>
                  <input type="file" id="avatar-input" name="profilePicture" class="sr-only" />
              </div>
          </div>

          <div class="form-grid paddingTopMedium">
              <!-- Name Field -->
              <div class="form-field-group">
                  <label for="name" class="field-label">Full Name</label>
                  <div class="input-with-icon">
                      <span class="input-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                      </span>
                      <input type="text" id="name" name="username" class="form-input icon-padding" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" required />
                  </div>
              </div>

              <!-- Email Field -->
              <div class="form-field-group">
                  <label for="email" class="field-label">Email Address</label>
                  <div class="input-with-icon">
                      <span class="input-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                      </span>
                      <input type="email" id="email" name="email" class="form-input icon-padding" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required />
                  </div>
              </div>

              <!-- Phone Number Field -->
              <div class="form-field-group">
                  <label for="phone" class="field-label">Phone Number</label>
                  <input type="tel" id="phone" name="telephoneNumber" class="form-input" value="<?php echo htmlspecialchars($user['telephoneNumber'] ?? ''); ?>" required />
              </div>

              <!-- Role Field (Read-only display) -->
              <div class="form-field-group">
                  <span class="field-label">Role</span>
                  <div class="role-display">
                      <span class="role-badge"><?php echo ucfirst(htmlspecialchars($user['role'] ?? 'Volunteer')); ?></span>
                  </div>
              </div>
          </div>

          <h4 class="paddingTopMedium">Password</h4>

          <div style="display: flex; gap: 15px">
              <!-- New Password Field -->
              <div class="form-field-group" style="width: 50%">
                  <label for="new-password" class="field-label">Change Password</label>
                  <div class="input-with-icon">
                      <span class="input-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                      </span>
                      <input type="password" id="new-password" name="password" class="form-input icon-padding" />
                  </div>
              </div>

              <!-- Confirm Password Field -->
              <div class="form-field-group" style="width: 50%">
                  <label for="confirm-password" class="field-label">Confirm Password</label>
                  <div class="input-with-icon">
                      <span class="input-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                      </span>
                      <input type="password" id="confirm-password" name="confirm_password" class="form-input icon-padding"/>
                  </div>
              </div>
          </div>

          <div id="responseMessage" class="mt-3"></div>
          <button type="submit" class="primaryButton buttonText">Save Changes</button>
      </form>

        </div> 

        <div style="display: flex; gap: 10px; margin-bottom: 20px">
            <div>
            <form action="../Components/logout.php" method="POST">
            <button type="submit" class="secondaryButton buttonText">Log out</button>
        </form>
    </div>
            <div>
            <button class="primaryButton buttonText">Delete account</button></div>
        </div>

    </div> 

    <div style="margin-bottom: 75px"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
    document.getElementById('accountForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        let msgDiv = document.getElementById('responseMessage');

        fetch('../Components/updateProfile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                msgDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                setTimeout(() => location.reload(), 1500); // refresh to reflect updates
            } else {
                msgDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        })
        .catch(error => {
            msgDiv.innerHTML = `<div class="alert alert-danger">An error occurred while saving.</div>`;
        });
    });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>