<?php
include 'database/Connection.php';
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}


$current_login = $_SESSION['login'];
$message = "";
$message_class = "";

$stmt = $db->prepare("SELECT id_client, name, surname, phone_nb, address, login FROM clients WHERE login = ?");
$stmt->bind_param("s", $current_login);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    die("User not found.");
}

$id_client = $user['id_client'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $new_name = $_POST['name'];
    $new_surname = $_POST['surname'];
    $new_phone = $_POST['phone_nb'];
    $new_address = $_POST['address'];
    $new_login = $_POST['login'];

    $new_name = !empty($new_name) ? $new_name : $user['name'];
    $new_surname = !empty($new_surname) ? $new_surname : $user['surname'];
    $new_phone = !empty($new_phone) ? $new_phone : $user['phone_nb'];
    $new_address = !empty($new_address) ? $new_address : $user['address'];
    $new_login = !empty($new_login) ? $new_login : $user['login'];

    if ($new_name == $user['name'] && $new_surname == $user['surname'] && $new_phone == $user['phone_nb'] && $new_address == $user['address'] && $new_login == $user['login']) 
    {
        $message = "No changes were made.";
        $message_class = "error";
    } else {
        $update_stmt = $db->prepare("UPDATE clients SET name=?, surname=?, phone_nb=?, address=?, login=? WHERE id_client=?");
        $update_stmt->bind_param("sssssi", $new_name, $new_surname, $new_phone, $new_address, $new_login, $id_client);

        if ($update_stmt->execute()) {
            $message = "Profile updated successfully!";
            $message_class = "success";
            $_SESSION['login'] = $new_login;
            $user['login'] = $new_login;
            $user['name'] = $new_name;
            $user['surname'] = $new_surname;
            $user['phone_nb'] = $new_phone;
            $user['address'] = $new_address;
        } else {
            $message = "Error updating profile: " . $db->error;
            $message_class = "error";
        }
        $update_stmt->close();
    }
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
    <script>
        function confirmChanges() {
            return confirm("Do you want to make changes?");
        }
    </script>
    <style>
        .success {
            color: #25bb63ff;
            font-weight: bold;
            text-align: center;
        }
        .error {
            color: #ff4d4d;
            font-weight: bold;
            text-align: center;
            text-decoration: underline;
            font-size: 18px; }
        table{
            margin: auto;

        }
        label{
            font-family: "Jaini", system-ui;
            font-weight: 400;
            font-style: normal;
            font-size: 24px;
        }
        .login_main input{
            font-size: 21px
        }
        table input{
            padding: 0px 0px 0px 9px
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
    <div class="main">
<h1 style="text-align: center; font-family: 'Gravitas One';">Edit Your Profile</h1>

    <?php if ($message): ?>
        <p class="<?php echo $message_class; ?>"><?php echo $message; ?></p>
    <?php endif; ?>

    <div  class="login_main">
        <form action="" method="post" onsubmit="return confirmChanges()">
            <table>
                <tr>
                    <td><label>Name:</label></td>
                    <td><input type="text" name="name" placeholder="| name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" pattern="{3, 20}"></td>
                </tr>
                <tr>
                    <td><label>Surname:</label></td>
                    <td><input type="text" name="surname" placeholder="| surname" value="<?php echo htmlspecialchars($user['surname'] ?? ''); ?>" pattern="{3, 20}"></td>
                </tr>
                <tr>
                    <td><label>Phone Number:</label></td>
                    <td><input type="text" name="phone_nb" placeholder="| phone" value="<?php echo htmlspecialchars($user['phone_nb'] ?? ''); ?>" pattern="^(?:\+48)? ?[0-9]{3}[ -]?[0-9]{3}[ -]?[0-9]{3}$"></td>
                </tr>
                <tr>
                    <td><label>Address:</label></td>
                    <td><input type="text" name="address" placeholder="| address" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>" pattern="{9, 50}"></td>
                </tr>
                <tr>
                    <td><label>Login:</label></td>
                    <td><input type="text" name="login" placeholder="| login" value="<?php echo htmlspecialchars($user['login']); ?>" pattern="(?=.*[a-z])[a-z0-9]{3,20}"></td>
                </tr>
            </table>
            <input type="submit" name="update_profile" value="Save Changes">
        </form>
        <h1 style="text-align: center;"><a href="profile.php">Back to Profile</a></h1>
    </div>

<?php
// echo "<h1>Hello, <h2 style='display: inline'>" . htmlspecialchars($_SESSION['login']) . "!</h2></h1>";
// echo "<br><a href='logout.php'>Log out</a>"
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
