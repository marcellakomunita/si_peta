<?php
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    $image = $_GET['img'];
    $path = 'E:/hpics-cjpeb/' . $image;
    if(!file_exists($path)){
        http_response_code(404);
        die();
    }
    $type = pathinfo($path, PATHINFO_EXTENSION);
    if(!in_array($type, $allowed_extensions)){
        http_response_code(400);
        die();
    }
    readfile($path);
?>