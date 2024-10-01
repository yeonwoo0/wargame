<?php
    session_start();
    include "../../../utils/common.php";
    header("Content-Type: text/html; charset=UTF-8");
    
    $idx = isset($_GET['idx']) ? $_GET['idx'] : 1;
    if (preg_match('/["\']/', $idx)) {
        echo "<script>alert('Do not try Hacking!');history.back(-1);</script>";
        exit;
    }else if (preg_match('/\b(?:union|substr|mid|substring)\b/i', strtolower($idx))) {
        echo "<script>alert('Do not try Hacking!');history.back(-1);</script>";
        exit;
    }


    $query = "SELECT * FROM board WHERE idx = $idx";
    $result = $db_conn->query($query);
    $num = ($result && $result->num_rows) ? $result->num_rows : 0;
    if ($num == 0){
        echo "<script>alert('존재하지 않는 게시글입니다.');history.back(-1)</script>";
        exit;
    }
    $row = $result->fetch_assoc();
    $filename = isset($row['filename']) ? $row['filename'] : '';
    if($row['password'] == 'NoBruteForce'){
        $writer = '관리자';
    }else{
        $writer = $row['writer'];
    }
    $db_conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./utils/common.js">
    <title>SQL Injection - Level 15</title>
    <style>
        .main-container{
            width: 50%;
            height: 200px;
            margin: auto;
            margin-top: 100px;
            
        }
        .title-box {
            width: 100%;
            border: 1px solid black;
            height: 50px;
            border-radius: 10px;
            padding-left: 10px;
            margin-bottom: 10px;
            display: flex; /* Flexbox 사용 */
            align-items: center; /* 수직 가운데 정렬 */
        }
        .content-box{
            width: 100%;
            border: 1px solid black;
            height: 200px;
            border-radius: 10px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="alert alert-dark" role="alert" style="text-align: center;">
            <strong>Let's get password of admin !</strong><br>
            <strong>DB : wargame | Table : users</strong>
        </div>
        <div style="width:100%; border:1px solid grey; border-radius: 5px; min-height: 50px; display:flex; margin-top:20px;">
            <div style="width: 15%; border-right:1px black solid; min-height:50px; padding:13px; text-align: center; word-wrap: break-word;">
                <?=$writer?>
            </div>
            <div style="width: 50%; border-right:1px black solid; min-height:50px; padding:13px; word-wrap: break-word;">
                <?=$row['title']?>
            </div>
            <div style="width: 15%; min-height:50px; padding:13px;text-align: center; border-right:1px grey solid; word-wrap: break-word;">
                <?=substr($row['regdate'],0,10)?>
            </div>
            <div style="width: 15%; min-height:50px; padding:13px;text-align: center; font-size:10px; word-wrap: break-word;">
                <a><?=$row['filename']?></a>
            </div>
        </div>
        <div style="overflow: auto; border:1px solid grey; border-radius:5px; padding:20px; margin-top:20px; min-height:300px">
            <?=$row['content']?>
        </div>
            <button type="button" class="btn btn-outline-danger" style="width: 100%; margin-top:10px">back</button>
        <div style="margin: auto; text-align:center; margin-top:10px">
            <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev8/index.php'">Prev</button>
            <button type="button" class="btn btn-outline-danger" onclick="location.href='../../../index.php'">Home</button>
        </div>
    </div>
</body>
</html>