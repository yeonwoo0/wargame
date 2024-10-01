<?php
include "../../../utils/common.php";

$schema = isset($_GET['schema']) ? trim($_GET['schema']) : '';
$table = isset($_GET['table']) ? trim($_GET['table']) : '';
if (preg_match('/["\']|concat|char/i', $schema)) {
    echo "<script>alert('Do not try Hacking!');history.back(-1);</script>";
    exit;
}

$query = "SELECT column_name FROM information_schema.columns WHERE table_schema=$schema AND table_name=$table LIMIT 1,1";
if(trim($query) == "SELECT * FROM users WHERE idx =1"){
    echo "<script>alert('Do not try Hacking!');history.back(-1);</script>";
    exit;
}
$result = $db_conn->query($query);
$column_name = 'nothing';
if ($result === false) {
    $column_name = 'nothing';
} else {
    $row = $result->fetch_assoc();
    if ($row) {
        if ($row['column_name'] == 'title') {
            echo "<script>alert('Congratulations!')</script>";
            $column_name = $row['column_name'];
        }else{
            $column_name = $row['column_name'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection - Level 6</title>
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
        <strong>Enter the name of current Database and the first table in that database</strong>
    </div>
    <div class="main-container">        
        <div style="text-align: center;">
            <h5><strong>Query : <?=$query?></strong></h5>
            <?php
                if($column_name == 'title') { ?>
                <h5 style="color: red;"><strong>column_name : <?=$column_name?></strong></h5>    
            <?php }else { ?>
                <h5><strong>column_name : <?=$column_name?></strong></h5>
            <?php }?>
            <h5><strong>Filter : ', ", concat, char</strong></h5>
        </div>
    </div>
    <div style="margin: auto; text-align:center; margin-top:10px">
        <button type="button" class="btn btn-outline-danger" onclick="location.href='./lev5.php?schema='">Prev</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../../../index.php'">Home</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev1/index.php'">Next</button>
    </div>
</body>
</html>