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
    <title>SQL Injection - Level 14</title>
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
        }
        .login-box {

            flex-direction: column;
            gap: 10px;
        }
        input[type="text"],
        input[type="password"] {
            width: 200px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            border: 1px black solid;
            height: 34.5px;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <div class="alert alert-dark" role="alert" style="text-align: center; width:50%; margin:auto; margin-top:200px">
        <strong>Let's get password of admin !</strong>
    </div>
    <div class="login-container">
        <form action="./register.php">
            <div class="login-box">
                <input type="text" name="userid" placeholder="Username" autocomplete="off">
                <button type="button" onclick="checkDuplicate()">중복확인</button><br>
                <div id="result"></div>
                <input type="password" name="userpw" placeholder="Password">
                <input type="submit" value="Register" style="width: 100%;">
            </div>
            
        </form>
    </div>
    <script>
        function checkDuplicate() {
            var userid = document.querySelector('input[name="userid"]').value;
            console.log('User ID:', userid);
            if (userid) {
                fetch('check.php?userid=' + encodeURIComponent(userid))
                    .then(response => response.text())
                    .then(data => {
                        console.log('Response:', data);
                        document.getElementById('result').innerText = data;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('result').innerText = 'An error occurred.';
                    });
            } else {
                alert('Please enter a username.');
            }
        }
    </script>
    <div style="margin: auto; text-align:center">
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev7/index.php?idx=1'">Prev</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../../../index.php'">Home</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev9/index.php?idx=1'">Next</button>
    </div>
</body>
</html>
