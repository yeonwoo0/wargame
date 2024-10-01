<?php
    include "../../../utils/common.php";
    $realfile = isset($_GET['filename']) ? $_GET['filename'] : '';
    if ($realfile == ''){
        echo "<script>alert('wrong approach');history.back(-1);</script>";
        exit;
    }
    $realfile = str_replace("../", "", $realfile);
    $filepath = "./upload/".$realfile;
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