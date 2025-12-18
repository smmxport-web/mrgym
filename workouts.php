<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GYM Pro - التمارين</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* إضافات خاصة بصفحة التمارين */
        .workouts-page {
            background-color: #121212;
            min-height: 100vh;
            padding-bottom: 70px;
        }
        
        /* الهيدر */
        .workouts-header {
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
        
        /* فلترة التمارين */
        .filters-section {
            background-color: #1e1e1e;
            padding: 1rem;
            border-radius: 15px;
            margin: 1rem;
            border: 1px solid #333;
        }
        
        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }
        
        .filter-tab {
            background: none;
            border: 1px solid #444;
            color: #adb5bd;
            padding: 0.7rem 1.2rem;
            border-radius: 25px;
            font-size: 0.9rem;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.3s;
        }
        
        .filter-tab.active {
            background-color: #2a9d8f;
            color: white;
            border-color: #2a9d8f;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 1rem 3rem 1rem 1rem;
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
        
        /* قائمة التمارين */
        .workouts-list {
            padding: 0 1rem;
        }
        
        .workout-category {
            margin-bottom: 2rem;
        }
        
        .category-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #333;
        }
        
        .category-title h2 {
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .workouts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
        }
        
        .workout-card {
            background-color: #1e1e1e;
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #333;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .workout-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }
        
        .workout-image {
            height: 150px;
            background-color: #2d2d2d;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 3rem;
        }
        
        .workout-content {
            padding: 1.2rem;
        }
        
        .workout-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.8rem;
        }
        
        .workout-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #e9ecef;
        }
        
        .workout-difficulty {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .difficulty-beginner {
            background-color: rgba(42, 157, 143, 0.2);
            color: #2a9d8f;
        }
        
        .difficulty-intermediate {
            background-color: rgba(231, 111, 81, 0.2);
            color: #e76f51;
        }
        
        .difficulty-advanced {
            background-color: rgba(108, 117, 125, 0.2);
            color: #adb5bd;
        }
        
        .workout-description {
            color: #adb5bd;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }
        
        .workout-meta {
            display: flex;
            justify-content: space-between;
            color: #6c757d;
            font-size: 0.85rem;
            margin-bottom: 1.2rem;
        }
        
        .workout-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .workout-actions {
            display: flex;
            gap: 0.8rem;
        }
        
        .btn-add {
            flex: 1;
            background-color: #2a9d8f;
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 10px;
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
            padding: 0.8rem 1rem;
            border-radius: 10px;
            font-size: 0.9rem;
            cursor: pointer;
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
        
        /* مودال تفاصيل التمرين */
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
            max-width: 500px;
            border: 1px solid #333;
            max-height: 90vh;
            overflow-y: auto;
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
        
        .workout-steps {
            margin: 1.5rem 0;
        }
        
        .step-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #333;
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            background-color: #2a9d8f;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }
        
        .step-content h4 {
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }
        
        .step-content p {
            color: #adb5bd;
            font-size: 0.9rem;
            line-height: 1.5;
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
<body class="workouts-page">
    <!-- الهيدر -->
    <header class="workouts-header">
        <div class="header-top">
            <div class="page-title">
                <i class="fas fa-dumbbell"></i>
                <span>التمارين</span>
            </div>
            <button class="back-btn" onclick="window.history.back()">
                <i class="fas fa-arrow-right"></i>
                رجوع
            </button>
        </div>
        
        <!-- فلترة -->
        <div class="filters-section">
            <div class="filter-tabs" id="filterTabs">
                <button class="filter-tab active" data-category="all">الكل</button>
                <button class="filter-tab" data-category="chest">الصدر</button>
                <button class="filter-tab" data-category="back">الظهر</button>
                <button class="filter-tab" data-category="legs">الأرجل</button>
                <button class="filter-tab" data-category="arms">الأذرع</button>
                <button class="filter-tab" data-category="shoulders">الأكتاف</button>
                <button class="filter-tab" data-category="cardio">كارديو</button>
                <button class="filter-tab" data-category="abs">البطن</button>
            </div>
            
            <div class="search-box">
                <input type="text" class="search-input" id="searchInput" placeholder="ابحث عن تمرين...">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>
    </header>

    <!-- رسائل -->
    <div class="alert" id="message"></div>

    <!-- قائمة التمارين -->
    <main class="workouts-list">
        <div class="loading" id="loading">
            <i class="fas fa-spinner"></i>
            <p>جاري تحميل التمارين...</p>
        </div>
        
        <div id="workoutsContainer">
            <!-- التمارين هتتحمل هنا -->
        </div>
    </main>

    <!-- النافبار السفلي -->
    <nav class="bottom-nav">
        <a href="dashboard.php" class="nav-item">
            <i class="fas fa-home"></i>
            <span>الرئيسية</span>
        </a>
        <a href="workouts.php" class="nav-item active">
            <i class="fas fa-dumbbell"></i>
            <span>التمارين</span>
        </a>
        <a href="add-workout.php" class="nav-item">
            <i class="fas fa-plus-circle"></i>
            <span>إضافة</span>
        </a>
        <a href="my-workouts.php" class="nav-item">
            <i class="fas fa-list-check"></i>
            <span>تماريني</span>
        </a>
        <a href="profile.php" class="nav-item">
            <i class="fas fa-user"></i>
            <span>الملف</span>
        </a>
    </nav>

    <!-- مودال تفاصيل التمرين -->
    <div class="modal-overlay" id="workoutModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">تفاصيل التمرين</h3>
                <button class="modal-close" id="closeModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- محتوى المودال هيتحمل هنا -->
            </div>
        </div>
    </div>

    <script>
        // بيانات المستخدم
        const currentUser = JSON.parse(localStorage.getItem('currentUser'));
        
        document.addEventListener('DOMContentLoaded', function() {
            // إذا مفيش مستخدم، نرجع للتسجيل
            if (!currentUser) {
                window.location.href = 'login.php';
                return;
            }
            
            // تحميل التمارين
            loadWorkouts();
            
            // أحداث الفلترة
            setupFilters();
            
            // حدث البحث
            setupSearch();
            
            // أحداث المودال
            setupModal();
            
            // تحميل التمارين من السيرفر
            async function loadWorkouts() {
                try {
                    const response = await fetch('php/workouts-data.php');
                    
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        displayWorkouts(data.workouts);
                    } else {
                        showMessage('حدث خطأ في تحميل التمارين', 'error');
                        // عرض بيانات تجريبية
                        displayDemoWorkouts();
                    }
                } catch (error) {
                    console.error('Error loading workouts:', error);
                    showMessage('حدث خطأ في الاتصال بالخادم', 'error');
                    displayDemoWorkouts();
                }
            }
            
            // عرض التمارين
            function displayWorkouts(workouts) {
                const container = document.getElementById('workoutsContainer');
                const loading = document.getElementById('loading');
                
                loading.style.display = 'none';
                container.innerHTML = '';
                
                if (!workouts || workouts.length === 0) {
                    container.innerHTML = `
                        <div class="empty-state">
                            <i class="fas fa-dumbbell"></i>
                            <p>لا توجد تمارين متاحة حالياً</p>
                            <small>سيتم إضافة تمارين جديدة قريباً</small>
                        </div>
                    `;
                    return;
                }
                
                // تجميع التمارين حسب الفئة
                const categories = {};
                
                workouts.forEach(workout => {
                    if (!categories[workout.category]) {
                        categories[workout.category] = [];
                    }
                    categories[workout.category].push(workout);
                });
                
                // عرض التمارين حسب الفئة
                for (const [category, categoryWorkouts] of Object.entries(categories)) {
                    const categorySection = document.createElement('div');
                    categorySection.className = 'workout-category';
                    categorySection.id = `category-${category}`;
                    
                    const categoryTitle = getCategoryTitle(category);
                    
                    categorySection.innerHTML = `
                        <div class="category-title">
                            <h2>
                                <i class="${getCategoryIcon(category)}"></i>
                                ${categoryTitle}
                            </h2>
                            <span class="badge">${categoryWorkouts.length} تمرين</span>
                        </div>
                        <div class="workouts-grid" id="grid-${category}">
                            ${categoryWorkouts.map(workout => createWorkoutCard(workout)).join('')}
                        </div>
                    `;
                    
                    container.appendChild(categorySection);
                }
                
                // إضافة أحداث للأزرار
                addWorkoutEvents();
            }
            
            // إنشاء بطاقة تمرين
            function createWorkoutCard(workout) {
                const difficultyClass = `difficulty-${workout.difficulty || 'beginner'}`;
                const difficultyText = getDifficultyText(workout.difficulty);
                
                return `
                    <div class="workout-card" data-id="${workout.id}" data-category="${workout.category}">
                        <div class="workout-image">
                            <i class="${getWorkoutIcon(workout.category)}"></i>
                        </div>
                        <div class="workout-content">
                            <div class="workout-header">
                                <h3 class="workout-title">${workout.name}</h3>
                                <span class="workout-difficulty ${difficultyClass}">
                                    ${difficultyText}
                                </span>
                            </div>
                            <p class="workout-description">${workout.description || 'لا يوجد وصف'}</p>
                            <div class="workout-meta">
                                <span>
                                    <i class="fas fa-clock"></i>
                                    ${workout.duration || 0} دقيقة
                                </span>
                                <span>
                                    <i class="fas fa-fire"></i>
                                    ${workout.calories || 0} سعرة
                                </span>
                                <span>
                                    <i class="fas fa-repeat"></i>
                                    ${workout.sets || 0} مجموعات
                                </span>
                            </div>
                            <div class="workout-actions">
                                <button class="btn-add" data-id="${workout.id}">
                                    <i class="fas fa-plus"></i>
                                    أضف لخطتي
                                </button>
                                <button class="btn-details" data-id="${workout.id}">
                                    التفاصيل
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }
            
            // بيانات تجريبية
            function displayDemoWorkouts() {
                const demoWorkouts = [
                    {
                        id: '1',
                        name: 'تمرين ضغط الصدر',
                        category: 'chest',
                        difficulty: 'beginner',
                        description: 'تمرين أساسي لتقوية عضلات الصدر',
                        duration: 30,
                        calories: 200,
                        sets: 3,
                        steps: [
                            'استلقي على الأرض مع ثني الركبتين',
                            'ضع يديك بمحاذاة الصدر',
                            'اخفض جسمك حتى يقترب الصدر من الأرض',
                            'ارفع جسمك للوضع الأول'
                        ]
                    },
                    {
                        id: '2',
                        name: 'تمرين العقلة',
                        category: 'back',
                        difficulty: 'intermediate',
                        description: 'تمرين ممتاز لعضلات الظهر',
                        duration: 25,
                        calories: 180,
                        sets: 4,
                        steps: [
                            'أمسك بالعقلة بيديك',
                            'ارفع جسمك حتى تصل الذقن للعقلة',
                            'اخفض جسمك ببطء'
                        ]
                    },
                    {
                        id: '3',
                        name: 'تمرين القرفصاء',
                        category: 'legs',
                        difficulty: 'beginner',
                        description: 'تمرين أساسي لعضلات الأرجل',
                        duration: 20,
                        calories: 150,
                        sets: 3,
                        steps: [
                            'قف مستقيمًا مع مباعدة القدمين',
                            'اخفض جسمك كما لو تجلس على كرسي',
                            'ارجع للوضع الأول'
                        ]
                    },
                    {
                        id: '4',
                        name: 'تمرين البايسبس',
                        category: 'arms',
                        difficulty: 'beginner',
                        description: 'تمرين لعضلات الذراع الأمامية',
                        duration: 15,
                        calories: 100,
                        sets: 3,
                        steps: [
                            'أمسك الدمبل بيدك',
                            'اثني الذراع نحو الكتف',
                            'اخفض الدمبل ببطء'
                        ]
                    }
                ];
                
                displayWorkouts(demoWorkouts);
            }
            
            // إعداد الفلاتر
            function setupFilters() {
                const filterTabs = document.querySelectorAll('.filter-tab');
                
                filterTabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        // إزالة النشاط من كل التبويبات
                        filterTabs.forEach(t => t.classList.remove('active'));
                        
                        // إضافة النشاط للتبويب الحالي
                        this.classList.add('active');
                        
                        // تطبيق الفلترة
                        const category = this.dataset.category;
                        filterWorkouts(category);
                    });
                });
            }
            
            // فلترة التمارين
            function filterWorkouts(category) {
                const allCards = document.querySelectorAll('.workout-card');
                const allCategories = document.querySelectorAll('.workout-category');
                
                if (category === 'all') {
                    // إظهار كل التمارين
                    allCards.forEach(card => {
                        card.style.display = 'block';
                    });
                    allCategories.forEach(cat => {
                        cat.style.display = 'block';
                    });
                } else {
                    // إخفاء كل التمارين أولاً
                    allCards.forEach(card => {
                        card.style.display = 'none';
                    });
                    allCategories.forEach(cat => {
                        cat.style.display = 'none';
                    });
                    
                    // إظهار التمارين في الفئة المحددة فقط
                    const selectedCards = document.querySelectorAll(`.workout-card[data-category="${category}"]`);
                    const selectedCategory = document.getElementById(`category-${category}`);
                    
                    if (selectedCards.length > 0) {
                        selectedCards.forEach(card => {
                            card.style.display = 'block';
                        });
                        if (selectedCategory) {
                            selectedCategory.style.display = 'block';
                        }
                    } else {
                        document.getElementById('workoutsContainer').innerHTML = `
                            <div class="empty-state">
                                <i class="fas fa-dumbbell"></i>
                                <p>لا توجد تمارين في هذه الفئة</p>
                            </div>
                        `;
                    }
                }
            }
            
            // إعداد البحث
            function setupSearch() {
                const searchInput = document.getElementById('searchInput');
                let searchTimeout;
                
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    
                    searchTimeout = setTimeout(() => {
                        const searchTerm = this.value.trim().toLowerCase();
                        
                        if (searchTerm.length === 0) {
                            // إذا البحث فارغ، نعيد عرض كل التمارين
                            const activeTab = document.querySelector('.filter-tab.active');
                            if (activeTab) {
                                filterWorkouts(activeTab.dataset.category);
                            }
                            return;
                        }
                        
                        // البحث في التمارين
                        const allCards = document.querySelectorAll('.workout-card');
                        let found = false;
                        
                        allCards.forEach(card => {
                            const title = card.querySelector('.workout-title').textContent.toLowerCase();
                            const description = card.querySelector('.workout-description').textContent.toLowerCase();
                            
                            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                                card.style.display = 'block';
                                found = true;
                            } else {
                                card.style.display = 'none';
                            }
                        });
                        
                        // إخفاء العناوين الفارغة
                        document.querySelectorAll('.workout-category').forEach(category => {
                            const visibleCards = category.querySelectorAll('.workout-card[style*="block"]');
                            category.style.display = visibleCards.length > 0 ? 'block' : 'none';
                        });
                        
                        if (!found) {
                            document.getElementById('workoutsContainer').innerHTML = `
                                <div class="empty-state">
                                    <i class="fas fa-search"></i>
                                    <p>لا توجد نتائج للبحث: "${searchTerm}"</p>
                                </div>
                            `;
                        }
                    }, 300);
                });
            }
            
            // إعداد المودال
            function setupModal() {
                const modal = document.getElementById('workoutModal');
                const closeBtn = document.getElementById('closeModal');
                
                closeBtn.addEventListener('click', () => {
                    modal.style.display = 'none';
                });
                
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.style.display = 'none';
                    }
                });
            }
            
            // إضافة أحداث للأزرار
            function addWorkoutEvents() {
                // أزرار التفاصيل
                document.querySelectorAll('.btn-details').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const workoutId = this.dataset.id;
                        showWorkoutDetails(workoutId);
                    });
                });
                
                // أزرار الإضافة
                document.querySelectorAll('.btn-add').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const workoutId = this.dataset.id;
                        addToMyWorkouts(workoutId);
                    });
                });
            }
            
            // عرض تفاصيل التمرين
            async function showWorkoutDetails(workoutId) {
                try {
                    // محاولة جلب البيانات من السيرفر
                    const response = await fetch(`php/workouts-data.php?id=${workoutId}`);
                    let workout;
                    
                    if (response.ok) {
                        const data = await response.json();
                        workout = data.workout;
                    } else {
                        // إذا فشل، نبحث في البيانات المحلية
                        workout = findWorkoutById(workoutId);
                    }
                    
                    if (!workout) {
                        showMessage('لم يتم العثور على التمرين', 'error');
                        return;
                    }
                    
                    const modal = document.getElementById('workoutModal');
                    const modalTitle = document.getElementById('modalTitle');
                    const modalBody = document.getElementById('modalBody');
                    
                    modalTitle.textContent = workout.name;
                    
                    const stepsHtml = workout.steps && workout.steps.length > 0 
                        ? workout.steps.map((step, index) => `
                            <div class="step-item">
                                <div class="step-number">${index + 1}</div>
                                <div class="step-content">
                                    <h4>الخطوة ${index + 1}</h4>
                                    <p>${step}</p>
                                </div>
                            </div>
                        `).join('')
                        : '<p class="empty-state">لا توجد خطوات مفصلة لهذا التمرين</p>';
                    
                    modalBody.innerHTML = `
                        <div class="workout-info">
                            <p><strong>الفئة:</strong> ${getCategoryTitle(workout.category)}</p>
                            <p><strong>المستوى:</strong> ${getDifficultyText(workout.difficulty)}</p>
                            <p><strong>المدة:</strong> ${workout.duration} دقيقة</p>
                            <p><strong>السعرات:</strong> ${workout.calories} سعرة حرارية</p>
                            <p><strong>المجموعات:</strong> ${workout.sets || 3} مجموعات</p>
                        </div>
                        
                        <div class="workout-steps">
                            <h4>خطوات التمرين:</h4>
                            ${stepsHtml}
                        </div>
                        
                        <button class="btn-add" style="width: 100%;" onclick="addToMyWorkouts('${workoutId}')">
                            <i class="fas fa-plus"></i>
                            أضف هذا التمرين لخطتي
                        </button>
                    `;
                    
                    modal.style.display = 'flex';
                    
                } catch (error) {
                    console.error('Error loading workout details:', error);
                    showMessage('حدث خطأ في تحميل التفاصيل', 'error');
                }
            }
            
            // إضافة تمرين لتماريني
            async function addToMyWorkouts(workoutId) {
                if (!currentUser) {
                    showMessage('يجب تسجيل الدخول أولاً', 'error');
                    return;
                }
                
                try {
                    const response = await fetch('php/my-workouts.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=add&userId=${currentUser.id}&workoutId=${workoutId}`
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        showMessage('تم إضافة التمرين لخطتك بنجاح!', 'success');
                    } else {
                        showMessage(result.message || 'حدث خطأ في الإضافة', 'error');
                    }
                } catch (error) {
                    console.error('Error adding workout:', error);
                    showMessage('تم إضافة التمرين مؤقتاً (بدون اتصال)', 'success');
                    
                    // حفظ محلي إذا فشل الاتصال
                    saveWorkoutLocally(workoutId);
                }
            }
            
            // حفظ التمرين محلياً
            function saveWorkoutLocally(workoutId) {
                const myWorkouts = JSON.parse(localStorage.getItem('myWorkouts')) || [];
                if (!myWorkouts.includes(workoutId)) {
                    myWorkouts.push(workoutId);
                    localStorage.setItem('myWorkouts', JSON.stringify(myWorkouts));
                }
            }
            
            // البحث عن تمرين بالـ ID
            function findWorkoutById(workoutId) {
                // هذا مكان للبحث في البيانات المحلية إذا كانت موجودة
                return null;
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
            function getCategoryTitle(category) {
                const categories = {
                    'chest': 'تمارين الصدر',
                    'back': 'تمارين الظهر',
                    'legs': 'تمارين الأرجل',
                    'arms': 'تمارين الأذرع',
                    'shoulders': 'تمارين الأكتاف',
                    'cardio': 'تمارين الكارديو',
                    'abs': 'تمارين البطن'
                };
                return categories[category] || category;
            }
            
            function getCategoryIcon(category) {
                const icons = {
                    'chest': 'fas fa-heart',
                    'back': 'fas fa-vest',
                    'legs': 'fas fa-walking',
                    'arms': 'fas fa-hand-fist',
                    'shoulders': 'fas fa-user',
                    'cardio': 'fas fa-running',
                    'abs': 'fas fa-dumbbell'
                };
                return icons[category] || 'fas fa-dumbbell';
            }
            
            function getWorkoutIcon(category) {
                const icons = {
                    'chest': 'fas fa-heart',
                    'back': 'fas fa-vest',
                    'legs': 'fas fa-walking',
                    'arms': 'fas fa-hand-fist',
                    'shoulders': 'fas fa-user',
                    'cardio': 'fas fa-running',
                    'abs': 'fas fa-dumbbell'
                };
                return icons[category] || 'fas fa-dumbbell';
            }
            
            function getDifficultyText(difficulty) {
                const levels = {
                    'beginner': 'مبتدئ',
                    'intermediate': 'متوسط',
                    'advanced': 'متقدم'
                };
                return levels[difficulty] || 'مبتدئ';
            }
        });
    </script>
</body>
</html>