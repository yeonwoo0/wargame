<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Cross-Site-Scripting - Level 7</title>
    <style>
        .main-container{
            width: 50%;
            height: 200px;
            margin: auto;
            margin-top: 100px;
        }
        .title-box{
            width: 100%;
            border: 1px solid black;
            height: 50px;
            border-radius: 10px;
            padding-left: 10px;
            margin-bottom: 10px;
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
        <form action="./action.php" method="post">
            <input type="text" class="title-box" autofocus name="title" placeholder="Title">
            <textarea name="content" id="" class="content-box" placeholder="Content"></textarea>
            <button type="submit" class="btn btn-outline-success" style="width: 100%;">Write</button>
            <button type="button" class="btn btn-outline-danger" style="width: 100%;" onclick="location.href='./index.php'">back</button>
        </form>
    </div>
</body>
</html>
