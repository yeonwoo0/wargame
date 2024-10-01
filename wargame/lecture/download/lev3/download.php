<?php
    include "../../../utils/common.php";
    
    $realfile = isset($_GET['filename']) ? $_GET['filename'] : '';
    $path = isset($_POST['path']) ? $_POST['path'] : '';

    if ($realfile == ''){
        echo "<script>alert('wrong approach');history.back(-1);</script>";
        exit;
    }
    $query = "SELECT * FROM download where filename = '$realfile'";
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
    if($row == null){
        echo "<script>alert('File does not exist');history.back(-1);</script>";
        exit;
    }
    $filepath = "./upload/".$path."/".$row['filename'];
    $filename = $realfile;
    if(is_file($filepath)){
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Transfer-Encoding: binary");
        readfile($filepath); // 파일을 출력합니다.
        exit;
    } else {
        echo "<script>alert('File does not exist');history.back(-1);</script>";
        exit;
    }
?>
