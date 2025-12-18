<?php
header('Content-Type: application/json');

// قراءة data.json
$dataFile = 'data.json';
if (!file_exists($dataFile)) {
    echo json_encode(['error' => 'File not found'], JSON_PRETTY_PRINT);
    exit;
}

$json = file_get_contents($dataFile);
$data = json_decode($json, true);

echo json_encode([
    'file_exists' => true,
    'users_count' => count($data['users'] ?? []),
    'ads_count' => count($data['ads'] ?? []),
    'users' => $data['users'] ?? [],
    'ads' => $data['ads'] ?? []
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>