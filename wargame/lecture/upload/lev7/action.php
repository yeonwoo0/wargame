<?php
session_start();
    include "../../../utils/common.php";
    header("Content-Type: text/html; charset=UTF-8");

    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $userfile = isset($_FILES['userfile']) ? $_FILES['userfile'] : '';
    $password = isset($_POST['userpass']) ? $_POST['userpass'] : '';
    $writer = 'user';
    if($title == '' || $content == ''){
        echo "<script>alert('There is an empty parameter');history.back(-1)</script>";
        exit;
    }
    if(mb_strlen($title) > 30){
        echo "<script>alert('제목은 30글자 미만으로 작성해주세요');history.back(-1)</script>";
        exit;
    }
    // HTML 엔티티로 변환
    $filename = '';
    $content = str_replace("\r\n", "<br>", $content);
    // 파일 업로드 처리
    if(!empty($_FILES['userfile']['name'])) {
        $filename = $_FILES['userfile']['name']; 
        $upload_path = "./user_upload_files/".$filename; 
        $file_info = pathinfo($upload_path); 
        $ext = strtolower($file_info["extension"]);
        if(!move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_path)){
            echo "<script>alert('File upload failed');history.back(-1)</script>";
            exit;
        }
    }
    
    $query = "INSERT INTO uploadLev7 (title, writer, content, regdate, filename) values('$title', '$writer', '$content',curdate(),'$filename')";
    $result = $db_conn->query($query);
    if($result) {
       echo "<script>alert('Successfully created post');</script>";
    } else {
       echo "<script>alert('Failed to create post');history.back(-1);</script>";
       exit;
    }
    echo "<script>self.location.href='index.php';</script>";
?>
