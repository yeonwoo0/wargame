<?php
    setcookie("path", "upload", time() + 3600, "./download.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>File Download - Level 8</title>
    <style>
        .main-container{
            width: 50%;
            margin: auto;
            margin-top: 100px;
            text-align: center;
        }
        .sub-container{
            width: 100%;
            background-color: whitesmoke;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="alert alert-dark" role="alert">
            <strong>Download the /etc/passwd !</strong>
        </div>
        <div class="sub-container">
            <form action="./download.php?filename=secret.txt" method="post">
                <input type="hidden" name="path" value="image">
                <button type="submit" class="btn btn-link"><strong>[Download]</strong></button>
            </form>
        </div>
        <button type="button" class="btn btn-outline-success" style="width: 100%; margin-top:10px" onclick="location.href='write.php'">Write</button>
    </div>
    <div style="margin: auto; text-align:center; margin-top:10px">
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev7/index.php'">Prev</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../../../index.php'">Home</button>
    </div>
</body>
</html>
