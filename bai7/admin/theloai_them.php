<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

</head>


<body>

<form action="theloai_them_xl.php" method="post" enctype="multipart/form-data" name="form1">

<table align="left" width="400">

<tr>

<td align="right">

Tên Thể Loại

</td>

<td>

<input type="text" name="TenTL" value="" />

</td>

</tr>

<tr>

<td align="right">

Thứ tự

</td>

<td>

<input type="text" name="ThuTu" value="" />

</td>

</tr>

<tr>

<td align="right">

Ẩn / Hiện

</td>

<td>

<select name="AnHien">

<option value="0">An</option>

<option value="1">Hien</option>

</select>

</td>

</tr>

<tr>

<td align="right">icon</td>

<td>

<input type="file" name="image" id="anh" />


</td>

</tr>

<tr>

<td align="right">

<input type="submit" name="Them" value="Them" />

</td>

<td>

  <button type="button" onclick="window.location.href='theloai.php'">Hủy</button>

</td>

</tr>

</table>

</form>


</body>

</html>