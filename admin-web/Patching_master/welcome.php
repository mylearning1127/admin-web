<?php
session_start();

if (!isset($_SESSION["authenticated"]) || !$_SESSION["authenticated"]) {
    header("Location: index.php"); // Redirect to login if not authenticated
    exit();
}

// Logout functionality
if (isset($_GET["logout"])) {
    session_unset();    // Unset all session variables
    session_destroy();  // Destroy the session
    header("Location: index.php"); // Redirect to login page after logout
    exit();
}

// Check for inactivity timeout
$inactive_timeout = 120; // 2 minutes
if (isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"] > $inactive_timeout)) {
    session_unset();    // Unset all session variables
    session_destroy();  // Destroy the session
    header("Location: index.php"); // Redirect to login page due to inactivity
    exit();
}

$_SESSION["last_activity"] = time(); // Update last activity timestamp
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Welcome Page</title>
</head>
<body>
    <div class="container">
        <h2>Welcome</h2>
        <p>This is the welcome page. Only accessible after successful login.</p>
        <a href="?logout">Logout</a>
    </div>
    <script>
        // JavaScript code for automatic logout after inactivity
        var timeout = setTimeout(function() {
            window.location.href = 'welcome.php?logout';
        }, <?php echo ($inactive_timeout * 1000); ?>); // Convert seconds to milliseconds
        
        // Function to clear the automatic logout timeout on user interaction
        function resetTimeout() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                window.location.href = 'welcome.php?logout';
            }, <?php echo ($inactive_timeout * 1000); ?>); // Convert seconds to milliseconds
        }

        // Attach the resetTimeout function to user interactions
        window.addEventListener("mousemove", resetTimeout);
        window.addEventListener("keydown", resetTimeout);
    </script>
</body>
</html>

