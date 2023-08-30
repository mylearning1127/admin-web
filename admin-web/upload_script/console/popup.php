<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cycleName = $_POST["fname"];
    $changeNumber = $_POST["lname"];

    // Construct the command to execute the Bash script
    $command = "bash ./test.sh " . escapeshellarg($cycleName) . " " . escapeshellarg($changeNumber);
    
    // Execute the command and capture output
    $output = shell_exec($command);

    // Return the captured output
    echo $output;
}
?>

