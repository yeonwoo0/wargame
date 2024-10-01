<?php
include "../../../utils/common.php";

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
    $query = "SELECT * FROM users WHERE username = '$userid'";
    $result = $db_conn->query($query);

    if (preg_match('/\b(?:union|substr|mid|substring)\b/i', strtolower($userid))) {
        echo 'Do not try Hacking!';
        exit;
    }else if (preg_match('/[><=]/', $userid)) {
        echo 'Do not try Hacking!';
        exit;
    }

    if ($result === false) {
        exit;
    }
    if ($result->num_rows > 0) {
        echo 'The ID that already exists';
    } else {
        echo 'Username is available';
    }
} else {
    echo 'No username provided.';
}
?>
