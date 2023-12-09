<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise CSS Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .progress-bar {
            width: 100%;
            height: 20px;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .progress-segment {
            height: 100%;
            float: left;
            position: relative;
        }

        .success, .failure, .implementation {
            height: 100%;
        }

        .success {
            background-color: green;
        }

        .failure {
            background-color: red;
        }

        .implementation {
            background-color: yellow;
        }

        .tooltip {
            position: absolute;
            left: 50%;
            display: none;
            padding: 10px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            white-space: pre-wrap;
            max-width: 300px;
 	    height: 300px;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "Linux@123";
$dbname = "percentage"; // Replace with your actual database name
$tableName = "percentage"; // Replace with your actual table name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT week, success, failed, implementation FROM $tableName"); // Replace with your actual column names
    $stmt->execute();

    echo "<table style='width:100%; text-align: center;'>";
    echo "<tr>";
    echo "<th style='width:10%;'>Week</th>";
    echo "<th style='width:20%;'>Success (%)</th>";
    echo "<th style='width:20%;'>Failure (%)</th>";
    echo "<th style='width:20%;'>Implementation (%)</th>";
    echo "<th style='width:20%;'>Progress</th>";
    echo "<th style='width:15%;'>View</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $total = $row['success'] + $row['failed'] + $row['implementation'];
        $successPercentage = ($row['success'] / $total) * 100;
        $failurePercentage = ($row['failed'] / $total) * 100;
        $implementationPercentage = ($row['implementation'] / $total) * 100;

        echo "<tr>";
        echo "<td>" . $row['week'] . "</td>";
        echo "<td>" . $row['success'] . "</td>";
        echo "<td>" . $row['failed'] . "</td>";
        echo "<td>" . $row['implementation'] . "</td>";
        echo "<td>";
        echo "<div class='progress-bar' onmouseover='showTooltip(this, \"Week: " . $row['week'] . "\\nSuccess: " . $row['success'] . "%\\nFailed: " . $row['failed'] . "%\\nImplementation: " . $row['implementation'] . "%\")' onmouseout='hideTooltip()'>";
        echo "<div class='progress-segment success' style='width: " . $successPercentage . "%;'></div>";
        echo "<div class='progress-segment failure' style='width: " . $failurePercentage . "%;'></div>";
        echo "<div class='progress-segment implementation' style='width: " . $implementationPercentage . "%;'></div>";
        echo "<div class='tooltip'></div>";
        echo "</div>";
        echo "</td>";
        echo "<td>";
        echo "<a href='view_page.php?week=" . $row['week'] . "'>View Details</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<script>
    function showTooltip(element, message) {
        const tooltip = element.querySelector('.tooltip');
        tooltip.innerHTML = message;
        tooltip.style.display = 'block';
    }

    function hideTooltip() {
        const tooltips = document.querySelectorAll('.tooltip');
        tooltips.forEach(tooltip => {
            tooltip.style.display = 'none';
        });
    }
</script>

</body>
</html>

