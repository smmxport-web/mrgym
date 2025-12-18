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
        .admin-login-page {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }
        
        .admin-login-container {
            background-color: #1e1e1e;
            border-radius: 20px;
            width: 100%;
            max-width: 450px;
            padding: 2.5rem;
            border: 1px solid #333;
            box-shadow: 0 15px 40px rgba(0,0,0,0.5);
            text-align: center;
        }
        
        .admin-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .admin-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #2a9d8f 0%, #1d6f65 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            margin-bottom: 1rem;
            box-shadow: 0 10px 20px rgba(42, 157, 143, 0.3);
        }
        
        .admin-title {
            font-size: 1.8rem;
            color: #e9ecef;
            margin-bottom: 0.5rem;
        }
        
        .admin-subtitle {
            color: #adb5bd;
            font-size: 0.95rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            text-align: right;
        }
        
        .form-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 0.5rem;
            color: #e9ecef;
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .form-label i {
            color: #2a9d8f;
        }
        
        .form-control {
            width: 100%;
            padding: 1rem;
            background-color: #2d2d2d;
            border: 2px solid #444;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #2a9d8f;
            outline: none;
            box-shadow: 0 0 0 3px rgba(42, 157, 143, 0.2);
        }
        
        .password-wrapper {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #adb5bd;
            font-size: 1.2rem;
            cursor: pointer;
        }
        
        .btn-admin-login {
            width: 100%;
            background: linear-gradient(135deg, #2a9d8f 0%, #1d6f65 100%);
            color: white;
            border: none;
            padding: 1.2rem;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 1rem;
            transition: all 0.3s;
        }
        
        .btn-admin-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(42, 157, 143, 0.3);
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
        
        .back-to-site {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #333;
        }
        
        .back-link {
            color: #6c757d;
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .back-link:hover {
            color: #2a9d8f;
        }
    </style>
</head>
<body class="admin-login-page">
    <div class="admin-login-container">
        <!-- الشعار -->
        <div class="admin-logo">
            <div class="admin-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <h1 class="admin-title">لوحة التحكم</h1>
            <p class="admin-subtitle">GYM Pro - نظام إدارة التطبيق</p>
        </div>

        <!-- رسالة الخطأ -->
        <div class="alert" id="message"></div>

        <!-- نموذج تسجيل الدخول -->
        <form id="adminLoginForm">
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-user"></i>
                    <span>اسم المستخدم</span>
                </label>
                <input type="text" class="form-control" id="adminUsername" 
                       placeholder="أدخل اسم المستخدم" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-lock"></i>
                    <span>كلمة المرور</span>
                </label>
                <div class="password-wrapper">
                    <input type="password" class="form-control" id="adminPassword" 
                           placeholder="أدخل كلمة المرور" required>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="btn-admin-login">
                <i class="fas fa-sign-in-alt"></i>
                دخول لوحة التحكم
            </button>
        </form>

        <!-- الرجوع للموقع -->
        <div class="back-to-site">
            <a href="index.php" class="back-link">
                <i class="fas fa-arrow-right"></i>
                العودة للموقع الرئيسي
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // إظهار/إخفاء كلمة المرور
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('adminPassword');
            const messageDiv = document.getElementById('message');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? 
                    '<i class="fas fa-eye"></i>' : 
                    '<i class="fas fa-eye-slash"></i>';
            });
            
            // تسجيل دخول الأدمن
            document.getElementById('adminLoginForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const username = document.getElementById('adminUsername').value.trim();
                const password = document.getElementById('adminPassword').value;
                
                // تحقق بسيط
                if (!username || !password) {
                    showMessage('يرجى ملء جميع الحقول', 'error');
                    return;
                }
                
                try {
                    const response = await fetch('php/auth.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=admin_login&username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        showMessage('تم الدخول بنجاح!', 'success');
                        localStorage.setItem('isAdmin', 'true');
                        
                        // الانتقال للوحة التحكم بعد ثانية
                        setTimeout(() => {
                            window.location.href = 'admin-dashboard.php';
                        }, 1000);
                    } else {
                        showMessage(result.message || 'بيانات الدخول غير صحيحة', 'error');
                    }
                } catch (error) {
                    console.error('Error logging in:', error);
                    showMessage('حدث خطأ في الاتصال بالخادم', 'error');
                }
            });
            
            // عرض رسالة
            function showMessage(text, type = 'error') {
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