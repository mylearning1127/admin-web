<?php
$targetDir = "tmp/";  // Temporary directory

if (isset($_FILES['uploadedFile'])) {
    $uploadedFile = $_FILES['uploadedFile'];
    $originalFileName = $uploadedFile['name'];
    $targetPath = $targetDir . $originalFileName;

    if (file_exists($targetPath)) {
        $backupPath = $targetDir . "backup_" . time() . "_" . $originalFileName;
        rename($targetPath, $backupPath);
    }

    move_uploaded_file($uploadedFile['tmp_name'], $targetPath);

    // Simulate script output
    echo "1\n2\n"; // Output: 1 followed by a newline, then 2 followed by a newline
} else {
    echo "No file uploaded.";
}
?>

