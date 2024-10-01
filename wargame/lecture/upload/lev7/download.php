<?php
session_start();
include "../../../utils/common.php";

$fileidx = isset($_GET['idx']) ? $_GET['idx'] : '';
if ($fileidx == ''){
    echo "<script>alert('wrong approach');history.back(-1);</script>";
    exit;
}
//쿼리 실행부분. 파일 다운로드 기능
$query = "SELECT * FROM uploadLev7 WHERE idx = $fileidx";
$result = $db_conn->query($query);
$row = $result->fetch_assoc();
if($row == null){
    echo "<script>alert('File does not exist');history.back(-1);</script>";
    exit;
}
$filepath = "./user_upload_files/".$row['filename'];
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