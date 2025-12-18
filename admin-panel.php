<?php
require_once 'admin-auth.php';

// إذا لم يكن مسجل دخول، اعرض واجهة الدخول
if(!is_admin_logged_in() && !isset($_POST['action'])): 
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MRGYM - تسجيل دخول المدير</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            backdrop-filter: blur(10px);
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 5px;
        }
        
        .logo p {
            color: #666;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 600;
            font-size: 14px;
        }
        
        .form-group input {
            width: 100%;
            padding: 14px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
            background: #f8f9fa;
        }
        
        .form-group input:focus {
            border-color: #667eea;
            background: white;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.1);
        }
        
        .error-message {
            background: #fee;
            color: #c33;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #fcc;
        }
        
        .admin-note {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1>🏋️‍♂️ MRGYM</h1>
            <p>لوحة تحكم المدير</p>
        </div>
        
        <?php if(isset($login_error)): ?>
            <div class="error-message"><?php echo $login_error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <input type="hidden" name="action" value="login">
            
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" required 
                       placeholder="admin@gym.com">
            </div>
            
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" id="password" name="password" required 
                       placeholder="●●●●●●●●">
            </div>
            
            <button type="submit" class="login-btn">تسجيل الدخول</button>
        </form>
        
        <div class="admin-note">
            البريد الافتراضي: admin@gym.com | كلمة المرور: admin123
        </div>
    </div>
</body>
</html>

<?php
// إذا كان مسجلاً، اعرض لوحة التحكم
elseif(is_admin_logged_in()):
    
// قراءة بيانات الأعضاء من ملف JSON (إن وجد)
$members_file = 'data/members.json';
$members = [];
if(file_exists($members_file)) {
    $members_data = file_get_contents($members_file);
    $members = json_decode($members_data, true) ?: [];
}

// قراءة بيانات الحجوزات (إن وجدت)
$bookings_file = 'data/bookings.json';
$bookings = [];
if(file_exists($bookings_file)) {
    $bookings_data = file_get_contents($bookings_file);
    $bookings = json_decode($bookings_data, true) ?: [];
}

// معالجة طلبات الإدارة
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if($action === 'add_member') {
        $new_member = [
            'id' => uniqid(),
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'membership' => $_POST['membership'],
            'join_date' => date('Y-m-d'),
            'status' => 'active'
        ];
        $members[] = $new_member;
        file_put_contents($members_file, json_encode($members, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $success_message = "تم إضافة العضو بنجاح!";
    }
    
    elseif($action === 'delete_member') {
        $member_id = $_POST['member_id'];
        $members = array_filter($members, function($m) use ($member_id) {
            return $m['id'] !== $member_id;
        });
        file_put_contents($members_file, json_encode(array_values($members), JSON_PRETTY_PRINT));
        $success_message = "تم حذف العضو بنجاح!";
    }
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MRGYM - لوحة تحكم المدير</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --dark: #2d3748;
            --light: #f8f9fa;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: #f5f7fb;
            color: var(--dark);
        }
        
        /* شريط التنقل العلوي */
        .admin-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .logo-area h1 {
            font-size: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-area {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info {
            text-align: right;
        }
        
        .user-name {
            font-weight: 600;
            font-size: 16px;
        }
        
        .user-email {
            font-size: 12px;
            opacity: 0.9;
        }
        
        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        
        /* المحتوى الرئيسي */
        .admin-container {
            display: flex;
            min-height: calc(100vh - 70px);
        }
        
        /* القائمة الجانبية */
        .admin-sidebar {
            width: 250px;
            background: white;
            padding: 25px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }
        
        .sidebar-menu {
            list-style: none;
        }
        
        .menu-item {
            padding: 15px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #64748b;
            text-decoration: none;
            transition: all 0.3s;
            border-right: 3px solid transparent;
        }
        
        .menu-item:hover, .menu-item.active {
            background: #f1f5f9;
            color: var(--primary);
            border-right-color: var(--primary);
        }
        
        .menu-item i {
            width: 20px;
            text-align: center;
        }
        
        /* المحتوى */
        .admin-content {
            flex: 1;
            padding: 30px;
        }
        
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .page-title {
            font-size: 28px;
            color: var(--dark);
        }
        
        .add-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        /* بطاقات الإحصائيات */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
            border-top: 4px solid var(--primary);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }
        
        .stat-title {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark);
        }
        
        .stat-change {
            font-size: 14px;
            color: var(--success);
            margin-top: 5px;
        }
        
        /* الجداول */
        .data-table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }
        
        .table-header {
            padding: 20px 25px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .table-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background: #f8fafc;
        }
        
        th {
            padding: 15px 20px;
            text-align: right;
            color: #64748b;
            font-weight: 600;
            font-size: 14px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        td {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f5f9;
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        tr:hover td {
            background: #f8fafc;
        }
        
        .member-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-active {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .action-btns {
            display: flex;
            gap: 8px;
        }
        
        .btn-icon {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            color: white;
        }
        
        .btn-edit {
            background: var(--primary);
        }
        
        .btn-delete {
            background: var(--danger);
        }
        
        .btn-view {
            background: var(--success);
        }
        
        .btn-icon:hover {
            opacity: 0.9;
            transform: scale(1.05);
        }
        
        /* نماذج */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            display: none;
        }
        
        .modal {
            background: white;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            padding: 30px;
            animation: modalSlide 0.3s ease-out;
        }
        
        @keyframes modalSlide {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .modal-title {
            font-size: 22px;
            color: var(--dark);
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #94a3b8;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #475569;
            font-weight: 600;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            background: white;
        }
        
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }
        
        .btn {
            padding: 12px 25px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }
        
        .btn-secondary {
            background: #e2e8f0;
            color: #475569;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        
        /* التنبيهات */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .close-alert {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }
        
        /* تصميم متجاوب */
        @media (max-width: 992px) {
            .admin-sidebar {
                width: 70px;
            }
            
            .menu-item span {
                display: none;
            }
        }
        
        @media (max-width: 768px) {
            .admin-container {
                flex-direction: column;
            }
            
            .admin-sidebar {
                width: 100%;
                padding: 15px 0;
            }
            
            .sidebar-menu {
                display: flex;
                overflow-x: auto;
            }
            
            .menu-item {
                white-space: nowrap;
                border-right: none;
                border-bottom: 3px solid transparent;
            }
            
            .menu-item:hover, .menu-item.active {
                border-right: none;
                border-bottom-color: var(--primary);
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- شريط التنقل العلوي -->
    <header class="admin-header">
        <div class="logo-area">
            <h1><i class="fas fa-dumbbell"></i> MRGYM Dashboard</h1>
        </div>
        
        <div class="user-area">
            <div class="user-info">
                <div class="user-name"><?php echo $_SESSION['admin_name']; ?></div>
                <div class="user-email"><?php echo $_SESSION['admin_email']; ?></div>
            </div>
            
            <form method="POST" action="">
                <input type="hidden" name="action" value="logout">
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> خروج
                </button>
            </form>
        </div>
    </header>
    
    <!-- المحتوى الرئيسي -->
    <div class="admin-container">
        <!-- القائمة الجانبية -->
        <nav class="admin-sidebar">
            <ul class="sidebar-menu">
                <li>
                    <a href="#" class="menu-item active">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>لوحة التحكم</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item" onclick="openModal('members')">
                        <i class="fas fa-users"></i>
                        <span>إدارة الأعضاء</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <i class="fas fa-calendar-check"></i>
                        <span>الحجوزات</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <i class="fas fa-dumbbell"></i>
                        <span>التمارين</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <i class="fas fa-credit-card"></i>
                        <span>المدفوعات</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>التقارير</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <i class="fas fa-cog"></i>
                        <span>الإعدادات</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- المحتوى -->
        <main class="admin-content">
            <?php if(isset($success_message)): ?>
                <div class="alert alert-success">
                    <span><?php echo $success_message; ?></span>
                    <button class="close-alert">&times;</button>
                </div>
            <?php endif; ?>
            
            <div class="content-header">
                <h2 class="page-title">مرحباً بعودتك، <?php echo $_SESSION['admin_name']; ?> 👋</h2>
                <button class="add-btn" onclick="openModal('addMember')">
                    <i class="fas fa-user-plus"></i> إضافة عضو جديد
                </button>
            </div>
            
            <!-- إحصائيات -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">إجمالي الأعضاء</div>
                            <div class="stat-value"><?php echo count($members); ?></div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-change">+2 هذا الأسبوع</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">الحجوزات النشطة</div>
                            <div class="stat-value"><?php echo count($bookings); ?></div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                    <div class="stat-change">+5 اليوم</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">الإيرادات</div>
                            <div class="stat-value">
                                <?php echo count($members) * 300; ?> ج.م
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                    </div>
                    <div class="stat-change">+12% عن الشهر الماضي</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">نسبة الإشغال</div>
                            <div class="stat-value">78%</div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="stat-change">+5% عن الأسبوع الماضي</div>
                </div>
            </div>
            
            <!-- جدول الأعضاء -->
            <div class="data-table-container">
                <div class="table-header">
                    <h3 class="table-title">الأعضاء المسجلين</h3>
                    <div class="table-actions">
                        <button class="btn btn-secondary">
                            <i class="fas fa-download"></i> تصدير
                        </button>
                    </div>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>العضو</th>
                            <th>البريد الإلكتروني</th>
                            <th>الهاتف</th>
                            <th>نوع العضوية</th>
                            <th>تاريخ الانضمام</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($members)): ?>
                            <tr>
                                <td colspan="8" style="text-align: center; padding: 40px; color: #94a3b8;">
                                    <i class="fas fa-users-slash" style="font-size: 40px; margin-bottom: 15px; display: block;"></i>
                                    لا توجد أعضاء مسجلين بعد
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach(array_slice($members, 0, 5) as $index => $member): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div class="member-avatar">
                                            <?php echo strtoupper(substr($member['name'], 0, 1)); ?>
                                        </div>
                                        <?php echo htmlspecialchars($member['name']); ?>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($member['email'] ?? 'غير محدد'); ?></td>
                                <td><?php echo htmlspecialchars($member['phone'] ?? 'غير محدد'); ?></td>
                                <td><?php echo htmlspecialchars($member['membership'] ?? 'شهري'); ?></td>
                                <td><?php echo $member['join_date'] ?? date('Y-m-d'); ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo $member['status'] ?? 'active'; ?>">
                                        <?php echo ($member['status'] ?? 'active') === 'active' ? 'نشط' : 'غير نشط'; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <button class="btn-icon btn-view" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn-icon btn-edit" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="action" value="delete_member">
                                            <input type="hidden" name="member_id" value="<?php echo $member['id']; ?>">
                                            <button type="submit" class="btn-icon btn-delete" title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذا العضو؟')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    
    <!-- نموذج إضافة عضو -->
    <div id="addMemberModal" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">إضافة عضو جديد</h3>
                <button class="close-modal" onclick="closeModal('addMemberModal')">&times;</button>
            </div>
            
            <form method="POST" action="">
                <input type="hidden" name="action" value="add_member">
                
                <div class="form-group">
                    <label class="form-label">الاسم الكامل</label>
                    <input type="text" name="name" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="tel" name="phone" class="form-input">
                </div>
                
                <div class="form-group">
                    <label class="form-label">نوع العضوية</label>
                    <select name="membership" class="form-select" required>
                        <option value="شهري">عضوية شهرية - 300 ج.م</option>
                        <option value="ربع سنوي">عضوية ربع سنوية - 800 ج.م</option>
                        <option value="نصف سنوي">عضوية نصف سنوية - 1500 ج.م</option>
                        <option value="سنوي">عضوية سنوية - 2800 ج.م</option>
                    </select>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addMemberModal')">
                        إلغاء
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> حفظ العضو
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // إدارة النماذج
        function openModal(modalId) {
            if(modalId === 'addMember') {
                document.getElementById('addMemberModal').style.display = 'flex';
            }
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
        
        // إغلاق النماذج عند النقر خارجها
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if(e.target === this) {
                    this.style.display = 'none';
                }
            });
        });
        
        // إغلاق التنبيهات
        document.querySelectorAll('.close-alert').forEach(btn => {
            btn.addEventListener('click', function() {
                this.parentElement.style.display = 'none';
            });
        });
        
        // تحديث الوقت
        function updateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('currentTime').textContent = 
                now.toLocaleDateString('ar-SA', options);
        }
        
        updateTime();
        setInterval(updateTime, 60000);
    </script>
</body>
</html>

<?php 
else:
    // في حالة فشل المصادقة
    header('Location: admin-panel.php');
    exit();
endif; 
?>