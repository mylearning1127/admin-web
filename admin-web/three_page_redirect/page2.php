<?php
session_start();
$_SESSION['access_granted'] = true; // Grant access to page3.php
?>

<!-- Your page content here -->
<a href="page3.php">Go to page 3</a>

