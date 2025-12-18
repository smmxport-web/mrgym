<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// ملف البيانات
$dataFile = __DIR__ . '/data.json';

// قراءة البيانات المدخلة
$input = file_get_contents('php://input');
$sessionData = json_decode($input, true);

// إذا مفيش بيانات
if (!$sessionData) {
    echo json_encode([
        'success' => false,
        'message' => 'لم يتم استلام بيانات الجلسة'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// التحقق من وجود userId
if (!isset($sessionData['userId'])) {
    echo json_encode([
        'success' => false,
        'message' => 'معرف المستخدم مطلوب'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// قراءة البيانات الحالية
if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $data = json_decode($json, true);
} else {
    $data = ['users' => [], 'sessions' => []];
}

// إنشاء مصفوفة الجلسات إذا غير موجودة
if (!isset($data['sessions'])) {
    $data['sessions'] = [];
}

// إضافة بيانات إضافية للجلسة
$sessionData['id'] = $sessionData['sessionId'] ?? 'session_' . time();
$sessionData['created_at'] = date('Y-m-d H:i:s');
$sessionData['updated_at'] = date('Y-m-d H:i:s');

// إضافة الجلسة لمصفوفة الجلسات
$data['sessions'][] = $sessionData;

// البحث عن المستخدم وإضافة الجلسة له
$userFound = false;
foreach ($data['users'] as &$user) {
    if ($user['id'] === $sessionData['userId']) {
        $userFound = true;
        
        // إنشاء مصفوفة جلسات المستخدم إذا غير موجودة
        if (!isset($user['training_sessions'])) {
            $user['training_sessions'] = [];
        }
        
        // إضافة الجلسة للمستخدم
        $user['training_sessions'][] = $sessionData['id'];
        
        // إضافة التمارين لمصفوفة workouts
        if (!isset($user['workouts'])) {
            $user['workouts'] = [];
        }
        
        // إنشاء workout من الجلسة
        $workoutData = [
            'id' => $sessionData['id'],
            'name' => $sessionData['name'],
            'type' => 'session',
            'date' => $sessionData['date'],
            'duration' => $sessionData['estimatedDuration'],
            'calories' => $sessionData['calories'],
            'exercises_count' => count($sessionData['exercises']),
            'created_at' => $sessionData['created_at']
        ];
        
        $user['workouts'][] = $workoutData;
        
        break;
    }
}

// حفظ البيانات
try {
    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    echo json_encode([
        'success' => true,
        'message' => 'تم حفظ جلسة التدريب بنجاح',
        'sessionId' => $sessionData['id']
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'حدث خطأ في حفظ البيانات: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>