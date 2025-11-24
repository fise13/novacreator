<?php
header('Content-Type: application/json');
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['subscription']) || !isset($data['client_id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing data']);
    exit;
}

$subscriptions = loadSubscriptions();
$clientId = $data['client_id'];
$subscriptionData = $data['subscription'];

$found = false;
foreach ($subscriptions as &$sub) {
    if ($sub['client_id'] == $clientId) {
        $sub['subscription'] = $subscriptionData;
        $sub['updated_at'] = date('Y-m-d H:i:s');
        $found = true;
        break;
    }
}

if (!$found) {
    $subscriptions[] = [
        'client_id' => $clientId,
        'subscription' => $subscriptionData,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
}

saveSubscriptions($subscriptions);

echo json_encode(['success' => true]);
?>

