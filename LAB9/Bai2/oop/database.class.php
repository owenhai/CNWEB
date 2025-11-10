<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "udn";
    private $conn;

    // Kết nối CSDL
    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8");
        return $this->conn;
    }

    // Lấy toàn bộ dữ liệu từ 1 bảng bất kỳ
    public function getAll($table) {
        $sql = "SELECT * FROM $table";
        $result = $this->conn->query($sql);
        $rows = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    // Đóng kết nối
    public function close() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>

