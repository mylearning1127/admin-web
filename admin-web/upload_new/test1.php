<!DOCTYPE html>
<html>
<head>
<style>
.output-box {
    border: 1px solid #ccc;
    padding: 10px;
    background-color: #f9f9f9;
    width: 80%;
    margin: 0 auto;
    white-space: pre-wrap;
    font-family: monospace;
    overflow: auto;
    height: 400px;
}
</style>
<script>
function updateOutput(data) {
    const outputDiv = document.getElementById("output");
    outputDiv.innerHTML += data + "\n";
    outputDiv.scrollTop = outputDiv.scrollHeight;
}

const evtSource = new EventSource("update1.php");
evtSource.onmessage = function(event) {
    updateOutput(event.data);
};
</script>
</head>
<body>
<div class="output-box" id="output"></div>
</body>
</html>

