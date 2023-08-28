<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Call the authentication script and capture its output
    $script_output = trim(shell_exec("./authentication_script.sh $username $password"));

    // Check if the script output is "pass"
    if ($script_output === "pass") {
        $_SESSION["authenticated"] = true; // Mark user as authenticated
        header("Location: welcome.php"); // Redirect to the welcome page
        exit();
    } else {
        $error_message = "Authentication failed. Please try again.";
    }
}

if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]) {
    header("Location: welcome.php"); // Redirect to the welcome page if authenticated
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>

/* Reset some default styles */
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Bitter', serif;
}


body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f4f4f4;
}

.login-form {
    margin-top: 0%;
    background-color: #ffffff;
    padding: 25px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    width: 25%;
}

.login-form h2 {
    text-align: center;
    margin-bottom: 15px;
}

.login-form input {
    width: 90%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.login-form button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.login-form button:hover {
    background-color: #0056b3;
}


</style>

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

