<?php
include "../../../utils/common.php";

// 사용자 이름과 비밀번호를 GET 매개변수로부터 가져옴
$username = isset($_GET['userid']) ? $_GET['userid'] : '';
$password = isset($_GET['userpw']) ? $_GET['userpw'] : '';

if($username =='' || $password == ''){
    echo "<script>alert('There is a space');history.back(-1);</script>";
    exit;
}
$query = "INSERT INTO users(username, password) VALUES(?, ?)";
$stmt = $db_conn->prepare($query);

// 쿼리 준비 오류 확인
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($db_conn->error));
}

$stmt->bind_param("ss", $username, $password);
$execute_result = $stmt->execute();

// 실행 결과 확인
if ($execute_result) {
    echo "<script>alert('Sign up is complete');</script>";
    echo "<script>window.location.href='index.php';</script>";
    exit;
} else {
    // 오류 발생 시 메시지 출력
    echo "Error: " . htmlspecialchars($stmt->error);
}

// 명시적으로 연결 해제 (선택 사항)
$stmt->close();
$db_conn->close();
?>
