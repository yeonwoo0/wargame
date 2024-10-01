<?php
    include "../../../utils/common.php";
    $input = isset($_GET['imgsrc']) ? $_GET['imgsrc'] : "../../../utils/cat.jpg";
    if(preg_match("/\(|\)|javascript|script|<|>|`/", $input)){
        echo "<script>alert('허용되지 않은 문자');history.back(-1);</script>";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cross-Site-Scripting - Level 9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .main-container{
            width: 50%;
            height: 300px;
            margin-top: 10hv;
            background-color: whitesmoke;
            margin: auto;
            border-radius: 10px;
            overflow: auto;
        }
        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="alert alert-dark" role="alert" style="text-align: center; width:50%; margin:auto; margin-top:100px">
        <strong>Launch document.cookie !</strong>
    </div>
    <div class="main-container">        
        <div>
            <h5><strong>&lt;?php <br>
            &nbsp; &nbsp; &nbsp; &nbsp;$input = isset($_GET['imgsrc']) ? $_GET['imgsrc'] : "../../../utils/cat.jpg";<br>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;if(preg_match("/\(|\)|javascript|script|<|>|`/", $input)){<br>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;$input = "";<br>
                &nbsp; &nbsp; &nbsp; &nbsp;}<br>?&gt;
            </strong></h5>
            <h5><strong>&lt;img src="&lt;?=$input?&gt;"</strong></h5>
        </div>
        <div class="image-container">
            <img src="<?=$input?>" alt="" style="max-width:70%;">
        </div>
    </div>
    <div style="margin: auto; text-align:center; margin-top:10px">
    <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev8/index.php'">Prev</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../../../index.php'">Home</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev10/index.php?imgsrc=../../../utils/cat.jpg'">Next</button>
    </div>
</body>
</html>