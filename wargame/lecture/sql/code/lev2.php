<?php
include "../../../utils/common.php";

$username = isset($_GET['username']) ? $_GET['username'] : '';
$password = isset($_GET['password']) ? $_GET['password'] : '';

if (preg_match('/[=]|like/i', $username) || preg_match('/[=]|like/i', $password)) {
    echo 'Do not try Hacking!';
    exit;
}
$query = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
$result = $db_conn->query($query);

$username = 'nothing';
if ($result === false) {
    $username = 'nothing';
} else {
    $row = $result->fetch_assoc();
    if ($row) {
        if ($row['username'] == 'admin') {
            echo "<script>alert('Congratulations!')</script>";
            $username = $row['username'];
        }else{
            $username = $row['username'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection - Level 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .main-container{
            width: 50%;
            height: 150px;
            margin-top: 10hv;
            background-color: whitesmoke;
            margin: auto;
            border-radius: 10px;
            overflow: auto;
        }
    </style>
</head>
<body>
    <div class="alert alert-dark" role="alert" style="text-align: center; width:50%; margin:auto; margin-top:100px">
        <strong>Let's login with the Admin account!<br>username : admin</strong>
    </div>
    <div class="main-container">        
        <div style="text-align: center;">
            <h5><strong>Query : <?=$query?></strong></h5>
            <?php
                if($username == 'admin') { ?>
                <h5 style="color: red;"><strong>username : <?=$username?></strong></h5>    
            <?php }else { ?>
                <h5><strong>username : <?=$username?></strong></h5>
            <?php }?>
            <h5><strong>Filter : =, like</strong></h5>
        </div>
    </div>
    <div style="margin: auto; text-align:center; margin-top:10px">
        <button type="button" class="btn btn-outline-danger" onclick="location.href='./lev1.php?username=&password='">Prev</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../../../index.php'">Home</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='./lev3.php?idx=2'">Next</button>
    </div>
</body>
</html>
