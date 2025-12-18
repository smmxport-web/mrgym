<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// السماح بجميع أنواع الطلبات
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$dataFile = __DIR__ . '/data.json';

// دالة لكتابة خطأ
function logError($message) {
    error_log("GYM Pro Error: " . $message);
}

// قراءة البيانات من JSON
function readData() {
    global $dataFile;
    
    if (!file_exists($dataFile)) {
        // إنشاء ملف جديد إذا لم يوجد
        $initialData = [
            'users' => [],
            'workouts' => [],
            'ads' => [
                [
                    'id' => 'ad1',
                    'title' => 'خصم 20% على الاشتراك السنوي',
                    'description' => 'استفد من العرض لفترة محدودة',
                    'type' => 'عرض خاص',
                    'buttonText' => 'احصل على الخصم'
                ]
            ],
            'admin' => [
                'username' => 'admin',
                'password' => 'admin123'
            ]
        ];
        
        file_put_contents($dataFile, json_encode($initialData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return $initialData;
    }
    
    $json = file_get_contents($dataFile);
    if ($json === false) {
        logError("Cannot read data file");
        return ['users' => [], 'workouts' => [], 'ads' => [], 'admin' => ['username' => 'admin', 'password' => 'admin123']];
    }
    
    $data = json_decode($json, true);
    if ($data === null) {
        logError("Invalid JSON in data file");
        return ['users' => [], 'workouts' => [], 'ads' => [], 'admin' => ['username' => 'admin', 'password' => 'admin123']];
    }
    
    return $data;
}

// حفظ البيانات في JSON
function saveData($data) {
    global $dataFile;
    
    $result = file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    if ($result === false) {
        logError("Cannot write to data file");
        return false;
    }
    
    return true;
}

// معالجة طلبات POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // الحصول على البيانات المدخلة
    $input = file_get_contents('php://input');
    $postData = [];
    
    // محاولة قراءة البيانات كـ JSON أولاً
    if (!empty($input)) {
        $jsonData = json_decode($input, true);
        if ($jsonData !== null) {
            $postData = $jsonData;
        }
    }
    
    // إذا مفيش بيانات في JSON، نجرب FormData
    if (empty($postData)) {
        $postData = $_POST;
    }
    
    $action = $postData['action'] ?? '';
    $response = ['success' => false, 'message' => 'إجراء غير معروف'];
    
    // تسجيل الدخول
    if ($action === 'login') {
        $phone = $postData['phone'] ?? '';
        $password = $postData['password'] ?? '';
        
        if (empty($phone) || empty($password)) {
            $response['message'] = 'يرجى ملء جميع الحقول';
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            exit;
        }
        
        $data = readData();
        
        // البحث عن المستخدم
        foreach ($data['users'] as $user) {
            if ($user['phone'] === $phone && $user['password'] === $password) {
                $response['success'] = true;
                $response['message'] = 'تم تسجيل الدخول بنجاح';
                $response['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'phone' => $user['phone'],
                    'governorate' => $user['governorate']
                ];
                break;
            }
        }
        
        if (!$response['success']) {
            $response['message'] = 'رقم الهاتف أو كلمة المرور غير صحيحة';
        }
    }
    
    // إنشاء حساب
    elseif ($action === 'register') {
        $name = $postData['name'] ?? '';
        $phone = $postData['phone'] ?? '';
        $governorate = $postData['governorate'] ?? '';
        $password = $postData['password'] ?? '';
        $confirm = $postData['confirm'] ?? '';
        
        // التحقق من البيانات
        if (empty($name) || empty($phone) || empty($governorate) || empty($password) || empty($confirm)) {
            $response['message'] = 'يرجى ملء جميع الحقول';
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            exit;
        }
        
        if ($password !== $confirm) {
            $response['message'] = 'كلمتا المرور غير متطابقتين';
        } elseif (strlen($password) < 6) {
            $response['message'] = 'كلمة المرور يجب أن تكون 6 أحرف على الأقل';
        } elseif (!preg_match('/^01[0-9]{9}$/', $phone)) {
            $response['message'] = 'رقم الهاتف غير صحيح';
        } else {
            $data = readData();
            
            // التحقق من عدم وجود الرقم مسبقاً
            foreach ($data['users'] as $user) {
                if ($user['phone'] === $phone) {
                    $response['message'] = 'رقم الهاتف مسجل مسبقاً';
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    exit;
                }
            }
            
            // إضافة المستخدم الجديد
            $newUser = [
                'id' => 'user_' . time() . '_' . rand(1000, 9999),
                'name' => $name,
                'phone' => $phone,
                'governorate' => $governorate,
                'password' => $password,
                'created_at' => date('Y-m-d H:i:s'),
                'workouts' => []
            ];
            
            $data['users'][] = $newUser;
            
            if (saveData($data)) {
                $response['success'] = true;
                $response['message'] = 'تم إنشاء الحساب بنجاح';
                $response['user'] = [
                    'id' => $newUser['id'],
                    'name' => $newUser['name'],
                    'phone' => $newUser['phone'],
                    'governorate' => $newUser['governorate']
                ];
            } else {
                $response['message'] = 'حدث خطأ في حفظ البيانات';
            }
        }
    }
    
    // دخول الأدمن
    elseif ($action === 'admin_login') {
        $username = $postData['username'] ?? '';
        $password = $postData['password'] ?? '';
        
        $data = readData();
        
        if (isset($data['admin']) && 
            $data['admin']['username'] === $username && 
            $data['admin']['password'] === $password) {
            $response['success'] = true;
            $response['message'] = 'تم دخول الأدمن بنجاح';
            $response['redirect'] = 'admin.php';
        } else {
            $response['message'] = 'بيانات الأدمن غير صحيحة';
        }
    }
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

// إذا كان طلب GET، نرجع رسالة
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode([
        'status' => 'online',
        'message' => 'GYM Pro API is running',
        'endpoints' => ['login', 'register', 'admin_login']
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
?>