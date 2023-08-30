<?php
$targetDirectory = 'tmp/';
$targetFile = $targetDirectory . basename($_FILES['csvFile']['name']);

if (file_exists($targetFile)) {
  // Create a backup by appending a timestamp to the filename
  $backupFile = $targetDirectory . pathinfo($targetFile, PATHINFO_FILENAME) . '_' . time() . '.' . pathinfo($targetFile, PATHINFO_EXTENSION);
  if (copy($targetFile, $backupFile)) {
    echo "Existing file backed up successfully.<br>";
  } else {
    echo "Failed to back up existing file.<br>";
  }
}

$uploadSuccess = move_uploaded_file($_FILES['csvFile']['tmp_name'], $targetFile);

if ($uploadSuccess) {
  echo "Upload successful.";
} else {
  echo "Upload failed.";
}
?>

