<?php
    include "../../../utils/common.php";
    header("Content-Type: text/html; charset=UTF-8");
    
    // 사용자 입력을 받아오기
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $writer = 'user';
    $filename = '';
    if($title == '' || $content == ''){
        echo "<script>alert('There is an empty parameter');history.back(-1)</script>";
        exit;
    }
    if(mb_strlen($title) > 30){
        echo "<script>alert('제목은 30글자 미만으로 작성해주세요');history.back(-1)</script>";
        exit;
    }
    // HTML 엔티티로 변환
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    $content = str_replace("\r\n", "<br>", $content);

    // 파일 업로드 처리
    if(!empty($_FILES['userfile']['name'])) {
        $filename = $_FILES['userfile']['name']; 
        $upload_path = "./user_files/".$filename; 
        $file_info = pathinfo($upload_path); 
        $ext = strtolower($file_info["extension"]);
    
        if(!move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_path)){
            echo "<script>alert('File upload failed');history.back(-1)</script>";
            exit;
        }
        $upload_msg = 'File upload Successful : '.$upload_path;
        echo "<script>alert({$upload_msg})</script>";
    }
    // 쿼리 실행부분
    $sql = "INSERT INTO uploadLev3 (title, writer, content, regdate, filename) VALUES (?, ?, ?, CURDATE(), ?)";
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
