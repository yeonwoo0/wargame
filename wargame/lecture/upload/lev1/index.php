<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>File Upload - Level 1</title>
    <style>
        .main-container{
            width: 50%;
            margin: auto;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="alert alert-dark text-center" role="alert">
            <strong>Upload your WebShell !</strong>
        </div>
        <form action="./action.php?path=image" enctype="multipart/form-data" method="post">
            <div class="input-group mb-3 wrap">
                <input type="file" class="form-control" id="inputGroupFile02" name="userfile">
                <button type="submit" class="btn btn-outline-success">Upload</button>
            </div>
        </form>
    </div>
    <div style="margin: auto; text-align:center">
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../../../index.php'">Home</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev2/index.php'">Next</button>
    </div>
</body>
</html>