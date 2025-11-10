<?php
include("database.class.php");

if (isset($_GET['tb'])) {
    $tb = $_GET['tb'];

    $db = new Database();
    $conn = $db->connect();
    $rows = $db->getAll($tb);

    if (count($rows) > 0) {
        echo "<h3>Bảng: $tb</h3>";
        echo "<table border='1' cellspacing='0' cellpadding='5'>";
        echo "<tr class='hd'>";
        foreach ($rows[0] as $col => $val) {
            echo "<th>$col</th>";
        }
        echo "</tr>";

        foreach ($rows as $r) {
            echo "<tr>";
            foreach ($r as $val) {
                echo "<td>$val</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Bảng <b>$tb</b> không có dữ liệu.";
    }

    $db->close();
}
?>

