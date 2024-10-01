<?php
    include "../../../utils/common.php";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>SQL Injection - Level 8</title>
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
        }
        .login-box {
            display: flex;
            flex-direction: column;
            gap: 10px; /* 입력 요소들 사이의 간격 조정 */
        }
        input[type="text"],
        input[type="password"] {
            width: 200px; /* 입력 필드의 너비 조정 */
            padding: 5px; /* 입력 필드의 안쪽 여백 조정 */
            border: 1px solid #ccc; /* 입력 필드의 테두리 스타일 지정 */
            border-radius: 5px; /* 입력 필드의 테두리 둥글기 조정 */
        }
    </style>
</head>
<body>
    <div class="alert alert-dark" role="alert" style="text-align: center; width:50%; margin:auto; margin-top:200px">
        <strong>Let's login with the Admin account!<br>username : admin</strong>
    </div>
    <div class="login-container">
        <form action="./action.php">
            <div class="login-box">
                <input type="text" name="userid" placeholder="Username" autocomplete="off">
                <input type="password" name="userpw" placeholder="Password">
                <input type="hidden" name="level" value="lev2">
                <input type="submit" value="Login" style="width: 100%;">
            </div>
        </form>
    </div>
    <div style="margin: auto; text-align:center">
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev1/index.php'">Prev</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../../../index.php'">Home</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev3/index.php'">Next</button>
    </div>
</body>
</html>
