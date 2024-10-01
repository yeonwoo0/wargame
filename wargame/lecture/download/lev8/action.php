<?php
    include "../../../utils/common.php";

    // 입력값 가져오기
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $filename = '';
    // 입력값 검증
    if (empty($title) || empty($content)) {
        echo "<script>alert('There is an empty parameter');history.back(-1);</script>";
        exit;
    }

    if (isset($_FILES['filename']) && $_FILES['filename']['error'] === UPLOAD_ERR_OK) {
        $tempName = $_FILES['filename']['tmp_name'];
        $filename = basename($_FILES['filename']['name']);

        $uploadPath = "./upload/image/".$filename;
        if (move_uploaded_file($tempName, $uploadPath)) {
            // 파일 업로드 성공
        } else {
            echo "<script>alert('Failed to upload file');history.back(-1);</script>";
            exit;
        }
    }
    // SQL 쿼리 작성
    $query = "INSERT INTO download (title, content, filename) VALUES (?, ?, ?)";
    $stmt = $db_conn->prepare($query);
    
    if ($stmt === false) {
        echo "<script>alert('Database query preparation failed');history.back(-1);</script>";
        exit;
    }

    // 파라미터 바인딩 및 실행
    $stmt->bind_param("sss", $title, $content, $filename);
    $executeResult = $stmt->execute();
    // 결과 확인
    if ($executeResult) {
        echo "<script>alert('Successful creation of post'); window.location.href = './index.php';</script>";
    } else {
        echo "<script>alert('Failed to create post');history.back(-1);</script>";
    }
    // 리소스 해제
    $stmt->close();
    $db_conn->close();
?>
