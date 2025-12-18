<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GYM Pro - تسجيل الدخول</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* نفس الستايل بالضبط زي صفحة التسجيل */
        .login-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #121212 0%, #1a1a1a 100%);
            padding: 1rem;
            display: flex;
            flex-direction: column;
        }
        
        .login-header {
            text-align: center;
            padding: 2rem 1rem 1.5rem;
        }
        
        .login-header .logo {
            justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .login-header .tagline {
            color: #adb5bd;
            font-size: 1.1rem;
        }
        
        .login-container {
            background-color: #1e1e1e;
            border-radius: 20px;
            padding: 2rem;
            margin: 1rem;
            border: 1px solid #333;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            flex-grow: 1;
        }
        
        .login-form .form-group {
            margin-bottom: 1.2rem;
        }
        
        .login-form label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 0.5rem;
            color: #e9ecef;
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .login-form .form-control {
            width: 100%;
            padding: 0.9rem;
            background-color: #2d2d2d;
            border: 2px solid #444;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .login-form .form-control:focus {
            border-color: #2a9d8f;
            outline: none;
        }
        
        .password-container {
            position: relative;
        }
        
        .password-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #adb5bd;
            font-size: 1.1rem;
            cursor: pointer;
        }
        
        .btn-login {
            width: 100%;
            padding: 1.2rem;
            background-color: #2a9d8f;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            margin: 1.5rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.5rem 0;
            padding: 1rem;
            background-color: rgba(42, 157, 143, 0.1);
            border-radius: 10px;
            border: 1px solid rgba(42, 157, 143, 0.3);
        }
        
        .checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #adb5bd;
            cursor: pointer;
        }
        
        .checkbox input {
            width: 18px;
            height: 18px;
            accent-color: #2a9d8f;
        }
        
        .forgot-link {
            color: #2a9d8f;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .forgot-link:hover {
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #6c757d;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #444;
        }
        
        .divider span {
            padding: 0 1rem;
            font-size: 0.9rem;
        }
        
        .btn-admin {
            width: 100%;
            padding: 1rem;
            background-color: transparent;
            border: 2px solid #e76f51;
            color: #e76f51;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin: 0.5rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #333;
            color: #adb5bd;
        }
        
        .register-link a {
            color: #2a9d8f;
            text-decoration: none;
            font-weight: 600;
        }
        
        .back-home {
            position: absolute;
            top: 1rem;
            right: 1rem;
            color: #adb5bd;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
        }
        
        .back-home:hover {
            color: #2a9d8f;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            text-align: center;
            display: none;
        }
        
        .alert-error {
            background-color: rgba(231, 111, 81, 0.2);
            border: 1px solid #e76f51;
            color: #e76f51;
        }
        
        .alert-success {
            background-color: rgba(42, 157, 143, 0.2);
            border: 1px solid #2a9d8f;
            color: #2a9d8f;
        }
        
        .form-hint {
            display: block;
            margin-top: 0.3rem;
            font-size: 0.85rem;
            color: #6c757d;
        }
    </style>
