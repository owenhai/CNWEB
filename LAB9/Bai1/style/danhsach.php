<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ajax - Danh sách lớp</title>
<link href="style.css" type="text/css" rel="stylesheet">

<style>
body { font-size: 11pt; }
div { padding: 3px 5px; font: normal 13pt Arial; }
table { background-color: #eaeaea; border-collapse: collapse; width: 80%; margin-top: 10px; }
td, th { border: 1px solid gray; padding: 5px; }
.hd { background-color: navy; color: white; text-align: center; }
</style>

<script>
function sendajax() {
    var lop = document.getElementById("lop").value;
    var objds = document.getElementById("ds");
    var xml = new XMLHttpRequest();

    xml.onreadystatechange = function() {
        if (xml.readyState == 4 && xml.status == 200) {
            objds.innerHTML = xml.responseText;
        }
    }

    xml.open("GET", "ds.php?lop=" + lop, true);
    xml.send();
}
</script>
</head>

<body>
<h3>In danh sách theo từng lớp</h3>

<?php
include("../inc/connect.inc");

function initClass($con) {
    $sql = "SELECT DISTINCT lop FROM sinhvien";
    $rs = mysqli_query($con, $sql);

    echo "Chọn lớp: <select id='lop' onchange='sendajax();'>";
    echo "<option value=''>--Chọn lớp--</option>";
    while ($row = mysqli_fetch_array($rs)) {
        echo "<option value='{$row['lop']}'>{$row['lop']}</option>";
    }
    echo "</select>";
}
initClass($con);
?>

<hr>
<div id="ds">Danh sách sinh viên sẽ hiển thị tại đây</div>

</body>
</html>
