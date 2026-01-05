<?php
include 'database/Connection.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
