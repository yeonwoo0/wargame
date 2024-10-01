<?php
    include "../../../utils/common.php";
    header("Content-Type: text/html; charset=UTF-8");

    // HTML 엔티티로 변환
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $writer = 'user';
    if($title == '' || $content == ''){
        echo "<script>alert('There is an empty parameter');history.back(-1)</script>";
        exit;
    }
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    $content = str_replace("\r\n", "<br>", $content);


    // 쿼리 실행부분
    $sql = "INSERT INTO uploadLev6 (title, writer, content, regdate, filename) VALUES (?, ?, ?, CURDATE(),?)";
    $stmt = $db_conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $writer, $content, $filename);
    $result = $stmt->execute();
    if($result) {
       echo "<script>alert('Successfully created post');</script>";
    } else {
       echo "<script>alert('Failed to create post');</script>";
       exit;
    }
    echo "<script>self.location.href='./index.php';</script>";
    $stmt->close();
    $db_conn->close();
?>
