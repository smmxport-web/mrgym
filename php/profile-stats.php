<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// ملف البيانات
$dataFile = __DIR__ . '/data.json';

// إذا مفيش ملف، نرجع بيانات افتراضية
if (!file_exists($dataFile)) {
    echo json_encode([
        'success' => true,
        'stats' => [
            'totalSessions' => 15,
            'totalCalories' => 3250,
            'totalHours' => 9,
            'streakDays' => 7
        ],
        'progress' => [
            'sessions' => 15,
            'goals' => 3,
            'attendance' => 85
        ],
        'info' => [
            'level' => 'مبتدئ',
            'weeklyGoal' => '5 حصص',
            'avgDuration' => '45 دقيقة'
        ]
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// قراءة البيانات
$json = file_get_contents($dataFile);
$data = json_decode($json, true);

// الحصول على userId
$userId = $_GET['userId'] ?? '';

// بيانات افتراضية
$response = [
    'success' => true,
    'stats' => [
        'totalSessions' => 0,
        'totalCalories' => 0,
        'totalHours' => 0,
        'streakDays' => 0
    ],
    'progress' => [
        'sessions' => 0,
        'goals' => 0,
        'attendance' => 0
    ],
    'info' => [
        'level' => 'مبتدئ',
        'weeklyGoal' => '5 حصص',
        'avgDuration' => '45 دقيقة'
    ]
];

// إذا في userId، نحاول نجيب بياناته
if ($userId && isset($data['users'])) {
    foreach ($data['users'] as $user) {
        if ($user['id'] === $userId) {
            // حساب الإحصائيات
            if (isset($user['workouts']) && is_array($user['workouts'])) {
                $totalSessions = count($user['workouts']);
                $totalCalories = 0;
                $totalMinutes = 0;
                
                foreach ($user['workouts'] as $workout) {
                    $totalCalories += ($workout['calories'] ?? 0);
                    $totalMinutes += ($workout['duration'] ?? 0);
                }
                
                $response['stats']['totalSessions'] = $totalSessions;
                $response['stats']['totalCalories'] = $totalCalories;
                $response['stats']['totalHours'] = floor($totalMinutes / 60);
                
                // حساب الأيام المتتالية (مبسط)
                if ($totalSessions > 0) {
                    $response['stats']['streakDays'] = min(30, floor($totalSessions / 3));
                }
                
                // حساب التقدم
                $response['progress']['sessions'] = min(30, floor($totalSessions / 2));
                $response['progress']['goals'] = min(5, floor($totalSessions / 3));
                $response['progress']['attendance'] = min(100, floor(($totalSessions / 30) * 100));
                
                // تحديد المستوى
                if ($totalSessions >= 50) {
                    $response['info']['level'] = 'متقدم';
                } elseif ($totalSessions >= 20) {
                    $response['info']['level'] = 'متوسط';
                } else {
                    $response['info']['level'] = 'مبتدئ';
                }
                
                // حساب الهدف الأسبوعي
                $response['info']['weeklyGoal'] = max(3, floor($totalSessions / 4)) . ' حصص';
                
                // حساب متوسط المدة
                if ($totalSessions > 0) {
                    $avgDuration = floor($totalMinutes / $totalSessions);
                    $response['info']['avgDuration'] = $avgDuration . ' دقيقة';
                }
            }
            break;
        }
    }
}

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>