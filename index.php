<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GYM Pro - موبايل</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- نافبار الموبايل -->
    <nav class="navbar">
        <div class="logo-container">
            <div class="logo">
                <i class="fas fa-dumbbell"></i>
                <span>GYM Pro</span>
            </div>
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <div class="nav-links" id="navLinks">
            <a href="index.html" class="nav-link">
                <i class="fas fa-home"></i> الرئيسية
            </a>
            <a href="workouts.html" class="nav-link">
                <i class="fas fa-dumbbell"></i> التمارين
            </a>
            <a href="dashboard.html" class="nav-link">
                <i class="fas fa-chart-line"></i> التدريبات
            </a>
            <a href="profile.html" class="nav-link">
                <i class="fas fa-user"></i> الملف
            </a>
        </div>
    </nav>

    <!-- الهيرو -->
    <section class="hero">
        <h1>ابني جسدك المثالي مع <span class="highlight">GYM Pro</span></h1>
        <p>خطط تدريب شخصية، تتبع النتائج، ودعم متكامل</p>
        
        <div class="cta-buttons">
            <button class="btn btn-primary" id="startBtn">
                <a href="/register.php" >
                                    ابدأ الآن مجاناً

                </a>
            </button>
            <button class="btn btn-outline" id="loginBtn">
                <a href="/login.php" >
                تسجيل الدخول
                </a>
            </button>
        </div>
    </section>

    <!-- الميزات -->
    <section class="features">
        <h2>مميزات التطبيق</h2>
        
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-dumbbell"></i>
                <h3>تمارين متنوعة</h3>
                <p>مكتبة كاملة من التمارين</p>
            </div>
            
            <div class="feature-card">
                <i class="fas fa-calendar-check"></i>
                <h3>خطط تدريب</h3>
                <p>أنشئ خطة التدريب الخاصة بك</p>
            </div>
            
            <div class="feature-card">
                <i class="fas fa-chart-bar"></i>
                <h3>تتبع النتائج</h3>
                <p>رسم بياني لتقدمك الرياضي</p>
            </div>
        </div>
    </section>

    <!-- قسم تسجيل الدخول -->
    <section class="auth-section" id="authSection" style="display: none;">
        <div class="auth-tabs">
            <button class="auth-tab active" data-tab="login">تسجيل الدخول</button>
            <button class="auth-tab" data-tab="register">إنشاء حساب</button>
        </div>
        
        <!-- نموذج تسجيل الدخول -->
        <form id="loginForm" class="auth-form">
            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="tel" id="phone" class="form-control" placeholder="01xxxxxxxxx" required>
            </div>
            
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" id="password" class="form-control" placeholder="******" required>
            </div>
            
            <button type="submit" class="btn btn-primary">دخول</button>
        </form>
        
        <!-- نموذج إنشاء حساب -->
        <form id="registerForm" class="auth-form" style="display: none;">
            <div class="form-group">
                <label for="regName">الاسم</label>
                <input type="text" id="regName" class="form-control" placeholder="أحمد محمد" required>
            </div>
            
            <div class="form-group">
                <label for="regPhone">رقم الهاتف</label>
                <input type="tel" id="regPhone" class="form-control" placeholder="01xxxxxxxxx" required>
            </div>
            
            <div class="form-group">
                <label for="regGovernorate">المحافظة</label>
                <select id="regGovernorate" class="form-control" required>
                    <option value="">اختر المحافظة</option>
                    <option value="cairo">القاهرة</option>
                    <option value="alex">الإسكندرية</option>
                    <option value="giza">الجيزة</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="regPassword">كلمة المرور</label>
                <input type="password" id="regPassword" class="form-control" placeholder="******" required>
            </div>
            
            <div class="form-group">
                <label for="regConfirm">تأكيد كلمة المرور</label>
                <input type="password" id="regConfirm" class="form-control" placeholder="******" required>
            </div>
            
            <button type="submit" class="btn btn-primary">إنشاء حساب</button>
        </form>
    </section>

    <!-- نافبار سفلي للموبايل -->
    <div class="bottom-nav">
        <a href="index.html" class="nav-item active">
            <i class="fas fa-home"></i>
            <span>الرئيسية</span>
        </a>
        <a href="workouts.html" class="nav-item">
            <i class="fas fa-dumbbell"></i>
            <span>التمارين</span>
        </a>
        <a href="dashboard.html" class="nav-item">
            <i class="fas fa-plus-circle"></i>
            <span>إضافة</span>
        </a>
        <a href="progress.html" class="nav-item">
            <i class="fas fa-chart-line"></i>
            <span>التقدم</span>
        </a>
        <a href="profile.html" class="nav-item">
            <i class="fas fa-user"></i>
            <span>الملف</span>
        </a>
    </div>

    <!-- مودال الإضافة -->
    <div class="modal-overlay" id="addWorkoutModal">
        <div class="modal-content">
            <button class="modal-close" id="closeModal">
                <i class="fas fa-times"></i>
            </button>
            <h3>إضافة تمرين جديد</h3>
            <!-- هنا هيحط محتوى المودال -->
        </div>
    </div>

    <script src="js/main.js"></script>
</body>
</html>