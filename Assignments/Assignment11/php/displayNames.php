<?php
require_once("../classes/Pdo_methods.php");

$pdo = new PdoMethods();
$sql = "SELECT name FROM names ORDER BY name ASC";
$records = $pdo->selectNotBinded($sql);

$response = [];

if ($records === 'error') {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'Could not retrieve names.';
} elseif (count($records) === 0) {
    $response['masterstatus'] = 'success';
    $response['names'] = 'No names to display.';
} else {
    $output = "<ul>";
    foreach ($records as $row) {
        $output .= "<li>" . htmlspecialchars($row['name']) . "</li>";
    }
    $output .= "</ul>";

    $response['masterstatus'] = 'success';
    $response['names'] = $output;
}

echo json_encode($response);
?>