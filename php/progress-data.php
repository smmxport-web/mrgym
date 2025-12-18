<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// ملف البيانات
$dataFile = __DIR__ . '/data.json';

// الحصول على المعاملات
$userId = $_GET['userId'] ?? '';
$period = $_GET['period'] ?? 'week';

// إذا مفيش ملف، نرجع بيانات افتراضية
if (!file_exists($dataFile)) {
    echo getDefaultProgressData($period);
    exit;
}

// قراءة البيانات
$json = file_get_contents($dataFile);
$data = json_decode($json, true);

// البحث عن المستخدم
$userData = null;
if ($userId && isset($data['users'])) {
    foreach ($data['users'] as $user) {
        if ($user['id'] === $userId) {
            $userData = $user;
            break;
        }
    }
}

// إذا مفيش بيانات للمستخدم، نرجع بيانات افتراضية
if (!$userData) {
    echo getDefaultProgressData($period);
    exit;
}

// حساب البيانات حسب الفترة المحددة
$response = calculateProgressData($userData, $period);

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

// دالة لحساب بيانات التقدم
function calculateProgressData($userData, $period) {
    // بيانات افتراضية (يمكن تطويرها لتحليل بيانات حقيقية)
    $workouts = $userData['workouts'] ?? [];
    $workoutsCount = count($workouts);
    
    // حساب الإحصائيات الأساسية
    $totalCalories = 0;
    $totalMinutes = 0;
    $workoutTypes = [];
    
    foreach ($workouts as $workout) {
        $totalCalories += ($workout['calories'] ?? 0);
        $totalMinutes += ($workout['duration'] ?? 0);
        
        $type = $workout['type'] ?? 'other';
        if (!isset($workoutTypes[$type])) {
            $workoutTypes[$type] = 0;
        }
        $workoutTypes[$type]++;
    }
    
    // توزيع التمارين
    $distribution = [];
    foreach ($workoutTypes as $type => $count) {
        $percentage = $workoutsCount > 0 ? round(($count / $workoutsCount) * 100) : 0;
        $distribution[] = [
            'type' => $type,
            'count' => $count,
            'percentage' => $percentage
        ];
    }
    
    // تحديد البيانات حسب الفترة
    switch ($period) {
        case 'week':
            $summaryLabel = 'هذا الأسبوع';
            $chartLabel = 'آخر 7 أيام';
            break;
        case 'month':
            $summaryLabel = 'هذا الشهر';
            $chartLabel = 'آخر 30 يوم';
            break;
        case '3months':
            $summaryLabel = 'آخر 3 شهور';
            $chartLabel = 'آخر 90 يوم';
            break;
        case '6months':
            $summaryLabel = 'آخر 6 شهور';
            $chartLabel = 'آخر 180 يوم';
            break;
        case 'year':
            $summaryLabel = 'هذه السنة';
            $chartLabel = 'آخر 12 شهر';
            break;
        default:
            $summaryLabel = 'الكل';
            $chartLabel = 'كل الفترات';
    }
    
    return [
        'success' => true,
        'summary' => [
            'totalWorkouts' => $workoutsCount,
            'totalCalories' => $totalCalories,
            'totalTime' => floor($totalMinutes / 60),
            'avgSession' => $workoutsCount > 0 ? floor($totalMinutes / $workoutsCount) : 0,
            'workoutsChange' => rand(5, 20),
            'caloriesChange' => rand(3, 15),
            'timeChange' => rand(8, 25),
            'avgChange' => rand(1, 10),
            'label' => $summaryLabel
        ],
        'charts' => [
            'weeklySessions' => [
                'data' => array_map(fn() => rand(0, 4), range(1, 7)),
                'label' => $summaryLabel
            ],
            'calories' => [
                'labels' => ['أسبوع 1', 'أسبوع 2', 'أسبوع 3', 'أسبوع 4'],
                'data' => array_map(fn() => rand(1000, 2000), range(1, 4)),
                'label' => $chartLabel
            ]
        ],
        'distribution' => $distribution,
        'achievements' => getAchievements($workoutsCount, $totalCalories),
        'weeklyProgress' => getWeeklyProgress()
    ];
}

