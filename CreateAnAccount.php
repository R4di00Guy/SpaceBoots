<?php
include 'database/Connection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $qCheckEmail = $db -> prepare("SELECT email FROM clients WHERE email = ?");
    $qCheckEmail -> bind_param("s", $email);
    $qCheckEmail -> execute();
    $qCheckEmail -> store_result();

    if ($checkEmailStmt->num_rows > 0) {
        $message = "Email ID already exists";
    }
    else {
        $stmt = $db -> prepare("INSERT INTO clients (login, mail, phone_nb, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $phone, $password);

        if ($stmt->execute()) {
            $message = "Account created successfully";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $qCheckEmail->close();
    $db->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SpaceBoots Login</title>
    <link href="styles.css" rel="stylesheet">
    <html lang="en">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jaini&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IM+Fell+Great+Primer+SC&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gravitas+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gelasio:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
<script src="JavaScript/jquery-3.7.1.js"></script>
<script src="JavaScript/scripts.js"></script>
</head>
<body>
    <header>
        <a href="space_boots_home.html" class="logo"><img src="images/SpaceBoots_logo2.png"></a>
        <!--logo--> 
        <nav>
                <a href="#" class="nav"><img id="cart" alt="shopping cart" src='images/ikony/koszyk.png'></a><!--koszyk--><div class="spaces"></div>
                <a href="#" class="nav">Category</a><!--dropdown menu?--><div class="spaces"></div>
                <a href="aboutus_SpaceBoots.html" class="nav">About us</a><!--link do podstrony--><div class="spaces"></div>
                <a href="contact_SpaceBoots.html" class="nav">Contact</a><!--link do podstrony--><div class="spaces"></div>
                <a href="#" class="nav">Profile</a><!--link do podstrony--><div class="spaces"></div>
                <button id="themeSwitch"><img alt="light theme" class="themes" src="images/ikony/slonce.png"></button>
        </nav>
    </header>
    <div class="main" id="log-sig">
        <div class="login_head">
           <h1>Log in  or Sign in</h1>
           <h2><a href="">to make an order</a></h2> 
        </div>
        <div class="login_main">
            <h1>Sign in</h1>
            <?php if ($message): ?>
            <?php echo $message; ?>
            <?php endif; ?>
            <form action="" onsubmit=""  method="post">
                <input type="text" name="username" placeholder="| username"  style="font-size: 18px;" required>
                <input type="text" name="email" placeholder="| email"  style="font-size: 18px;" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                <input type="text" name="phone" placeholder="| phone number"  style="font-size: 18px;" pattern="^(?:\+48)? ?[0-9]{3}[ -]?[0-9]{3}[ -]?[0-9]{3}$" required>
                <input type="password" name="password" pattern="(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%^&*(),?\[\]{}<>]).{10,30}" placeholder="| password"  style="font-size: 18px;" required>
                <input type="submit" name="reg" id="reg" value="Create an account>
            </form><br>
            <div class="line"></div><!--idk how to make those stripes-->
            <div style="margin-top: -27px;"><h2 id="orsign" style="background-color: #fff; display: block; width: fit-content; margin: auto;">OR</h2></div>
            <h1><a href="login_SpaceBoots.html">Log in</a></h1>
            <h4>Problems? <a href="contact_SpaceBoots.html">Contact us.</a></h4>
        </div>
    </div>
    <footer id="homef">
        <div class="footerlogo">
            <a href="space_boots_home.html" class="logo"><img src="images/SpaceBoots_logo2.png"></a>
        </div>

        <div class="afterwords">
            <table>
                <tr><td><b>Topic</b></td><td><b>Topic</b></td><td><b>Topic</b></td></tr>
                <tr><td><a href="">Page</a></td><td><a href="">Page</a></td><td><a href="">Page</a></td></tr>
                <tr><td><a href="">Page</a></td><td><a href="">Page</a></td><td><a href="">Page</a></td></tr>
                <tr><td><a href="">Page</a></td><td><a href="">Page</a></td><td><a href="">Page</a></td></tr>
            </table>
        </div>
        
        <div class="socials">
            <ul>
                <li><a href="#"><img src="images/ikony/facebook.png" alt="Facebook"></a></li>
                <li><a href="#"><img src="images/ikony/instagram.png" alt="Instagram"></a></li>
                <li><a href="#"><img src="images/ikony/twitter.png" alt="Twitter"></a></li>
            </ul>
        </div>
        <div class="copyrights">
            <h4>spaceboots&copy;, 2025</h4>
        </div>
    </footer>
    
</body>

</html>
