<?php
include 'database/Connection.php';
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db -> prepare("SELECT password FROM clients WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_password);
        $stmt->fetch();

        if(password_verify($password, $db_password)){
            $message = "Login successful";
            // session_start();
            $_SESSION['login'] = $login;
            header("Location: profile.php");
            exit();
        } 
        else {
            $message = "Incorrect password";
            $error_class = "input-error";
        }
    } 
    else {
        $message = "Login not found";
        $error_class = "input-error";
    }

    $stmt->close();
    $db->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SpaceBoots Login</title>
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
        input:not(:placeholder-shown):invalid {
            border: 2px solid #ff4d4d !important;
            background-color: #fff5f5;
        }

        input:focus:invalid {
            outline: none;
            box-shadow: 0 0 5px #ff4d4d;
        }

        input:not(:placeholder-shown):valid {
            border: 2px solid #25bb63ff;
        }


        .input-error {
            color: #ff4d4d;
            text-decoration: underline;
            /* background-color: #fff5f5; */
            font-weight: bold; 
            font-size: 18px
        }
    </style>
</head>
<body>
    <header>
        <a href="index.php" class="logo"><img src="images/SpaceBoots_logo2.png" alt="SpaceBoots Logo"></a>
        <!--logo--> 
        <nav>
                <a href="ShoppingCart.php" class="nav"><img id="cart" alt="shopping cart" src='images/ikony/koszyk.png'></a><!--koszyk--><div class="spaces"></div>
                <a href="aboutus.html" class="nav">About us</a><!--link do podstrony--><div class="spaces"></div>
                <a href="contact.html" class="nav">Contact</a><!--link do podstrony--><div class="spaces"></div>
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
            <h1>Log in</h1>
            <form action="" onsubmit="" method="post">
                <?php if ($message): ?>
                    <h5 class="input-error"><?php echo $message; ?></h5>
                    <!-- <?php echo $message; ?> -->
                <?php endif; ?>
                <input type="text" name="login" placeholder="| login" style="font-size: 18px;" pattern="(?=.*[a-z])[a-z0-9]{3,20}" required>
                <input type="password" name="password" placeholder="| password" style="font-size: 18px;" pattern="(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%^&*(),?\[\]{}<>]).{10,30}" required>
                <a href="contactus.html" id="log_password">Forgot password?</a>
                <input type="submit" name="log_login_inp" id="log_login_inp" value="Log in">
            </form><br>
            <div class="line"></div>
            <div style="margin-top: -27px;"><h2 id="orsign" style="background-color: #fff; display: block; width: fit-content; margin: auto;">OR</h2></div>
            <h1><a href="CreateAnAccount.php">Create an account</a></h1>
            <h4>Problems? <a href="contactus.html">Contact us.</a></h4>
        </div>
    </div>
    <footer id="homef">
        <div class="footerlogo">
            <a href="home.html" class="logo"><img src="images/SpaceBoots_logo2.png"></a>
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

