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

    <!-- <?php include "../Components/sidebar.php";?> -->

    <div class="main">

<div class="accountContainer">
    <h3 class="minionPro"> Account information </h3>

    <div class="profile-upload-row">
  <!-- Left: Round circle placeholder -->
  <div class="profile-avatar-container">
    <span class="avatar-placeholder">Photo</span>
  </div>

  <!-- Right: Styled upload button -->
  <div class="profile-action-container">
    <label for="avatar-input" class="custom-upload-btn">
      Upload profile picture
    </label>
    <input type="file" id="avatar-input" class="sr-only" />
  </div>
</div>

<div class="form-grid paddingTopMedium">
    
    <!-- Name Field -->
    <div class="form-field-group">
      <label for="name" class="field-label">Full Name</label>
      <div class="input-with-icon">
        <span class="input-icon">
          <!-- User Icon SVG -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </span>
        <input type="text" id="name" class="form-input icon-padding" placeholder="Jane Doe" />
      </div>
    </div>

    <!-- 2. Email Field -->
    <div class="form-field-group">
      <label for="email" class="field-label">Email Address</label>
      <div class="input-with-icon">
        <span class="input-icon">
          <!-- Mail Icon SVG -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </span>
        <input type="email" id="email" class="form-input icon-padding" placeholder="jane@example.com" />
      </div>
    </div>

    <!-- 3. Phone Number Field -->
    <div class="form-field-group">
      <label for="phone" class="field-label">Phone Number</label>
      <input type="tel" id="phone" class="form-input" placeholder="+24 (123) 456-9878" />
    </div>

    <!-- 4. Role Field -->
    <div class="form-field-group">
      <span class="field-label">Role</span>
      <div class="role-display">
        <span class="role-badge">Administrator</span>
      </div>
    </div>

  </div>

  <h4 class="paddingTopMedium">Password</h4>

  <div style="display: flex; gap: 15px">
   <!-- 5. New Password Field (with icon) -->
    <div class="form-field-group" style="width: 50%">
      <label for="new-password" class="field-label">Change Password</label>
      <div class="input-with-icon">
        <span class="input-icon">
          <!-- Lock Icon SVG -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </span>
        <input type="password" id="new-password" class="form-input icon-padding" placeholder="••••••••" />
      </div>
    </div>

    <!-- 6. Confirm Password Field (with icon) -->
    <div class="form-field-group" style="width: 50%">
      <label for="confirm-password" class="field-label">Confirm Password</label>
      <div class="input-with-icon">
        <span class="input-icon">
          <!-- Lock Icon SVG -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </span>
        <input type="password" id="confirm-password" class="form-input icon-padding" placeholder="••••••••"/>
      </div>
    </div>

</div>

<button class="primaryButton buttonText marginTopSmall">Save Changes</button>

</div> <!-- end of flex container -->

</div> <!-- main -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>