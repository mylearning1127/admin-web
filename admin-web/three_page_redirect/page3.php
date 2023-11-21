<?php
session_start();

// Prevent caching of this page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check if access is granted
if (isset($_SESSION['access_granted']) && $_SESSION['access_granted'] === true) {
    // Page content for page3.php
} else {
    // Redirect to an appropriate page (e.g., page1.php)
    header("Location: page1.php");
    exit();
}
?>

<!-- Your page content here -->
page 3
