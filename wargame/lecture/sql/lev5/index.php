<?php
    include "../../../utils/common.php";


    $sort_column = isset($_GET['sort_column']) ? $_GET['sort_column'] : 'idx';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'desc';



    if (!isset($_POST['keyword'])) {
        // 변수를 문자열 안에 넣기 위해 문자열 연결 연산자를 사용하여 쿼리를 구성합니다.
        $query = "SELECT * FROM board ORDER BY $sort_column $sort";
        $result = $db_conn->query($query);
        if($result == null){
            echo "<script>alert('bad request');history.back(-1);</script>";
            exit;
        }
        $num = $result->num_rows;
    } else {
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
        $search_type = isset($_POST['search_type']) ? $_POST['search_type'] : '';

        if ($search_type == 'all'){
            $query = "SELECT * FROM board WHERE title LIKE ? OR writer LIKE ? OR content LIKE ?";
            $keyword_like = "%$keyword%"; // 사용자 입력값에 와일드카드를 추가합니다.
            $stmt = $db_conn->prepare($query);
            $stmt->bind_param("sss", $keyword_like, $keyword_like, $keyword_like);
        } else if($search_type == 'title'){
            $query = "SELECT * FROM board WHERE title LIKE ?";
            $keyword_like = "%$keyword%"; // 사용자 입력값에 와일드카드를 추가합니다.
            $stmt = $db_conn->prepare($query);
            $stmt->bind_param("s", $keyword_like);
        } else if($search_type == 'writer'){
            $query = "SELECT * FROM board WHERE writer LIKE ?";
            $keyword_like = "%$keyword%"; // 사용자 입력값에 와일드카드를 추가합니다.
            $stmt = $db_conn->prepare($query);
            $stmt->bind_param("s", $keyword_like);
        } else if($search_type == 'content'){
            $query = "SELECT * FROM board WHERE content LIKE ?";
            $keyword_like = "%$keyword%"; // 사용자 입력값에 와일드카드를 추가합니다.
            $stmt = $db_conn->prepare($query);
            $stmt->bind_param("s", $keyword_like);
        } else{
            echo "<script>alert('bad request');history.back(-1);</script>";
            exit;
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $num = ($result && $result->num_rows) ? $result->num_rows : 0;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>SQL Injection - Level 11</title>
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
            <strong>Let's get Database name !</strong>
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
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev4/index.php?idx=1'">Prev</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../../../index.php'">Home</button>
        <button type="button" class="btn btn-outline-danger" onclick="location.href='../lev6/index.php'">Next</button>
    </div>
</body>
</html>
