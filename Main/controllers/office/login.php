<?php
header('content-type:text/html;charset=utf-8');
$host = "localhost";
$user = "root";
$password = "";
$db = "myDB10";

// 實例化 mysqli 的對象, 連接mysql 數據庫
$mysqli = new mysqli($host, $user, $password, $db);

if ($mysqli->connect_error){
    die($mysqli->connect_error);
}
$mysqli->set_charset('utf8');

function getUser($mysqli){
    // 開始搜尋集 SELECT 操作
    $sql = "SELECT username, age, gender FROM demo WHERE username = ? and pwd= ?";
    $mysqli_stmt = $mysqli->prepare($sql);

    // 檢查是否存在這些變數
    if (isset($_GET['username']) && isset($_GET['password'])){
        $username = $_GET['username'];
        $password = $_GET['password'];
        $mysqli_stmt->bind_param('ss', $username, $password);

        if ($mysqli_stmt->execute()){
            $username = null;
            $gender = null;
            $age = null;

            // bind_result() 綁定結果集中的值到變量
            $mysqli_stmt->bind_result($username, $gender, $age);

            // 檢查是否有結果
            if ($mysqli_stmt->fetch()) {
                // 回應 personal/index.html
                echo "<script>window.location.href ='../../views/user/person.html'</script>";
                // echo "歡迎姓名: ".$username;
                // echo "<br/>";
                // $s = ($gender == 0 ? 'female' : 'male');
                // echo "性別: ".$s;
                // echo "<br/>";
                // echo "年齡: ".$age;
                // echo "<br/>";
            } else {
                echo "未找到用戶或密碼不正確。";
            }
        }
        $mysqli_stmt->free_result();
    } else {
        echo "請提供用戶名稱與密碼";
    }

    $mysqli_stmt->close();
}

getUser($mysqli);
mysqli_close($mysqli);
?>
