<?php
session_start(); 
include 'database/Connection.php';

$collections = $db->query("SELECT DISTINCT p_collection FROM products");
$colors = $db->query("SELECT DISTINCT colors FROM sizes_colors");
$sizes = $db->query("SELECT DISTINCT sizes FROM sizes_colors ORDER BY sizes ASC");

$sql = "SELECT DISTINCT p.id_product, p.p_name, p.p_collection, MIN(p.p_price) as p_price 
        FROM products p 
        LEFT JOIN sizes_colors sc ON p.id_product = sc.id_product 
        WHERE 1=1";

if (!empty($_GET['type'])) {
    $type = $db->real_escape_string($_GET['type']);
    $sql .= " AND p.p_collection = '$type'";
}

if (!empty($_GET['colour'])) {
    $colour = $db->real_escape_string($_GET['colour']);
    $sql .= " AND sc.colors = '$colour'";
}

if (!empty($_GET['size'])) {
    $size = (int)$_GET['size'];
    $sql .= " AND sc.sizes = $size";
}

if (!empty($_GET['price_en'])) {
    $price_to = (float)$_GET['price_en'];
    $sql .= " AND p.p_price <= $price_to";
}

$sql .= " GROUP BY p.id_product";

$result = $db->query($sql);
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
        .container {
            margin: 20px 0px 8px 16px;
            height: 267px;
            float: left;
            width: 21%;
            background-color: #FFEA9461;
            border-radius: 1%;
            border: 5px solid black;
            text-align: left;
            overflow: hidden;
            padding: 0px 0px 0px 1%;
        }
        .container h3{margin-bottom: 0;}
        .container h4{margin-top: 0;}
        .product_img_cont{
            width: 142%;
            position: relative;
            max-height: 150px;
            margin-bottom: 14px;
        }
        .product_img{
            width: 200px;
        }

        .main::after { content: ""; display: table; clear: both; }
    </style>
</head>
<body>
    <header>
        <a href="home.html" class="logo"><img src="images/SpaceBoots_logo2.png"></a>
        <nav>
                <a href="#" class="nav"><img id="cart" alt="shopping cart" src='images/ikony/koszyk.png'></a><div class="spaces"></div>
                <a href="aboutus.html" class="nav">About us</a><div class="spaces"></div>
                <a href="contact.html" class="nav">Contact</a><div class="spaces"></div>
                <a href="profile.php" class="nav">Profile</a><div class="spaces"></div>
                <button id="themeSwitch"><img alt="light theme" class="themes" src="images/ikony/slonce.png"></button>
        </nav>
    </header>
    <div class="main" id="home" style="margin-left: 100px;">

    <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="container">
                    <h5 style="font-size: 28px; margin: 0px; padding: 0px; margin-top: 6px"><?php echo htmlspecialchars($row['p_name']); ?></h5>
                    
                    <div class="product_img_cont">
                        <img class="product_img" src="images/buty/but<?php echo $row['id_product']; ?>.png" alt="boots">
                    </div>
                    
                    <h4><?php echo $row['p_price']; ?> zł</h4>
                    
                    <?php if(isset($_SESSION['username'])): ?>
                         <button style="font-family: 'Inter'; font-size: 10px; cursor: pointer;">Add to cart</button>
                    <?php endif; ?>
                </div>
                <?php
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>

    </div>
    <style>
        .filters h1{font-family: "Gravitas One", serif;}
        .filters label{font-family: "Jaini", system-ui;font-size: 23px; margin: 10px;}
        .filters input,select{width: 70px; font-family: Gelasio; font-size: 16px;}
    </style>
    <div class="filters">
        <h1>Filters:</h1>
        <form method="GET" action="index.php">
            <table>
                <tr>
                    <td><label for="size">Size:</label></td>
                    <td>
                        <select name="size">
                            <option value="">Any</option>
                            <?php while($s = $sizes->fetch_assoc()): ?>
                                <option value="<?php echo $s['sizes']; ?>" <?php if(isset($_GET['size']) && $_GET['size'] == $s['sizes']) echo 'selected'; ?>>
                                    <?php echo $s['sizes']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><label for="colour">Colour:</label></td>
                    <td>
                        <select name="colour">
                            <option value="">Any</option>
                            <?php while($c = $colors->fetch_assoc()): ?>
                                <option value="<?php echo $c['colors']; ?>" <?php if(isset($_GET['colour']) && $_GET['colour'] == $c['colors']) echo 'selected'; ?>>
                                    <?php echo $c['colors']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><label for="type">Type:</label></td>
                    <td>
                        <select name="type">
                            <option value="">Any</option>
                            <?php while($coll = $collections->fetch_assoc()): ?>
                                <option value="<?php echo $coll['p_collection']; ?>" <?php if(isset($_GET['type']) && $_GET['type'] == $coll['p_collection']) echo 'selected'; ?>>
                                    <?php echo $coll['p_collection']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><label>Price to:</label></td>
                    <td><input type="number" name="price_en" value="<?php echo $_GET['price_en'] ?? ''; ?>"></td>
                </tr>
            </table>
                <button type="submit" style="margin-top: 10px; cursor: pointer;">Apply Filters</button>
                <a href="index.php" style="font-size: 12px; margin-left: 10px;">Reset</a>
        </form>
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


