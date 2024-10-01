<?php
    $url = $_GET['url'];
    $ext = pathinfo($url, PATHINFO_EXTENSION);
    $img = base64_encode(file_get_contents($url));
    $img_src = "data:image/{$ext};base64,{$img}";
    echo "<img src=\"{$img_src}\" alt=\"\">";
?>