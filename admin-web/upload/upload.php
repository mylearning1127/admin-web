<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$targetDirectory = 'tmp/'; // Set the path to your upload directory
$targetFile = $targetDirectory . basename($_FILES['csvFile']['name']);
$uploadSuccess = move_uploaded_file($_FILES['csvFile']['tmp_name'], $targetFile);

if ($uploadSuccess) {
    echo "File uploaded successfully.";
} else {
    echo "File upload failed.";
}
?>

