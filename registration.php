<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
  <link rel="stylesheet" href="style_footer.css">
  <link rel="stylesheet" href="registration.css">
  <script src="script.js"></script>
    <title>Lourdes School Quezon City</title>
    <link rel="icon" type="image/png" href="title_logo.png" />
</head>

<body>
        <div class="header"><div style="margin-left: 0.8%;
    display: flex;
    height: 100%;
    flex: 19.25%;
    justify-content: center;
    align-items: center;
    margin-right: 100%;"> <a href="index.php"><img style="margin-top:3px; height:90px;" src="logo.png"></a></div></div>
        <div class="center">
            <div class="child">
                <div class="signIn">
                    <p class="big">Sign In</p>
                    <p>Pax Et Bonum!</p>
                </div>
                <br>
                <br>
                <form action="register.php" method="POST">
                <div class="row">
                   <div class="column"><label for="first-name">First</label><br>
                    <input type="text" class="inputBox" id="first-name" name="first-name" placeholder="John" required></div>

                    <div class="column" id="column2"><label for="last-name">Last</label><br>
                    <input type="text" class="inputBox" id="last-name" name="last-name" placeholder="Doe" required></div>
                </div>

                    <label for="email">Email</label><br>
                    <div class="password">
                        <input type="text" class="inputBoxPass" id="email" name="email" placeholder="Email"
                            required>
                    </div><br>
                    <label for="contactNo">Contact No.</label><br>
                    <div class="password">
                        <input type="text" class="inputBoxPass" id="contactNo" name="contactNo" placeholder="091234567890"
                            required>
                    </div><br>
                    <label for="password">Password</label><br>
                    <div class="password">
                        <input type="password" class="inputBoxPass" id="password" name="password" placeholder="Password"
                            required>
                        <img src="hidden.png" onclick="pass()" class="passIcon" id="passIcon">
                    </div><br>
                    <input type="submit" class="button" id="submit" name="submit" value="Register"><br>
                    <div class="line"></div>
                    <div class="center">
                    <span>Already have an account?</span> <a class="createAcc" href="index.php">Log in now
                        🡭</a>
</div>
            </div>
        </div>
        </form>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class="footer">
    <div class="footer_container">
    <div class="footer_links">
        <h3>Contact Us</h3>
        <span>Kanlaon Cor. Don Manuel Sts. Sta.<br>
    Mesa Heights, Quezon City</span><br>
        <span>Tel. Nos. 87315127 | 87315198 |87311777</span><br>
        <span>registrar@lsqc.edu.ph | admin@lsqc.edu.ph</span><br>
</div>
    <div class="footer_links">
        <h3>Accreditations</h3>
        <p class="footer-link">PAASCU Accredited Level 3<br></p></a>
        <p class="footer-link">CEAP Member<br></p></a>
        <p class="footer-link">ESC Certified</p></a>
    </div>
    <div class="footer_links">
        <h3>Follow Us!</h3>
        <a href="" class="contact_icon"><img class="contact_icon"
            src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dbf0a2f2b67e3b3ba079c_Twitter%20Icon.svg"
            height="20px" width="20" alt="Twitter icon"></a><a href=""class="contact_icon">
          <img class="contact_icon"
            src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dbfe70fcf5a0514c5b1da_Instagram%20Icon.svg"></a>
        <a href="" class="contact_icon"><img class="contact_icon"
            src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dbe42e1e6034fdaba46f6_Facebook%20Icon.svg"></a>
        <a href="" class="contact_icon"><img class="contact_icon"
            src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dc0002f2b676eb4ba0869_LinkedIn%20Icon.svg"></a>
        <a href="" class="contact_icon"><img class="contact_icon"
            src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dc0112f2b6739c9ba0871_Pinterest%20Icon.svg"></a>
  
    </div>
</div>
</div>
</body>

</html>