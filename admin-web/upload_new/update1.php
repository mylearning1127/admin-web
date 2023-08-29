<?php
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
header("Connection: keep-alive");

$command = "bash ./test.sh";
$handle = popen($command, "r");

while (!feof($handle)) {
    $output = fgets($handle);
    echo "data: " . $output . "\n\n";
    flush();
    ob_flush();
    usleep(100000); // Adjust sleep time as needed
}

pclose($handle);
?>

