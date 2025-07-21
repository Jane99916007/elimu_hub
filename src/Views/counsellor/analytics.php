<?php
// PHP variables for dynamic content
$pageTitle = "Elimu Hub - Analytics Dashboard";
$teacherName = "Mr. Joseph Mungai";
$teacherInitials = "JM";
$currentEngagement = "87%";
$currentGPA = "3.4";
$currentCareerMatch = "89%";
$currentAtRisk = "8";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        /* Rest of your CSS remains exactly the same */
        /* ... (all your CSS styles from the original file) ... */
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">Elimu Hub</div>
            <div class="nav-links">
                <a href="#">Dashboard</a>
                <a href="#">Students</a>
                <a href="#" class="active">Analytics</a>
                <a href="#">Reports</a>
            </div>
            <div class="user-info">
                <div class="avatar"><?php echo $teacherInitials; ?></div>
                <span><?php echo $teacherName; ?></span>
            </div>
        </div>
    </nav>

    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Analytics Dashboard</h1>
                <p>Comprehensive insights into student performance, counselling effectiveness, and institutional trends.</p>
            </div>
            <div class="time-filter">
                <button class="time-btn" onclick="setTimeFilter('7d', this)">7 Days</button>
                <button class="time-btn active" onclick="setTimeFilter('30d', this)">30 Days</button>
                <button class="time-btn" onclick="setTimeFilter('90d', this)">90 Days</button>
                <button class="time-btn" onclick="setTimeFilter('1y', this)">1 Year</button>
            </div>
        </div>

        <!-- Analytics Overview -->
        <div class="analytics-overview">
            <div class="overview-card">
                <span class="overview-icon">👥</span>
                <div class="overview-title">Student Engagement</div>
                <div class="overview-value"><?php echo $currentEngagement; ?></div>
                <div class="overview-change change-positive">
                    ↗ +5.2% from last month
                </div>
            </div>
            <div class="overview-card">
                <span class="overview-icon">📈</span>
                <div class="overview-title">Average GPA</div>
                <div class="overview-value"><?php echo $currentGPA; ?></div>
                <div class="overview-change change-positive">
                    ↗ +0.2 from last semester
                </div>
            </div>
            <div class="overview-card">
                <span class="overview-icon">🎯</span>
                <div class="overview-title">Career Match Score</div>
                <div class="overview-value"><?php echo $currentCareerMatch; ?></div>
                <div class="overview-change change-positive">
                    ↗ +3.1% improvement
                </div>
            </div>
            <div class="overview-card">
                <span class="overview-icon">⚠️</span>
                <div class="overview-title">At-Risk Students</div>
                <div class="overview-value"><?php echo $currentAtRisk; ?></div>
                <div class="overview-change change-negative">
                    ↘ -2 from last month
                </div>
            </div>
        </div>

        <!-- Main Analytics Grid -->
        <div class="analytics-grid">
            <!-- Student Performance Trends -->
            <div class="analytics-card">
                <div class="card-header">
                    <div class="card-title">Student Performance Trends</div>
                    <button class="btn btn-sm">View Details</button>
                </div>
                <div class="chart-container">
                    <div class="chart-placeholder">
                        📊<br>
                        <small style="font-size: 1rem;">Performance Chart</small>
                    </div>
                </div>
                <div class="performance-metrics">
                    <div class="metric-box">
                        <div class="metric-number">92%</div>
                        <div class="metric-label">Pass Rate</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-number">3.4</div>
                        <div class="metric-label">Avg. GPA</div>
                    </div>
                </div>
            </div>

            <!-- Simulation Analytics -->
            <div class="analytics-card">
                <div class="card-header">
                    <div class="card-title">Simulation Usage</div>
                    <button class="btn btn-sm">Export Data</button>
                </div>
                <div class="chart-container">
                    <div class="chart-placeholder">
                        🎯<br>
                        <small style="font-size: 1rem;">Simulation Chart</small>
                    </div>
                </div>
                <ul class="trend-list">
                    <li class="trend-item">
                        <span class="trend-label">Total Simulations</span>
                        <span class="trend-value trend-up">
                            156 ↗
                        </span>
                    </li>
                    <li class="trend-item">
                        <span class="trend-label">Avg. Completion Rate</span>
                        <span class="trend-value trend-up">
                            94% ↗
                        </span>
                    </li>
                    <li class="trend-item">
                        <span class="trend-label">Career Matches</span>
                        <span class="trend-value trend-up">
                            89% ↗
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Progress Tracking -->
            <div class="analytics-card">
                <div class="card-header">
                    <div class="card-title">Student Progress Overview</div>
                    <button class="btn btn-sm">View All</button>
                </div>
                <ul class="progress-list">
                    <li class="progress-item">
                        <div class="progress-info">
                            <h4>Year 1 Students</h4>
                            <p>8 students • Overall progress</p>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%"></div>
                            </div>
                        </div>
                        <span class="progress-percentage">75%</span>
                    </li>
                    <li class="progress-item">
                        <div class="progress-info">
                            <h4>Year 2 Students</h4>
                            <p>12 students • Overall progress</p>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 82%"></div>
                            </div>
                        </div>
                        <span class="progress-percentage">82%</span>
                    </li>
                    <li class="progress-item">
                        <div class="progress-info">
                            <h4>Year 3 Students</h4>
                            <p>8 students • Overall progress</p>
                            <div class="progress-bar">
                                <div class="progress-fill warning" style="width: 68%"></div>
                            </div>
                        </div>
                        <span class="progress-percentage">68%</span>
                    </li>
                </ul>
            </div>

            <!-- Counselling Effectiveness -->
            <div class="analytics-card">
                <div class="card-header">
                    <div class="card-title">Counselling Impact</div>
                    <button class="btn btn-sm">Generate Report</button>
                </div>
                <div class="chart-container">
                    <div class="chart-placeholder">
                        💡<br>
                        <small style="font-size: 1rem;">Impact Chart</small>
                    </div>
                </div>
                <ul class="trend-list">
                    <li class="trend-item">
                        <span class="trend-label">Sessions Completed</span>
                        <span class="trend-value trend-up">
                            45 ↗
                        </span>
                    </li>
                    <li class="trend-item">
                        <span class="trend-label">Student Satisfaction</span>
                        <span class="trend-value trend-up">
                            4.6/5 ↗
                        </span>
                    </li>
                    <li class="trend-item">
                        <span class="trend-label">Follow-up Rate</span>
                        <span class="trend-value">
                            89%
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Comparative Analysis -->
        <div class="comparative-analysis">
            <div class="comparison-card">
                <div class="comparison-header">
                    <div class="comparison-title">Your Performance</div>
                    <div class="comparison-value">4.6/5</div>
                    <p style="color: #666; margin-top: 0.5rem;">Student satisfaction rating</p>
                </div>
                <div class="performance-metrics">
                    <div class="metric-box">
                        <div class="metric-number">28</div>
                        <div class="metric-label">Students</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-number">156</div>
                        <div class="metric-label">Sessions</div>
                    </div>
                </div>
            </div>
            <div class="comparison-card">
                <div class="comparison-header">
                    <div class="comparison-title">Department Average</div>
                    <div class="comparison-value">4.2/5</div>
                    <p style="color: #666; margin-top: 0.5rem;">Overall department performance</p>
                </div>
                <div class="performance-metrics">
                    <div class="metric-box">
                        <div class="metric-number">25</div>
                        <div class="metric-label">Avg Students</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-number">134</div>
                        <div class="metric-label">Avg Sessions</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- AI-Powered Insights -->
        <div class="insight-panel">
            <h2 style="margin-bottom: 1.5rem; color: #333;">AI-Powered Insights</h2>
            <div class="insight-item">
                <div class="insight-icon insight-success">✓</div>
                <div class="insight-content">
                    <h4>Strong Performance Indicator</h4>
                    <p>Your students show 15% higher engagement rates compared to department average. Continue current mentoring approach.</p>
                </div>
            </div>
            <div class="insight-item">
                <div class="insight-icon insight-warning">⚠</div>
                <div class="insight-content">
                    <h4>Attention Needed</h4>
                    <p>5 students show declining academic performance. Consider scheduling intensive support sessions within the next week.</p>
                </div>
            </div>
            <div class="insight-item">
                <div class="insight-icon insight-info">ℹ</div>
                <div class="insight-content">
                    <h4>Trending Pattern</h4>
                    <p>Software development career simulations are 23% more popular this semester. Consider expanding related resources.</p>
                </div>
            </div>
        </div>

        <!-- Recommendations -->
        <div class="recommendations-card">
            <h2 style="margin-bottom: 1.5rem; color: #333;">Personalized Recommendations</h2>
            <div class="recommendations-grid">
                <div class="recommendation-item">
                    <div class="recommendation-title">Focus on At-Risk Students</div>
                    <div class="recommendation-desc">
                        3 students (Mary Njeri, Kevin Ochieng, Grace Mutua) require immediate intervention. 
                        Schedule one-on-one sessions within 48 hours.
                    </div>
                </div>
                <div class="recommendation-item warning">
                    <div class="recommendation-title">Career Path Diversification</div>
                    <div class="recommendation-desc">
                        85% of your students are pursuing similar career paths. Introduce them to emerging 
                        fields like Data Science and Cloud Computing.
                    </div>
                </div>
                <div class="recommendation-item critical">
                    <div class="recommendation-title">Industry Connection</div>
                    <div class="recommendation-desc">
                        Arrange guest speaker sessions with Kenyan tech industry professionals to improve 
                        career readiness and industry awareness.
                    </div>
                </div>
                <div class="recommendation-item">
                    <div class="recommendation-title">Skills Gap Analysis</div>
                    <div class="recommendation-desc">
                        Students lack exposure to modern frameworks. Recommend additional resources on 
                        React, Node.js, and cloud technologies.
                    </div>
                </div>
                <div class="recommendation-item warning">
                    <div class="recommendation-title">Group Session Opportunity</div>
                    <div class="recommendation-desc">
                        7 students share similar career interests. Consider organizing a group workshop 
                        on entrepreneurship in tech.
                    </div>
                </div>
                <div class="recommendation-item">
                    <div class="recommendation-title">Success Story Sharing</div>
                    <div class="recommendation-desc">
                        John Mwangi's recent hackathon win could inspire others. Share his journey in 
                        your next group session.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setTimeFilter(period, button) {
            // Remove active class from all buttons
            document.querySelectorAll('.time-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Add active class to clicked button
            button.classList.add('active');
            
            // Simulate data refresh
            refreshAnalyticsData(period);
            showNotification(`Analytics updated for ${period} period`);
        }

        function refreshAnalyticsData(period) {
            // Simulate different values based on time period
            const data = {
                '7d': {
                    engagement: '91%',
                    gpa: '3.5',
                    careerMatch: '92%',
                    atRisk: '3'
                },
                '30d': {
                    engagement: '87%',
                    gpa: '3.4',
                    careerMatch: '89%',
                    atRisk: '8'
                },
                '90d': {
                    engagement: '84%',
                    gpa: '3.3',
                    careerMatch: '86%',
                    atRisk: '12'
                },
                '1y': {
                    engagement: '82%',
                    gpa: '3.2',
                    careerMatch: '85%',
                    atRisk: '15'
                }
            };
            
            const periodData = data[period] || data['30d'];
            
            // Update overview cards with animation
            document.querySelectorAll('.overview-value').forEach((element, index) => {
                element.style.opacity = '0.5';
                setTimeout(() => {
                    switch(index) {
                        case 0:
                            element.textContent = periodData.engagement;
                            break;
                        case 1:
                            element.textContent = periodData.gpa;
                            break;
                        case 2:
                            element.textContent = periodData.careerMatch;
                            break;
                        case 3:
                            element.textContent = periodData.atRisk;
                            break;
                    }
                    element.style.opacity = '1';
                }, 300);
            });
        }

        function showNotification(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: linear-gradient(135deg, #667eea, #764ba2);
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                z-index: 3000;
                animation: slideIn 0.3s ease;
            `;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Add notification animations CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        // Simulate real-time data updates
        function updateAnalyticsData() {
            // Update progress bars
            const progressBars = document.querySelectorAll('.progress-fill');
            progressBars.forEach(bar => {
                const currentWidth = parseInt(bar.style.width);
                if (Math.random() < 0.1) { // 10% chance to change
                    const change = Math.random() < 0.7 ? 1 : -1; // 70% chance to increase
                    const newWidth = Math.max(30, Math.min(95, currentWidth + change));
                    bar.style.width = newWidth + '%';
                    
                    // Update percentage text
                    const percentageElement = bar.closest('.progress-item').querySelector('.progress-percentage');
                    if (percentageElement) {
                        percentageElement.textContent = newWidth + '%';
                    }
                }
            });

            // Update trend values occasionally
            if (Math.random() < 0.05) { // 5% chance
                const trendValues = document.querySelectorAll('.trend-value');
                const randomTrend = trendValues[Math.floor(Math.random() * trendValues.length)];
                
                // Add a subtle animation to indicate update
                randomTrend.style.transition = 'all 0.3s ease';
                randomTrend.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    randomTrend.style.transform = 'scale(1)';
                }, 300);
            }
        }

        // Initialize page with animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate overview cards
            document.querySelectorAll('.overview-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Animate analytics cards
            document.querySelectorAll('.analytics-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, (index * 150) + 500);
            });

            // Start real-time updates
            setInterval(updateAnalyticsData, 15000); // Update every 15 seconds
        });

        // Add hover effects to buttons
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });

        // Simulate chart interactions
        document.querySelectorAll('.chart-container').forEach(chart => {
            chart.addEventListener('click', function() {
                showNotification('Interactive chart feature coming soon!');
            });
        });
    </script>
</body>
</html>