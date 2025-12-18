<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// ملف البيانات
$dataFile = __DIR__ . '/data.json';

// إذا مفيش ملف، نعمله
if (!file_exists($dataFile)) {
    $initialData = [
        'ads' => [
            [
                'id' => 'ad1',
                'title' => 'خصم 20% على الاشتراك السنوي',
                'description' => 'استفد من العرض لفترة محدودة',
                'type' => 'عرض خاص',
                'buttonText' => 'احصل على الخصم'
            ],
            [
                'id' => 'ad2',
                'title' => 'جلسات تدريب شخصي',
                'description' => 'احصل على تدريب شخصي مع أفضل المدربين',
                'type' => 'خدمة جديدة',
                'buttonText' => 'احجز الآن'
            ]
        ],
        'users' => []
    ];
    
    file_put_contents($dataFile, json_encode($initialData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// قراءة البيانات
$json = file_get_contents($dataFile);
$data = json_decode($json, true);

// بيانات افتراضية للداشبورد
$response = [
    'success' => true,
    'stats' => [
        'totalWorkouts' => rand(10, 50),
        'totalCalories' => rand(2000, 10000),
        'totalMinutes' => rand(500, 3000),
        'streakDays' => rand(1, 30)
    ],
    'ads' => $data['ads'] ?? [
        [
            'id' => 'ad1',
            'title' => 'مرحباً بك في GYM Pro',
            'description' => 'ابدأ رحلتك الرياضية معنا',
            'type' => 'ترحيب',
            'buttonText' => 'ابدأ الآن'
        ]
    ],
    'recentWorkouts' => [
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
        ],
        [
            'id' => 'workout3',
            'name' => 'تمرين الظهر',
            'type' => 'back',
            'duration' => 50,
            'calories' => 320,
            'date' => date('Y-m-d', strtotime('-2 days'))
        ]
    ]
];

// إذا في userId، نحاول نجيب بياناته
$userId = $_GET['userId'] ?? '';
if ($userId && isset($data['users'])) {
    foreach ($data['users'] as $user) {
        if ($user['id'] === $userId) {
            if (isset($user['workouts']) && count($user['workouts']) > 0) {
                // حساب الإحصائيات الحقيقية
                $totalWorkouts = count($user['workouts']);
                $totalCalories = 0;
                $totalMinutes = 0;
                
                foreach ($user['workouts'] as $workout) {
                    $totalCalories += ($workout['calories'] ?? 0);
                    $totalMinutes += ($workout['duration'] ?? 0);
                }
                
                $response['stats']['totalWorkouts'] = $totalWorkouts;
                $response['stats']['totalCalories'] = $totalCalories;
                $response['stats']['totalMinutes'] = $totalMinutes;
                
                // آخر التمارين
                $response['recentWorkouts'] = array_slice($user['workouts'], -3);
            }
            break;
        }
    }
}

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>