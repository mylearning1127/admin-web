<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Call the authentication script and capture its output
    $script_output = trim(shell_exec("./authentication_script.sh"));

    // Check if the script output is "pass"
    if ($script_output === "pass") {
        header("Location: welcome.html"); // Redirect to the welcome page
        exit();
    } else {
        $error_message = "Authentication failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <form class="login-form" method="post" action="index.php">
            <h2>Login</h2>
            <input type="text" placeholder="Username" name="username" required>
            <input type="password" placeholder="Password" name="password" required>
            <button type="submit">Login</button>
            <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>
        </form>
    </div>
</body>
</html>

