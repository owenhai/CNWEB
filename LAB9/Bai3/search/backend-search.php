<?php
$link = mysqli_connect("localhost", "root", "", "udn");
if ($link === false) die("ERROR: Không thể kết nối. " . mysqli_connect_error());

// Gợi ý khi người dùng nhập
if (isset($_REQUEST["term"])) {
    $sql = "SELECT * FROM hocphan WHERE tenhp LIKE ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        $param_term = $_REQUEST["term"] . '%';
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<p>" . htmlspecialchars($row["tenhp"]) . "</p>";
            }
        } else {
            echo "<p>Không tìm thấy kết quả nào</p>";
        }
        mysqli_stmt_close($stmt);
    }
}

// Khi click vào một học phần → hiển thị thông tin chi tiết
if (isset($_GET['tenhp'])) {
    $tenhp = $_GET['tenhp'];
    $sql = "SELECT * FROM hocphan WHERE tenhp = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $tenhp);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<h3>Thông tin chi tiết học phần</h3>";
            echo "<table>";
            echo "<tr><th>Mã HP</th><td>{$row['mahp']}</td></tr>";
            echo "<tr><th>Tên học phần</th><td>{$row['tenhp']}</td></tr>";
            echo "<tr><th>Tín chỉ</th><td>{$row['tinchi']}</td></tr>";
            echo "<tr><th>Tiên quyết</th><td>{$row['tienquyet']}</td></tr>";
            echo "<tr><th>Học kỳ</th><td>{$row['hocky']}</td></tr>";
            echo "</table>";
        }
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($link);
?>
