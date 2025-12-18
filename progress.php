<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GYM Pro - تقدمي</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* إضافات خاصة بصفحة التقدم */
        .progress-page {
            background-color: #121212;
            min-height: 100vh;
            padding-bottom: 70px;
        }
        
        /* الهيدر */
        .progress-header {
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
        
        /* فلترة التاريخ */
        .time-filter {
            background-color: #1e1e1e;
            padding: 1rem;
            border-radius: 15px;
            margin: 1rem;
            border: 1px solid #333;
        }
        
        .filter-tabs {
            display: flex;
            gap: 0.5rem;
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
        
        /* ملخص الإحصائيات */
        .stats-summary {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
        }
        
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.8rem;
        }
        
        .summary-item {
            text-align: center;
        }
        
        .summary-value {
            font-size: 1.3rem;
            font-weight: bold;
            color: #e9ecef;
            margin-bottom: 0.2rem;
        }
        
        .summary-label {
            color: #adb5bd;
            font-size: 0.8rem;
        }
        
        .summary-change {
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3px;
            margin-top: 0.3rem;
        }
        
        .change-up {
            color: #2a9d8f;
        }
        
        .change-down {
            color: #e76f51;
        }
        
        /* الرسوم البيانية */
        .charts-section {
            padding: 0 1rem;
        }
        
        .chart-container {
            background-color: #1e1e1e;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border: 1px solid #333;
        }
        
        .chart-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #333;
            font-size: 1.1rem;
        }
        
        .chart-wrapper {
            position: relative;
            height: 250px;
        }
        
        /* توزيع التمارين */
        .workouts-distribution {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
        }
        
        .distribution-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .distribution-item {
            background-color: #2d2d2d;
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .dist-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(42, 157, 143, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2a9d8f;
            font-size: 1.2rem;
        }
        
        .dist-content {
            flex: 1;
        }
        
        .dist-title {
            font-size: 0.9rem;
            color: #e9ecef;
            margin-bottom: 0.3rem;
        }
        
        .dist-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .dist-value {
            font-size: 1.1rem;
            font-weight: bold;
            color: #2a9d8f;
        }
        
        .dist-percentage {
            color: #adb5bd;
            font-size: 0.85rem;
        }
        
        /* الإنجازات */
        .achievements {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
        }
        
        .achievements-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .achievement-item {
            background-color: #2d2d2d;
            border-radius: 12px;
            padding: 1.2rem;
            text-align: center;
            transition: transform 0.3s;
        }
        
        .achievement-item:hover {
            transform: translateY(-5px);
        }
        
        .achievement-icon {
            font-size: 2rem;
            color: #2a9d8f;
            margin-bottom: 0.8rem;
        }
        
        .achievement-title {
            font-size: 0.9rem;
            color: #e9ecef;
            margin-bottom: 0.3rem;
        }
        
        .achievement-desc {
            color: #adb5bd;
            font-size: 0.8rem;
        }
        
        /* التقدم الأسبوعي */
        .weekly-progress {
            background-color: #1e1e1e;
            border-radius: 15px;
            margin: 1rem;
            padding: 1.5rem;
            border: 1px solid #333;
        }
        
        .week-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .day-item {
            text-align: center;
        }
        
        .day-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #2d2d2d;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-weight: bold;
            color: #adb5bd;
            border: 2px solid transparent;
        }
        
        .day-circle.active {
            background-color: rgba(42, 157, 143, 0.3);
            color: #2a9d8f;
            border-color: #2a9d8f;
        }
        
        .day-name {
            color: #adb5bd;
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
        
        /* ألوان الرسوم البيانية */
        .chart-colors {
            --chart-primary: #2a9d8f;
            --chart-secondary: #e76f51;
            --chart-tertiary: #e9c46a;
            --chart-quaternary: #f4a261;
        }
        
        /* تحسينات للشاشات الصغيرة */
        @media (max-width: 768px) {
            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .achievements-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body class="progress-page">
    <!-- الهيدر -->
    <header class="progress-header">
        <div class="header-top">
            <div class="page-title">
                <i class="fas fa-chart-line"></i>
                <span>تقدمي</span>
            </div>
            <button class="back-btn" onclick="window.history.back()">
                <i class="fas fa-arrow-right"></i>
                رجوع
            </button>
        </div>
        
        <!-- فلترة الوقت -->
        <div class="time-filter">
            <div class="filter-tabs" id="timeFilterTabs">
                <button class="filter-tab active" data-period="week">أسبوع</button>
                <button class="filter-tab" data-period="month">شهر</button>
                <button class="filter-tab" data-period="3months">3 شهور</button>
                <button class="filter-tab" data-period="6months">6 شهور</button>
                <button class="filter-tab" data-period="year">سنة</button>
                <button class="filter-tab" data-period="all">الكل</button>
            </div>
        </div>
    </header>

    <!-- رسائل -->
    <div class="alert" id="message"></div>

    <!-- محتوى صفحة التقدم -->
    <main>
        <!-- ملخص الإحصائيات -->
        <section class="stats-summary">
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-value" id="totalWorkouts">0</div>
                    <div class="summary-label">تمرين</div>
                    <div class="summary-change change-up" id="workoutsChange">
                        <i class="fas fa-arrow-up"></i>
                        <span>0%</span>
                    </div>
                </div>
                
                <div class="summary-item">
                    <div class="summary-value" id="totalCalories">0</div>
                    <div class="summary-label">سعرة</div>
                    <div class="summary-change change-up" id="caloriesChange">
                        <i class="fas fa-arrow-up"></i>
                        <span>0%</span>
                    </div>
                </div>
                
                <div class="summary-item">
                    <div class="summary-value" id="totalTime">0</div>
                    <div class="summary-label">ساعة</div>
                    <div class="summary-change change-up" id="timeChange">
                        <i class="fas fa-arrow-up"></i>
                        <span>0%</span>
                    </div>
                </div>
                
                <div class="summary-item">
                    <div class="summary-value" id="avgSession">0</div>
                    <div class="summary-label">دقيقة/حصة</div>
                    <div class="summary-change change-up" id="avgChange">
                        <i class="fas fa-arrow-up"></i>
                        <span>0%</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- الرسوم البيانية -->
        <section class="charts-section">
            <!-- رسم بياني للحصص الأسبوعية -->
            <div class="chart-container">
                <div class="chart-title">
                    <span><i class="fas fa-calendar-week"></i> الحصص الأسبوعية</span>
                    <span class="summary-label" id="weeklySessionsLabel">هذا الأسبوع</span>
                </div>
                <div class="chart-wrapper">
                    <canvas id="weeklySessionsChart"></canvas>
                </div>
            </div>
            
            <!-- رسم بياني للسعرات الحرارية -->
            <div class="chart-container">
                <div class="chart-title">
                    <span><i class="fas fa-fire"></i> السعرات الحرارية</span>
                    <span class="summary-label" id="caloriesChartLabel">آخر 30 يوم</span>
                </div>
                <div class="chart-wrapper">
                    <canvas id="caloriesChart"></canvas>
                </div>
            </div>
        </section>

        <!-- توزيع التمارين -->
        <section class="workouts-distribution">
            <div class="chart-title">
                <span><i class="fas fa-chart-pie"></i> توزيع التمارين</span>
                <span class="summary-label">حسب النوع</span>
            </div>
            
            <div class="distribution-grid" id="workoutsDistribution">
                <!-- سيتم تعبئته بالجافاسكريبت -->
                <div class="loading" id="distributionLoading">
                    <i class="fas fa-spinner"></i>
                </div>
            </div>
        </section>

        <!-- الإنجازات -->
        <section class="achievements">
            <div class="chart-title">
                <span><i class="fas fa-trophy"></i> إنجازاتي</span>
                <span class="summary-label" id="achievementsCount">0/10</span>
            </div>
            
            <div class="achievements-grid" id="achievementsGrid">
                <!-- سيتم تعبئته بالجافاسكريبت -->
            </div>
        </section>

        <!-- التقدم الأسبوعي -->
        <section class="weekly-progress">
            <div class="chart-title">
                <span><i class="fas fa-chart-bar"></i> تقدمي الأسبوعي</span>
                <span class="summary-label">حضور الأيام</span>
            </div>
            
            <div class="week-days" id="weekDays">
                <!-- سيتم تعبئته بالجافاسكريبت -->
            </div>
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
        <a href="progress.php" class="nav-item active">
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
        let currentPeriod = 'week';
        let charts = {};
        
        document.addEventListener('DOMContentLoaded', function() {
            // إذا مفيش مستخدم، نرجع للتسجيل
            if (!currentUser) {
                window.location.href = 'login.php';
                return;
            }
            
            // تحميل بيانات التقدم
            loadProgressData();
            
            // إعداد الفلاتر
            setupTimeFilters();
            
            // إعداد أحداث الرسوم البيانية
            setupCharts();
            
            // تحميل بيانات التقدم
            async function loadProgressData() {
                try {
                    const userId = currentUser.id;
                    const response = await fetch(`php/progress-data.php?userId=${userId}&period=${currentPeriod}`);
                    
                    if (response.ok) {
                        const data = await response.json();
                        
                        if (data.success) {
                            updateStatsSummary(data.summary);
                            updateCharts(data.charts);
                            updateWorkoutsDistribution(data.distribution);
                            updateAchievements(data.achievements);
                            updateWeeklyProgress(data.weeklyProgress);
                        } else {
                            showDefaultData();
                        }
                    } else {
                        showDefaultData();
                    }
                } catch (error) {
                    console.error('Error loading progress:', error);
                    showDefaultData();
                }
            }
            
            // تحديث ملخص الإحصائيات
            function updateStatsSummary(summary) {
                document.getElementById('totalWorkouts').textContent = summary.totalWorkouts || 0;
                document.getElementById('totalCalories').textContent = summary.totalCalories || 0;
                document.getElementById('totalTime').textContent = summary.totalTime || 0;
                document.getElementById('avgSession').textContent = summary.avgSession || 0;
                
                // تحديث النسب المئوية
                updateChangeIndicator('workoutsChange', summary.workoutsChange);
                updateChangeIndicator('caloriesChange', summary.caloriesChange);
                updateChangeIndicator('timeChange', summary.timeChange);
                updateChangeIndicator('avgChange', summary.avgChange);
            }
            
            // تحديث مؤشر التغيير
            function updateChangeIndicator(elementId, change) {
                const element = document.getElementById(elementId);
                if (!element || change === undefined) return;
                
                const isPositive = change >= 0;
                const icon = isPositive ? 'fa-arrow-up' : 'fa-arrow-down';
                const colorClass = isPositive ? 'change-up' : 'change-down';
                
                element.className = `summary-change ${colorClass}`;
                element.innerHTML = `<i class="fas ${icon}"></i><span>${Math.abs(change)}%</span>`;
            }
            
            // إعداد الفلاتر الزمنية
            function setupTimeFilters() {
                const filterTabs = document.querySelectorAll('.filter-tab');
                
                filterTabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        // إزالة النشاط من كل التبويبات
                        filterTabs.forEach(t => t.classList.remove('active'));
                        
                        // إضافة النشاط للتبويب الحالي
                        this.classList.add('active');
                        
                        // تحديث الفترة وتحميل البيانات الجديدة
                        currentPeriod = this.dataset.period;
                        loadProgressData();
                    });
                });
            }
            
            // إعداد الرسوم البيانية
            function setupCharts() {
                // إعدادات عامة للرسوم البيانية
                Chart.defaults.color = '#adb5bd';
                Chart.defaults.borderColor = '#333';
                
                // رسم بياني الحصص الأسبوعية
                const weeklyCtx = document.getElementById('weeklySessionsChart').getContext('2d');
                charts.weeklySessions = new Chart(weeklyCtx, {
                    type: 'bar',
                    data: {
                        labels: ['أ', 'إ', 'ث', 'أر', 'خ', 'ج', 'س'],
                        datasets: [{
                            label: 'عدد الحصص',
                            data: [0, 0, 0, 0, 0, 0, 0],
                            backgroundColor: '#2a9d8f',
                            borderColor: '#2a9d8f',
                            borderWidth: 1,
                            borderRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#1e1e1e',
                                titleColor: '#e9ecef',
                                bodyColor: '#adb5bd',
                                borderColor: '#333',
                                borderWidth: 1
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: '#333'
                                },
                                ticks: {
                                    stepSize: 1
                                }
                            },
                            x: {
                                grid: {
                                    color: '#333'
                                }
                            }
                        }
                    }
                });
                
                // رسم بياني السعرات الحرارية
                const caloriesCtx = document.getElementById('caloriesChart').getContext('2d');
                charts.calories = new Chart(caloriesCtx, {
                    type: 'line',
                    data: {
                        labels: ['أسبوع 1', 'أسبوع 2', 'أسبوع 3', 'أسبوع 4'],
                        datasets: [{
                            label: 'السعرات الحرارية',
                            data: [0, 0, 0, 0],
                            backgroundColor: 'rgba(42, 157, 143, 0.2)',
                            borderColor: '#2a9d8f',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#1e1e1e',
                                titleColor: '#e9ecef',
                                bodyColor: '#adb5bd',
                                borderColor: '#333',
                                borderWidth: 1
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: '#333'
                                }
                            },
                            x: {
                                grid: {
                                    color: '#333'
                                }
                            }
                        }
                    }
                });
            }
            
            // تحديث الرسوم البيانية
            function updateCharts(chartData) {
                if (!chartData) return;
                
                // تحديث رسم الحصص الأسبوعية
                if (chartData.weeklySessions && charts.weeklySessions) {
                    charts.weeklySessions.data.datasets[0].data = chartData.weeklySessions.data;
                    charts.weeklySessions.update();
                    document.getElementById('weeklySessionsLabel').textContent = chartData.weeklySessions.label || 'هذا الأسبوع';
                }
                
                // تحديث رسم السعرات الحرارية
                if (chartData.calories && charts.calories) {
                    charts.calories.data.labels = chartData.calories.labels;
                    charts.calories.data.datasets[0].data = chartData.calories.data;
                    charts.calories.update();
                    document.getElementById('caloriesChartLabel').textContent = chartData.calories.label || 'آخر 30 يوم';
                }
            }
            
            // تحديث توزيع التمارين
            function updateWorkoutsDistribution(distribution) {
                const container = document.getElementById('workoutsDistribution');
                const loading = document.getElementById('distributionLoading');
                
                if (loading) loading.style.display = 'none';
                
                if (!distribution || distribution.length === 0) {
                    container.innerHTML = `
                        <div class="empty-state">
                            <p>لا توجد بيانات للتوزيع</p>
                        </div>
                    `;
                    return;
                }
                
                let html = '';
                distribution.forEach(item => {
                    html += `
                        <div class="distribution-item">
                            <div class="dist-icon">
                                <i class="${getWorkoutTypeIcon(item.type)}"></i>
                            </div>
                            <div class="dist-content">
                                <div class="dist-title">${getWorkoutTypeName(item.type)}</div>
                                <div class="dist-stats">
                                    <div class="dist-value">${item.count}</div>
                                    <div class="dist-percentage">${item.percentage}%</div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                container.innerHTML = html;
            }
            
            // تحديث الإنجازات
            function updateAchievements(achievements) {
                const container = document.getElementById('achievementsGrid');
                const countElement = document.getElementById('achievementsCount');
                
                if (!achievements || achievements.length === 0) {
                    container.innerHTML = `
                        <div class="empty-state" style="grid-column: 1 / -1;">
                            <p>لا توجد إنجازات بعد</p>
                        </div>
                    `;
                    countElement.textContent = '0/10';
                    return;
                }
                
                const achieved = achievements.filter(a => a.achieved).length;
                countElement.textContent = `${achieved}/${achievements.length}`;
                
                let html = '';
                achievements.forEach(achievement => {
                    const iconClass = achievement.achieved ? 'fas fa-check-circle' : 'far fa-circle';
                    const iconColor = achievement.achieved ? '#2a9d8f' : '#6c757d';
                    
                    html += `
                        <div class="achievement-item ${achievement.achieved ? 'achieved' : ''}">
                            <div class="achievement-icon" style="color: ${iconColor}">
                                <i class="${iconClass}"></i>
                            </div>
                            <div class="achievement-title">${achievement.title}</div>
                            <div class="achievement-desc">${achievement.description}</div>
                        </div>
                    `;
                });
                
                container.innerHTML = html;
            }
            
            // تحديث التقدم الأسبوعي
            function updateWeeklyProgress(weeklyProgress) {
                const container = document.getElementById('weekDays');
                
                if (!weeklyProgress || weeklyProgress.length === 0) {
                    container.innerHTML = `
                        <div class="empty-state" style="grid-column: 1 / -1;">
                            <p>لا توجد بيانات للأسبوع</p>
                        </div>
                    `;
                    return;
                }
                
                const days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
                const shortDays = ['أ', 'إ', 'ث', 'أر', 'خ', 'ج', 'س'];
                
                let html = '';
                weeklyProgress.forEach((day, index) => {
                    const isActive = day.hasWorkout;
                    const sessions = day.sessions || 0;
                    
                    html += `
                        <div class="day-item">
                            <div class="day-circle ${isActive ? 'active' : ''}" title="${days[index]}: ${sessions} حصة">
                                ${shortDays[index]}
                            </div>
                            <div class="day-name">${days[index]}</div>
                        </div>
                    `;
                });
                
                container.innerHTML = html;
            }
            
            // عرض بيانات افتراضية
            function showDefaultData() {
                // ملخص افتراضي
                updateStatsSummary({
                    totalWorkouts: 24,
                    totalCalories: 4850,
                    totalTime: 18,
                    avgSession: 45,
                    workoutsChange: 12,
                    caloriesChange: 8,
                    timeChange: 15,
                    avgChange: 5
                });
                
                // رسوم بيانية افتراضية
                updateCharts({
                    weeklySessions: {
                        data: [2, 3, 1, 4, 2, 3, 2],
                        label: 'هذا الأسبوع'
                    },
                    calories: {
                        labels: ['أسبوع 1', 'أسبوع 2', 'أسبوع 3', 'أسبوع 4'],
                        data: [1200, 1500, 1350, 1700],
                        label: 'آخر 30 يوم'
                    }
                });
                
                // توزيع افتراضي
                updateWorkoutsDistribution([
                    { type: 'chest', count: 8, percentage: 33 },
                    { type: 'back', count: 6, percentage: 25 },
                    { type: 'legs', count: 5, percentage: 21 },
                    { type: 'arms', count: 3, percentage: 13 },
                    { type: 'cardio', count: 2, percentage: 8 }
                ]);
                
                // إنجازات افتراضية
                updateAchievements([
                    { title: 'أول حصة', description: 'أكمل أول حصة تدريب', achieved: true },
                    { title: 'أسبوع متواصل', description: 'تمرن لمدة أسبوع', achieved: true },
                    { title: '1000 سعرة', description: 'أحرق 1000 سعرة', achieved: true },
                    { title: '10 حصص', description: 'أكمل 10 حصص', achieved: true },
                    { title: 'متفاني', description: 'تمرن 30 يوماً', achieved: false },
                    { title: 'متفوق', description: 'أحرق 10000 سعرة', achieved: false }
                ]);
                
                // تقدم أسبوعي افتراضي
                updateWeeklyProgress([
                    { day: 0, hasWorkout: true, sessions: 2 },
                    { day: 1, hasWorkout: true, sessions: 3 },
                    { day: 2, hasWorkout: false, sessions: 0 },
                    { day: 3, hasWorkout: true, sessions: 1 },
                    { day: 4, hasWorkout: true, sessions: 4 },
                    { day: 5, hasWorkout: false, sessions: 0 },
                    { day: 6, hasWorkout: true, sessions: 2 }
                ]);
            }
            
            // دوال مساعدة
            function getWorkoutTypeIcon(type) {
                const icons = {
                    'chest': 'fas fa-heart',
                    'back': 'fas fa-vest',
                    'legs': 'fas fa-walking',
                    'arms': 'fas fa-hand-fist',
                    'shoulders': 'fas fa-user',
                    'cardio': 'fas fa-running',
                    'abs': 'fas fa-dumbbell'
                };
                return icons[type] || 'fas fa-dumbbell';
            }
            
            function getWorkoutTypeName(type) {
                const names = {
                    'chest': 'الصدر',
                    'back': 'الظهر',
                    'legs': 'الأرجل',
                    'arms': 'الأذرع',
                    'shoulders': 'الأكتاف',
                    'cardio': 'كارديو',
                    'abs': 'البطن'
                };
                return names[type] || type;
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