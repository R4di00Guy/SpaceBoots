<?php
include 'database/Connection.php';
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$user_login = $_SESSION['login'];

$client_query = $db->prepare("SELECT id_client FROM clients WHERE login = ?");
$client_query->bind_param("s", $user_login);
$client_query->execute();
// $client_data = $client_query->get_result()->fetch_assoc();

// if (!$client_data) {
//     die("Error: Client not found in database for login: " . htmlspecialchars($user_login));
// }
$id_client = $client_query->get_result()->fetch_assoc()['id_client'];

if (isset($_GET['remove'])) {
    $remove_id = (int)$_GET['remove'];
    $db->query("DELETE FROM shopping_cart WHERE id_shopping_cart = $remove_id AND id_client = $id_client");
    header("Location: ShoppingCart.php");
    exit();
}

$sql = "SELECT sc.id_shopping_cart, sc.amount, sc.p_size, sc.p_color, p.id_product, p.p_name, p.p_price 
        FROM shopping_cart sc 
        JOIN products p ON sc.id_product = p.id_product 
        WHERE sc.id_client = ? AND sc.ordered = 0";


$stmt = $db->prepare($sql);
if (!$stmt) {
    die("SQL Error: " . $db->error);
}
$stmt->bind_param("i", $id_client);
$stmt->execute();
$cart_result = $stmt->get_result();

$total_price = 0;
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
        img.boot{
            max-width: 200px;
        }
        button{
            background-color: white;
            border: solid rgba(98, 0, 217, 0.48) 2px;
            font-size: 17px;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.php" class="logo"><img src="images/SpaceBoots_logo2.png" alt="SpaceBoots Logo"></a>
        <nav>
                <span class="the_choosen_one"><a href="ShoppingCart.php" class="nav"><img id="cart" alt="shopping cart" src='images/ikony/koszyk.png'></a></span><div class="spaces"></div>
                <a href="aboutus.html" class="nav">About us</a><div class="spaces"></div>
                <a href="contact.html" class="nav">Contact</a><div class="spaces"></div>
                <a href="profile.php" class="nav">Profile</a><div class="spaces"></div>
                <button id="themeSwitch"><img alt="light theme" class="themes" src="images/ikony/slonce.png"></button>
        </nav>
    </header>
    <div class="main" style="padding: 24px; width: fit-content;">

    <?php if ($cart_result->num_rows > 0): ?>
        <table class="cart-table">
                <tr>
                    <th>Product</th>
                    <th>Info</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
                <?php while($item = $cart_result->fetch_assoc()): 
                    $subtotal = $item['p_price'] * $item['amount'];
                    $total_price += $subtotal;
                ?>
                    <tr>
                        <td>
                            <img class="boot" src="images/buty/but<?php echo $item['id_product']; ?>.png" class="product-img-small" alt="boot">
                        </td>
                        <td>
                            <strong style="font-size: 18px;"><?php echo htmlspecialchars($item['p_name']); ?></strong><br>
                            <span style="font-size: 14px; color: #666;">Color: <?php echo $item['p_color']; ?>, Size: <?php echo $item['p_size']; ?></span>
                        </td>
                        <td><?php echo number_format($item['p_price'], 2); ?> zł</td>
                        <td><?php echo $item['amount']; ?></td>
                        <td><strong><?php echo number_format($subtotal, 2); ?> zł</strong></td>
                        <td>
                            <a href="ShoppingCart.php?remove=<?php echo $item['id_shopping_cart']; ?>" class="remove-btn" onclick="return confirm('Remove this item?')">Remove</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>

            <div class="total-section">
                <p>Total: <strong><?php echo number_format($total_price, 2); ?> zł</strong></p>
                <button class="checkout-btn">Proceed to Checkout</button>
            </div>

        <?php else: ?>
            <div style="text-align: center; margin-top: 50px;">
                <h4 style="font-size: 26px">Your cart is empty...</h2>
                <a href="index.php" style="color: #000;">Go shopping!</a>
            </div>
        <?php endif; ?>
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
                <li><a href="#"><img src="images/ikony/facebook.png" alt="Facebook" class="icon" class="icon"></a></li>
                <li><a href="#"><img src="images/ikony/instagram.png" alt="Instagram" class="icon" class="icon"></a></li>
                <li><a href="#"><img src="images/ikony/twitter.png" alt="Twitter" class="icon" class="icon"></a></li>
            </ul>
        </div>
        <div class="copyrights">
            <h4>spaceboots&copy;, 2025</h4>
        </div>
    </footer>
    
</body>

</html>

