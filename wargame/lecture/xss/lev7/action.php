<?php
session_start();
    include "../../../utils/common.php";
    header("Content-Type: text/html; charset=UTF-8");
    
    // 사용자 입력을 받아오기
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    if($title == '' || $content == ''){
        echo "<script>alert('There is an empty parameter');history.back(-1);</script>";
        exit;
    }
    $writer = 'user';
    if(mb_strlen($title) > 20){
        echo "<script>alert('The title must be less than 20 characters.');history.back(-1)</script>";
        exit;
    }
    $content = str_replace("\r\n", "<br>", $content);
    $sql = "INSERT INTO xss (title, content, writer, regdate) VALUES (?, ?,?, CURDATE())";
    $stmt = $db_conn->prepare($sql);
    $stmt->bind_param("sss", $title, $content,$writer);
    $result = $stmt->execute();
    if($result) {
       echo "<script>alert('Successfully created post');</script>";
    } else {
       echo "<script>alert('Failed create post');</script>";
       exit;
    }
    echo "<script>self.location.href='./index.php';</script>";
    $stmt->close();
    $db_conn->close();
?>
