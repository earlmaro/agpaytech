<?php
use App\DataModel;
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../app/DataModel.php';

$data = new DataModel();
$result = $data->getAllCurrencies();
$num = count($result);

if ($num > 0) {

    echo json_encode($result);
} else {
    // No Posts
    echo json_encode(
        array('message' => 'No data Found')
    );
}
