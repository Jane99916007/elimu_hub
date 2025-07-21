<?php
// Start session and check authentication
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Check if user is a counsellor
if ($_SESSION['user']['role'] !== 'counsellor') {
    header('Location: unauthorized.php');
    exit;
}

// Database connection (example - replace with your actual connection)
require_once 'db_config.php';

// Get counsellor data from database
$counsellor_id = $_SESSION['user']['id'];
$counsellor_name = "Mr. Joseph Mungai"; // Replace with database query
$students_assigned = 28; // Replace with database query
$pending_reviews = 12; // Replace with database query
$simulations_reviewed = 167; // Replace with database query
$student_satisfaction = 94; // Replace with database query

// Get students data from database
$students = [
    [
        'name' => 'Jane Karani',
        'program' => 'Business Information Technology',
        'year' => 'Year 2',
        'status' => 'Needs Review',
        'status_class' => 'status-review'
    ],
    [
        'name' => 'John Mwangi',
        'program' => 'Computer Science',
        'year' => 'Year 3',
        'status' => 'On Track',
        'status_class' => 'status-active'
    ],
    [
        'name' => 'Mary Njeri',
        'program' => 'Software Engineering',
        'year' => 'Year 1',
        'status' => 'Pending Response',
        'status_class' => 'status-pending'
    ],
    [
        'name' => 'Peter Otieno',
        'program' => 'Data Science',
        'year' => 'Year 2',
        'status' => 'Excellent Progress',
        'status_class' => 'status-active'
    ]
];

// Get recent messages from database
$messages = [
    [
        'author' => 'Jane Karani',
        'time' => '1 hour ago',
        'content' => '"Thank you for the recommendation! I\'ve started the JavaScript course you suggested."'
    ],
    [
        'author' => 'System Notification',
        'time' => '3 hours ago',
        'content' => '"New simulation results available for Mary Njeri - Software Engineering path."'
    ],
    [
        'author' => 'John Mwangi',
        'time' => '1 day ago',
        'content' => '"Could we schedule a meeting to discuss my final year project options?"'
    ]
];

