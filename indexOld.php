<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style_footer.css">
  <script>
    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
</head>

<body>
  <div class="parent-header">
    <div class="header">
      <a href="https://www.lsqc.edu.ph/">
        <div class="logo"></div>
      </a>
    </div>
  </div>
  <div class="parent-wrapper">
    <div class="wrapper">
      <h1 class="pax">PAX ET BONUM</h1>
      <form action="login.php" method="POST">
        <label for="username" class="userpass">Username:</label><br>
        <div class="row">
          <input type="text" id="username" name="username" class="username" required>
        </div>
        <br>
        <label for="password" class="userpass">Password:</label><br>
        <div class="row">
          <input type="password" id="password" name="password" class="password" required><br>
          <i class="bi bi-eye-slash" id="togglePassword"></i>
        </div>
        <br><label for="checkbox" class="showpass"><input type="checkbox" id="checkbox" name="checkbox"
            onclick="myFunction()"> Show Password</label><br><br>
        <a href="#">Forgot password?</a><br><br>
        <input type="submit" class="bluebutton" value="Login"><br><br>
        <label class="needaccount">Need an account? <a href="registration.php">Create an ORS account.</a></label>

      </form>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class="container-footer w-container">
    <div class="contact_us">
      <h3 class="footer-titles">Contact Us</h3>
      <p class="footer-links"><a href="" target="_blank"><span class="footer-link">Kanlaon Cor. Don Manuel Sts. Sta.
            <br> Mesa Heights, Quezon City<br></span></a>
        <a href=""><span class="footer-link">Tel. Nos. 87315127 | 87315198 |87311777</span></a><span><br></span>
        <a href=""><span class="footer-link">registrar@lsqc.edu.ph | admin@lsqc.edu.ph<br></span></a>
    </div>
    <div class="affiliation">
      <h3 class="footer-titles">Accreditations / Affiliations</h3>
      <p class="footer-links"><a href=""><span class="footer-link">PAASCU Accredited Level 3<br></span></a>
        <a href=""><span class="footer-link">CEAP Member<br></span></a>
        <a href=""><span class="footer-link">ESC Certified</span></a>
    </div>
    <div class="follow_us">
      <h3 class="footer-titles">Follow Us!</h3>
      <a href="" target="_blank" class="footer-social-network-icons w-inline-block"><img
          src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dbf0a2f2b67e3b3ba079c_Twitter%20Icon.svg"
          width="20" alt="Twitter icon"></a><a href="" target="_blank"
        class="footer-social-network-icons w-inline-block">
        <img
          src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dbfe70fcf5a0514c5b1da_Instagram%20Icon.svg"
          width="20" alt="Instagram icon"></a>
      <a href="" target="_blank" class="footer-social-network-icons w-inline-block"><img
          src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dbe42e1e6034fdaba46f6_Facebook%20Icon.svg"
          width="20" alt="Facebook Icon"></a>
      <a href="" target="_blank" class="footer-social-network-icons w-inline-block"><img
          src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dc0002f2b676eb4ba0869_LinkedIn%20Icon.svg"
          width="20" alt="LinkedIn Icon"></a>
      <a href="" target="_blank" class="footer-social-network-icons w-inline-block"><img
          src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dc0112f2b6739c9ba0871_Pinterest%20Icon.svg"
          width="20" alt="Pinterest Icon" class=""></a>

    </div>
</body>

</html>