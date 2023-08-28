<?php
if ($argc !== 2) {
    echo "Usage: php your_script.php <csv_path>";
    exit(1);
}

$csvPath = $argv[1];
$outputFile = "output.txt";

// Your processing logic here...

// Open the output file in append mode
$outputHandle = fopen($outputFile, "a");

for ($i = 0; $i < 100; $i++) {
    $output = "Line $i processed.\n"; // Replace with your actual processing logic
    echo $output; // Print to console
    fwrite($outputHandle, $output); // Write to the output file
    fflush($outputHandle); // Flush the output to the file
    sleep(6); // Sleep for 6 seconds, simulate processing time
}

fclose($outputHandle);

echo "Script completed!";
?>

