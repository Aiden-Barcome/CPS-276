<?php
require_once("../classes/Pdo_methods.php");

$pdo = new PdoMethods();
$sql = "TRUNCATE TABLE names";
$result = $pdo->otherNotBinded($sql);

$response = [];

if ($result === 'error') {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'Failed to clear names from the database.';
} else {
    $response['masterstatus'] = 'success';
    $response['msg'] = 'All names have been cleared.';
}

echo json_encode($response);

?>