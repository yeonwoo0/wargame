<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>SQL Injection</title>
    <style>
        body, html {
            height: 100%;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .main-container{
            width:30%;
            height:100%;
            margin:auto;
            line-height: 50px;
        }
        .lecture-box{
            width:100%;
            margin:auto;
            border:solid 1px black;
            height: 50px;
            border-radius: 10px;
            text-align: center;
        }
        .lecture-margin{
            margin-bottom:10px;
            align-items: center; /* 내부 요소들을 수직 가운데 정렬 */
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[Lev 1] Understand logic</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/code/lev1.php?username=&password='">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[Lev 2] Understand logic</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/code/lev2.php?username=&password='">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[Lev 3] Understand logic</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/code/lev3.php?idx=2'">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[Lev 4] Understand logic</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/code/lev4.php?idx=2'">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[Lev 5] Understand logic</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/code/lev5.php?schema='">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[Lev 6] Understand logic</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/code/lev6.php?schema=&table='">Start</button>
        </div>

        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[ Level 1 ]</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/lev1/index.php'">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[ Level 2 ]</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/lev2/index.php'">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[ Level 3 ]</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/lev3/index.php'">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[ Level 4 ]</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/lev4/index.php?idx=1'">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[ Level 5 ]</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/lev5/index.php'">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[ Level 6 ]</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/lev6/index.php'">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[ Level 7 ]</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/lev7/index.php?idx=1'">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[ Level 8 ]</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/lev8/index.php'">Start</button>
        </div>
        <div style="display:flex" class="lecture-margin">
            <div class="lecture-box">[ Level 9 ]</div>
            <button type="button" class="btn btn-outline-success" style="height: 50px;" onclick="location.href='../sql/lev9/index.php?idx=1'">Start</button>
        </div>
    </div>
    
</body>
</html>