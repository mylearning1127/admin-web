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
            height: 12px;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .progress-segment {
            height: 100%;
            float: left;
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

        tr:hover {
            background-color: #f5f5f5;
        }

        .tooltip {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 5px;
            z-index: 1;
        }
    </style>

    <script>
        function showTooltip(element, week, success, failed, implementation) {
            var tooltip = document.createElement("div");
            tooltip.innerHTML = "Week: " + week + "<br>Success: " + success + "<br>Failed: " + failed + "<br>Implementation: " + implementation;
            tooltip.className = "tooltip";
            element.appendChild(tooltip);
        }

        function hideTooltip() {
            var tooltips = document.querySelectorAll(".tooltip");
            tooltips.forEach(function (tooltip) {
                tooltip.parentNode.removeChild(tooltip);
            });
        }
    </script>
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
        echo "<td onmouseover='showTooltip(this, \"$row[week]\", $row[success], $row[failed], $row[implementation])' onmouseout='hideTooltip()'>";
        echo "<div class='progress-bar'>";
        echo "<div class='progress-segment success' style='width: " . $successPercentage . "%;'></div>";
        echo "<div class='progress-segment failure' style='width: " . $failurePercentage . "%;'></div>";
        echo "<div class='progress-segment implementation' style='width: " . $implementationPercentage . "%;'></div>";
        echo "</div>";
        echo "</td>";
        echo "<td>";
	echo "<a href='" . $row['week'] . ".php'>View Report</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

</body>
</html>

