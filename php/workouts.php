<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$dataFile = 'data.json';

// قراءة البيانات
function readData() {
    global $dataFile;
    if (!file_exists($dataFile)) {
        return ['users' => [], 'workouts' => [], 'ads' => []];
    }
    $json = file_get_contents($dataFile);
    return json_decode($json, true);
}

// حفظ البيانات
function saveData($data) {
    global $dataFile;
    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    return true;
}

// إضافة تمرين سريع
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? '';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($action === 'add_quick') {
        $userId = $input['userId'] ?? '';
        $type = $input['type'] ?? '';
        $duration = $input['duration'] ?? 0;
        $calories = $input['calories'] ?? 0;
        $date = $input['date'] ?? date('Y-m-d');
        
        if (!$userId || !$type) {
            $response['message'] = 'بيانات غير كافية';
            echo json_encode($response);
            exit;
        }
        
        $data = readData();
        
        // البحث عن المستخدم وإضافة التمرين
        foreach ($data['users'] as &$user) {
            if ($user['id'] === $userId) {
                if (!isset($user['workouts'])) {
                    $user['workouts'] = [];
                }
                
                $newWorkout = [
                    'id' => uniqid('workout_'),
                    'name' => 'تمرين ' . $type,
                    'type' => $type,
                    'duration' => (int)$duration,
                    'calories' => (int)$calories,
                    'date' => $date,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $user['workouts'][] = $newWorkout;
                saveData($data);
                
                $response['success'] = true;
                $response['message'] = 'تم إضافة التمرين بنجاح';
                $response['workout'] = $newWorkout;
                break;
            }
        }
    }
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}
?>