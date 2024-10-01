<?php
    $column_list = array('idx', 'title', 'content', 'writer');
    $sort_list = array('asc', 'desc');
    $sort_column = isset($_GET['sort_column']) && in_array(strtolower($_GET['sort_column']), $column_list) ? $_GET['sort_column'] : 'idx';
    $sort = isset($_GET['sort']) && in_array(strtolower($_GET['sort']), $sort_list) ? $_GET['sort'] : 'asc';
    $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
    if (!isset($_POST['keyword'])) {
        // 변수를 문자열 안에 넣기 위해 문자열 연결 연산자를 사용하여 쿼리를 구성합니다.
        $query = "SELECT * FROM xss ORDER BY $sort_column $sort";
        $result = $db_conn->query($query);
        $num = $result->num_rows;
    }
?>