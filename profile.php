<?php
include 'database/Connection.php';

if (!isset($_SESSION['login'])) {
    // header("Location: login.php");
    exit();
}
echo "<h1>Hello, " . htmlspecialchars($_SESSION['login']) . "!</h1>";
echo "<a href='logout.php'>Log out</a>"
?>