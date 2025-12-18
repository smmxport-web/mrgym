<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GYM Pro - إنشاء حساب</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* إضافات خاصة بصفحة التسجيل */
        .register-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #121212 0%, #1a1a1a 100%);
            padding: 1rem;
            display: flex;
            flex-direction: column;
        }
        
        .register-header {
            text-align: center;
            padding: 2rem 1rem 1.5rem;
        }
        
        .register-header .logo {
            justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .register-header .tagline {
            color: #adb5bd;
            font-size: 1.1rem;
        }
        
        .register-container {
            background-color: #1e1e1e;
            border-radius: 20px;
            padding: 2rem;
            margin: 1rem;
            border: 1px solid #333;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            flex-grow: 1;
        }
        
        .register-form .form-group {
            margin-bottom: 1.2rem;
        }
        
        .register-form label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 0.5rem;
            color: #e9ecef;
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .register-form .form-control {
            width: 100%;
            padding: 0.9rem;
            background-color: #2d2d2d;
            border: 2px solid #444;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .register-form .form-control:focus {
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
        
        .btn-register {
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
        
        .terms-check {
            background-color: rgba(42, 157, 143, 0.1);
            padding: 1rem;
            border-radius: 10px;
            margin: 1.5rem 0;
            border: 1px solid rgba(42, 157, 143, 0.3);
        }
        
        .terms-check label {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: #adb5bd;
            cursor: pointer;
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .terms-check input {
            margin-top: 3px;
            width: 18px;
            height: 18px;
            accent-color: #2a9d8f;
            flex-shrink: 0;
        }
        
        .terms-check a {
            color: #2a9d8f;
            text-decoration: none;
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #333;
            color: #adb5bd;
        }
        
        .login-link a {
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
        
        .province-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23adb5bd' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 1rem center;
            background-size: 16px;
            padding-right: 1rem;
        }
    </style>
</head>
<body class="register-page">
    <!-- زر الرجوع للرئيسية -->
    <a href="index.php" class="back-home">
        <i class="fas fa-arrow-right"></i>
        الرئيسية
    </a>

    <div class="register-header">
        <div class="logo">
            <i class="fas fa-dumbbell"></i>
            <span>GYM Pro</span>
        </div>
        <p class="tagline">أنشئ حسابك لتبدأ رحلتك الرياضية</p>
    </div>

    <div class="register-container">
        <!-- رسالة الخطأ/النجاح -->
        <div class="alert" id="message"></div>

        <form id="registerForm" class="register-form">
            <div class="form-group">
                <label for="name">
                    <i class="fas fa-user"></i>
                    الاسم الكامل
                </label>
                <input type="text" id="name" class="form-control" 
                       placeholder="أحمد محمد أحمد" 
                       required>
            </div>
            
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
                <label for="governorate">
                    <i class="fas fa-map-marker-alt"></i>
                    المحافظة
                </label>
               <select id="governorate" class="form-control province-select text-right" required dir="rtl">
    <option value="">اختر المحافظة</option>
    <option value="بورسعيد">بورسعيد</option>
    <option value="الإسكندرية">الإسكندرية</option>
    <option value="الإسماعيلية">الإسماعيلية</option>
    <option value="أسوان">أسوان</option>
    <option value="أسيوط">أسيوط</option>
    <option value="الأقصر">الأقصر</option>
    <option value="البحر الأحمر">البحر الأحمر</option>
    <option value="البحيرة">البحيرة</option>
    <option value="الجيزة">الجيزة</option>
    <option value="الدقهلية">الدقهلية</option>
    <option value="السويس">السويس</option>
    <option value="الشرقية">الشرقية</option>
    <option value="الغربية">الغربية</option>
    <option value="الفيوم">الفيوم</option>
    <option value="القاهرة">القاهرة</option>
    <option value="القليوبية">القليوبية</option>
    <option value="المنوفية">المنوفية</option>
    <option value="المنيا">المنيا</option>
    <option value="الوادي الجديد">الوادي الجديد</option>
    <option value="بني سويف">بني سويف</option>
    <option value="بورسعيد">بورسعيد</option>
    <option value="جنوب سيناء">جنوب سيناء</option>
    <option value="حلوان">حلوان</option>
    <option value="دمياط">دمياط</option>
    <option value="سوهاج">سوهاج</option>
    <option value="شمال سيناء">شمال سيناء</option>
    <option value="قنا">قنا</option>
    <option value="كفر الشيخ">كفر الشيخ</option>
    <option value="مطروح">مطروح</option>
</select>
            </div>
            
            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i>
                    كلمة المرور
                </label>
                <div class="password-container">
                    <input type="password" id="password" class="form-control" 
                           placeholder="6 أحرف على الأقل" 
                           minlength="6" 
                           required>
                    <button type="button" class="password-icon" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="form-group">
                <label for="confirmPassword">
                    <i class="fas fa-lock"></i>
                    تأكيد كلمة المرور
                </label>
                <div class="password-container">
                    <input type="password" id="confirmPassword" class="form-control" 
                           placeholder="أعد إدخال كلمة المرور" 
                           minlength="6" 
                           required>
                    <button type="button" class="password-icon" id="toggleConfirmPassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="terms-check">
                <label>
                    <input type="checkbox" id="agreeTerms" required>
                    <span>أوافق على <a href="#">الشروط والأحكام</a> و <a href="#">سياسة الخصوصية</a></span>
                </label>
            </div>
            
            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus"></i>
                إنشاء حساب جديد
            </button>
        </form>

        <div class="login-link">
            <p>لديك حساب بالفعل؟ <a href="login.php">سجل دخول من هنا</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // عناصر DOM
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const messageDiv = document.getElementById('message');
            const registerForm = document.getElementById('registerForm');
            
            // إظهار/إخفاء كلمة المرور
            togglePassword.addEventListener('click', function() {
                togglePasswordVisibility(passwordInput, this);
            });
            
            toggleConfirmPassword.addEventListener('click', function() {
                togglePasswordVisibility(confirmPasswordInput, this);
            });
            
            function togglePasswordVisibility(input, button) {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                button.innerHTML = type === 'password' ? 
                    '<i class="fas fa-eye"></i>' : 
                    '<i class="fas fa-eye-slash"></i>';
            }
            
            // عرض رسالة
            function showMessage(text, type = 'error') {
                messageDiv.textContent = text;
                messageDiv.className = `alert alert-${type}`;
                messageDiv.style.display = 'block';
                
                setTimeout(() => {
                    messageDiv.style.display = 'none';
                }, 5000);
            }
            
            // تسجيل المستخدم الجديد
            registerForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // جمع البيانات
                const name = document.getElementById('name').value.trim();
                const phone = document.getElementById('phone').value.trim();
                const governorate = document.getElementById('governorate').value;
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                
                // التحقق من البيانات
                if (!name || !phone || !governorate || !password || !confirmPassword) {
                    showMessage('يرجى ملء جميع الحقول');
                    return;
                }
                
                if (password !== confirmPassword) {
                    showMessage('كلمتا المرور غير متطابقتين');
                    return;
                }
                
                if (password.length < 6) {
                    showMessage('كلمة المرور يجب أن تكون 6 أحرف على الأقل');
                    return;
                }
                
                if (!/^01[0-9]{9}$/.test(phone)) {
                    showMessage('رقم الهاتف يجب أن يكون 11 رقم ويبدأ بـ 01');
                    return;
                }
                
                if (!document.getElementById('agreeTerms').checked) {
                    showMessage('يجب الموافقة على الشروط والأحكام');
                    return;
                }
                
                // إرسال البيانات لـ PHP
                try {
                    const formData = new FormData();
                    formData.append('action', 'register');
                    formData.append('name', name);
                    formData.append('phone', phone);
                    formData.append('governorate', governorate);
                    formData.append('password', password);
                    formData.append('confirm', confirmPassword);
                    
                    const response = await fetch('php/auth.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        showMessage(result.message, 'success');
                        // حفظ بيانات المستخدم
                        localStorage.setItem('currentUser', JSON.stringify(result.user));
                        // الانتقال للداشبورد
                        setTimeout(() => {
                            window.location.href = 'dashboard.php'; // أو dashboard.php
                        }, 1500);
                    } else {
                        showMessage(result.message);
                    }
                } catch (error) {
                    showMessage('حدث خطأ في الاتصال بالخادم');
                    console.error(error);
                }
            });
        });
    </script>
</body>
</html>