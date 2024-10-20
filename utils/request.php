<?php
function returnJson($data, $status = 'success') {
    header('Content-Type: application/json');
    $response = [
        "status" => $status,
        "data" => $data
    ];
    echo json_encode($response);
    exit;
}
?>
