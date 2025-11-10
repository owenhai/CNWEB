<?php
include("../inc/connect.inc");

if (isset($_GET['lop'])) {
    $lop = $_GET['lop'];

    $sql = "SELECT * FROM sinhvien WHERE lop='$lop'";
    $rs = mysqli_query($con, $sql);

    if (mysqli_num_rows($rs) > 0) {
        $str = "<table border='1' cellspacing='0' cellpadding='5'>";
        $str .= "<tr class='hd'>
                    <th>Mã SV</th>
                    <th>Họ tên</th>
                    <th>Lớp</th>
                    <th>Địa chỉ</th>
                 </tr>";

        while ($row = mysqli_fetch_array($rs)) {
            $str .= "<tr>
                        <td>{$row['masv']}</td>
                        <td>{$row['hoten']}</td>
                        <td>{$row['lop']}</td>
                        <td>{$row['diachi']}</td>
                     </tr>";
        }

        $str .= "</table>";
        echo $str;
    } else {
        echo "Không có sinh viên nào trong lớp này.";
    }
}
?>