</head>
<body class="login-page">
    <!-- زر الرجوع للرئيسية -->
    <a href="index.php" class="back-home">
        <i class="fas fa-arrow-right"></i>
        الرئيسية
    </a>

    <div class="login-header">
        <div class="logo">
            <i class="fas fa-dumbbell"></i>
            <span>GYM Pro</span>
        </div>
        <p class="tagline">سجل دخول لتبدأ رحلتك الرياضية</p>
    </div>

    <div class="login-container">
        <!-- رسالة الخطأ/النجاح -->
        <div class="alert" id="message"></div>

        <form id="loginForm" class="login-form">
            <div class="form-group">
                <label for="phone">
                    <i class="fas fa-phone"></i>
                    رقم الهاتف
                </label>
                <input type="tel" id="phone" class="form-control" 
                       placeholder="مثال: 01012345678" 
                       pattern="01[0-9]{9}" 
                       required>
            </div>
            
            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i>
                    كلمة المرور
                </label>
                <div class="password-container">
                    <input type="password" id="password" class="form-control" 
                           placeholder="أدخل كلمة المرور" 
                           minlength="6" 
                           required>
                    <button type="button" class="password-icon" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <small class="form-hint">6 أحرف على الأقل</small>
            </div>

            <div class="form-options">
                <label class="checkbox">
                    <input type="checkbox" id="rememberMe">
                    <span>تذكرني</span>
                </label>
                <a href="#" class="forgot-link">نسيت كلمة المرور؟</a>
            </div>
            
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i>
                تسجيل الدخول
            </button>

            <div class="divider">
                <span>أو</span>
            </div>

      
        </form>

        <div class="register-link">
            <p>ليس لديك حساب؟ <a href="register.php">أنشئ حساب جديد</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // عناصر DOM
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const messageDiv = document.getElementById('message');
            const loginForm = document.getElementById('loginForm');
            const adminLoginBtn = document.getElementById('adminLoginBtn');
            
            // إظهار/إخفاء كلمة المرور
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? 
                    '<i class="fas fa-eye"></i>' : 
                    '<i class="fas fa-eye-slash"></i>';
            });
            
            // عرض رسالة
            function showMessage(text, type = 'error') {
                messageDiv.textContent = text;
                messageDiv.className = `alert alert-${type}`;
                messageDiv.style.display = 'block';
                
                setTimeout(() => {
                    messageDiv.style.display = 'none';
                }, 5000);
            }
            
            // تسجيل الدخول
            loginForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const phone = document.getElementById('phone').value.trim();
                const password = document.getElementById('password').value;
                
                // تحقق بسيط
                if (!phone || !password) {
                    showMessage('يرجى ملء جميع الحقول');
                    return;
                }
                
                if (!/^01[0-9]{9}$/.test(phone)) {
                    showMessage('رقم الهاتف يجب أن يكون 11 رقم ويبدأ بـ 01');
                    return;
                }
                
                if (password.length < 6) {
                    showMessage('كلمة المرور يجب أن تكون 6 أحرف على الأقل');
                    return;
                }
                
                // إرسال البيانات لـ PHP
                try {
                    const formData = new FormData();
                    formData.append('action', 'login');
                    formData.append('phone', phone);
                    formData.append('password', password);
                    
                    const response = await fetch('php/auth.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        showMessage(result.message, 'success');
                        // حفظ بيانات المستخدم
                        localStorage.setItem('currentUser', JSON.stringify(result.user));
                        // حفظ تذكرني إذا اختار
                        if (document.getElementById('rememberMe').checked) {
                            localStorage.setItem('rememberMe', 'true');
                        }
                        // الانتقال للداشبورد
                        setTimeout(() => {
                            window.location.href = 'dashboard.php'; // صفحة الداشبورد
                        }, 1500);
                    } else {
                        showMessage(result.message);
                    }
                } catch (error) {
                    showMessage('حدث خطأ في الاتصال بالخادم');
                    console.error(error);
                }
            });
            
            // دخول الأدمن
            adminLoginBtn.addEventListener('click', function() {
                // يمكن عمل مودال أو صفحة منفصلة للأدمن
                const username = prompt('اسم المستخدم للأدمن:');
                const password = prompt('كلمة المرور للأدمن:');
                
                if (username && password) {
                    // هنا رح نرسل للـ PHP للتحقق
                    fetch('php/auth.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=admin_login&username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            localStorage.setItem('isAdmin', 'true');
                            window.location.href = 'admin.php';
                        } else {
                            showMessage('بيانات الأدمن غير صحيحة');
                        }
                    })
                    .catch(error => {
                        showMessage('حدث خطأ في الاتصال');
                    });
                }
            });
            
            // تحميل تذكرني إذا كان مخزن
            if (localStorage.getItem('rememberMe') === 'true') {
                document.getElementById('rememberMe').checked = true;
                // يمكن إضافة تذكر بيانات المستخدم هنا إذا أردت
            }
        });
    </script>
</body>
</html>