<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_footer.css">
        <link rel="stylesheet" href="style_button.css">
    <script src="script.js"></script>
    <title>Lourdes School Quezon City</title>
    <link rel="icon" type="image/png" href="title_logo.png" />
</head>

<body>
    <div class="parent">
        <div class="header1"><div class="logo-div1"><a href="index.php"><img style="margin-top:3px; height:90px;" src="logo.png"></a></div></div>
        <div class="center">
            <div class="child">
                <div class="signIn">
                    <p class="big">Sign In</p>
                    <p>Pax Et Bonum!</p>
                </div>
                <br>

                <?php if(isset($_SESSION['error'])){
    echo '<div class="invalidCreds" id="invalidCreds"><span class="invalid">Invalid or wrong credentials</span>
    <img src="close.png" onclick="hideDiv()" class="invalidIcon" id="invalidIcon">
</div>';
    unset($_SESSION['error']);
}?>

                <br>
                <form action="login.php" method="POST">
                    <label for="email">Email</label><br>
                    <input type="text" class="inputBox" id="email" name="email" placeholder="Email" required>
                    <br>
                    <label for="password">Password</label><br>
                    <div class="password">
                        <input type="password" class="inputBoxPass" id="password" name="password" placeholder="Password"
                            required>
                        <img src="hidden.png" onclick="pass()" class="passIcon" id="passIcon">
                    </div><br>
                    <div class="row">
                    </div><br>
                    <input type="submit" class="button" value="Login"><br>
                    <div class="line"></div>
                    <div class="row" style="justify-content:space-between;">
                        <div class="column" style="align-items:center; display:flex;">Not registered yet?</div>
                        <div class="column" style="width:fit-content"><a style="margin-bottom:5px;" class="createAcc" href="registration.php"><span>Create an account🡭</span></a></div>
</div>
            </div>
        </div>
        </form>
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
                            height="20px" width="20" alt="Twitter icon"></a><a href="" class="contact_icon">
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
        <div class="copyright">Copyright © 2024 - Lourdes School Quezon City. All Rights Reserved</div>
    </div>



</body>

</html>