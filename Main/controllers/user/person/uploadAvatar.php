<?php
    const limited_size = 20480000;
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    echo $_FILES["file"]["name"]; // 成功接收
    $extension = end($temp); // 文件後綴名, 也就是檔案類型

    // echo "文件正在被處理...<br>";
    // echo $_FILES["file"]["name"]. "<br>";
    // echo $_FILES["file"]["type"]. "<br>";
    // echo (($_FILES["file"]["size"] < limited_size) ? "大小通過": "大小不通過") . "<br>";

    if ((($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/x-png")
    || ($_FILES["file"]["type"] == "image/png")) // 圖片格式
    && ($_FILES["file"]["size"] < limited_size) // 圖片大小不能過大
    && in_array($extension, $allowedExts)) {

        if ($_FILES["file"]["error"] > 0){
            echo "錯誤 ： ". $_FILES["file"]["error"] . "<br>";
        } else {

            echo "文件加載成功！<br>";
            echo "上傳文件名稱： " . $_FILES["file"]["name"] . "<br>";
            echo "文件類型： " . $_FILES["file"]["type"] . "<br>";
            echo "文件大小： " . ($_FILES["file"]["size"] / 1024 ). "kB<br>";
            echo "上傳文件臨時存儲位置： " . $_FILES["file"]["tmp_name"] . "<br>";

            // 是否已經存在
            if  (file_exists("../../../upload/avatar/" . $_FILES["file"]["name"])){
                echo $_FILES["file"]["name"] . "文件已經存在.";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], "../../../upload/avatar/" . $_FILES["file"]["name"]);
                echo "文件存儲在" . "../../../upload/avatar/" . $_FILES["file"]["name"];
            }


            // 圖片的展示
            $filePath = "../../../upload/avatar/" . $_FILES["file"]["name"];
            echo "<img src = '{$filePath}' />";

        }

    } else {
        echo "非法的格式";
        if ($_FILES["file"]["size"] >= limited_size){
            echo "錯誤！！ 圖片檔案過大";
        }
    }


?>