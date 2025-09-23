<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

</head>


<body>

<?php
include("../connect.php");

if(isset($_GET['idTL']) && $_GET['idTL'] != '') {
    $idTL = intval($_GET['idTL']);
    $sl = "select * from theloai where idTL=$idTL";
    $results = mysqli_query($connect, $sl);
    if (!$results) {
        die('Lỗi truy vấn: ' . mysqli_error($connect));
    }
    $d = mysqli_fetch_array($results);
} else {
    die('Thiếu tham số idTL trên URL!');
}
?>

<form action="" method="post" enctype="multipart/form-data" name="form1">

<table align="left" width="400">

<tr>

<td align="right">

Tên Thể Loại

</td>

<td>

<input type="text" name="TenTL" value="<?php echo $d['TenTL'];?>" />

</td>

</tr>

<tr>

<td align="right">

Thứ Tự

</td>

<td>

<input type="text" name="ThuTu" value="<?php echo $d['ThuTu'];?>" />

</td>

</tr>

<tr>

<td align="right">

Ẩn / Hiện

</td>

<td>

<select name="AnHien">

<option value="0" <?php if($d['AnHien']==0) echo "selected";?>>Ẩn</option>

<option value="1" <?php if($d['AnHien']==1) echo "selected";?>>Hiện</option>

</select>

</td>

</tr>

<tr>

<td align="right">icon</td>

<td> <img src="../image/<?php echo $d['icon'] ?>" width="40" height="40" /></td>


</tr>

<tr>

<td align="right">&nbsp;</td>

<td> <input type="file" name="image" id="image" />

<input type="hidden" name="ten_anh" value="<?php echo $d['icon']; ?>" >
</td>

</tr>

<tr>

<td align="right">

<input type="hidden" name="idTL" value="<?php echo $_GET['idTL'];?>" />

<input type="submit" name="Sua" value="Sua" />

</td>

<td>

    <button type="button" onclick="window.location.href='theloai.php'">Hủy</button>

</td>

</tr>

</table>

</form>


<?php

include("../connect.php");


if(isset($_POST["TenTL"])) $theloai = $_POST['TenTL'];

if(isset($_POST["ThuTu"])) $thutu = $_POST['ThuTu'];

if(isset($_POST["AnHien"])) $an= $_POST['AnHien'];

$ten_file_tai_len="";
if(isset($_FILES["image"]["name"])) $ten_file_tai_len=$_FILES["image"]["name"];

if($ten_file_tai_len!="")

{

$icon = $ten_file_tai_len;

}

else
{

if(isset($_POST['ten_anh'])) $icon = $_POST['ten_anh'];

}


if(isset($_GET["idTL"])) $key = $_GET["idTL"];

if (isset($_POST['Sua']))

{


$sl="select count(*) from theloai where icon='$icon' ";

$results=mysqli_query($connect,$sl);

$d=mysqli_fetch_array($results);

if($d[0]==0 or $ten_file_tai_len=="")

{

$sl="update theloai set TenTL='$theloai',ThuTu='$thutu',AnHien='$an',icon='$icon' where idTL ='$key'";


if($ten_file_tai_len!="")

{



move_uploaded_file($_FILES['image']['tmp_name'],"../image/".$ten_file_tai_len);

$duong_dan_anh_cu="../image/".filter_input(INPUT_POST,"ten_anh");

unlink($duong_dan_anh_cu);

}


if(mysqli_query($connect, $sl))

{echo "<script language='javascript'>alert('sua thanh cong');";

echo "location.href='theloai.php';</script>";

}


}


else

{

echo "<script language='javascript'>alert('anh bi trung ten');";

echo "location.href='theloai_sua.php?idTL=$key';</script>";

}





}




?>

</body>

</html>