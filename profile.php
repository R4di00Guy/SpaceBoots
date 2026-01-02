<?php
include 'database/Connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
echo "<h1>Hello, " . htmlspecialchars($_SESSION['username']) . "!</h1>";
echo "<a href='logout.php'>Log out</a>"
?>