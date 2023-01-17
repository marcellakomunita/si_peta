<?php
	$allowed_extensions = ['pdf'];
    $file = $_GET['file'];
    $path = 'E:/hpics-wrty/' . urldecode($file);
    if(!file_exists($path)){
        http_response_code(404);
        die();
    }
    $type = pathinfo($path, PATHINFO_EXTENSION);
	if(!in_array($type, $allowed_extensions)){
        http_response_code(400);
        die();
    }
    $data = file_get_contents($path);
    $base64 = 'data:file/' . $type . ';base64,' . base64_encode($data);
    echo json_encode(['file' => $base64]);
?>