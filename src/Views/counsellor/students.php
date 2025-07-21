<?php
// You can add PHP variables and logic here
$pageTitle = "Elimu Hub - My Students";
$teacherName = "Mr. Joseph Mungai";
$teacherInitials = "JM";
$totalStudents = 28;
$needsAttention = 5;
$activeThisWeek = 12;
$avgProgress = "85%";
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
                <a href="#" class="active">Students</a>
                <a href="#">Analytics</a>
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
            <h1>My Students</h1>
            <p>Monitor and support your assigned students' academic progress, provide personalized guidance, and track their career development journey.</p>
        </div>

        <!-- Stats Overview -->
        <div class="stats-overview">
            <div class="stat-card">
                <span class="stat-number"><?php echo $totalStudents; ?></span>
                <div class="stat-label">Total Students</div>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo $needsAttention; ?></span>
                <div class="stat-label">Need Attention</div>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo $activeThisWeek; ?></span>
                <div class="stat-label">Active This Week</div>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo $avgProgress; ?></span>
                <div class="stat-label">Average Progress</div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="filters-section">
            <div class="filters-grid">
                <div class="form-group">
                    <label>Filter by Status</label>
                    <select class="form-control" onchange="filterStudents('status', this.value)">
                        <option value="all">All Students</option>
                        <option value="active">Active</option>
                        <option value="attention">Needs Attention</option>
                        <option value="critical">Critical</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Filter by Program</label>
                    <select class="form-control" onchange="filterStudents('program', this.value)">
                        <option value="all">All Programs</option>
                        <option value="bit">Business IT</option>
                        <option value="cs">Computer Science</option>
                        <option value="se">Software Engineering</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Search Students</label>
                    <input type="text" class="form-control" placeholder="Search by name..." onkeyup="searchStudents(this.value)">
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <button class="btn" onclick="exportStudentData()">📊 Export Data</button>
                </div>
            </div>
        </div>

        <!-- Students Container -->
        <div class="students-container" id="students-container">
            <!-- Student Card 1 -->
            <div class="student-card" data-status="attention" data-program="bit">
                <div class="priority-indicator priority-medium"></div>
                <div class="student-status status-attention">Needs Attention</div>
                <div class="student-header">
                    <div class="student-avatar">JK</div>
                    <div class="student-info">
                        <h3>Jane Karani</h3>
                        <p>Business Information Technology • Year 2</p>
                        <p>Student ID: 181362</p>
                    </div>
                </div>

                <div class="student-metrics">
                    <div class="metric-item">
                        <div class="metric-value">3.7</div>
                        <div class="metric-label">GPA</div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-value">85%</div>
                        <div class="metric-label">Progress</div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-value">5</div>
                        <div class="metric-label">Simulations</div>
                    </div>
                </div>

                <div class="student-progress">
                    <div class="progress-item">
                        <span>Academic Performance</span>
                        <span>65%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill warning" style="width: 65%"></div>
                    </div>
                    <div class="progress-item">
                        <span>Career Readiness</span>
                        <span>58%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill warning" style="width: 58%"></div>
                    </div>
                </div>

                <div class="recent-activity">
                    <h4 style="margin-bottom: 0.5rem; color: #333;">Recent Activity</h4>
                    <div class="activity-item">
                        Struggling with advanced algorithms
                        <div class="activity-time">2 days ago</div>
                    </div>
                    <div class="activity-item">
                        Requested academic support
                        <div class="activity-time">5 days ago</div>
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="btn btn-sm" onclick="viewStudentProfile('sarah-kimani')">View Profile</button>
                    <button class="btn btn-sm btn-success" onclick="scheduleSession('sarah-kimani')">Schedule Session</button>
                    <button class="btn btn-sm btn-warning" onclick="sendMessage('sarah-kimani')">Message</button>
                </div>
            </div>

            <!-- Student Card 6 -->
            <div class="student-card" data-status="active" data-program="se">
                <div class="student-status status-active">Active</div>
                <div class="student-header">
                    <div class="student-avatar">DW</div>
                    <div class="student-info">
                        <h3>David Wanjiku</h3>
                        <p>Software Engineering • Year 2</p>
                        <p>Student ID: 182591</p>
                    </div>
                </div>

                <div class="student-metrics">
                    <div class="metric-item">
                        <div class="metric-value">3.8</div>
                        <div class="metric-label">GPA</div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-value">89%</div>
                        <div class="metric-label">Progress</div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-value">7</div>
                        <div class="metric-label">Simulations</div>
                    </div>
                </div>

                <div class="student-progress">
                    <div class="progress-item">
                        <span>Academic Performance</span>
                        <span>89%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 89%"></div>
                    </div>
                    <div class="progress-item">
                        <span>Career Readiness</span>
                        <span>91%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 91%"></div>
                    </div>
                </div>

                <div class="recent-activity">
                    <h4 style="margin-bottom: 0.5rem; color: #333;">Recent Activity</h4>
                    <div class="activity-item">
                        Won hackathon competition
                        <div class="activity-time">1 day ago</div>
                    </div>
                    <div class="activity-item">
                        Published research paper draft
                        <div class="activity-time">1 week ago</div>
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="btn btn-sm" onclick="viewStudentProfile('david-wanjiku')">View Profile</button>
                    <button class="btn btn-sm btn-success" onclick="scheduleSession('david-wanjiku')">Schedule Session</button>
                    <button class="btn btn-sm btn-secondary" onclick="sendMessage('david-wanjiku')">Message</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Profile Modal -->
    <div id="studentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Student Profile</h2>
                <button class="close-btn" onclick="closeStudentModal()">&times;</button>
            </div>
            
            <div class="tabs">
                <button class="tab-btn active" onclick="switchTab('overview')">Overview</button>
                <button class="tab-btn" onclick="switchTab('academic')">Academic</button>
                <button class="tab-btn" onclick="switchTab('simulations')">Simulations</button>
                <button class="tab-btn" onclick="switchTab('notes')">Notes</button>
            </div>

            <!-- Overview Tab -->
            <div id="overview-tab" class="tab-content active">
                <div id="student-overview">
                    <h3 id="student-name">Loading...</h3>
                    <p id="student-details">Loading student information...</p>
                    
                    <div class="student-metrics" style="margin: 1.5rem 0;">
                        <div class="metric-item">
                            <div class="metric-value" id="modal-gpa">0.0</div>
                            <div class="metric-label">Current GPA</div>
                        </div>
                        <div class="metric-item">
                            <div class="metric-value" id="modal-progress">0%</div>
                            <div class="metric-label">Overall Progress</div>
                        </div>
                        <div class="metric-item">
                            <div class="metric-value" id="modal-simulations">0</div>
                            <div class="metric-label">Simulations Done</div>
                        </div>
                    </div>

                    <h4>Recent Activity</h4>
                    <div id="modal-activities" style="margin-top: 1rem;">
                        <!-- Activities will be loaded here -->
                    </div>
                </div>
            </div>

            <!-- Academic Tab -->
            <div id="academic-tab" class="tab-content">
                <h4>Current Semester Courses</h4>
                <div id="current-courses" style="margin: 1rem 0;">
                    <div class="progress-item">
                        <span>Database Management Systems</span>
                        <span>92%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 92%"></div>
                    </div>
                    <div class="progress-item">
                        <span>Web Development</span>
                        <span>88%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 88%"></div>
                    </div>
                    <div class="progress-item">
                        <span>Software Engineering Principles</span>
                        <span>75%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>
                </div>

                <h4>Grade History</h4>
                <div style="margin: 1rem 0;">
                    <p><strong>Year 1:</strong> 3.4 GPA</p>
                    <p><strong>Year 2 Sem 1:</strong> 3.6 GPA</p>
                    <p><strong>Year 2 Sem 2:</strong> 3.7 GPA (Current)</p>
                </div>
            </div>

            <!-- Simulations Tab -->
            <div id="simulations-tab" class="tab-content">
                <h4>Completed Simulations</h4>
                <div style="margin: 1rem 0;">
                    <div class="recent-activity">
                        <div class="activity-item">
                            <strong>Software Development Career Path</strong><br>
                            Match Score: 94% • Completed: March 15, 2025
                        </div>
                        <div class="activity-item">
                            <strong>Data Science Exploration</strong><br>
                            Match Score: 87% • Completed: March 8, 2025
                        </div>
                        <div class="activity-item">
                            <strong>Full-Stack Development Track</strong><br>
                            Match Score: 91% • Completed: February 28, 2025
                        </div>
                    </div>
                </div>

                <h4>Recommendations Generated</h4>
                <div style="margin: 1rem 0;">
                    <p><em>Focus on cloud technologies and AWS certification</em></p>
                    <p><em>Consider advanced JavaScript frameworks</em></p>
                    <p><em>Explore internship opportunities in fintech</em></p>
                </div>
            </div>

            <!-- Notes Tab -->
            <div id="notes-tab" class="tab-content">
                <h4>Counsellor Notes</h4>
                <textarea id="counsellor-notes" style="width: 100%; height: 200px; margin: 1rem 0; padding: 1rem; border: 2px solid #e0e0e0; border-radius: 8px;" placeholder="Add your notes about this student...">
