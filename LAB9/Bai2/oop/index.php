<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>OOP with PHP</title>
<link href="style.css" rel="stylesheet">
<style>
body { font-family: Arial, sans-serif; margin: 20px; }
h1 { color: navy; }
select { padding: 5px; font-size: 11pt; }
table { border-collapse: collapse; margin-top: 10px; background: #f4f4f4; }
td, th { border: 1px solid gray; padding: 5px; }
.hd { background-color: navy; color: white; text-align: center; }
</style>

<script>
function ajax() {
    var tb = document.getElementById("chon").value;
    var info = document.getElementById("info");

    if (tb === "") {
        info.style.display = "none";
        info.innerHTML = "";
        return;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            info.style.display = "block";
            info.innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "showTable.php?tb=" + tb, true);
    xhttp.send();
}
</script>
</head>

<body>
<h1>OOP with PHP</h1>

<select id="chon" onChange="ajax();">
    <option value="">-- Chọn bảng --</option>
    <option value="giaovien">Giáo viên</option>
    <option value="sinhvien">Sinh viên</option>
    <option value="hocphan">Học phần</option>
</select>

<hr>
<div id="info" style="display:none;"></div>

</body>
</html>

