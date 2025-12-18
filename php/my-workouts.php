<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$dataFile = __DIR__ . '/data.json';

// قراءة البيانات
function readData() {
    global $dataFile;
    
    if (!file_exists($dataFile)) {
        return ['users' => []];
    }
    
    $json = file_get_contents($dataFile);
    return json_decode($json, true);
}

// حفظ البيانات
function saveData($data) {
    global $dataFile;
    return file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $userId = $_POST['userId'] ?? '';
    $workoutId = $_POST['workoutId'] ?? '';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($action === 'add' && $userId && $workoutId) {
        $data = readData();
        
        // البحث عن المستخدم
        $userFound = false;
        foreach ($data['users'] as &$user) {
            if ($user['id'] === $userId) {
                $userFound = true;
                
                // إنشاء مصفوفة التمارين إذا غير موجودة
                if (!isset($user['saved_workouts'])) {
                    $user['saved_workouts'] = [];
                }
                
                // إضافة التمرين إذا لم يكن موجوداً
                if (!in_array($workoutId, $user['saved_workouts'])) {
                    $user['saved_workouts'][] = $workoutId;
                    $user['saved_workouts_date'] = date('Y-m-d H:i:s');
                    
                    if (saveData($data)) {
                        $response['success'] = true;
                        $response['message'] = 'تم إضافة التمرين بنجاح';
                    } else {
                        $response['message'] = 'حدث خطأ في حفظ البيانات';
                    }
                } else {
                    $response['message'] = 'التمرين مضاف مسبقاً';
                }
                
                break;
            }
        }
        
        if (!$userFound) {
            $response['message'] = 'المستخدم غير موجود';
        }
    } else {
        $response['message'] = 'بيانات غير كافية';
    }
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

// إذا كان طلب GET، نرجع رسالة
echo json_encode([
    'status' => 'online',
    'message' => 'My Workouts API'
], JSON_UNESCAPED_UNICODE);
?>