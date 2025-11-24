<?php
header('Content-Type: application/json');
require_once 'config.php';

$clientId = $_GET['client_id'] ?? null;

if (!$clientId) {
    http_response_code(400);
    echo json_encode(['subscribed' => false]);
    exit;
}

$subscriptions = loadSubscriptions();
$subscribed = false;

foreach ($subscriptions as $sub) {
    if ($sub['client_id'] == $clientId) {
        $subscribed = true;
        break;
    }
}

echo json_encode(['subscribed' => $subscribed]);
?>