Student shows strong technical aptitude but needs guidance on career direction. Recommended focusing on full-stack development path based on simulation results.

Next steps:
- Schedule follow-up meeting to discuss internship opportunities
- Connect with industry mentors in software development
- Monitor progress in advanced programming courses
                </textarea>
                <button class="btn" onclick="saveNotes()">Save Notes</button>
            </div>

            <div style="display: flex; gap: 1rem; justify-content: center; margin-top: 2rem;">
                <button class="btn btn-success" onclick="scheduleSessionFromModal()">Schedule Session</button>
                <button class="btn btn-warning" onclick="sendMessageFromModal()">Send Message</button>
                <button class="btn btn-secondary" onclick="generateReport()">Generate Report</button>
            </div>
        </div>
    </div>

    <script>
        // Student data for modal display
        const studentData = {
            'jane-karani': {
                name: 'Jane Karani',
                details: 'Business Information Technology • Year 2 • Student ID: 181362',
                gpa: '3.7',
                progress: '85%',
                simulations: '5',
                activities: [
                    'Completed Web Development simulation - 2 days ago',
                    'Missed counselling appointment - 1 week ago',
                    'Submitted career assessment form - 2 weeks ago'
                ]
            },
            'john-mwangi': {
                name: 'John Mwangi',
                details: 'Computer Science • Year 3 • Student ID: 182156',
                gpa: '3.9',
                progress: '92%',
                simulations: '8',
                activities: [
                    'Started AI/ML specialization track - 1 day ago',
                    'Attended career fair networking event - 3 days ago',
                    'Completed advanced algorithms course - 1 week ago'
                ]
            },
            'mary-njeri': {
                name: 'Mary Njeri',
                details: 'Software Engineering • Year 1 • Student ID: 183472',
                gpa: '2.8',
                progress: '45%',
                simulations: '1',
                activities: [
                    'Missed 3 consecutive classes - 1 week ago',
                    'Failed midterm examination - 2 weeks ago',
                    'Requested academic support - 3 weeks ago'
                ]
            }
        };

        function viewStudentProfile(studentId) {
            const modal = document.getElementById('studentModal');
            const student = studentData[studentId] || studentData['jane-karani'];
            
            document.getElementById('modalTitle').textContent = `${student.name} - Profile`;
            document.getElementById('student-name').textContent = student.name;
            document.getElementById('student-details').textContent = student.details;
            document.getElementById('modal-gpa').textContent = student.gpa;
            document.getElementById('modal-progress').textContent = student.progress;
            document.getElementById('modal-simulations').textContent = student.simulations;
            
            const activitiesContainer = document.getElementById('modal-activities');
            activitiesContainer.innerHTML = student.activities.map(activity => 
                `<div class="activity-item">${activity}</div>`
            ).join('');
            
            modal.classList.add('show');
        }

        function closeStudentModal() {
            document.getElementById('studentModal').classList.remove('show');
        }

        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected tab and activate button
            document.getElementById(tabName + '-tab').classList.add('active');
            event.target.classList.add('active');
        }

        function filterStudents(filterType, value) {
            const students = document.querySelectorAll('.student-card');
            
            students.forEach(student => {
                const shouldShow = value === 'all' || 
                    (filterType === 'status' && student.getAttribute('data-status') === value) ||
                    (filterType === 'program' && student.getAttribute('data-program') === value);
                
                if (shouldShow) {
                    student.style.display = 'block';
                    student.style.animation = 'fadeIn 0.3s ease-in-out';
                } else {
                    student.style.display = 'none';
                }
            });
        }

        function searchStudents(searchTerm) {
            const students = document.querySelectorAll('.student-card');
            const searchLower = searchTerm.toLowerCase();
            
            students.forEach(student => {
                const name = student.querySelector('.student-info h3').textContent.toLowerCase();
                const program = student.querySelector('.student-info p').textContent.toLowerCase();
                
                if (name.includes(searchLower) || program.includes(searchLower)) {
                    student.style.display = 'block';
                    student.style.animation = 'fadeIn 0.3s ease-in-out';
                } else {
                    student.style.display = 'none';
                }
            });
        }

        function scheduleSession(studentId) {
            showNotification(`Scheduling session with ${getStudentName(studentId)}`);
        }

        function scheduleSessionFromModal() {
            closeStudentModal();
            showNotification('Session scheduling form opened');
        }

        function sendMessage(studentId) {
            showNotification(`Opening message interface for ${getStudentName(studentId)}`);
        }

        function sendMessageFromModal() {
            closeStudentModal();
            showNotification('Message composer opened');
        }

        function urgentIntervention(studentId) {
            showNotification(`Urgent intervention scheduled for ${getStudentName(studentId)}`);
        }

        function exportStudentData() {
            showNotification('Exporting student data... Download will start shortly.');
        }

        function saveNotes() {
            showNotification('Counsellor notes saved successfully');
        }

        function generateReport() {
            showNotification('Generating comprehensive student report...');
        }

        function getStudentName(studentId) {
            const names = {
                'jane-karani': 'Jane Karani',
                'john-mwangi': 'John Mwangi',
                'mary-njeri': 'Mary Njeri',
                'peter-otieno': 'Peter Otieno',
                'sarah-kimani': 'Sarah Kimani',
                'david-wanjiku': 'David Wanjiku'
            };
            return names[studentId] || 'Student';
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

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('studentModal');
            if (event.target === modal) {
                closeStudentModal();
            }
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(event) {
            const modal = document.getElementById('studentModal');
            if (modal.classList.contains('show') && event.key === 'Escape') {
                closeStudentModal();
            }
        });

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

        // Simulate real-time updates
        function updateStudentMetrics() {
            const progressBars = document.querySelectorAll('.progress-fill');
            
            progressBars.forEach(bar => {
                const currentWidth = parseInt(bar.style.width);
                if (Math.random() < 0.05 && currentWidth < 95) { // 5% chance to increase
                    const newWidth = Math.min(currentWidth + 1, 100);
                    bar.style.width = newWidth + '%';
                }
            });

            // Occasionally update student status
            if (Math.random() < 0.02) { // 2% chance
                const students = document.querySelectorAll('.student-card');
                const randomStudent = students[Math.floor(Math.random() * students.length)];
                const activityContainer = randomStudent.querySelector('.recent-activity');
                
                if (activityContainer) {
                    const newActivity = document.createElement('div');
                    newActivity.className = 'activity-item';
                    newActivity.innerHTML = `
                        Logged into system
                        <div class="activity-time">Just now</div>
                    `;
                    activityContainer.appendChild(newActivity);
                    
                    // Remove old activities if too many
                    const activities = activityContainer.querySelectorAll('.activity-item');
                    if (activities.length > 3) {
                        activities[1].remove(); // Keep header, remove oldest activity
                    }
                }
            }
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Animate student cards on load
            document.querySelectorAll('.student-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Start real-time updates
            setInterval(updateStudentMetrics, 30000); // Update every 30 seconds
        });

        // Add smooth hover effects
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });
    </script>
</body>
</html>