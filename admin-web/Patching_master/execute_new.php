<?php
date_default_timezone_set('America/New_York');
$timestamp = date("Y-m-d H:i:s");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $changeNumber = $_POST["change_number"];
    $cycleName = $_POST["cycle_name"];
    $uploadedFile = $_FILES["csvFile"]["tmp_name"];
    $originalFileName = $_FILES["csvFile"]["name"];
    $destinationDirectory = "tmp/";
    $destinationPath = $destinationDirectory . $originalFileName;
    $startdate = $_POST["startdate"];
    $enddate = $_POST["enddate"];


    $uploadSuccess = move_uploaded_file($uploadedFile, $destinationPath);

    if (!$uploadSuccess) {
        echo "[$timestamp] [ERROR]: File upload failed.\n";
        exit;
    }
    echo "[$timestamp] [SUCCESS]: File copied to destination.\n";

    // Check if the file already exists, if yes, create a backup
    if (file_exists($destinationPath)) {
        $backupFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_backup_' . time() . '.csv';
        $backupPath = $destinationDirectory . $backupFileName;

        if (!copy($destinationPath, $backupPath)) {
            echo "[$timestamp] [ERROR]: File backup creation failed.\n";
            exit;
        }

        echo "[$timestamp] [SUCCESS]: File backed up successfully.\n\n";
    }

    // Construct the bash command
    $bashCommand = "bash ./test_new.sh $changeNumber $cycleName $destinationPath $startdate $enddate";

    echo "[$timestamp] [INFO]: Starting script execution.\n";

    // Execute the bash command and capture the output
    $output = shell_exec($bashCommand);

    echo "[$timestamp] [INFO]: Script execution completed.\n\n";

    echo $output;
}




?>

