<?php
require_once("../classes/Pdo_methods.php");

$response = [];
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['name']) || empty(trim($data['name']))) {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'No name provided.';
    echo json_encode($response);
    exit;
}

// Separate into first and last name
$nameParts = explode(' ', trim($data['name']));
if (count($nameParts) < 2) {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'Please enter both first and last name.';
    echo json_encode($response);
    exit;
}

// Format to "Last, First"
$firstName = ucfirst(strtolower($nameParts[0]));
$lastName = ucfirst(strtolower($nameParts[1]));
$formattedName = "$lastName, $firstName";

// Insert into database
$pdo = new PdoMethods();
$sql = "INSERT INTO names (name) VALUES (:name)";
$bindings = [[':name', $formattedName, 'str']];
$result = $pdo->otherBinded($sql, $bindings);

if ($result === 'error') {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'Database error: could not add name.';
} else {
    $response['masterstatus'] = 'success';
    $response['msg'] = 'Name added successfully.';
}

echo json_encode($response);
?>