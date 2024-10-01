<?php
    include "../../../utils/common.php";
    include "../service.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Cross-Site-Scripting - Level 8</title>
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
            <strong>Launch document.cookie !</strong>
        </div>
        <form id="searchForm" method="post" action="./index.php">
            <div class="input-group mb-3">
                <div class="col-auto my-1" style="margin-right: 10px">
                    <select name="search_type" id="inlineFormCustomSelect" class="form-select form-select-sm" aria-label="Small select example">
                        <option value="all" selected>All</option>
                        <option value="title">Title</option>
                        <option value="writer">Writer</option>
                        <option value="content">Content</option>
                    </select>
                </div>
                <input type="text" class="form-control" placeholder="Keyword Input" name="keyword" id="search_input" autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
<?php 
        if(isset($_POST['keyword'])){ 
            $keyword = str_replace("script", "REDACTED", $_POST['keyword']);
            $keyword = str_replace("alert", "REDACTED", $keyword);
            $keyword = str_replace("cookie", "REDACTED", $keyword);
            $keyword = str_replace("String", "REDACTED", $keyword);
            $keyword = str_replace("from", "REDACTED", $keyword);
?>
            <div class="alert alert-success  alert-dismissible fade show" role="alert">
                <strong>"<?=$keyword?>"에 대한 검색 결과입니다.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
<?php } ?>
        </form>
    </div>
    <div style="margin: auto; text-align:center">
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev7/index.php'">Prev</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../../../index.php'">Home</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev9/index.php?imgsrc=../../../utils/cat.jpg'">Next</button>
    </div>
</body>
</html>