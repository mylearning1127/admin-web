<!DOCTYPE html>
<html>
<head>
<title>Patch Report</title>

<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<style>
h1 {
    text-align: center;
}

body {
    background-color: white;
    font-family: "SERIF", Bodoni MT;
}

input[type=button], input[type=submit], input[type=reset] {
    background-color: #04AA6D;
    border: none;
    color: white;
    padding: 6px 8px;
    text-decoration: none;
    margin: 0px 740px;
    cursor: pointer;
    font-weight: bold;
}

.tbcustom th, .tbcustom td {
    background-color: #eaeded;
    color: #17202a;
    font-size: 14px;
    font-family: 'Courier New';
    padding: 8px;
}

.tbcustom th {
    background-color: #2c3e50;
    color: white;
    font-size: 15px;
}

.red-column {
    background-color: red !important;
    color: white !important;
}

.search-bar {
    box-sizing: border-box;
    width: 100%; /* Set initial width to 100% */
}

.highlight {
    color: red;
    font-weight: bold;
}

</style>
</head>
<body>

<h1 style="background: #E1DACE; color: #34495e; padding:10px 20px; text-align: center; font-size: 20px;">Linux Basic Details - Monthly Report</h1>
<form action="Linux_basic_info.php">
    <input type="submit" value="Export" align="right" />
</form>

<form method="post">
    <table>
        <tr>
            <?php
            $columnHeaders = ["Year", "Industry_aggregation_NZSIOC", "Industry_code_NZSIOC", "Industry_name_NZSIOC", "Units", "Variable_code", "Variable_name", "Variable_category", "Value"];
            
            foreach ($columnHeaders as $columnHeader) {
                echo "<th></th>";
            }
            ?>
        </tr>
        <tr>
            <?php
            foreach ($columnHeaders as $columnHeader) {
                echo "<td><input class='search-bar' type='text' name='search[$columnHeader]'></td>";
            }
            ?>
            <td><input type="submit" value="Search"></td>
        </tr>
    </table>
</form>

<script>
window.onload = function() {
    const columnHeaders = document.querySelectorAll('.tbcustom th');
    const searchBars = document.querySelectorAll('.search-bar');

    for (let i = 0; i < columnHeaders.length; i++) {
        searchBars[i].style.width = columnHeaders[i].clientWidth + 'px';
    }
};
</script>

<?php
$servername = "localhost";
$username = "root";
$password = "Linux@123";
$dbname = "test";

$highlightWords = ["99999", "Level 1"]; // Add words to highlight

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT Year,Industry_aggregation_NZSIOC,Industry_code_NZSIOC,Industry_name_NZSIOC,Units,Variable_code,Variable_name,Variable_category,Value from authors");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo "<table class='tbcustom'>";
    echo "<tr>";
    foreach ($columnHeaders as $columnHeader) {
        echo "<th class='column-header'>$columnHeader</th>";
    }
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $displayRow = true;

        // Check if search values are provided for each column
        foreach ($row as $key => $value) {
            if (isset($_POST['search'][$key]) && $_POST['search'][$key] !== '' && stripos($value, $_POST['search'][$key]) === false) {
                $displayRow = false;
                break;
            }
        }

        if ($displayRow) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                // Highlight specific words with red
                foreach ($highlightWords as $highlightWord) {
                    $value = str_ireplace($highlightWord, "<span class='highlight'>$highlightWord</span>", $value);
                }

                // Add red-column class to cells with specified values
                $cellClass = (in_array($value, $highlightValues)) ? 'class="red-column"' : '';
                echo "<td $cellClass>$value</td>";
            }
            echo "</tr>";
        }
    }

    echo "</table>";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

</body>
</html>

