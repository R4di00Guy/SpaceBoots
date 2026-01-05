<?php
    session_start();
    include 'database/Connection.php';

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
    } else {
        header("Location: index.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SpaceBoots Home page</title>
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
        .main {
        display: flex;
        align-items: stretch;
        margin-left: 100px;
        gap: 20px;
        }
        .error, .success {
            /* background-color: #fff5f5; */
            font-weight: bold; 
            font-size: 18px
        }
        .error{
            color: #ff4d4d;
            text-decoration: underline;
        }
        .success{
            color: #25bb63ff;
        }
        select, button{
            background-color: white;
            border: solid rgba(98, 0, 217, 0.48) 2px;
            font-size: 17px;
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
                <a href="login.php" class="nav">Profile</a><!--link do podstrony--><div class="spaces"></div>
                <button id="themeSwitch"><img alt="light theme" class="themes" src="images/ikony/slonce.png"></button>
        </nav>
    </header>
<div class="main">
    <?php 
        $message = "";

        $product_query = $db->query("SELECT * FROM products WHERE id_product = $id");
        $product = $product_query->fetch_assoc();

        if (!$product) {
            die("Product not found!");
        }

        $options_query = $db->query("SELECT DISTINCT colors, sizes FROM sizes_colors WHERE id_product = $id");
        $options = [];
        while($opt = $options_query->fetch_assoc()) {
        $options[] = $opt;
        }


        if (isset($_POST['add_to_cart'])) {
        
            if (!isset($_SESSION['login'])) {
                header("Location: login.php");
                exit();
            }

            $user_login = $_SESSION['login'];
            $user_query = $db->query("SELECT id_client FROM clients WHERE login = '$user_login'"); 
            $user_data = $user_query->fetch_assoc();
            $id_client = $user_data['id_client'];

            // $id_product = (int)$_POST['product_id'];
            $color = $db->real_escape_string($_POST['selected_color']);
            $size = (int)$_POST['selected_size'];
            $amount = 1;

            $insert_sql = "INSERT INTO shopping_cart (id_client, id_product, amount, p_size, p_color) 
            VALUES ('$id_client', '$id', '$amount', '$size', '$color')";

            if ($db->query($insert_sql)) {
                $message = "<h5 class='success'>Product successfully added to your cart in database!</h5>";
            } else {
                $message = "<h5 class='error'>Error: " . $db->error . "</h5>";
            }
        }
    ?>

    <div class="product-info">
        <div class="image">
            <img class="product_img" src="images/buty/but<?php echo htmlspecialchars($product['id_product']); ?>.png" alt="boots">
        </div>

            <h1 style="margin: 8px 0px;"><?php echo htmlspecialchars($product['p_name']); ?></h1>
            <h5 style="font-size: 26px; margin: 0px;">Collection: <?php echo htmlspecialchars($product['p_collection']); ?></h5>
            <p class="price"><?php echo $product['p_price']; ?> zł</p>
    </div>


    <div class="options">
        <div>
            <form method="POST" action="product.php?id=<?php echo $id; ?>">
                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                <div class="selector" style="margin-bottom: 12px">
                    <label>Choose <h2 style="display: inline;">Color:</h2></label>
                    <select name="selected_color" required>
                        <?php 
                        $unique_colors = array_unique(array_column($options, 'colors'));
                        foreach($unique_colors as $color): ?>
                            <option><?php echo $color; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="selector">
                    <label>Choose <h2 style="display: inline;">Size:</h2></label>
                    <select name="selected_size" required>
                        <?php 
                        $unique_sizes = array_unique(array_column($options, 'sizes'));
                        sort($unique_sizes);
                        foreach($unique_sizes as $size): ?>
                            <option><?php echo $size; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div><button type="submit" name="add_to_cart" style="margin-top: 20px; padding: 10px 20px; cursor: pointer; ">
                    Add to shopping cart   
            <?php if ($message): ?>
                <?php echo $message; ?>
            <?php endif; ?>
                </button>

            </form>
        </div>
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
