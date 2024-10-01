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
    <title>Cross-Site-Scripting - Level 7</title>
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
        <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%; text-align:center"><a href="./index.php?sort_column=idx&sort=asc" style="text-decoration: none; color: black">Index ▼</a></th>
                        <th scope="col" style="width: 50%"><a href="./index.php?sort_column=title&sort=asc" style="text-decoration: none; color: black">Title ▼</a></th>
                        <th scope="col" style="width: 20%"><a href="./index.php?sort_column=writer&sort=asc" style="text-decoration: none; color: black">Writer ▼</a></th>
                        <th scope="col" style="width: 20%"><a href="./index.php?sort_column=regdate&sort=asc" style="text-decoration: none; color: black">Date ▼</a></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                        if($num !=0){
                            while($row = $result->fetch_assoc()){ ?>
                    <tr>
                        <td style="text-align: center"><?=$row["idx"]?></td>
                        <td style="text-align: left;"><a style="color: black; text-decoration: none;"><?=$row["title"]?></a></td>
                        <td><?=$row["writer"]?></td>
                        <td><?=date('Y-m-d', strtotime($row["regdate"]))?></td>
                    </tr>
                    <?php }}else {
                    ?>
                    <tr>
                        <td colspan="4">Posts does not exist.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <button type="button" class="btn btn-outline-success" style="width: 100%;" onclick="location.href='write.php'">Write</button>
    </div>
    <div style="margin: auto; text-align:center; margin-top:10px">
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev6/index.php'">Prev</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../../../index.php'">Home</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev8/index.php'">Next</button>
    </div>
</body>
</html>
