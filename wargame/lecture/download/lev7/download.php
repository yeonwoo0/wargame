<?php
    include "../../../utils/common.php";
    
    $idx = isset($_GET['idx']) ? $_GET['idx'] : '';
    $path = isset($_POST['path']) ? $_POST['path'] : '';
    if (preg_match('/[\'"=]|like/i', $idx)) {
        echo "<script>alert('Do not try Hacking!');history.back(-1);</script>";
        exit;
    }
    $query = "SELECT * FROM download where idx = $idx";
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
    if($row == null){
        echo "<script>alert('File does not exist');history.back(-1);</script>";
        exit;
    }
    $filepath = "./upload/".$path."/".$row['filename'];
    $filename = $row['filename'];
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
