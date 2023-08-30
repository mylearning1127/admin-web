<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Run the Bash script and capture its output
  $output = shell_exec('bash test.sh'); // Replace with the actual script name

  // Send the output back to the client
  echo $output;
}
?>

