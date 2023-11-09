<?php

$payload = file_get_contents('php://input');
$data = json_decode($payload, true);


$directory = '/var/www/edusmart/spa.edu-smart.space';

chdir($directory);

$result = exec('git pull origin main', $output, $returnCode);

if ($returnCode !== 0) {
    header('Content-Type: application/json');
    echo json_encode(['error' => true]);

} else {
    echo $result;
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
}



?>
