<html>
<?php
$command = "bash ./test.sh";
$handle = popen($command, "r");

while (!feof($handle)) {
    $output = fgets($handle);
    echo $output . "<br>";
    flush();
}

pclose($handle);
?>
</html>
