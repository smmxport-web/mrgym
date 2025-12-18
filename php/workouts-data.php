<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// ملف البيانات
$dataFile = __DIR__ . '/workouts.json';

// إذا مفيش ملف، نعمله ببيانات تجريبية
if (!file_exists($dataFile)) {
    $initialWorkouts = [
        [
            'id' => '1',
            'name' => 'تمرين ضغط الصدر',
            'category' => 'chest',
            'difficulty' => 'beginner',
            'description' => 'تمرين أساسي لتقوية عضلات الصدر الأمامية',
            'duration' => 30,
            'calories' => 200,
            'sets' => 3,
            'reps' => 15,
            'steps' => [
                'استلقي على الأرض مع ثني الركبتين',
                'ضع يديك بمحاذاة الصدر مع مباعدتهما',
                'اخفض جسمك حتى يقترب الصدر من الأرض',
                'ارفع جسمك للوضع الأول مع الزفير'
            ]
        ],
        [
            'id' => '2',
            'name' => 'تمرين العقلة',
            'category' => 'back',
            'difficulty' => 'intermediate',
            'description' => 'تمرين ممتاز لتقوية عضلات الظهر والعضلة الظهرية',
            'duration' => 25,
            'calories' => 180,
            'sets' => 4,
            'reps' => 10,
            'steps' => [
                'أمسك بالعقلة بيديك مع المباعدة',
                'ارفع جسمك حتى تصل الذقن للعقلة',
                'اخفض جسمك ببطء للوضع الأول'
            ]
        ],
        [
            'id' => '3',
            'name' => 'تمرين القرفصاء',
            'category' => 'legs',
            'difficulty' => 'beginner',
            'description' => 'تمرين أساسي لعضلات الأرجل والأرداف',
            'duration' => 20,
            'calories' => 150,
            'sets' => 3,
            'reps' => 20,
            'steps' => [
                'قف مستقيمًا مع مباعدة القدمين',
                'اخفض جسمك كما لو تجلس على كرسي',
                'احفظ الظهر مستقيماً',
                'ارجع للوضع الأول'
            ]
        ],
        [
            'id' => '4',
            'name' => 'تمرين البايسبس',
            'category' => 'arms',
            'difficulty' => 'beginner',
            'description' => 'تمرين لعضلات الذراع الأمامية (البايسبس)',
            'duration' => 15,
            'calories' => 100,
            'sets' => 3,
            'reps' => 12,
            'steps' => [
                'أمسك الدمبل بيدك',
                'اثني الذراع نحو الكتف',
                'اخفض الدمبل ببطء'
            ]
        ],
        [
            'id' => '5',
            'name' => 'تمرين الضغط المائل',
            'category' => 'shoulders',
            'difficulty' => 'intermediate',
            'description' => 'تمرين لعضلات الأكتاف الجانبية',
            'duration' => 25,
            'calories' => 120,
            'sets' => 4,
            'reps' => 12,
            'steps' => [
                'استلقي على جانبك',
                'ارفع الجسم بالذراع السفلى',
                'اخفض الجسم ببطء'
            ]
        ],
        [
            'id' => '6',
            'name' => 'تمرين الجري',
            'category' => 'cardio',
            'difficulty' => 'beginner',
            'description' => 'تمرين كارديو لتحسين اللياقة القلبية',
            'duration' => 30,
            'calories' => 300,
            'sets' => 1,
            'reps' => 1,
            'steps' => [
                'ابدأ بالمشي البطيء',
                'زد السرعة تدريجياً',
                'حافظ على وتيرة ثابتة'
            ]
        ],
        [
            'id' => '7',
            'name' => 'تمرين البلانك',
            'category' => 'abs',
            'difficulty' => 'intermediate',
            'description' => 'تمرين لتقوية عضلات البطن والوسط',
            'duration' => 10,
            'calories' => 80,
            'sets' => 3,
            'reps' => 1,
            'steps' => [
                'استلقي على بطنك',
                'ارفع الجسم على الذراعين وأصابع القدم',
                'احفظ الجسم في خط مستقيم'
            ]
        ]
    ];
    
    file_put_contents($dataFile, json_encode($initialWorkouts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// قراءة البيانات
$json = file_get_contents($dataFile);
$workouts = json_decode($json, true);

// إذا طلب تمرين محدد
if (isset($_GET['id'])) {
    $workoutId = $_GET['id'];
    $foundWorkout = null;
    
    foreach ($workouts as $workout) {
        if ($workout['id'] === $workoutId) {
            $foundWorkout = $workout;
            break;
        }
    }
    
    if ($foundWorkout) {
        echo json_encode([
            'success' => true,
            'workout' => $foundWorkout
        ], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'لم يتم العثور على التمرين'
        ], JSON_UNESCAPED_UNICODE);
    }
    
    exit;
}

// إرجاع كل التمارين
echo json_encode([
    'success' => true,
    'workouts' => $workouts,
    'count' => count($workouts)
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>