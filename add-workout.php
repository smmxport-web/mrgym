<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GYM Pro - إنشاء جلسة تدريب</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* إضافات خاصة بصفحة إنشاء جلسة تدريب */
        .create-session-page {
            background-color: #121212;
            min-height: 100vh;
            padding-bottom: 70px;
        }
        
        /* الهيدر */
        .create-session-header {
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
        
        /* معلومات الجلسة */
        .session-info {
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
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
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
            padding: 0.9rem;
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
        }
        
        /* اختيار التمارين */
        .exercises-selection {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
        }
        
        .selection-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .search-box {
            position: relative;
            flex: 1;
            margin-right: 1rem;
        }
        
        .search-input {
            width: 100%;
            padding: 0.9rem 3rem 0.9rem 1rem;
            background-color: #2d2d2d;
            border: 2px solid #444;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 1.2rem;
        }
        
        .btn-primary {
            background-color: #2a9d8f;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* تمارين مختارة */
        .selected-exercises {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
            min-height: 150px;
        }
        
        .selected-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #333;
            font-size: 1.2rem;
        }
        
        #selectedList {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .selected-item {
            background-color: #2d2d2d;
            border-radius: 12px;
            padding: 1rem;
            border-left: 4px solid #2a9d8f;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .exercise-info h4 {
            font-size: 1rem;
            margin-bottom: 0.3rem;
            color: #e9ecef;
        }
        
        .exercise-meta {
            display: flex;
            gap: 1rem;
            color: #adb5bd;
            font-size: 0.85rem;
        }
        
        .remove-selected {
            background: none;
            border: none;
            color: #e76f51;
            font-size: 1.2rem;
            cursor: pointer;
        }
        
        /* قائمة التمارين المتاحة */
        .available-exercises {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
        }
        
        .available-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #333;
            font-size: 1.2rem;
        }
        
        .exercises-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
        }
        
        .exercise-card {
            background-color: #2d2d2d;
            border-radius: 12px;
            padding: 1.2rem;
            border: 1px solid #444;
            transition: all 0.3s;
        }
        
        .exercise-card:hover {
            border-color: #2a9d8f;
            transform: translateY(-2px);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.8rem;
        }
        
        .card-title {
            font-size: 1rem;
            color: #e9ecef;
            font-weight: 600;
        }
        
        .card-category {
            background-color: rgba(42, 157, 143, 0.2);
            color: #2a9d8f;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .card-description {
            color: #adb5bd;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        
        .card-actions {
            display: flex;
            gap: 0.8rem;
        }
        
        .btn-select {
            flex: 1;
            background-color: #2a9d8f;
            color: white;
            border: none;
            padding: 0.7rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-details {
            background-color: transparent;
            border: 1px solid #444;
            color: #adb5bd;
            padding: 0.7rem;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
        }
        
        /* تفاصيل التمرين */
        .exercise-details-form {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
            display: none;
        }
        
        .details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #333;
        }
        
        .details-form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        /* زر الحفظ */
        .save-section {
            padding: 1rem;
        }
        
        .save-btn {
            width: 100%;
            background-color: #2a9d8f;
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
        
        /* لا توجد تمارين */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        /* تحسينات للشاشات الصغيرة */
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .exercises-grid {
                grid-template-columns: 1fr;
            }
            
            .details-form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="create-session-page">
    <!-- الهيدر -->
    <header class="create-session-header">
        <div class="header-top">
            <div class="page-title">
                <i class="fas fa-plus-circle"></i>
                <span>إنشاء جلسة تدريب</span>
            </div>
            <button class="back-btn" onclick="window.history.back()">
                <i class="fas fa-arrow-right"></i>
                رجوع
            </button>
        </div>
    </header>

    <!-- رسائل -->
    <div class="alert" id="message"></div>

    <!-- محتوى الصفحة -->
    <main>
        <!-- معلومات الجلسة -->
        <section class="session-info">
            <div class="info-title">
                <i class="fas fa-info-circle"></i>
                <span>معلومات الجلسة</span>
            </div>
            
            <div class="info-grid">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-heading"></i>
                        <span>اسم الجلسة</span>
                    </label>
                    <input type="text" class="form-control" id="sessionName" 
                           placeholder="مثال: جلسة الصدر اليومية" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calendar-alt"></i>
                        <span>تاريخ الجلسة</span>
                    </label>
                    <input type="date" class="form-control" id="sessionDate" 
                           value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-clock"></i>
                        <span>وقت البداية</span>
                    </label>
                    <input type="time" class="form-control" id="startTime" 
                           value="<?php echo date('H:i'); ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-stopwatch"></i>
                        <span>المدة المتوقعة (دقائق)</span>
                    </label>
                    <input type="number" class="form-control" id="estimatedDuration" 
                           min="15" max="300" placeholder="60" required>
                </div>
            </div>
        </section>

        <!-- التمارين المختارة -->
        <section class="selected-exercises">
            <div class="selected-title">
                <i class="fas fa-list-check"></i>
                <span>التمارين المختارة</span>
                <span class="form-label" id="selectedCount">(0 تمارين)</span>
            </div>
            
            <div id="selectedList">
                <!-- ستم تعبئته بالجافاسكريبت -->
                <div class="empty-state" id="emptySelected">
                    <i class="fas fa-dumbbell"></i>
                    <p>لم يتم اختيار أي تمارين بعد</p>
                    <small>اختر تمارين من القائمة بالأسفل</small>
                </div>
            </div>
        </section>

        <!-- اختيار التمارين -->
        <section class="exercises-selection">
            <div class="selection-header">
                <div class="search-box">
                    <input type="text" class="search-input" id="exerciseSearch" 
                           placeholder="ابحث عن تمرين...">
                    <i class="fas fa-search search-icon"></i>
                </div>
                <button class="btn-primary" id="showAllBtn">
                    <i class="fas fa-list"></i>
                    عرض الكل
                </button>
            </div>
        </section>

        <!-- التمارين المتاحة -->
        <section class="available-exercises">
            <div class="available-title">
                <i class="fas fa-dumbbell"></i>
                <span>التمارين المتاحة</span>
            </div>
            
            <div id="exercisesList">
                <!-- ستم تعبئته بالجافاسكريبت -->
                <div class="loading" id="exercisesLoading">
                    <i class="fas fa-spinner"></i>
                    <p>جاري تحميل التمارين...</p>
                </div>
            </div>
        </section>

        <!-- تفاصيل التمرين -->
        <section class="exercise-details-form" id="exerciseDetailsForm">
            <div class="details-header">
                <h3 id="detailsTitle">تفاصيل التمرين</h3>
                <button class="btn-primary" id="closeDetailsBtn">
                    <i class="fas fa-times"></i>
                    إغلاق
                </button>
            </div>
            
            <div class="details-form" id="detailsFormContent">
                <!-- ستم تعبئته بالجافاسكريبت -->
            </div>
        </section>

        <!-- زر الحفظ -->
        <section class="save-section">
            <button class="save-btn" id="saveSessionBtn">
                <i class="fas fa-save"></i>
                حفظ الجلسة
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
        <a href="add-workout.php" class="nav-item active">
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

    <script>
        // بيانات المستخدم
        const currentUser = JSON.parse(localStorage.getItem('currentUser'));
        let selectedExercises = [];
        let allExercises = [];
        
        document.addEventListener('DOMContentLoaded', function() {
            // إذا مفيش مستخدم، نرجع للتسجيل
            if (!currentUser) {
                window.location.href = 'login.php';
                return;
            }
            
            // تحميل التمارين المتاحة
            loadAvailableExercises();
            
            // إعداد أحداث البحث
            setupSearch();
            
            // إعداد أحداث الأزرار
            document.getElementById('showAllBtn').addEventListener('click', showAllExercises);
            document.getElementById('closeDetailsBtn').addEventListener('click', hideDetailsForm);
            document.getElementById('saveSessionBtn').addEventListener('click', saveTrainingSession);
            
            // تحميل التمارين من قاعدة البيانات
            async function loadAvailableExercises() {
                try {
                    const response = await fetch('php/workouts-data.php');
                    
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        allExercises = data.workouts || [];
                        displayAvailableExercises(allExercises);
                    } else {
                        loadDemoExercises();
                    }
                } catch (error) {
                    console.error('Error loading exercises:', error);
                    loadDemoExercises();
                }
            }
            
            // عرض التمارين المتاحة
            function displayAvailableExercises(exercises) {
                const container = document.getElementById('exercisesList');
                const loading = document.getElementById('exercisesLoading');
                
                if (loading) loading.style.display = 'none';
                
                if (!exercises || exercises.length === 0) {
                    container.innerHTML = `
                        <div class="empty-state">
                            <i class="fas fa-dumbbell"></i>
                            <p>لا توجد تمارين متاحة حالياً</p>
                            <small>سيتم إضافة تمارين جديدة قريباً</small>
                        </div>
                    `;
                    return;
                }
                
                let html = '<div class="exercises-grid">';
                
                exercises.forEach(exercise => {
                    const isSelected = selectedExercises.some(sel => sel.id === exercise.id);
                    
                    html += `
                        <div class="exercise-card" data-id="${exercise.id}">
                            <div class="card-header">
                                <div class="card-title">${exercise.name}</div>
                                <div class="card-category">${getCategoryName(exercise.category)}</div>
                            </div>
                            <div class="card-description">
                                ${exercise.description || 'لا يوجد وصف'}
                            </div>
                            <div class="card-actions">
                                <button class="btn-select ${isSelected ? 'selected' : ''}" 
                                        onclick="selectExercise('${exercise.id}')"
                                        ${isSelected ? 'disabled style="opacity:0.5"' : ''}>
                                    <i class="fas fa-${isSelected ? 'check' : 'plus'}"></i>
                                    ${isSelected ? 'مختار' : 'اختيار'}
                                </button>
                                <button class="btn-details" onclick="showExerciseDetails('${exercise.id}')">
                                    <i class="fas fa-info-circle"></i>
                                    التفاصيل
                                </button>
                            </div>
                        </div>
                    `;
                });
                
                html += '</div>';
                container.innerHTML = html;
            }
            
            // تحميل تمارين تجريبية
            function loadDemoExercises() {
                allExercises = [
                    {
                        id: '1',
                        name: 'ضغط الصدر',
                        category: 'chest',
                        description: 'تمرين أساسي لتقوية عضلات الصدر الأمامية',
                        difficulty: 'beginner',
                        duration: 30,
                        calories: 200,
                        sets: 3,
                        reps: 12
                    },
                    {
                        id: '2',
                        name: 'العقلة',
                        category: 'back',
                        description: 'تمرين ممتاز لعضلات الظهر والعضلة الظهرية',
                        difficulty: 'intermediate',
                        duration: 25,
                        calories: 180,
                        sets: 4,
                        reps: 8
                    },
                    {
                        id: '3',
                        name: 'القرفصاء',
                        category: 'legs',
                        description: 'تمرين أساسي لعضلات الأرجل والأرداف',
                        difficulty: 'beginner',
                        duration: 20,
                        calories: 150,
                        sets: 3,
                        reps: 15
                    },
                    {
                        id: '4',
                        name: 'البايسبس',
                        category: 'arms',
                        description: 'تمرين لعضلات الذراع الأمامية (البايسبس)',
                        difficulty: 'beginner',
                        duration: 15,
                        calories: 100,
                        sets: 3,
                        reps: 12
                    }
                ];
                
                displayAvailableExercises(allExercises);
            }
            
            // اختيار تمرين
            window.selectExercise = function(exerciseId) {
                const exercise = allExercises.find(ex => ex.id === exerciseId);
                if (!exercise) return;
                
                // التحقق إذا التمرين مختار مسبقاً
                if (selectedExercises.some(ex => ex.id === exerciseId)) {
                    showMessage('التمرين مختار مسبقاً', 'error');
                    return;
                }
                
                // إضافة تفاصيل إضافية للتمرين المختار
                const selectedExercise = {
                    ...exercise,
                    selectedSets: 3,
                    selectedReps: 12,
                    selectedWeight: null,
                    notes: ''
                };
                
                selectedExercises.push(selectedExercise);
                updateSelectedList();
                updateSelectedCount();
                
                // تحديث زر الاختيار
                const selectBtn = document.querySelector(`.exercise-card[data-id="${exerciseId}"] .btn-select`);
                if (selectBtn) {
                    selectBtn.disabled = true;
                    selectBtn.innerHTML = '<i class="fas fa-check"></i> مختار';
                    selectBtn.style.opacity = '0.5';
                }
                
                showMessage('تم إضافة التمرين للجلسة', 'success');
            };
            
            // تحديث قائمة التمارين المختارة
            function updateSelectedList() {
                const container = document.getElementById('selectedList');
                const emptyState = document.getElementById('emptySelected');
                
                if (selectedExercises.length === 0) {
                    if (!emptyState) {
                        container.innerHTML = `
                            <div class="empty-state" id="emptySelected">
                                <i class="fas fa-dumbbell"></i>
                                <p>لم يتم اختيار أي تمارين بعد</p>
                                <small>اختر تمارين من القائمة بالأسفل</small>
                            </div>
                        `;
                    }
                    return;
                }
                
                if (emptyState) emptyState.remove();
                
                let html = '';
                selectedExercises.forEach((exercise, index) => {
                    html += `
                        <div class="selected-item" data-index="${index}">
                            <div class="exercise-info">
                                <h4>${exercise.name}</h4>
                                <div class="exercise-meta">
                                    <span><i class="fas fa-layer-group"></i> ${exercise.selectedSets || 3} مجموعات</span>
                                    <span><i class="fas fa-repeat"></i> ${exercise.selectedReps || 12} تكرار</span>
                                    ${exercise.selectedWeight ? `<span><i class="fas fa-weight-hanging"></i> ${exercise.selectedWeight} كجم</span>` : ''}
                                </div>
                            </div>
                            <div>
                                <button class="btn-primary" style="padding: 0.5rem 1rem; margin-right: 0.5rem;" 
                                        onclick="editExerciseDetails(${index})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="remove-selected" onclick="removeSelectedExercise(${index})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    `;
                });
                
                container.innerHTML = html;
            }
            
            // تحديث عدد التمارين المختارة
            function updateSelectedCount() {
                const countElement = document.getElementById('selectedCount');
                countElement.textContent = `(${selectedExercises.length} تمارين)`;
            }
            
            // إزالة تمرين مختار
            window.removeSelectedExercise = function(index) {
                if (index >= 0 && index < selectedExercises.length) {
                    const removedExercise = selectedExercises.splice(index, 1)[0];
                    
                    // إعادة تفعيل زر الاختيار
                    const selectBtn = document.querySelector(`.exercise-card[data-id="${removedExercise.id}"] .btn-select`);
                    if (selectBtn) {
                        selectBtn.disabled = false;
                        selectBtn.innerHTML = '<i class="fas fa-plus"></i> اختيار';
                        selectBtn.style.opacity = '1';
                    }
                    
                    updateSelectedList();
                    updateSelectedCount();
                    showMessage('تم إزالة التمرين', 'success');
                }
            };
            
            // تعديل تفاصيل التمرين
            window.editExerciseDetails = function(index) {
                if (index >= 0 && index < selectedExercises.length) {
                    const exercise = selectedExercises[index];
                    showDetailsForm(exercise, index);
                }
            };
            
            // إعداد البحث
            function setupSearch() {
                const searchInput = document.getElementById('exerciseSearch');
                let searchTimeout;
                
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    
                    searchTimeout = setTimeout(() => {
                        const searchTerm = this.value.trim().toLowerCase();
                        
                        if (searchTerm.length === 0) {
                            displayAvailableExercises(allExercises);
                            return;
                        }
                        
                        const filteredExercises = allExercises.filter(exercise => {
                            return exercise.name.toLowerCase().includes(searchTerm) ||
                                   exercise.description.toLowerCase().includes(searchTerm) ||
                                   getCategoryName(exercise.category).toLowerCase().includes(searchTerm);
                        });
                        
                        displayAvailableExercises(filteredExercises);
                    }, 300);
                });
            }
            
            // عرض كل التمارين
            function showAllExercises() {
                document.getElementById('exerciseSearch').value = '';
                displayAvailableExercises(allExercises);
            }
            
            // عرض تفاصيل التمرين
            window.showExerciseDetails = function(exerciseId) {
                const exercise = allExercises.find(ex => ex.id === exerciseId);
                if (!exercise) return;
                
                const form = document.getElementById('exerciseDetailsForm');
                const title = document.getElementById('detailsTitle');
                const content = document.getElementById('detailsFormContent');
                
                title.textContent = exercise.name;
                
                content.innerHTML = `
                    <div style="grid-column: 1 / -1; margin-bottom: 1rem;">
                        <p style="color: #adb5bd; line-height: 1.6;">${exercise.description || 'لا يوجد وصف'}</p>
                    </div>
                    <div>
                        <label class="form-label">المستوى</label>
                        <div class="form-control" style="background-color: #2d2d2d; border: none;">
                            ${getDifficultyText(exercise.difficulty)}
                        </div>
                    </div>
                    <div>
                        <label class="form-label">المدة</label>
                        <div class="form-control" style="background-color: #2d2d2d; border: none;">
                            ${exercise.duration || 0} دقيقة
                        </div>
                    </div>
                    <div>
                        <label class="form-label">السعرات</label>
                        <div class="form-control" style="background-color: #2d2d2d; border: none;">
                            ${exercise.calories || 0} سعرة
                        </div>
                    </div>
                    <div>
                        <label class="form-label">المجموعات</label>
                        <div class="form-control" style="background-color: #2d2d2d; border: none;">
                            ${exercise.sets || 0} مجموعات
                        </div>
                    </div>
                    <div style="grid-column: 1 / -1; text-align: center; margin-top: 1rem;">
                        <button type="button" class="btn-primary" onclick="selectExercise('${exercise.id}'); hideDetailsForm();">
                            <i class="fas fa-plus"></i>
                            إضافة هذا التمرين
                        </button>
                    </div>
                `;
                
                form.style.display = 'block';
                form.scrollIntoView({ behavior: 'smooth' });
            };
            
            // عرض نموذج تفاصيل التمرين المختار
            function showDetailsForm(exercise, index) {
                const form = document.getElementById('exerciseDetailsForm');
                const title = document.getElementById('detailsTitle');
                const content = document.getElementById('detailsFormContent');
                
                title.textContent = `تعديل ${exercise.name}`;
                
                content.innerHTML = `
                    <div>
                        <label class="form-label">المجموعات</label>
                        <input type="number" class="form-control sets-input" 
                               value="${exercise.selectedSets || 3}" min="1" max="10">
                    </div>
                    <div>
                        <label class="form-label">التكرارات</label>
                        <input type="number" class="form-control reps-input" 
                               value="${exercise.selectedReps || 12}" min="1" max="50">
                    </div>
                    <div>
                        <label class="form-label">الوزن (كجم)</label>
                        <input type="number" class="form-control weight-input" 
                               value="${exercise.selectedWeight || ''}" min="0" max="200" step="0.5" placeholder="اختياري">
                    </div>
                    <div>
                        <label class="form-label">ملاحظات</label>
                        <input type="text" class="form-control notes-input" 
                               value="${exercise.notes || ''}" placeholder="ملاحظات إضافية">
                    </div>
                    <div style="grid-column: 1 / -1; display: flex; gap: 1rem; margin-top: 1rem;">
                        <button type="button" class="btn-primary" style="flex: 1;" 
                                onclick="updateExerciseDetails(${index})">
                            <i class="fas fa-save"></i>
                            حفظ التعديلات
                        </button>
                        <button type="button" class="btn-primary" style="background-color: #e76f51; flex: 1;" 
                                onclick="removeSelectedExercise(${index}); hideDetailsForm();">
                            <i class="fas fa-trash"></i>
                            حذف التمرين
                        </button>
                    </div>
                `;
                
                form.style.display = 'block';
                form.scrollIntoView({ behavior: 'smooth' });
            }
            
            // تحديث تفاصيل التمرين
            window.updateExerciseDetails = function(index) {
                const form = document.getElementById('exerciseDetailsForm');
                const setsInput = form.querySelector('.sets-input');
                const repsInput = form.querySelector('.reps-input');
                const weightInput = form.querySelector('.weight-input');
                const notesInput = form.querySelector('.notes-input');
                
                if (setsInput && repsInput && index >= 0 && index < selectedExercises.length) {
                    selectedExercises[index].selectedSets = parseInt(setsInput.value) || 3;
                    selectedExercises[index].selectedReps = parseInt(repsInput.value) || 12;
                    selectedExercises[index].selectedWeight = weightInput.value ? parseFloat(weightInput.value) : null;
                    selectedExercises[index].notes = notesInput.value.trim();
                    
                    updateSelectedList();
                    hideDetailsForm();
                    showMessage('تم تحديث تفاصيل التمرين', 'success');
                }
            };
            
            // إخفاء نموذج التفاصيل
            function hideDetailsForm() {
                document.getElementById('exerciseDetailsForm').style.display = 'none';
            }
            
            // حفظ جلسة التدريب
            async function saveTrainingSession() {
                // التحقق من البيانات الأساسية
                const sessionName = document.getElementById('sessionName').value.trim();
                const sessionDate = document.getElementById('sessionDate').value;
                const startTime = document.getElementById('startTime').value;
                const estimatedDuration = document.getElementById('estimatedDuration').value;
                
                if (!sessionName || !sessionDate || !startTime || !estimatedDuration) {
                    showMessage('يرجى ملء جميع معلومات الجلسة', 'error');
                    return;
                }
                
                if (selectedExercises.length === 0) {
                    showMessage('يرجى اختيار تمرين واحد على الأقل', 'error');
                    return;
                }
                
                // جمع بيانات الجلسة
                const sessionData = {
                    sessionId: 'session_' + Date.now(),
                    name: sessionName,
                    date: sessionDate,
                    startTime: startTime,
                    estimatedDuration: parseInt(estimatedDuration),
                    actualDuration: null, // سيتم تعبئته لاحقاً
                    calories: calculateTotalCalories(),
                    effortLevel: 5, // متوسط (يمكن إضافة اختيار)
                    notes: '',
                    exercises: selectedExercises.map(exercise => ({
                        exerciseId: exercise.id,
                        name: exercise.name,
                        category: exercise.category,
                        sets: exercise.selectedSets || 3,
                        reps: exercise.selectedReps || 12,
                        weight: exercise.selectedWeight,
                        notes: exercise.notes || ''
                    })),
                    userId: currentUser.id,
                    createdAt: new Date().toISOString(),
                    status: 'completed' // أو 'planned' للمستقبل
                };
                
                // حفظ الجلسة
                await saveSession(sessionData);
            }
            
            // حساب إجمالي السعرات
            function calculateTotalCalories() {
                return selectedExercises.reduce((total, exercise) => {
                    return total + (exercise.calories || 0);
                }, 0);
            }
            
            // دالة حفظ الجلسة المشتركة
            async function saveSession(sessionData) {
                // إظهار تحميل
                const saveBtn = document.getElementById('saveSessionBtn');
                const originalText = saveBtn.innerHTML;
                saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';
                saveBtn.disabled = true;
                
                try {
                    const response = await fetch('php/save-session.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(sessionData)
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        showMessage('تم حفظ جلسة التدريب بنجاح!', 'success');
                        
                        // الانتقال للداشبورد بعد ثانيتين
                        setTimeout(() => {
                            window.location.href = 'dashboard.php';
                        }, 2000);
                    } else {
                        showMessage(result.message || 'حدث خطأ في الحفظ', 'error');
                        saveBtn.innerHTML = originalText;
                        saveBtn.disabled = false;
                    }
                } catch (error) {
                    console.error('Error saving session:', error);
                    showMessage('حدث خطأ في الاتصال بالخادم', 'error');
                    saveBtn.innerHTML = originalText;
                    saveBtn.disabled = false;
                    
                    // حفظ محلي إذا فشل الاتصال
                    saveSessionLocally(sessionData);
                }
            }
            
            // حفظ الجلسة محلياً
            function saveSessionLocally(sessionData) {
                const mySessions = JSON.parse(localStorage.getItem('mySessions')) || [];
                mySessions.push(sessionData);
                localStorage.setItem('mySessions', JSON.stringify(mySessions));
                
                showMessage('تم حفظ الجلسة محلياً (بدون اتصال)', 'success');
                
                // الانتقال للداشبورد
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 2000);
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
            
            // دوال مساعدة
            function getCategoryName(category) {
                const categories = {
                    'chest': 'الصدر',
                    'back': 'الظهر',
                    'legs': 'الأرجل',
                    'arms': 'الأذرع',
                    'shoulders': 'الأكتاف',
                    'abs': 'البطن',
                    'cardio': 'كارديو',
                    'full_body': 'كل الجسم',
                    'stretching': 'إطالة'
                };
                return categories[category] || category;
            }
            
            function getDifficultyText(difficulty) {
                const levels = {
                    'beginner': 'مبتدئ',
                    'intermediate': 'متوسط',
                    'advanced': 'متقدم'
                };
                return levels[difficulty] || difficulty;
            }
        });
    </script>
</body>
</html>