// Get previous recommendations from database
$recommendations = [
    [
        'author' => 'Previous Recommendation',
        'time' => '3 days ago',
        'content' => '"Focus on developing full-stack skills. Consider taking advanced JavaScript and React courses."'
    ],
    [
        'author' => 'Follow-up',
        'time' => '1 week ago',
        'content' => '"Great progress on database fundamentals. Ready for more advanced concepts."'
    ]
];

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_recommendation'])) {
        // Process recommendation form
        $type = $_POST['recommendation_type'];
        $priority = $_POST['priority'];
        $details = $_POST['details'];
        
        // In a real application, you would save this to the database
        $success = true; // Simulate successful submission
        
        if ($success) {
            $success_message = "Recommendation submitted successfully!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimu Hub - Counsellor Dashboard</title>
    <style>
        /* All your CSS styles remain exactly the same */
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

        /* ... rest of your CSS styles ... */
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">Elimu Hub</div>
            <div class="nav-links">
                <a href="#" class="active">Dashboard</a>
                <a href="students.php">Students</a>
                <a href="analytics.php">Analytics</a>
                <a href="reports.php">Reports</a>
            </div>
            <div class="user-info">
                <div class="avatar"><?php echo substr($counsellor_name, 0, 1); ?></div>
                <span><?php echo htmlspecialchars($counsellor_name); ?></span>
            </div>
        </div>
    </nav>

    <div class="dashboard-container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Counsellor Dashboard</h1>
            <p>Guide students through their academic journey with data-driven insights and personalized recommendations.</p>
        </div>

        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number"><?php echo $students_assigned; ?></span>
                <div class="stat-label">Students Assigned</div>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo $pending_reviews; ?></span>
                <div class="stat-label">Pending Reviews</div>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo $simulations_reviewed; ?></span>
                <div class="stat-label">Simulations Reviewed</div>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo $student_satisfaction; ?>%</span>
                <div class="stat-label">Student Satisfaction</div>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="dashboard-grid">
            <!-- Student Simulation Analysis -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">📊</div>
                    <div class="card-title">Student Simulation Analysis</div>
                </div>
                
                <div class="tabs">
                    <button class="tab-btn active" onclick="switchTab('analysis')">Analysis</button>
                    <button class="tab-btn" onclick="switchTab('recommendations')">Recommendations</button>
                </div>

                <div id="analysis-tab" class="tab-content active">
                    <div class="form-group">
                        <label>Select Student</label>
                        <select class="form-control" id="student-select" onchange="loadStudentData()">
                            <option value="jane">Jane Karani - Business IT (Year 2)</option>
                            <option value="john">John Mwangi - Computer Science (Year 3)</option>
                            <option value="mary">Mary Njeri - Software Engineering (Year 1)</option>
                            <option value="peter">Peter Otieno - Data Science (Year 2)</option>
                        </select>
                    </div>
                    
                    <div id="student-analysis" class="simulation-analysis">
                        <h4>Latest Simulation Results 
                            <span class="priority-badge priority-high">High Priority</span>
                        </h4>
                        <p><strong>Career Interest:</strong> Full-Stack Web Development</p>
                        <p><strong>Academic Performance:</strong> 87% Average (Excellent)</p>
                        <p><strong>Simulation Score:</strong> 94% Career Match</p>
                        <p><strong>Skills Gap:</strong> Advanced JavaScript, Cloud Technologies</p>
                        <p><strong>Strengths:</strong> Problem-solving, Database Design, Team Collaboration</p>
                        <p><strong>Last Activity:</strong> 2 days ago</p>
                    </div>
                    
                    <button class="btn" onclick="showRecommendationForm()">Create Recommendation</button>
                    <button class="btn btn-secondary">View Full History</button>
                </div>

                <div id="recommendations-tab" class="tab-content">
                    <?php foreach ($recommendations as $recommendation): ?>
                    <div class="message-thread">
                        <div class="message-header">
                            <span class="message-author"><?php echo htmlspecialchars($recommendation['author']); ?></span>
                            <span class="message-time"><?php echo htmlspecialchars($recommendation['time']); ?></span>
                        </div>
                        <p><?php echo htmlspecialchars($recommendation['content']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div id="recommendation-form" class="recommendation-form">
                    <h4>Create New Recommendation</h4>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Recommendation Type</label>
                            <select class="form-control" name="recommendation_type" required>
                                <option value="Course Selection">Course Selection</option>
                                <option value="Career Path Guidance">Career Path Guidance</option>
                                <option value="Skill Development">Skill Development</option>
                                <option value="Study Plan">Study Plan</option>
                                <option value="Industry Preparation">Industry Preparation</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Priority Level</label>
                            <select class="form-control" name="priority" required>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Recommendation Details</label>
                            <textarea class="form-control" name="details" rows="4" placeholder="Enter your detailed recommendation..." required></textarea>
                        </div>
                        <button type="submit" name="submit_recommendation" class="btn">Submit Recommendation</button>
                        <button type="button" class="btn btn-secondary" onclick="hideRecommendationForm()">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- My Students Overview -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">👥</div>
                    <div class="card-title">My Students</div>
                </div>
                <div class="student-list">
                    <?php foreach ($students as $student): ?>
                    <div class="student-item">
                        <div class="student-info">
                            <h4><?php echo htmlspecialchars($student['name']); ?></h4>
                            <p><?php echo htmlspecialchars($student['program']); ?> • <?php echo htmlspecialchars($student['year']); ?></p>
                            <span class="student-status <?php echo htmlspecialchars($student['status_class']); ?>"><?php echo htmlspecialchars($student['status']); ?></span>
                        </div>
                        <div class="action-buttons">
                            <a href="review.php?student=<?php echo urlencode($student['name']); ?>" class="btn btn-sm">Review</a>
                            <a href="message.php?student=<?php echo urlencode($student['name']); ?>" class="btn btn-sm btn-secondary">Message</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <a href="students.php" class="btn">View All Students</a>
                <a href="schedule_group.php" class="btn btn-success">Schedule Group Session</a>
            </div>

            <!-- Quick Actions & Messages -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">💬</div>
                    <div class="card-title">Recent Messages & Updates</div>
                </div>
                <?php foreach ($messages as $message): ?>
                <div class="message-thread">
                    <div class="message-header">
                        <span class="message-author"><?php echo htmlspecialchars($message['author']); ?></span>
                        <span class="message-time"><?php echo htmlspecialchars($message['time']); ?></span>
                    </div>
                    <p><?php echo htmlspecialchars($message['content']); ?></p>
                </div>
                <?php endforeach; ?>
                <a href="messages.php" class="btn">View All Messages</a>
                <a href="bulk_update.php" class="btn btn-warning">Send Bulk Update</a>
            </div>
        </div>

        <!-- Analytics Section -->
        <div class="chart-container">
            <h3>Student Performance Analytics</h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number">82%</span>
                    <div class="stat-label">Average Career Match</div>
                </div>
                <div class="stat-card">
                    <span class="stat-number">71%</span>
                    <div class="stat-label">Students on Track</div>
                </div>
                <div class="stat-card">
                    <span class="stat-number">34</span>
                    <div class="stat-label">Recommendations This Month</div>
                </div>
                <div class="stat-card">
                    <span class="stat-number">4.6/5</span>
                    <div class="stat-label">Average Student Rating</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript functions remain exactly the same
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected tab and activate button
            document.getElementById(tabName + '-tab').classList.add('active');
            event.target.classList.add('active');
        }

        function loadStudentData() {
            const studentSelect = document.getElementById('student-select');
            const analysisDiv = document.getElementById('student-analysis');
            
            const studentData = {
                'jane': {
                    title: 'Latest Simulation Results',
                    priority: 'high',
                    career: 'Full-Stack Web Development',
                    performance: '87% Average (Excellent)',
                    score: '94% Career Match',
                    gaps: 'Advanced JavaScript, Cloud Technologies',
                    strengths: 'Problem-solving, Database Design, Team Collaboration',
                    activity: '2 days ago'
                },
                'john': {
                    title: 'Simulation Analysis',
                    priority: 'medium',
                    career: 'Software Architecture',
                    performance: '91% Average (Outstanding)',
                    score: '89% Career Match',
                    gaps: 'System Design, DevOps',
                    strengths: 'Programming, Leadership, Technical Documentation',
                    activity: '5 days ago'
                },
                'mary': {
                    title: 'Initial Assessment',
                    priority: 'low',
                    career: 'Mobile App Development',
                    performance: '78% Average (Good)',
                    score: '85% Career Match',
                    gaps: 'Mobile Frameworks, UI/UX Design',
                    strengths: 'Creativity, Quick Learning, Attention to Detail',
                    activity: '1 day ago'
                },
                'peter': {
                    title: 'Progress Review',
                    priority: 'medium',
                    career: 'Data Science & Analytics',
                    performance: '93% Average (Exceptional)',
                    score: '96% Career Match',
                    gaps: 'Advanced Machine Learning, Big Data Tools',
                    strengths: 'Mathematics, Statistical Analysis, Python Programming',
                    activity: '4 hours ago'
                }
            };
            
            const data = studentData[studentSelect.value];
            const priorityClass = `priority-${data.priority}`;
            
            analysisDiv.innerHTML = `
                <h4>${data.title} 
                    <span class="priority-badge ${priorityClass}">${data.priority.charAt(0).toUpperCase() + data.priority.slice(1)} Priority</span>
                </h4>
                <p><strong>Career Interest:</strong> ${data.career}</p>
                <p><strong>Academic Performance:</strong> ${data.performance}</p>
                <p><strong>Simulation Score:</strong> ${data.score}</p>
                <p><strong>Skills Gap:</strong> ${data.gaps}</p>
                <p><strong>Strengths:</strong> ${data.strengths}</p>
                <p><strong>Last Activity:</strong> ${data.activity}</p>
            `;
        }

        function showRecommendationForm() {
            document.getElementById('recommendation-form').classList.add('show');
        }

        function hideRecommendationForm() {
            document.getElementById('recommendation-form').classList.remove('show');
        }

        function submitRecommendation(event) {
            event.preventDefault();
            
            const submitBtn = event.target.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Submitting...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                alert('Recommendation submitted successfully!');
                hideRecommendationForm();
                submitBtn.textContent = 'Submit Recommendation';
                submitBtn.disabled = false;
                event.target.reset();
            }, 1500);
        }

        // Add smooth hover effects
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.type !== 'submit') {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                }
            });
        });

        // Auto-refresh student data every 30 seconds
        setInterval(() => {
            // Simulate real-time updates
            const notifications = document.querySelectorAll('.message-time');
            notifications.forEach(time => {
                // Update timestamps (simplified)
                console.log('Checking for updates...');
            });
        }, 30000);
    </script>
</body>
</html>