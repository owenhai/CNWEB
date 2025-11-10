<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Tìm kiếm tên học phần (Live Search)</title>

<style type="text/css">
    body {
        font-family: Arial, sans-serif;
        margin: 40px;
    }
    h2 {
        color: navy;
    }
    .search-box {
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"] {
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #ccc;
        font-size: 14px;
        width: 100%;
        box-sizing: border-box;
    }
    .result {
        position: absolute;
        z-index: 999;
        top: 100%;
        left: 0;
        background: white;
    }
    .result p {
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #ccc;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover {
        background: #f2f2f2;
    }
    #info {
        margin-top: 25px;
        width: 400px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        background-color: #fafafa;
    }
    th, td {
        border: 1px solid gray;
        padding: 6px 10px;
    }
    th {
        background-color: navy;
        color: white;
        text-align: left;
        width: 150px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){
    // Khi người dùng gõ trong ô input
    $('.search-box input[type="text"]').on("keyup input", function(){
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");

        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                resultDropdown.html(data);
            });
        } else {
            resultDropdown.empty();
        }
    });

    // Khi người dùng click vào 1 gợi ý
    $(document).on("click", ".result p", function(){
        var tenhp = $(this).text();
        var infoDiv = $("#info");

        // Gán giá trị vào ô input
        $(this).parents(".search-box").find('input[type="text"]').val(tenhp);
        $(this).parent(".result").empty();

        // Gọi Ajax lần 2 để lấy thông tin chi tiết
        $.get("backend-search.php", {tenhp: tenhp}).done(function(data){
            infoDiv.html(data);
        });
    });
});
</script>
</head>

<body>
    <h2>Tìm kiếm tên học phần (Live Search có chi tiết)</h2>
    <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Nhập tên học phần...">
        <div class="result"></div>
    </div>

    <div id="info"></div>
</body>
</html>
