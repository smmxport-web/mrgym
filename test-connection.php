<?php
header('Content-Type: text/html; charset=utf-8');
echo "<h1>✅ PHP يعمل بشكل صحيح</h1>";
echo "<p>تاريخ السيرفر: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>الملف الحالي: " . __FILE__ . "</p>";

// اختبار كتابة الملفات
$testFile = 'test_write.txt';
if (file_put_contents($testFile, 'test')) {
    echo "<p>✅ يمكن كتابة الملفات</p>";
    unlink($testFile);
} else {
    echo "<p>❌ لا يمكن كتابة الملفات</p>";
}

// اختبار JSON
$jsonTest = json_encode(['test' => 'data']);
if ($jsonTest) {
    echo "<p>✅ JSON يعمل</p>";
} else {
    echo "<p>❌ JSON لا يعمل</p>";
}
?>