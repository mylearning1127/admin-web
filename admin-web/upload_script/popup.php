<?php
// Check if the request comes from the main HTML page
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

// Replace this with the actual URL of your main HTML page
$validReferer = 'http://192.168.72.128/admin-web/upload_script/index.html';

if ($referer !== $validReferer) {
    echo "Access denied. Please start the script from the main page.";
    exit;
}

$cmd = 'bash ./test.sh';

while (@ob_end_flush()); // end all output buffers if any

$proc = popen($cmd, 'r');
echo '<pre>';
while (!feof($proc))
{
    echo fread($proc, 4096);
    @flush();
}
echo '</pre>';
?>


