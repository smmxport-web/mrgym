<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GYM Pro - الملف الشخصي</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* إضافات خاصة بصفحة الملف الشخصي */
        .profile-page {
            background-color: #121212;
            min-height: 100vh;
            padding-bottom: 70px;
        }
        
        /* الهيدر */
        .profile-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            padding: 1rem;
            border-bottom: 1px solid #333;
            z-index: 1000;
        }
        
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .page-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
        }
        
        .page-title i {
            color: #2a9d8f;
        }
        
        .back-btn {
            background: none;
            border: 1px solid #444;
            color: #adb5bd;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        /* قسم الصورة الشخصية */
        .profile-avatar-section {
            text-align: center;
            padding: 2rem 1rem;
        }
        
        .avatar-container {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #2a9d8f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            font-weight: bold;
            border: 4px solid #333;
            overflow: hidden;
        }
        
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .avatar-overlay {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.2rem;
            border: 2px solid #2a9d8f;
        }
        
        .user-name {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            color: #e9ecef;
        }
        
        .user-phone {
            color: #adb5bd;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .user-location {
            color: #2a9d8f;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        
        /* الإحصائيات */
        .profile-stats {
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
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        .stat-item {
            background-color: #2d2d2d;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            border: 1px solid #444;
        }
        
        .stat-icon {
            font-size: 1.8rem;
            color: #2a9d8f;
            margin-bottom: 0.5rem;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.3rem;
            color: #e9ecef;
        }
        
        .stat-label {
            color: #adb5bd;
            font-size: 0.9rem;
        }
        
        /* التقدم الشهري */
        .monthly-progress {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
        }
        
        .progress-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #333;
            font-size: 1.2rem;
        }
        
        .progress-bars {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .progress-item {
            margin-bottom: 0.5rem;
        }
        
        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            color: #adb5bd;
            font-size: 0.9rem;
        }
        
        .progress-bar {
            height: 8px;
            background-color: #2d2d2d;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background-color: #2a9d8f;
            border-radius: 4px;
            transition: width 0.5s ease;
        }
        
        /* المعلومات الشخصية */
        .personal-info {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
        }
        
        .info-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #333;
            font-size: 1.2rem;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        .info-item {
            background-color: #2d2d2d;
            border-radius: 12px;
            padding: 1rem;
        }
        
        .info-label {
            color: #adb5bd;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }
        
        .info-value {
            color: #e9ecef;
            font-size: 1rem;
            font-weight: 500;
        }
        
        /* الإجراءات */
        .profile-actions {
            margin: 1rem;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        .action-btn {
            background-color: #1e1e1e;
            border: 1px solid #333;
            color: #e9ecef;
            padding: 1rem;
            border-radius: 12px;
            font-size: 0.95rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
        }
        
        .action-btn:hover {
            background-color: #2a2a2a;
        }
        
        .action-btn.edit {
            border-color: #2a9d8f;
            color: #2a9d8f;
        }
        
        .action-btn.logout {
            border-color: #e76f51;
            color: #e76f51;
        }
        
        .action-btn.settings {
            border-color: #adb5bd;
            color: #adb5bd;
        }
        
        .action-btn.support {
            border-color: #6c757d;
            color: #6c757d;
        }
        
        /* نافبار سفلي */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #1a1a1a;
            display: flex;
            justify-content: space-around;
            padding: 0.8rem 0;
            border-top: 1px solid #333;
            z-index: 1000;
        }
        
        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #adb5bd;
            text-decoration: none;
            font-size: 0.8rem;
        }
        
        .nav-item.active {
            color: #2a9d8f;
        }
        
        .nav-item i {
            font-size: 1.3rem;
            margin-bottom: 0.3rem;
        }
        
        /* مودال تغيير الصورة */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            padding: 1rem;
        }
        
        .modal-content {
            background-color: #1e1e1e;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            border: 1px solid #333;
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-close {
            background: none;
            border: none;
            color: #adb5bd;
            font-size: 1.2rem;
            cursor: pointer;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .avatar-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .avatar-option {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #2d2d2d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .avatar-option:hover {
            border-color: #2a9d8f;
        }
        
        .avatar-option.selected {
            border-color: #2a9d8f;
            transform: scale(1.1);
        }
        
        .upload-option {
            position: relative;
            overflow: hidden;
        }
        
        .upload-option input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        
        .upload-label {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
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
        
        /* رسوم بيانية بسيطة */
        .chart-mini {
            height: 100px;
            background-color: #2d2d2d;
            border-radius: 10px;
            margin: 1.5rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }
        
        /* تواريخ */
        .join-date {
            text-align: center;
            color: #6c757d;
            font-size: 0.85rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #333;
        }
    </style>
</head>
<body class="profile-page">
    <!-- الهيدر -->
    <header class="profile-header">
        <div class="header-top">
            <div class="page-title">
                <i class="fas fa-user"></i>
                <span>الملف الشخصي</span>
            </div>
            <button class="back-btn" onclick="window.history.back()">
                <i class="fas fa-arrow-right"></i>
                رجوع
            </button>
        </div>
    </header>

    <!-- رسائل -->
    <div class="alert" id="message"></div>

    <!-- محتوى الملف الشخصي -->
    <main>
        <!-- الصورة الشخصية -->
        <section class="profile-avatar-section">
            <div class="avatar-container">
                <div class="profile-avatar" id="profileAvatar">
                    <!-- الصورة أو الأحرف الأولى -->
                </div>
                <div class="avatar-overlay" id="changeAvatarBtn">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
            
            <h1 class="user-name" id="userName">تحميل...</h1>
            <p class="user-phone" id="userPhone">رقم الهاتف: تحميل...</p>
            <p class="user-location" id="userLocation">
                <i class="fas fa-map-marker-alt"></i>
                <span>المحافظة: تحميل...</span>
            </p>
        </section>

        <!-- الإحصائيات -->
        <section class="profile-stats">
            <div class="stats-title">
                <i class="fas fa-chart-line"></i>
                <span>إحصائياتك</span>
            </div>
            
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <div class="stat-value" id="totalSessions">0</div>
                    <div class="stat-label">حصص تدريب</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-fire"></i>
                    </div>
                    <div class="stat-value" id="totalCalories">0</div>
                    <div class="stat-label">سعرة حرارية</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-value" id="totalHours">0</div>
                    <div class="stat-label">ساعة تدريب</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-value" id="streakDays">0</div>
                    <div class="stat-label">يوم متتالي</div>
                </div>
            </div>
        </section>

        <!-- التقدم الشهري -->
        <section class="monthly-progress">
            <div class="progress-title">
                <i class="fas fa-calendar-alt"></i>
                <span>تقدمك هذا الشهر</span>
            </div>
            
            <div class="progress-bars">
                <div class="progress-item">
                    <div class="progress-label">
                        <span>الحصص المكتملة</span>
                        <span id="completedSessions">0/30</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="sessionsProgress" style="width: 0%"></div>
                    </div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>الأهداف المحققة</span>
                        <span id="achievedGoals">0/5</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="goalsProgress" style="width: 0%"></div>
                    </div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>معدل الحضور</span>
                        <span id="attendanceRate">0%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="attendanceProgress" style="width: 0%"></div>
                    </div>
                </div>
            </div>
            
            <div class="chart-mini">
                <i class="fas fa-chart-bar"></i>
                <span>رسم بياني للتقدم</span>
            </div>
        </section>

        <!-- المعلومات الشخصية -->
        <section class="personal-info">
            <div class="info-title">
                <i class="fas fa-info-circle"></i>
                <span>معلوماتك الشخصية</span>
            </div>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">تاريخ الانضمام</div>
                    <div class="info-value" id="joinDate">تحميل...</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">مستواك الحالي</div>
                    <div class="info-value" id="userLevel">مبتدئ</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">الهدف الأسبوعي</div>
                    <div class="info-value" id="weeklyGoal">5 حصص</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">متوسط المدة</div>
                    <div class="info-value" id="avgDuration">45 دقيقة</div>
                </div>
            </div>
            
            <div class="join-date" id="memberSince">
                عضو منذ: تحميل...
            </div>
        </section>

        <!-- الإجراءات -->
        <section class="profile-actions">
            <button class="action-btn edit" id="editProfileBtn">
                <i class="fas fa-edit"></i>
                تعديل الملف
            </button>
            
            <button class="action-btn settings" id="settingsBtn">
                <i class="fas fa-cog"></i>
                الإعدادات
            </button>
            
            <button class="action-btn support" id="supportBtn">
                <i class="fas fa-headset"></i>
                الدعم الفني
            </button>
            
            <button class="action-btn logout" id="logoutBtn">
                <i class="fas fa-sign-out-alt"></i>
                تسجيل الخروج
            </button>
        </section>
    </main>

    <!-- النافبار السفلي -->
    <nav class="bottom-nav">
        <a href="dashboard.php" class="nav-item">
            <i class="fas fa-home"></i>
            <span>الرئيسية</span>
        </a>
        <a href="workouts.php" class="nav-item">
            <i class="fas fa-dumbbell"></i>
            <span>التمارين</span>
        </a>
        <a href="add-workout.php" class="nav-item">
            <i class="fas fa-plus-circle"></i>
            <span>إضافة</span>
        </a>
        <a href="progress.php" class="nav-item">
            <i class="fas fa-chart-line"></i>
            <span>التقدم</span>
        </a>
        <a href="profile.php" class="nav-item active">
            <i class="fas fa-user"></i>
            <span>الملف</span>
        </a>
    </nav>

    <!-- مودال تغيير الصورة -->
    <div class="modal-overlay" id="avatarModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>تغيير الصورة الشخصية</h3>
                <button class="modal-close" id="closeAvatarModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="avatar-options">
                    <div class="avatar-option" data-avatar="A" style="background-color: #2a9d8f;">A</div>
                    <div class="avatar-option" data-avatar="B" style="background-color: #e76f51;">B</div>
                    <div class="avatar-option" data-avatar="C" style="background-color: #6c757d;">C</div>
                    <div class="avatar-option" data-avatar="D" style="background-color: #f4a261;">D</div>
                    <div class="avatar-option" data-avatar="E" style="background-color: #e9c46a;">E</div>
                    <div class="avatar-option upload-option">
                        <input type="file" id="imageUpload" accept="image/*">
                        <label for="imageUpload" class="upload-label">
                            <i class="fas fa-upload"></i>
                            <small>رفع صورة</small>
                        </label>
                    </div>
                </div>
                
                <button class="btn btn-primary" id="saveAvatarBtn" style="width: 100%; padding: 1rem;">
                    <i class="fas fa-save"></i>
                    حفظ الصورة
                </button>
            </div>
        </div>
    </div>

    <!-- مودال الدعم الفني -->
    <div class="modal-overlay" id="supportModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-headset"></i> الدعم الفني</h3>
                <button class="modal-close" id="closeSupportModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-headset" style="font-size: 3rem; color: #2a9d8f; margin-bottom: 1rem;"></i>
                    <p>نحن هنا لمساعدتك</p>
                </div>
                
                <div style="background-color: #2d2d2d; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                    <p><strong>رقم الدعم:</strong> 0123456789</p>
                    <p><strong>البريد الإلكتروني:</strong> support@gympro.com</p>
                    <p><strong>ساعات العمل:</strong> 9 صباحاً - 5 مساءً</p>
                </div>
                
                <textarea placeholder="اكتب رسالتك هنا..." style="width: 100%; padding: 1rem; background-color: #2d2d2d; border: 1px solid #444; border-radius: 10px; color: white; margin-bottom: 1rem; min-height: 100px;"></textarea>
                
                <button class="btn btn-primary" style="width: 100%; padding: 1rem;">
                    <i class="fas fa-paper-plane"></i>
                    إرسال الرسالة
                </button>
            </div>
        </div>
    </div>

    <script>
        // بيانات المستخدم
        const currentUser = JSON.parse(localStorage.getItem('currentUser'));
        let selectedAvatar = null;
        let uploadedImage = null;
        
        document.addEventListener('DOMContentLoaded', function() {
            // إذا مفيش مستخدم، نرجع للتسجيل
            if (!currentUser) {
                window.location.href = 'login.php';
                return;
            }
            
            // تحميل بيانات المستخدم
            loadUserData();
            loadUserStats();
            
            // أحداث الأزرار
            document.getElementById('changeAvatarBtn').addEventListener('click', showAvatarModal);
            document.getElementById('closeAvatarModal').addEventListener('click', hideAvatarModal);
            document.getElementById('saveAvatarBtn').addEventListener('click', saveAvatar);
            document.getElementById('logoutBtn').addEventListener('click', logout);
            document.getElementById('editProfileBtn').addEventListener('click', editProfile);
            document.getElementById('settingsBtn').addEventListener('click', showSettings);
            document.getElementById('supportBtn').addEventListener('click', showSupportModal);
            document.getElementById('closeSupportModal').addEventListener('click', hideSupportModal);
            
            // حدث رفع الصورة
            document.getElementById('imageUpload').addEventListener('change', handleImageUpload);
            
            // أحداث اختيار الصور
            setupAvatarSelection();
            
            // تحميل بيانات المستخدم
            function loadUserData() {
                const userName = document.getElementById('userName');
                const userPhone = document.getElementById('userPhone');
                const userLocation = document.getElementById('userLocation').querySelector('span');
                const profileAvatar = document.getElementById('profileAvatar');
                const joinDate = document.getElementById('joinDate');
                const memberSince = document.getElementById('memberSince');
                
                if (currentUser) {
                    // الاسم
                    userName.textContent = currentUser.name || 'مستخدم';
                    
                    // رقم الهاتف
                    userPhone.textContent = `رقم الهاتف: ${currentUser.phone || 'غير محدد'}`;
                    
                    // المحافظة
                    userLocation.textContent = `المحافظة: ${currentUser.governorate || 'غير محدد'}`;
                    
                    // تاريخ الانضمام
                    const joinDateStr = currentUser.created_at || new Date().toLocaleDateString('ar-SA');
                    joinDate.textContent = joinDateStr;
                    memberSince.textContent = `عضو منذ: ${joinDateStr}`;
                    
                    // الصورة الشخصية
                    loadUserAvatar(profileAvatar, currentUser);
                }
            }
            
            // تحميل الصورة الشخصية
            function loadUserAvatar(avatarElement, user) {
                // تحقق إذا فيه صورة مخزنة في localStorage
                const savedAvatar = localStorage.getItem(`user_avatar_${user.id}`);
                
                if (savedAvatar) {
                    if (savedAvatar.startsWith('data:image')) {
                        // إذا كانت صورة مرفوعة
                        avatarElement.innerHTML = `<img src="${savedAvatar}" alt="${user.name}">`;
                    } else {
                        // إذا كانت حرف أو أيقونة
                        avatarElement.textContent = savedAvatar;
                        avatarElement.style.backgroundColor = localStorage.getItem(`user_avatar_color_${user.id}`) || '#2a9d8f';
                    }
                } else {
                    // الأحرف الأولى من الاسم
                    const initials = user.name
                        ? user.name.split(' ').map(n => n[0]).join('').toUpperCase()
                        : 'م';
                    avatarElement.textContent = initials;
                    avatarElement.style.backgroundColor = '#2a9d8f';
                }
            }
            
            // تحميل إحصائيات المستخدم
            async function loadUserStats() {
                try {
                    const userId = currentUser.id;
                    const response = await fetch(`php/profile-stats.php?userId=${userId}`);
                    
                    if (response.ok) {
                        const data = await response.json();
                        
                        if (data.success) {
                            updateStats(data.stats);
                            updateProgress(data.progress);
                            updatePersonalInfo(data.info);
                        } else {
                            // إذا فشل، نعرض بيانات افتراضية
                            showDefaultStats();
                        }
                    } else {
                        showDefaultStats();
                    }
                } catch (error) {
                    console.error('Error loading stats:', error);
                    showDefaultStats();
                }
            }
            
            // تحديث الإحصائيات
            function updateStats(stats) {
                document.getElementById('totalSessions').textContent = stats.totalSessions || 0;
                document.getElementById('totalCalories').textContent = stats.totalCalories || 0;
                document.getElementById('totalHours').textContent = stats.totalHours || 0;
                document.getElementById('streakDays').textContent = stats.streakDays || 0;
            }
            
            // تحديث التقدم
            function updateProgress(progress) {
                const sessionsProgress = progress.sessions || 0;
                const goalsProgress = progress.goals || 0;
                const attendanceProgress = progress.attendance || 0;
                
                document.getElementById('completedSessions').textContent = `${sessionsProgress}/30`;
                document.getElementById('achievedGoals').textContent = `${goalsProgress}/5`;
                document.getElementById('attendanceRate').textContent = `${attendanceProgress}%`;
                
                document.getElementById('sessionsProgress').style.width = `${(sessionsProgress / 30) * 100}%`;
                document.getElementById('goalsProgress').style.width = `${(goalsProgress / 5) * 100}%`;
                document.getElementById('attendanceProgress').style.width = `${attendanceProgress}%`;
            }
            
            // تحديث المعلومات الشخصية
            function updatePersonalInfo(info) {
                document.getElementById('userLevel').textContent = info.level || 'مبتدئ';
                document.getElementById('weeklyGoal').textContent = info.weeklyGoal || '5 حصص';
                document.getElementById('avgDuration').textContent = info.avgDuration || '45 دقيقة';
            }
            
            // عرض إحصائيات افتراضية
            function showDefaultStats() {
                const totalSessions = Math.floor(Math.random() * 100) + 1;
                const totalCalories = totalSessions * 250;
                const totalHours = Math.floor(totalSessions * 0.75);
                const streakDays = Math.floor(Math.random() * 30) + 1;
                
                updateStats({
                    totalSessions: totalSessions,
                    totalCalories: totalCalories,
                    totalHours: totalHours,
                    streakDays: streakDays
                });
                
                const sessionsProgress = Math.min(30, Math.floor(Math.random() * 30) + 1);
                const goalsProgress = Math.floor(Math.random() * 5) + 1;
                const attendanceProgress = Math.floor(Math.random() * 100) + 1;
                
                updateProgress({
                    sessions: sessionsProgress,
                    goals: goalsProgress,
                    attendance: attendanceProgress
                });
                
                updatePersonalInfo({
                    level: ['مبتدئ', 'متوسط', 'متقدم'][Math.floor(Math.random() * 3)],
                    weeklyGoal: `${Math.floor(Math.random() * 7) + 3} حصص`,
                    avgDuration: `${Math.floor(Math.random() * 30) + 30} دقيقة`
                });
            }
            
            // إظهار مودال الصورة
            function showAvatarModal() {
                const modal = document.getElementById('avatarModal');
                modal.style.display = 'flex';
                
                // إعادة تعيين الاختيار
                selectedAvatar = null;
                uploadedImage = null;
                document.querySelectorAll('.avatar-option').forEach(option => {
                    option.classList.remove('selected');
                });
            }
            
            // إخفاء مودال الصورة
            function hideAvatarModal() {
                document.getElementById('avatarModal').style.display = 'none';
            }
            
            // إعداد اختيار الصور
            function setupAvatarSelection() {
                document.querySelectorAll('.avatar-option:not(.upload-option)').forEach(option => {
                    option.addEventListener('click', function() {
                        // إزالة التحديد من الجميع
                        document.querySelectorAll('.avatar-option').forEach(opt => {
                            opt.classList.remove('selected');
                        });
                        
                        // تحديد العنصر الحالي
                        this.classList.add('selected');
                        selectedAvatar = this.dataset.avatar;
                        uploadedImage = null;
                    });
                });
            }
            
            // معالجة رفع الصورة
            function handleImageUpload(event) {
                const file = event.target.files[0];
                
                if (file) {
                    // إزالة التحديد من الصور الأخرى
                    document.querySelectorAll('.avatar-option').forEach(opt => {
                        opt.classList.remove('selected');
                    });
                    
                    // تحديد صورة الرفع
                    event.target.closest('.avatar-option').classList.add('selected');
                    
                    // قراءة الصورة
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        uploadedImage = e.target.result;
                    };
                    reader.readAsDataURL(file);
                    selectedAvatar = null;
                }
            }
            
            // حفظ الصورة
            function saveAvatar() {
                if (!selectedAvatar && !uploadedImage) {
                    showMessage('يرجى اختيار صورة أولاً', 'error');
                    return;
                }
                
                const avatarElement = document.getElementById('profileAvatar');
                
                if (uploadedImage) {
                    // حفظ الصورة المرفوعة
                    avatarElement.innerHTML = `<img src="${uploadedImage}" alt="${currentUser.name}">`;
                    localStorage.setItem(`user_avatar_${currentUser.id}`, uploadedImage);
                } else if (selectedAvatar) {
                    // حفظ الصورة المختارة
                    avatarElement.textContent = selectedAvatar;
                    const color = document.querySelector(`.avatar-option[data-avatar="${selectedAvatar}"]`).style.backgroundColor;
                    avatarElement.style.backgroundColor = color;
                    
                    localStorage.setItem(`user_avatar_${currentUser.id}`, selectedAvatar);
                    localStorage.setItem(`user_avatar_color_${currentUser.id}`, color);
                }
                
                showMessage('تم تغيير الصورة بنجاح', 'success');
                hideAvatarModal();
            }
            
            // إظهار مودال الدعم
            function showSupportModal() {
                document.getElementById('supportModal').style.display = 'flex';
            }
            
            // إخفاء مودال الدعم
            function hideSupportModal() {
                document.getElementById('supportModal').style.display = 'none';
            }
            
            // تسجيل الخروج
            function logout() {
                if (confirm('هل تريد تسجيل الخروج؟')) {
                    localStorage.removeItem('currentUser');
                    localStorage.removeItem('rememberMe');
                    window.location.href = 'login.php';
                }
            }
            
            // تعديل الملف
            function editProfile() {
                showMessage('ميزة تعديل الملف ستتوفر قريباً', 'success');
            }
            
            // الإعدادات
            function showSettings() {
                showMessage('صفحة الإعدادات قيد التطوير', 'success');
            }
            
            // إغلاق المودالات بالنقر خارج المحتوى
            document.getElementById('avatarModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideAvatarModal();
                }
            });
            
            document.getElementById('supportModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideSupportModal();
                }
            });
            
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