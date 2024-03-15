<?php
    header('content-type:text/html;charset=utf-8');
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "myDB10";

    // 實例化 mysqli 的對象, 連接mysql 數據庫
    $mysqli = new mysqli($host, $user, $password, $db);

    if ($mysqli -> connect_error){
        die($mysqli -> connect_error);
    }
    $mysqli ->set_charset('utf8');

    // 註冊新用戶
    function register($mysqli){

        $username = null;
        $age = null;
        $gender = null;

        // 用戶註冊: 插入新數據
        $sql = "INSERT INTO demo( username, pwd, age, gender) VALUES (?, ?, ?, ?)";

        if(isset($_POST["username"], $_POST["age"], $_POST["gender"], $_POST["password"])) {
            $username = $_POST["username"];
            $passwrd = $_POST["password"];
            $age = $_POST["age"];
            $gender = $_POST["gender"];

            $mysqli_stmt = $mysqli -> prepare($sql);
            $mysqli_stmt -> bind_param("ssii", $username, $passwrd, $age, $gender);

            if ($mysqli_stmt -> execute()){
                echo $mysqli_stmt -> insert_id;
                echo PHP_EOL;
            } else {
                echo $mysqli_stmt -> error;
            }
            $mysqli_stmt -> close();

        } else {
            echo "Form not submitted.";
        }

    }

    register($mysqli);
    mysqli_close($mysqli);
?>
