<?php

echo "loaded<br><br>";

$cmd = 'bash ./myscript.sh';
$run = $cmd . ' > result.txt 2> errors.txt';
$output = shell_exec($run);

$results = file_get_contents('result.txt');
if (strlen(file_get_contents('errors.txt')) != 0) {
  $results .= file_get_contents('errors.txt');
}

echo "<pre>$results</pre>";

?>
