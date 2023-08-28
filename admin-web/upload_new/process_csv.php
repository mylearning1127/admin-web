<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_FILES["csv_file"]["error"] === UPLOAD_ERR_OK) {
        $targetPath = "tmp/" . basename($_FILES["csv_file"]["name"]);

        if (move_uploaded_file($_FILES["csv_file"]["tmp_name"], $targetPath)) {
            // Start the Bash script in the background and capture its output
            $outputFile = "output.txt";
            $command = "bash test.sh " . escapeshellarg($targetPath) . " > $outputFile 2>&1 &";
            exec($command);

            echo "Script started...";
        } else {
            echo "Error copying the CSV file.";
        }
    } else {
        echo "Error uploading the CSV file.";
    }
}
?>

