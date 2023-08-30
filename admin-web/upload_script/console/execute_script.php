<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $changeNumber = $_POST["change_number"];
    $cycleName = $_POST["cycle_name"];
    $file = $_POST["file"];

    // Construct the bash command
    $bashCommand = "bash ./test.sh $changeNumber $cycleName $file";

    // Execute the bash command and capture the output
    $output = shell_exec($bashCommand);

    echo $output;
}
?>

