<?php
include 'database/Connection.php';
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SpaceBoots test Home page</title>
    <link href="styles.css" rel="stylesheet">
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
    <style>
        h4, .data{
            display: inline;
            font-weight: bold
        }
        #name{
            text-transform: capitalize;
        }
        h4{
            font-size: 26px;
        }
        td{
            width: 61%;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.php" class="logo"><img src="images/SpaceBoots_logo2.png" alt="SpaceBoots Logo"></a>
        <nav>
                <a href="ShoppingCart.php" class="nav"><img id="cart" alt="shopping cart" src='images/ikony/koszyk.png'></a><div class="spaces"></div>
                <a href="aboutus.html" class="nav">About us</a><div class="spaces"></div>
                <a href="contact.html" class="nav">Contact</a><div class="spaces"></div>
                <span class="the_choosen_one"><a href="profile.php" class="nav">Profile</a></span><div class="spaces"></div>
                <button id="themeSwitch"><img alt="light theme" class="themes" src="images/ikony/slonce.png"></button>
        </nav>
    </header>
    <div class="main" style="padding: 24px; width: fit-content;">


<?php
echo "<h1 style='display: inline'>Hello, <h2 style='display: inline'>" . htmlspecialchars($_SESSION['login']) . "!</h2></h1>";

    $user_login = $_SESSION['login'];
    $dataQ = $db->query("SELECT * FROM clients WHERE login = '$user_login'");
    $profile = $dataQ->fetch_assoc();

    if (!$profile) {
        die("Strange thing.... No data found!");
    }
    if (!$profile['name']){
        $profile['name']="noname";
    }
    if (!$profile['address']){
        $profile['address']="No home";
    }


?>
<p></p><br><p></p>
<table>
    <tr>
        <td><h4>Your name and surname: </h4></td>
        <td><div class="data" id="name"><?php echo htmlspecialchars($profile['name'])?> <?php echo htmlspecialchars($profile['surname'])?></div></td>
    </tr>
    <tr>
        <td><h4>Your email: </h4></td>
        <td><div class="data"><?php echo htmlspecialchars($profile['mail'])?></div></td>
    </tr>
    <tr>
        <td><h4>Your phone number: </h4></td>
        <td><div class="data"><?php echo htmlspecialchars($profile['phone_nb'])?></div></td>
    </tr>
    <tr>
        <td><h4>Your address: </h4></td>
        <td><div class="data"><?php echo htmlspecialchars($profile['address'])?></div></td>
    </tr>
</table>

<h1><a href="ChangeProfile.php">Change your profile data</a></h1>


<?php
echo "<h2 style='margin: 23px 0px 0px 0px;'><a href='logout.php'>Log out</a></h2>";
?>


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
                <li><a href="#"><img src="images/ikony/facebook.png" alt="Facebook" class="icon"></a></li>
                <li><a href="#"><img src="images/ikony/instagram.png" alt="Instagram" class="icon"></a></li>
                <li><a href="#"><img src="images/ikony/twitter.png" alt="Twitter" class="icon"></a></li>
            </ul>
        </div>
        <div class="copyrights">
            <h4>spaceboots&copy;, 2025</h4>
        </div>
    </footer>
    
</body>

</html>
