<!-- execute.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Script Output</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <pre id="output"></pre>

    <script>
        function updateOutput() {
            $.ajax({
                url: 'get_output.php',
                success: function(data) {
                    $('#output').html(data);
                },
                complete: function() {
                    setTimeout(updateOutput, 1000);
                }
            });
        }

        updateOutput();
    </script>
</body>
</html>

