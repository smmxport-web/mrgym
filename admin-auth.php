<?php
session_start();

// بيانات المدير الافتراضية (يمكن تغييرها لاحقاً)
$ADMIN_CREDENTIALS = [
    'email' => 'admin@gym.com',
    'password' => 'admin123', // سيتم تشفيرها
    'name' => 'مدير النظام'
];

// تشفير كلمة المرور عند التشغيل الأول
if(!isset($_SESSION['admin_setup'])) {
    $ADMIN_CREDENTIALS['password'] = password_hash($ADMIN_CREDENTIALS['password'], PASSWORD_DEFAULT);
    $_SESSION['admin_setup'] = true;
}

// وظيفة تسجيل الدخول
function admin_login($email, $password) {
    global $ADMIN_CREDENTIALS;
    
    if($email === $ADMIN_CREDENTIALS['email'] && 
       password_verify($password, $ADMIN_CREDENTIALS['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = $ADMIN_CREDENTIALS['name'];
        $_SESSION['admin_email'] = $email;
        return true;
    }
    return false;
}

// وظيفة التحقق من تسجيل الدخول
function is_admin_logged_in() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// وظيفة تسجيل الخروج
function admin_logout() {
    session_destroy();
    header('Location: admin-panel.php');
    exit();
}

// معالجة طلبات تسجيل الدخول
if(isset($_POST['action'])) {
    if($_POST['action'] === 'login') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if(admin_login($email, $password)) {
            header('Location: admin-panel.php');
            exit();
        } else {
            $login_error = "بيانات الدخول غير صحيحة!";
        }
    }
    
    if($_POST['action'] === 'logout') {
        admin_logout();
    }
}
?>