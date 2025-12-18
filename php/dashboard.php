<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$dataFile = 'data.json';

// قراءة البيانات من JSON
function readData() {
    global $dataFile;
    if (!file_exists($dataFile)) {
        return ['users' => [], 'workouts' => [], 'ads' => []];
    }
    $json = file_get_contents($dataFile);
    return json_decode($json, true);
}

// الحصول على بيانات الداشبورد
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = readData();
    
    // الحصول على userId من الـ POST أو GET
    $userId = $_GET['userId'] ?? '';
    
    // إذا مفيش userId في الـ URL، نجرب من الـ POST
    if (!$userId && isset($_POST['userId'])) {
        $userId = $_POST['userId'];
    }
    
    $response = [
        'success' => true,
        'stats' => [
            'totalWorkouts' => 0,
            'totalCalories' => 0,
            'totalMinutes' => 0,
            'streakDays' => 0
        ],
        'ads' => [],
        'recentWorkouts' => []
    ];
    
    // الإعلانات
    if (isset($data['ads'])) {
        $response['ads'] = $data['ads'];
    } else {
        // إعلانات افتراضية إذا مفيش إعلانات في JSON
        $response['ads'] = [
            [
                'id' => 'ad1',
                'title' => 'خصم 20% على الاشتراك السنوي',
                'description' => 'استفد من العرض لفترة محدودة',
                'type' => 'عرض خاص',
                'image' => '',
                'link' => '#',
                'buttonText' => 'احصل على الخصم'
            ],
            [
                'id' => 'ad2',
                'title' => 'جلسات تدريب شخصي',
                'description' => 'احصل على تدريب شخصي مع أفضل المدربين',
                'type' => 'خدمة جديدة',
                'image' => '',
                'link' => '#',
                'buttonText' => 'احجز الآن'
            ]
        ];
    }
    
    // إذا كان هناك مستخدم
    if ($userId) {
        foreach ($data['users'] as $user) {
            if ($user['id'] === $userId) {
                // حساب الإحصائيات
                if (isset($user['workouts']) && is_array($user['workouts'])) {
                    foreach ($user['workouts'] as $workout) {
                        $response['stats']['totalWorkouts']++;
                        $response['stats']['totalCalories'] += ($workout['calories'] ?? 0);
                        $response['stats']['totalMinutes'] += ($workout['duration'] ?? 0);
                    }
                    
                    // آخر 5 تمارين
                    $recentWorkouts = array_slice($user['workouts'], -5);
                    $response['recentWorkouts'] = array_reverse($recentWorkouts); // الأحدث أولاً
                }
                break;
            }
        }
    }
    
    // إذا مفيش تمارين، نضيف بعض التمارين التجريبية
    if (empty($response['recentWorkouts'])) {
        $response['recentWorkouts'] = [
            [
                'id' => 'workout1',
                'name' => 'تمرين الصدر',
                'type' => 'chest',
                'duration' => 45,
                'calories' => 300,
                'date' => date('Y-m-d')
            ],
            [
                'id' => 'workout2',
                'name' => 'تمرين الأرجل',
                'type' => 'legs',
                'duration' => 60,
                'calories' => 450,
                'date' => date('Y-m-d', strtotime('-1 day'))
            ]
        ];
        
        // تحديث الإحصائيات بناءً على التمارين التجريبية
        foreach ($response['recentWorkouts'] as $workout) {
            $response['stats']['totalWorkouts']++;
            $response['stats']['totalCalories'] += $workout['calories'];
            $response['stats']['totalMinutes'] += $workout['duration'];
        }
        
        $response['stats']['streakDays'] = 2;
    }
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}
?>