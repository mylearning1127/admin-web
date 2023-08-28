<?php
$targetDirectory = 'tmp/';
$backupDirectory = 'tmp/';
$targetFile = basename($_FILES['csvFile']['name']); // Use only the filename

// Check if the file already exists
if (file_exists($targetDirectory . $targetFile)) {
    $backupTimestamp = time();
    $backupFile = $backupDirectory . $targetFile . '_' . $backupTimestamp . '.bak';
    copy($targetDirectory . $targetFile, $backupFile);
}

$uploadSuccess = move_uploaded_file($_FILES['csvFile']['tmp_name'], $targetDirectory . $targetFile);

if ($uploadSuccess) {
    echo "File uploaded successfully.";

    // Execute the Bash script
    $bashScriptOutput = shell_exec('./test.sh 2>&1');

    // Save Bash script output to a log file
    file_put_contents('output.log', $bashScriptOutput);
} else {
    echo "File upload failed.";
}
?>

