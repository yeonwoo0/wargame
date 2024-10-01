<?php
    include "../../../utils/common.php";
    header("Content-Type: text/html; charset=UTF-8");
    
    $userfile = isset($_FILES['userfile']) ? $_FILES['userfile'] : '';
    $path = isset($_GET['path']) ? $_GET['path'] : '';

    // 파일 업로드 처리
    if(!empty($_FILES['userfile']['name'])) {
        $filename = $_FILES['userfile']['name']; 
        
        $upload_path = "./fileList/".$path."/".$filename; 
        $file_info = pathinfo($upload_path); 
        $ext = strtolower($file_info["extension"]);
    
        if(!move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_path)){
            echo "<script>alert('File upload failed');history.back(-1)</script>";
            exit;
        }
        $upload_msg = 'File upload Successful : '.$upload_path;
        echo "<script>alert({$upload_msg});</script>";
    }else{
        echo "<script>alert('No file selected');history.back(-1)</script>";
        exit;
    }
    echo "<script>alert('Successful creation of post')</script>";
    echo "<script>self.location.href='./index.php';</script>";
?>
