<?php
include "../../../utils/common.php";
$username = isset($_GET['userid']) ? $_GET['userid'] : '';
$password = isset($_GET['userpw']) ? $_GET['userpw'] : '';

if(($username != '' && $password =='') || ($username == '' && $password != '')){
    echo "<script>alert('There is a space');history.back(-1)</script>";
    exit;
}

// SQL 쿼리 준비
$level = isset($_GET['level']) ? $_GET['level'] : '';

if($level == 'lev1'){
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $db_conn->query($query);

    if($result === false) {
        echo "<script>alert('bad request');history.back(-1)</script>";
        exit;
    }
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<script>alert('Congratulations! Authentication bypass was Successful');history.back(-1)</script>";
        exit;
    } else {
        echo "<script>alert('Invalid username or password');history.back(-1)</script>";
        exit;
    }

}else if($level == 'lev2'){
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $db_conn->query($query);
    if($result === false) {
        echo "<script>alert('bad request');history.back(-1)</script>";
        exit;
    }
    // $row가 null이 아닌지 확인한 후에 배열 오프셋에 접근
    if ($row = $result->fetch_assoc()) {
        if($row['username'] == $username){
            echo "<script>alert('Congratulations! Authentication bypass was Successful');history.back(-1)</script>";
            exit;
        } else {
            echo "<script>alert('Invalid username or password');history.back(-1)</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password');history.back(-1)</script>";
    }
}
?>