// دالة للحصول على الإنجازات
function getAchievements($workoutsCount, $totalCalories) {
    $achievements = [
        [
            'title' => 'أول خطوة',
            'description' => 'أكمل أول حصة تدريب',
            'achieved' => $workoutsCount >= 1
        ],
        [
            'title' => 'متفاني',
            'description' => 'أكمل 10 حصص تدريب',
            'achieved' => $workoutsCount >= 10
        ],
        [
            'title' => 'متفوق',
            'description' => 'أكمل 50 حصة تدريب',
            'achieved' => $workoutsCount >= 50
        ],
        [
            'title' => 'محترق',
            'description' => 'أحرق 1000 سعرة حرارية',
            'achieved' => $totalCalories >= 1000
        ],
        [
            'title' => 'فرن',
            'description' => 'أحرق 5000 سعرة حرارية',
            'achieved' => $totalCalories >= 5000
        ],
        [
            'title' => 'أسبوعي منتظم',
            'description' => 'تمرن 3 أيام متتالية',
            'achieved' => $workoutsCount >= 3
        ],
        [
            'title' => 'شهري نشيط',
            'description' => 'تمرن 15 يوماً في الشهر',
            'achieved' => $workoutsCount >= 15
        ],
        [
            'title' => 'متعدد المهارات',
            'description' => 'جرب 5 أنواع تمارين مختلفة',
            'achieved' => $workoutsCount >= 5
        ],
        [
            'title' => 'طويل النفس',
            'description' => 'تمرين لمدة ساعة متواصلة',
            'achieved' => $workoutsCount >= 1
        ],
        [
            'title' => 'مستمر',
            'description' => 'حافظ على التمرين لمدة شهر',
            'achieved' => $workoutsCount >= 8
        ]
    ];
    
    return $achievements;
}

// دالة للحصول على التقدم الأسبوعي
function getWeeklyProgress() {
    $weeklyProgress = [];
    
    for ($i = 0; $i < 7; $i++) {
        $hasWorkout = rand(0, 1) === 1;
        $weeklyProgress[] = [
            'day' => $i,
            'hasWorkout' => $hasWorkout,
            'sessions' => $hasWorkout ? rand(1, 4) : 0
        ];
    }
    
    return $weeklyProgress;
}

// دالة للحصول على بيانات افتراضية
function getDefaultProgressData($period) {
    $workoutsCount = rand(15, 50);
    $totalCalories = $workoutsCount * rand(200, 300);
    $totalMinutes = $workoutsCount * rand(30, 60);
    
    $distribution = [
        ['type' => 'chest', 'count' => rand(3, 8), 'percentage' => rand(20, 40)],
        ['type' => 'back', 'count' => rand(2, 6), 'percentage' => rand(15, 35)],
        ['type' => 'legs', 'count' => rand(2, 5), 'percentage' => rand(10, 30)],
        ['type' => 'arms', 'count' => rand(1, 4), 'percentage' => rand(5, 20)],
        ['type' => 'cardio', 'count' => rand(1, 3), 'percentage' => rand(5, 15)]
    ];
    
    // حساب النسب المئوية الإجمالية
    $totalCount = array_sum(array_column($distribution, 'count'));
    foreach ($distribution as &$item) {
        $item['percentage'] = $totalCount > 0 ? round(($item['count'] / $totalCount) * 100) : 0;
    }
    
    return json_encode([
        'success' => true,
        'summary' => [
            'totalWorkouts' => $workoutsCount,
            'totalCalories' => $totalCalories,
            'totalTime' => floor($totalMinutes / 60),
            'avgSession' => floor($totalMinutes / $workoutsCount),
            'workoutsChange' => rand(5, 20),
            'caloriesChange' => rand(3, 15),
            'timeChange' => rand(8, 25),
            'avgChange' => rand(1, 10)
        ],
        'charts' => [
            'weeklySessions' => [
                'data' => array_map(fn() => rand(0, 4), range(1, 7)),
                'label' => 'هذا الأسبوع'
            ],
            'calories' => [
                'labels' => ['أسبوع 1', 'أسبوع 2', 'أسبوع 3', 'أسبوع 4'],
                'data' => array_map(fn() => rand(1000, 2000), range(1, 4)),
                'label' => 'آخر 30 يوم'
            ]
        ],
        'distribution' => $distribution,
        'achievements' => getAchievements($workoutsCount, $totalCalories),
        'weeklyProgress' => getWeeklyProgress()
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
?>