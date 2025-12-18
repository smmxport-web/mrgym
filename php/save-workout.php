<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// ملف البيانات
$dataFile = __DIR__ . '/data.json';

// قراءة البيانات المدخلة
$input = file_get_contents('php://input');
$workoutData = json_decode($input, true);

// إذا مفيش بيانات
if (!$workoutData) {
    echo json_encode([
        'success' => false,
        'message' => 'لم يتم استلام بيانات التمرين'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// التحقق من وجود userId
if (!isset($workoutData['userId'])) {
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
    $data = ['users' => [], 'workouts' => []];
}

// البحث عن المستخدم
$userFound = false;
foreach ($data['users'] as &$user) {
    if ($user['id'] === $workoutData['userId']) {
        $userFound = true;
        
        // إنشاء مصفوفة التمارين إذا غير موجودة
        if (!isset($user['workouts'])) {
            $user['workouts'] = [];
        }
        
        // إضافة بيانات إضافية للتمرين
        $workoutData['id'] = 'workout_' . time() . '_' . rand(1000, 9999);
        $workoutData['created_at'] = date('Y-m-d H:i:s');
        
        // إضافة التمرين لمصفوفة التمارين
        $user['workouts'][] = $workoutData;
        
        break;
    }
}

// إذا لم يتم العثور على المستخدم، ننشئ واحد جديد (للحالات الطارئة)
if (!$userFound) {
    $newUser = [
        'id' => $workoutData['userId'],
        'workouts' => [$workoutData]
    ];
    $data['users'][] = $newUser;
}

// حفظ البيانات
try {
    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    echo json_encode([
        'success' => true,
        'message' => 'تم حفظ التمرين بنجاح',
        'workoutId' => $workoutData['id']
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'حدث خطأ في حفظ البيانات: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>