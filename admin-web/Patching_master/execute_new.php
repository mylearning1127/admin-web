<?php
$timestamp = date("Y-m-d H:i:s");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $changeNumber = $_POST["change_number"];
    $cycleName = $_POST["cycle_name"];
    $uploadedFile = $_FILES["csvFile"]["tmp_name"];
    $originalFileName = $_FILES["csvFile"]["name"];
    $destinationDirectory = "tmp/";
    $destinationPath = $destinationDirectory . $originalFileName;


    $uploadSuccess = move_uploaded_file($uploadedFile, $destinationPath);

    if (!$uploadSuccess) {
        echo "[$timestamp] [ERROR]: File upload failed.\n";
        exit;
    }

    echo "File copied to destination.\n";

    // Check if the file already exists, if yes, create a backup
    if (file_exists($destinationPath)) {
        $backupFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_backup_' . time() . '.csv';
        $backupPath = $destinationDirectory . $backupFileName;

        if (!copy($destinationPath, $backupPath)) {
            echo "File backup creation failed.\n";
            exit;
        }

        echo "File backed up successfully.\n";
    }

    // Construct the bash command
    $bashCommand = "bash ./test_new.sh $changeNumber $cycleName $destinationPath";

    echo "Starting script execution...\n";

    // Execute the bash command and capture the output
    $output = shell_exec($bashCommand);

    echo "Script execution completed.\n";

    echo $output;
}




?>

