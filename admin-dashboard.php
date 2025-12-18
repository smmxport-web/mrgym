<?php
// بداية PHP للتحقق من تسجيل دخول الأدمن
session_start();

// التحقق من أن المستخدم أدمن
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // تحقق من localStorage في الجافاسكريبت
    echo '<script>
        if (!localStorage.getItem("isAdmin") || localStorage.getItem("isAdmin") !== "true") {
            window.location.href = "admin-login.php";
        }
    </script>';
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GYM Pro - لوحة التحكم</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* إضافات خاصة بلوحة التحكم */
        .admin-dashboard-page {
            background-color: #0a0a0a;
            min-height: 100vh;
        }
        
        /* الهيدر */
        .admin-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            padding: 1rem;
            border-bottom: 1px solid #333;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .admin-header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .admin-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .admin-brand-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #2a9d8f 0%, #1d6f65 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
        }
        
        .admin-brand-text h1 {
            font-size: 1.5rem;
            color: #e9ecef;
            margin-bottom: 0.2rem;
        }
        
        .admin-brand-text p {
            color: #adb5bd;
            font-size: 0.9rem;
        }
        
        .admin-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .btn-admin {
            background: none;
            border: 1px solid #444;
            color: #adb5bd;
            padding: 0.7rem 1.2rem;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        
        .btn-admin:hover {
            border-color: #2a9d8f;
            color: #2a9d8f;
        }
        
        .btn-admin-primary {
            background-color: #2a9d8f;
            color: white;
            border: none;
        }
        
        .btn-admin-primary:hover {
            background-color: #1d6f65;
            color: white;
        }
        
        .btn-admin-logout {
            border-color: #e76f51;
            color: #e76f51;
        }
        
        .btn-admin-logout:hover {
            background-color: #e76f51;
            color: white;
        }
        
        /* إحصائيات الأدمن */
        .admin-stats {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
        }
        
        .stats-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #333;
            font-size: 1.2rem;
            color: #e9ecef;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        @media (min-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        .stat-card {
            background-color: #2d2d2d;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid #444;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            border-color: #2a9d8f;
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .stat-icon.users {
            color: #2a9d8f;
        }
        
        .stat-icon.exercises {
            color: #e76f51;
        }
        
        .stat-icon.sessions {
            color: #e9c46a;
        }
        
        .stat-icon.ads {
            color: #f4a261;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #e9ecef;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #adb5bd;
            font-size: 0.9rem;
        }
        
        /* القوائم السريعة */
        .quick-actions {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
        }
        
        .actions-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #333;
            font-size: 1.2rem;
            color: #e9ecef;
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        @media (min-width: 768px) {
            .actions-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        .action-card {
            background-color: #2d2d2d;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid #444;
            text-decoration: none;
            color: #adb5bd;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .action-card:hover {
            background-color: #2a2a2a;
            border-color: #2a9d8f;
            color: #2a9d8f;
            transform: translateY(-5px);
        }
        
        .action-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .action-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .action-desc {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        /* الجلسات الحديثة */
        .recent-sessions {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
        }
        
        .sessions-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #333;
            font-size: 1.2rem;
            color: #e9ecef;
        }
        
        .sessions-table {
            width: 100%;
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th {
            background-color: #2d2d2d;
            color: #adb5bd;
            padding: 1rem;
            text-align: right;
            border-bottom: 2px solid #333;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        td {
            padding: 1rem;
            border-bottom: 1px solid #333;
            color: #e9ecef;
            font-size: 0.9rem;
        }
        
        tr:hover {
            background-color: #2a2a2a;
        }
        
        .user-avatar-small {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #2a9d8f;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
            margin-left: 0.5rem;
        }
        
        .badge {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .badge-success {
            background-color: rgba(42, 157, 143, 0.2);
            color: #2a9d8f;
        }
        
        .badge-warning {
            background-color: rgba(231, 111, 81, 0.2);
            color: #e76f51;
        }
        
        /* الفوتر */
        .admin-footer {
            text-align: center;
            padding: 2rem 1rem;
            color: #6c757d;
            font-size: 0.9rem;
            border-top: 1px solid #333;
            margin-top: 2rem;
        }
        
        /* رسائل */
        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin: 1rem;
            text-align: center;
            display: none;
        }
        
        .alert-success {
            background-color: rgba(42, 157, 143, 0.2);
            border: 1px solid #2a9d8f;
            color: #2a9d8f;
        }
        
        .alert-error {
            background-color: rgba(231, 111, 81, 0.2);
            border: 1px solid #e76f51;
            color: #e76f51;
        }
        
        /* تحميل */
        .loading {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
        }
        
        .loading i {
            font-size: 2rem;
            margin-bottom: 1rem;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="admin-dashboard-page">
    <!-- الهيدر -->
    <header class="admin-header">
        <div class="admin-header-top">
            <div class="admin-brand">
                <div class="admin-brand-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="admin-brand-text">
                    <h1>لوحة التحكم</h1>
                    <p>GYM Pro - نظام الإدارة</p>
                </div>
            </div>
            
            <div class="admin-actions">
                <button class="btn-admin" onclick="refreshDashboard()">
                    <i class="fas fa-sync-alt"></i>
                    تحديث
                </button>
                <button class="btn-admin btn-admin-primary" onclick="window.location.href='admin-exercises.php'">
                    <i class="fas fa-plus"></i>
                    تمرين جديد
                </button>
                <button class="btn-admin btn-admin-logout" id="logoutBtn">
                    <i class="fas fa-sign-out-alt"></i>
                    خروج
                </button>
            </div>
        </div>
    </header>

    <!-- رسائل -->
    <div class="alert" id="message"></div>

    <!-- المحتوى الرئيسي -->
    <main>
        <!-- إحصائيات سريعة -->
        <section class="admin-stats">
            <div class="stats-title">
                <i class="fas fa-chart-line"></i>
                <span>نظرة عامة</span>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon users">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-value" id="totalUsers">0</div>
                    <div class="stat-label">مستخدم</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon exercises">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <div class="stat-value" id="totalExercises">0</div>
                    <div class="stat-label">تمرين</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon sessions">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-value" id="totalSessions">0</div>
                    <div class="stat-label">جلسة</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon ads">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="stat-value" id="totalAds">0</div>
                    <div class="stat-label">إعلان</div>
                </div>
            </div>
        </section>

        <!-- القوائم السريعة -->
        <section class="quick-actions">
            <div class="actions-title">
                <i class="fas fa-bolt"></i>
                <span>إجراءات سريعة</span>
            </div>
            
            <div class="actions-grid">
                <a href="admin-exercises.php" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <div class="action-title">إدارة التمارين</div>
                    <div class="action-desc">إضافة وتعديل التمارين الأساسية</div>
                </a>
                
                <a href="admin-users.php" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="action-title">إدارة المستخدمين</div>
                    <div class="action-desc">عرض وتعديل بيانات المستخدمين</div>
                </a>
                
                <a href="admin-ads.php" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="action-title">إدارة الإعلانات</div>
                    <div class="action-desc">إضافة إعلانات جديدة</div>
                </a>
                
                <a href="admin-sessions.php" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="action-title">جلسات التدريب</div>
                    <div class="action-desc">عرض جلسات المستخدمين</div>
                </a>
            </div>
        </section>

        <!-- آخر الجلسات -->
        <section class="recent-sessions">
            <div class="sessions-title">
                <i class="fas fa-history"></i>
                <span>آخر جلسات التدريب</span>
            </div>
            
            <div class="sessions-table">
                <table id="sessionsTable">
                    <thead>
                        <tr>
                            <th>المستخدم</th>
                            <th>اسم الجلسة</th>
                            <th>التاريخ</th>
                            <th>المدة</th>
                            <th>التمارين</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody id="sessionsTableBody">
                        <!-- سيتم تعبئته بالجافاسكريبت -->
                        <tr>
                            <td colspan="6">
                                <div class="loading">
                                    <i class="fas fa-spinner"></i>
                                    <p>جاري تحميل البيانات...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- الفوتر -->
    <footer class="admin-footer">
        <p>© 2024 GYM Pro - لوحة التحكم. جميع الحقوق محفوظة</p>
        <p>آخر تحديث: <span id="lastUpdate">--:--</span></p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // التحقق من أن المستخدم أدمن
            if (!localStorage.getItem('isAdmin') || localStorage.getItem('isAdmin') !== 'true') {
                window.location.href = 'admin-login.php';
                return;
            }
            
            // تحميل بيانات لوحة التحكم
            loadDashboardData();
            
            // أحداث الأزرار
            document.getElementById('logoutBtn').addEventListener('click', logoutAdmin);
            
            // تحديث الوقت
            updateLastUpdateTime();
            setInterval(updateLastUpdateTime, 60000); // كل دقيقة
            
            // تحميل بيانات لوحة التحكم
            async function loadDashboardData() {
                try {
                    const response = await fetch('php/admin-data.php');
                    
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        updateStats(data.stats);
                        updateRecentSessions(data.recentSessions);
                    } else {
                        loadDemoData();
                    }
                } catch (error) {
                    console.error('Error loading dashboard data:', error);
                    loadDemoData();
                }
            }
            
            // تحديث الإحصائيات
            function updateStats(stats) {
                document.getElementById('totalUsers').textContent = stats.totalUsers || 0;
                document.getElementById('totalExercises').textContent = stats.totalExercises || 0;
                document.getElementById('totalSessions').textContent = stats.totalSessions || 0;
                document.getElementById('totalAds').textContent = stats.totalAds || 0;
            }
            
            // تحديث الجلسات الحديثة
            function updateRecentSessions(sessions) {
                const tbody = document.getElementById('sessionsTableBody');
                
                if (!sessions || sessions.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: #6c757d;">
                                <i class="fas fa-calendar-times" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                                <p>لا توجد جلسات تدريب حديثة</p>
                            </td>
                        </tr>
                    `;
                    return;
                }
                
                let html = '';
                sessions.forEach(session => {
                    const userInitials = session.userName ? 
                        session.userName.split(' ').map(n => n[0]).join('').toUpperCase() : 'م';
                    
                    const date = new Date(session.date);
                    const formattedDate = date.toLocaleDateString('ar-SA');
                    
                    html += `
                        <tr onclick="viewSessionDetails('${session.id}')" style="cursor: pointer;">
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <div class="user-avatar-small">${userInitials}</div>
                                    <span>${session.userName || 'مستخدم'}</span>
                                </div>
                            </td>
                            <td>${session.name || 'بدون اسم'}</td>
                            <td>${formattedDate}</td>
                            <td>${session.duration || 0} دقيقة</td>
                            <td>${session.exercisesCount || 0} تمرين</td>
                            <td>
                                <span class="badge badge-success">مكتملة</span>
                            </td>
                        </tr>
                    `;
                });
                
                tbody.innerHTML = html;
            }
            
            // عرض بيانات تجريبية
            function loadDemoData() {
                updateStats({
                    totalUsers: 24,
                    totalExercises: 15,
                    totalSessions: 156,
                    totalAds: 3
                });
                
                updateRecentSessions([
                    {
                        id: '1',
                        userName: 'أحمد محمد',
                        name: 'تمرين الصدر اليومي',
                        date: new Date().toISOString(),
                        duration: 60,
                        exercisesCount: 4
                    },
                    {
                        id: '2',
                        userName: 'محمد علي',
                        name: 'جلسة الأرجل',
                        date: new Date(Date.now() - 86400000).toISOString(),
                        duration: 75,
                        exercisesCount: 5
                    },
                    {
                        id: '3',
                        userName: 'سارة أحمد',
                        name: 'تمرين الكارديو',
                        date: new Date(Date.now() - 172800000).toISOString(),
                        duration: 45,
                        exercisesCount: 3
                    }
                ]);
            }
            
            // تحديث وقت آخر تحديث
            function updateLastUpdateTime() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('ar-SA', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                document.getElementById('lastUpdate').textContent = timeString;
            }
            
            // تحديث لوحة التحكم
            window.refreshDashboard = function() {
                showMessage('جاري تحديث البيانات...', 'success');
                loadDashboardData();
            };
            
            // عرض تفاصيل الجلسة
            window.viewSessionDetails = function(sessionId) {
                // يمكن فتح صفحة تفاصيل أو مودال
                showMessage('عرض تفاصيل الجلسة: ' + sessionId, 'success');
                // window.location.href = `admin-session-details.php?id=${sessionId}`;
            };
            
            // تسجيل خروج الأدمن
            function logoutAdmin() {
                if (confirm('هل تريد تسجيل الخروج من لوحة التحكم؟')) {
                    localStorage.removeItem('isAdmin');
                    window.location.href = 'admin-login.php';
                }
            }
            
            // عرض رسالة
            function showMessage(text, type = 'error') {
                const messageDiv = document.getElementById('message');
                messageDiv.textContent = text;
                messageDiv.className = `alert alert-${type}`;
                messageDiv.style.display = 'block';
                
                setTimeout(() => {
                    messageDiv.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</body>
</html>