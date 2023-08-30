<?php
$cmd = 'bash ./myscript.sh';

// Output buffering must be disabled to send the output immediately
ob_implicit_flush(true);
ob_end_flush();

$descriptorspec = array(
   0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
   2 => array("pipe", "w")   // stderr is a pipe that the child will write to
);

$process = proc_open($cmd, $descriptorspec, $pipes);

if (is_resource($process)) {
    while ($f = fgets($pipes[1])) {
        echo $f;
        ob_flush();
        flush();
    }
    fclose($pipes[1]);
    proc_close($process);
}
?>

