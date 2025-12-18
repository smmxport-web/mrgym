<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GYM Pro - لوحة التحكم</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* إضافات خاصة بالداشبورد */
        .dashboard-page {
            background-color: #121212;
            min-height: 100vh;
            padding-bottom: 70px; /* علشان النافبار السفلي */
        }
        
        /* الهيدر - بدون sticky */
        .dashboard-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            padding: 1rem;
            border-bottom: 1px solid #333;
            z-index: 1000;
            /* تم إزالة position: sticky */
        }
        
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #2a9d8f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            font-weight: bold;
        }
        
        .user-details h3 {
            font-size: 1.2rem;
            margin-bottom: 0.2rem;
        }
        
        .user-details p {
            color: #adb5bd;
            font-size: 0.9rem;
        }
        
        .logout-btn {
            background: none;
            border: 1px solid #e76f51;
            color: #e76f51;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .stat-card {
            background-color: #1e1e1e;
            border-radius: 12px;
            padding: 1rem;
            border: 1px solid #333;
            text-align: center;
        }
        
        .stat-card .icon {
            font-size: 1.8rem;
            color: #2a9d8f;
            margin-bottom: 0.5rem;
        }
        
        .stat-card .value {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.2rem;
        }
        
        .stat-card .label {
            color: #adb5bd;
            font-size: 0.9rem;
        }
        
        /* محتوى الداشبورد */
        .dashboard-content {
            padding: 1rem;
        }
        
        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.5rem 0 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #333;
        }
        
        .section-title h2 {
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .view-all {
            color: #2a9d8f;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        /* الإعلانات */
        .ads-slider {
            background-color: #1e1e1e;
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #333;
            margin-bottom: 1.5rem;
        }
        
        .ad-item {
            padding: 1.5rem;
            text-align: center;
        }
        
        .ad-badge {
            display: inline-block;
            background-color: #e76f51;
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-bottom: 1rem;
        }
        
        .ad-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #2a9d8f;
        }
        
        .ad-desc {
            color: #adb5bd;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
        
        .ad-image {
            width: 100%;
            height: 150px;
            background-color: #2d2d2d;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            margin-bottom: 1rem;
        }
        
        /* التمارين الأخيرة */
        .workouts-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .workout-item {
            background-color: #1e1e1e;
            border-radius: 12px;
            padding: 1rem;
            border-left: 4px solid #2a9d8f;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #333;
        }
        
        .workout-info h4 {
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }
        
        .workout-meta {
            display: flex;
            gap: 1rem;
            color: #adb5bd;
            font-size: 0.85rem;
        }
        
        .workout-result {
            background-color: rgba(42, 157, 143, 0.2);
            color: #2a9d8f;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: bold;
            font-size: 0.9rem;
        }
        
        /* الرسوم البيانية */
        .chart-container {
            background-color: #1e1e1e;
            border-radius: 15px;
            padding: 1.5rem;
            border: 1px solid #333;
            margin-bottom: 1.5rem;
        }
        
        .chart-placeholder {
            height: 200px;
            background-color: #2d2d2d;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }
        
        .chart-placeholder i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        /* الإشعارات */
        .notifications {
            background-color: #1e1e1e;
            border-radius: 15px;
            border: 1px solid #333;
            overflow: hidden;
        }
        
        .notification-item {
            padding: 1rem;
            border-bottom: 1px solid #333;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }
        
        .notification-item:last-child {
            border-bottom: none;
        }
        
        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(42, 157, 143, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2a9d8f;
            flex-shrink: 0;
        }
        
        .notification-content h4 {
            font-size: 1rem;
            margin-bottom: 0.3rem;
        }
        
        .notification-content p {
            color: #adb5bd;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }
        
        .notification-time {
            color: #6c757d;
            font-size: 0.8rem;
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
        
        /* لا توجد بيانات */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        /* زر الإضافة السريعة */
        .quick-add {
            position: fixed;
            bottom: 80px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #2a9d8f;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 5px 20px rgba(42, 157, 143, 0.4);
            border: none;
            cursor: pointer;
            z-index: 999;
        }
        
        /* مودال الإضافة */
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
            padding: 1.5rem;
            border: 1px solid #333;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #333;
        }
        
        .modal-close {
            background: none;
            border: none;
            color: #adb5bd;
            font-size: 1.2rem;
            cursor: pointer;
        }
        
        /* تلميحات */
        .badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.75rem;
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
        
        .badge-info {
            background-color: rgba(108, 117, 125, 0.2);
            color: #adb5bd;
        }
        
        /* تحسينات الشكل */
        .form-control {
            width: 100%;
            padding: 0.9rem;
            background-color: #2d2d2d;
            border: 2px solid #444;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            border-color: #2a9d8f;
            outline: none;
        }
        
        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background-color: #2a9d8f;
            color: white;
        }
        
        .btn-outline {
            background-color: transparent;
            border: 2px solid #2a9d8f;
            color: #2a9d8f;
        }
        
        .btn-block {
            width: 100%;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #adb5bd;
            font-weight: 500;
        }
    </style>
</head>
<body class="dashboard-page">
    <!-- الهيدر -->
    <header class="dashboard-header">
        <div class="header-top">
            <div class="user-info">
                <div class="user-avatar" id="userAvatar">
                    <!-- الأحرف الأولى من الاسم -->
                </div>
                <div class="user-details">
                    <h3 id="userName">تحميل...</h3>
                    <p id="userLocation">محافظة: تحميل...</p>
                </div>
            </div>
            <button class="logout-btn" id="logoutBtn">
                <i class="fas fa-sign-out-alt"></i>
                خروج
            </button>
        </div>
        
        <div class="stats-cards">
            <div class="stat-card">
                <div class="icon">
                    <i class="fas fa-dumbbell"></i>
                </div>
                <div class="value" id="totalWorkouts">0</div>
                <div class="label">تمرين</div>
            </div>
            
            <div class="stat-card">
                <div class="icon">
                    <i class="fas fa-fire"></i>
                </div>
                <div class="value" id="totalCalories">0</div>
                <div class="label">سعرة حرارية</div>
            </div>
            
            <div class="stat-card">
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="value" id="totalMinutes">0</div>
                <div class="label">دقيقة</div>
            </div>
            
            <div class="stat-card">
                <div class="icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="value" id="streakDays">0</div>
                <div class="label">يوم متتالي</div>
            </div>
        </div>
    </header>

    <!-- محتوى الداشبورد -->
    <main class="dashboard-content">
        <!-- الإعلانات -->
        <div class="section-title">
            <h2><i class="fas fa-bullhorn"></i> إعلانات</h2>
            <a href="#" class="view-all">عرض الكل</a>
        </div>
        
        <div class="ads-slider" id="adsContainer">
            <!-- الإعلانات هتتحمل هنا من JSON -->
            <div class="ad-item">
                <span class="ad-badge">عرض خاص</span>
                <h3 class="ad-title">خصم 20% على الاشتراك السنوي</h3>
                <p class="ad-desc">استفد من العرض لفترة محدودة</p>
                <div class="ad-image">
                    <i class="fas fa-tag"></i>
                </div>
                <button class="btn btn-primary" style="width: 100%;">احصل على الخصم</button>
            </div>
        </div>

        <!-- التمارين الأخيرة -->
        <div class="section-title">
            <h2><i class="fas fa-history"></i> آخر التمارين</h2>
            <a href="workouts.html" class="view-all">عرض الكل</a>
        </div>
        
        <div class="workouts-list" id="recentWorkouts">
            <!-- التمارين هتتحمل هنا من JSON -->
            <div class="empty-state">
                <i class="fas fa-dumbbell"></i>
                <p>لا توجد تمارين سابقة</p>
                <button class="btn btn-outline" id="startWorkoutBtn">ابدأ تمرين جديد</button>
            </div>
        </div>

        <!-- الرسم البياني -->
        <div class="section-title">
            <h2><i class="fas fa-chart-line"></i> تقدمك خلال 30 يوم</h2>
        </div>
        
        <div class="chart-container">
            <div class="chart-placeholder">
                <i class="fas fa-chart-bar"></i>
                <p>سيظهر الرسم البياني هنا</p>
                <small>بمجرد تسجيل تمارين أكثر</small>
            </div>
        </div>

        <!-- الإشعارات -->
        <div class="section-title">
            <h2><i class="fas fa-bell"></i> إشعارات</h2>
        </div>
        
        <div class="notifications" id="notificationsContainer">
            <!-- الإشعارات هتتحمل هنا -->
            <div class="notification-item">
                <div class="notification-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="notification-content">
                    <h4>موعد تمرينك القادم</h4>
                    <p>لديك تمرين عضلات الصدر بعد 3 ساعات</p>
                    <div class="notification-time">قبل 2 ساعة</div>
                </div>
            </div>
        </div>
    </main>

    <!-- زر الإضافة السريعة -->
    <button class="quick-add" id="quickAddBtn">
        <i class="fas fa-plus"></i>
    </button>

    <!-- النافبار السفلي -->
    <nav class="bottom-nav">
        <a href="dashboard.php" class="nav-item active">
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
        <a href="profile.php" class="nav-item">
            <i class="fas fa-user"></i>
            <span>الملف</span>
        </a>
    </nav>

    <!-- مودال إضافة تمرين سريع -->
    <div class="modal-overlay" id="quickAddModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>إضافة تمرين سريع</h3>
                <button class="modal-close" id="closeQuickAddModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="quickWorkoutForm">
                <div class="form-group">
                    <label for="workoutType">نوع التمرين</label>
                    <select id="workoutType" class="form-control" required>
                        <option value="">اختر نوع التمرين</option>
                        <option value="chest">الصدر</option>
                        <option value="back">الظهر</option>
                        <option value="legs">الأرجل</option>
                        <option value="arms">الأذرع</option>
                        <option value="shoulders">الأكتاف</option>
                        <option value="cardio">كارديو</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="duration">المدة (دقائق)</label>
                    <input type="number" id="duration" class="form-control" min="5" max="180" required>
                </div>
                <div class="form-group">
                    <label for="calories">السعرات الحرارية</label>
                    <input type="number" id="calories" class="form-control" min="50" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-save"></i>
                    حفظ التمرين
                </button>
            </form>
        </div>
    </div>

    <script>
        // بيانات المستخدم من localStorage
        const currentUser = JSON.parse(localStorage.getItem('currentUser'));
        
        document.addEventListener('DOMContentLoaded', function() {
            // إذا مفيش مستخدم مسجل، نرجع لصفحة الدخول
            if (!currentUser) {
                window.location.href = 'login.php';
                return;
            }
            
            // تحميل بيانات المستخدم
            loadUserData();
            
            // تحميل البيانات من JSON
            loadDashboardData();
            
            // أحداث الأزرار
            document.getElementById('logoutBtn').addEventListener('click', logout);
            document.getElementById('startWorkoutBtn')?.addEventListener('click', startWorkout);
            document.getElementById('quickAddBtn').addEventListener('click', showQuickAddModal);
            document.getElementById('closeQuickAddModal').addEventListener('click', hideQuickAddModal);
            
            // نموذج إضافة تمرين سريع
            document.getElementById('quickWorkoutForm').addEventListener('submit', addQuickWorkout);
            
            // تحديث الأحرف الأولى للمستخدم
            function loadUserData() {
                const userName = document.getElementById('userName');
                const userLocation = document.getElementById('userLocation');
                const userAvatar = document.getElementById('userAvatar');
                
                if (currentUser) {
                    userName.textContent = currentUser.name || 'مستخدم';
                    userLocation.textContent = `محافظة: ${currentUser.governorate || 'غير محدد'}`;
                    
                    // الأحرف الأولى من الاسم
                    const initials = currentUser.name
                        ? currentUser.name.split(' ').map(n => n[0]).join('').toUpperCase()
                        : 'م';
                    userAvatar.textContent = initials;
                    
                    // تحديث الإحصائيات بالبيانات المحلية
                    updateStats({
                        totalWorkouts: 15,
                        totalCalories: 3250,
                        totalMinutes: 540,
                        streakDays: 7
                    });
                }
            }
            
            // تحميل بيانات الداشبورد
            async function loadDashboardData() {
                try {
                    const userId = currentUser ? currentUser.id : '';
                    const response = await fetch(`php/dashboard-simple.php?userId=${userId}`);
                    
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        updateStats(data.stats);
                        loadAds(data.ads);
                        loadWorkouts(data.recentWorkouts);
                    } else {
                        // إذا فشل، نعرض بيانات تجريبية
                        showDemoData();
                    }
                } catch (error) {
                    console.error('Error loading dashboard:', error);
                    // عرض بيانات تجريبية إذا فشل الاتصال
                    showDemoData();
                }
            }
            
            // تحديث الإحصائيات
            function updateStats(stats) {
                document.getElementById('totalWorkouts').textContent = stats.totalWorkouts || 0;
                document.getElementById('totalCalories').textContent = stats.totalCalories || 0;
                document.getElementById('totalMinutes').textContent = stats.totalMinutes || 0;
                document.getElementById('streakDays').textContent = stats.streakDays || 0;
            }
            
            // تحميل الإعلانات
            function loadAds(ads) {
                const adsContainer = document.getElementById('adsContainer');
                adsContainer.innerHTML = '';
                
                if (ads && ads.length > 0) {
                    ads.forEach(ad => {
                        const adElement = document.createElement('div');
                        adElement.className = 'ad-item';
                        adElement.innerHTML = `
                            <span class="ad-badge">${ad.type || 'إعلان'}</span>
                            <h3 class="ad-title">${ad.title}</h3>
                            <p class="ad-desc">${ad.description}</p>
                            <div class="ad-image">
                                ${ad.image ? `<img src="${ad.image}" alt="${ad.title}" style="width:100%;height:100%;object-fit:cover;border-radius:10px;">` : '<i class="fas fa-ad"></i>'}
                            </div>
                            ${ad.link ? `<a href="${ad.link}" class="btn btn-primary" style="width: 100%;">${ad.buttonText || 'عرض التفاصيل'}</a>` : ''}
                        `;
                        adsContainer.appendChild(adElement);
                    });
                } else {
                    adsContainer.innerHTML = `
                        <div class="ad-item">
                            <span class="ad-badge">عرض</span>
                            <h3 class="ad-title">مرحباً بك في GYM Pro</h3>
                            <p class="ad-desc">ابدأ رحلتك الرياضية معنا اليوم</p>
                            <div class="ad-image">
                                <i class="fas fa-dumbbell"></i>
                            </div>
                            <button class="btn btn-primary" style="width: 100%;">ابدأ الآن</button>
                        </div>
                    `;
                }
            }
            
            // تحميل التمارين الأخيرة
            function loadWorkouts(workouts) {
                const workoutsContainer = document.getElementById('recentWorkouts');
                workoutsContainer.innerHTML = '';
                
                if (workouts && workouts.length > 0) {
                    workouts.forEach(workout => {
                        const workoutElement = document.createElement('div');
                        workoutElement.className = 'workout-item';
                        workoutElement.innerHTML = `
                            <div class="workout-info">
                                <h4>${workout.name}</h4>
                                <div class="workout-meta">
                                    <span><i class="fas fa-clock"></i> ${workout.duration} دقيقة</span>
                                    <span><i class="fas fa-fire"></i> ${workout.calories} سعرة</span>
                                </div>
                            </div>
                            <div class="workout-result">
                                ${workout.date || 'اليوم'}
                            </div>
                        `;
                        workoutsContainer.appendChild(workoutElement);
                    });
                } else {
                    workoutsContainer.innerHTML = `
                        <div class="empty-state">
                            <i class="fas fa-dumbbell"></i>
                            <p>لا توجد تمارين سابقة</p>
                            <button class="btn btn-outline" id="startWorkoutBtn">ابدأ تمرين جديد</button>
                        </div>
                    `;
                    
                    // إعادة ربط الحدث للزر الجديد
                    document.getElementById('startWorkoutBtn').addEventListener('click', startWorkout);
                }
            }
            
            // عرض بيانات تجريبية
            function showDemoData() {
                updateStats({
                    totalWorkouts: 15,
                    totalCalories: 3250,
                    totalMinutes: 540,
                    streakDays: 7
                });
                
                loadAds([
                    {
                        id: 'ad1',
                        title: 'خصم 20% على الاشتراك السنوي',
                        description: 'استفد من العرض لفترة محدودة',
                        type: 'عرض خاص',
                        buttonText: 'احصل على الخصم'
                    },
                    {
                        id: 'ad2',
                        title: 'جلسات تدريب شخصي',
                        description: 'احصل على تدريب شخصي مع أفضل المدربين',
                        type: 'خدمة جديدة',
                        buttonText: 'احجز الآن'
                    }
                ]);
                
                loadWorkouts([
                    {
                        id: 'workout1',
                        name: 'تمرين الصدر',
                        duration: 45,
                        calories: 300,
                        date: 'اليوم'
                    },
                    {
                        id: 'workout2',
                        name: 'تمرين الأرجل',
                        duration: 60,
                        calories: 450,
                        date: 'أمس'
                    }
                ]);
            }
            
            // تسجيل الخروج
            function logout() {
                if (confirm('هل تريد تسجيل الخروج؟')) {
                    localStorage.removeItem('currentUser');
                    localStorage.removeItem('rememberMe');
                    window.location.href = 'login.php';
                }
            }
            
            // بدء تمرين جديد
            function startWorkout() {
                window.location.href = 'add-workout.php';
            }
            
            // إظهار/إخفاء مودال الإضافة السريعة
            function showQuickAddModal() {
                document.getElementById('quickAddModal').style.display = 'flex';
            }
            
            function hideQuickAddModal() {
                document.getElementById('quickAddModal').style.display = 'none';
            }
            
            // إغلاق المودال بالنقر خارج المحتوى
            document.getElementById('quickAddModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideQuickAddModal();
                }
            });
            
            // إضافة تمرين سريع
            async function addQuickWorkout(e) {
                e.preventDefault();
                
                const workoutType = document.getElementById('workoutType').value;
                const duration = document.getElementById('duration').value;
                const calories = document.getElementById('calories').value;
                
                if (!workoutType || !duration || !calories) {
                    alert('يرجى ملء جميع الحقول');
                    return;
                }
                
                try {
                    const response = await fetch('php/workouts.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=add_quick&userId=${currentUser.id}&type=${workoutType}&duration=${duration}&calories=${calories}&date=${new Date().toISOString().split('T')[0]}`
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        alert('تم حفظ التمرين بنجاح!');
                        hideQuickAddModal();
                        loadDashboardData(); // تحديث البيانات
                    } else {
                        alert('حدث خطأ في حفظ التمرين');
                    }
                } catch (error) {
                    console.error('Error adding workout:', error);
                    alert('حدث خطأ في الاتصال بالخادم');
                }
            }
        });
    </script>
</body>
</html>