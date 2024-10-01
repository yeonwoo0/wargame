<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>WarGame</title>
    <style>
        .lecture-box {
            width: 30%;
            height: 150px;
            border: solid black 1px;
            border-radius: 10px;
            text-align: center;
            margin: 5px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 10px;
        }
        .container-center {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .btnbtn {
            width: 100%;
        }
        .blinking-text {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            background: linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet);
            -webkit-background-clip: text;
            color: transparent;
            animation: rainbow 3s infinite linear, blinking 1s infinite alternate;
        }
        @keyframes rainbow {
            0%, 100% {
                background-position: 0 0;
            }
            50% {
                background-position: 100% 0;
            }
        }
        @keyframes blinking {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>    
    <div class="blinking-text"><h1><strong style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">WebHacking World</strong></h1></div>
    <div class="container-center">
        <div class="lecture-box">
            <h4><strong>SQL Injection</strong></h4>
            <button type="button" class="btn btn-outline-danger align-self-end btnbtn" onclick="location.href='./lecture/gubun/sql.php'">Start</button>
        </div>
        <div class="lecture-box">
            <h4><strong>Cross-Site-Scripting</strong></h4>
            <button type="button" class="btn btn-outline-danger align-self-end btnbtn" onclick="location.href='./lecture/gubun/xss.php'">Start</button>
        </div>
        <div class="lecture-box">
            <h4><strong>File Upload</strong></h4>
            <button type="button" class="btn btn-outline-danger align-self-end btnbtn" onclick="location.href='./lecture/gubun/upload.php'">Start</button>
        </div>
        <div class="lecture-box">
            <h4><strong>File Download</strong></h4>
            <button type="button" class="btn btn-outline-danger align-self-end btnbtn" onclick="location.href='./lecture/gubun/download.php'">Start</button>
        </div>
    </div>
    Copyright ⓒ 2024 Park Yeon Woo
</body>
</html>
