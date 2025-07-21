<?php
// File: src/Views/student/dashboard.php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit();
}

// Check if user is a student
if ($_SESSION['user']['role'] !== 'student') {
    header('Location: ../auth/login.php');
    exit();
}

// Get student data from session
$student_name = $_SESSION['user']['name'] ?? $_SESSION['user']['email'] ?? 'Student';
$student_email = $_SESSION['user']['email'] ?? '';

// Demo data (in real app, this would come from database)
$simulations_run = 5;
$career_paths = 3;
$counsellor_sessions = 2;
$profile_completion = 87;

// Get recent recommendations
$recommendations = [
    [
        'title' => 'Focus on Full-Stack Development',
        'source' => 'Mr. Joseph Mungai - Academic Supervisor',
        'date' => '2 days ago'
    ],
    [
        'title' => 'Consider Cloud Computing Specialization',
        'source' => 'Dr. Sarah Wanjiku - IT Career Counsellor',
        'date' => '1 week ago'
    ],
    [
        'title' => 'Join Tech Innovation Club',
        'source' => 'Prof. Michael Kimani - Academic Advisor',
        'date' => '2 weeks ago'
    ]
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['run_simulation'])) {
    $academic_interest = $_POST['academic_interest'];
    $career_goal = $_POST['career_goal'];
    $study_duration = $_POST['study_duration'];
    $location = $_POST['location'];
    
    // Demo simulation results
    $simulation_results = [
        'match' => '94% Excellent Match!',
        'salary' => 'KSh 95,000 - 120,000/month',
        'demand' => 'Very High 📈',
        'skills' => 'Programming, Database Design, Problem Solving',
        'courses' => 'Advanced Programming, Data Structures, Software Engineering'
    ];
    
    $simulations_run++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimu Hub - Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-blue: #007bff;
            --light-blue: #a3d8f4;
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: var(--gradient);
            min-height: 100vh;
            color: #333;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: var(--primary-blue) !important;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 5px;
            border-radius: 5px;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--primary-blue);
            color: white !important;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .welcome-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .welcome-section h1 {
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
            font-size: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-blue);
            display: block;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 0.75rem;
            transition: border-color 0.3s ease;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn {
            background: var(--gradient);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
        }

        .simulation-result {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-top: 1rem;
            border-left: 4px solid var(--primary-blue);
            display: none;
        }

        .simulation-result.show {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .progress-section {
            margin-bottom: 1.5rem;
        }

        .progress-bar {
            background: #e9ecef;
            border-radius: 10px;
            height: 8px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .progress-fill {
            background: var(--gradient);
            height: 100%;
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        .recommendations-list {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .recommendation-item {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #eee;
            transition: background-color 0.3s ease;
        }

        .recommendation-item:hover {
            background-color: #f8f9fa;
        }

        .recommendation-item:last-child {
            border-bottom: none;
        }

        .recommendation-item h4 {
            margin-bottom: 0.25rem;
            color: #333;
        }

        .recommendation-item p {
            color: #666;
            font-size: 0.9rem;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .action-btn {
            background: rgba(255, 255, 255, 0.95);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            text-decoration: none;
            color: #333;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            transform: translateY(-5px);
            color: var(--primary-blue);
            text-decoration: none;
        }

        .action-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .navbar-nav {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="../../../public/index.php">
                <i class="bi bi-mortarboard me-2"></i>Elimu Hub
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav me-auto">
                    <a class="nav-link active" href="dashboard.php">Dashboard</a>
                    <a class="nav-link" href="simulations.php">Simulations</a>
                    <a class="nav-link" href="progress.php">Progress</a>
                    <a class="nav-link" href="resources.php">Resources</a>
                </div>
                <div class="navbar-nav">
                    <div class="user-info">
                        <div class="avatar"><?php echo substr($student_name, 0, 1); ?></div>
                        <span><?php echo htmlspecialchars($student_name); ?></span>
                        <a class="nav-link" href="../auth/logout.php">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="dashboard-container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Welcome back, <?php echo explode(' ', $student_name)[0]; ?>!</h1>
            <p>Explore your academic pathways and make informed decisions about your future. Your journey to success starts here.</p>
        </div>

        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number"><?php echo $simulations_run; ?></span>
                <div class="stat-label">Simulations Run</div>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo $career_paths; ?></span>
                <div class="stat-label">Career Paths Explored</div>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo $counsellor_sessions; ?></span>
                <div class="stat-label">Counsellor Sessions</div>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo $profile_completion; ?>%</span>
                <div class="stat-label">Profile Completion</div>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="dashboard-grid">
            <!-- Run New Simulation -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon"><i class="bi bi-bullseye"></i></div>
                    <div class="card-title">Run New Simulation</div>
                </div>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Academic Interest</label>
                        <select class="form-control" name="academic_interest" required>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Business Information Technology">Business Information Technology</option>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Data Science">Data Science</option>
                            <option value="Information Systems">Information Systems</option>
                            <option value="Business Administration">Business Administration</option>
                            <option value="Finance">Finance</option>
                            <option value="Accounting">Accounting</option>
                            <option value="Investment Banking">Investment Banking</option>
                            <option value="Law(LLB)">Law(LLB)</option>
                            <option value="International Relations">International Relations</option>
                            <option value="Medicine">Medicine</option>    
                            <option value="Nursing">Nursing</option> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Career Goal</label>
                        <select class="form-control" name="career_goal" required>
                            <option value="Software Developer">Software Developer</option>
                            <option value="Data Scientist">Data Scientist</option>
                            <option value="IT Consultant">IT Consultant</option>
                            <option value="Project Manager">Project Manager</option>
                            <option value="System Analyst">System Analyst</option>
                            <option value="Business Analyst">Business Analyst</option>
                            <option value="Financial Analyst">Financial Analyst</option>
                            <option value="Accountant">Accountant</option>
                            <option value="Investment Banker">Investment Banker</option>
                            <option value="Lawyer">Lawyer</option>
                            <option value="Diplomat">Diplomat</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Nurse">Nurse</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Study Duration (Years)</label>
                        <select class="form-control" name="study_duration" required>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6+">6+</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Location Preference</label>
                        <select class="form-control" name="location" required>
                            <option value="Nairobi">Nairobi</option>
                            <option value="Mombasa">Mombasa</option>
                            <option value="Kisumu">Kisumu</option>
                            <option value="International">International</option>
                        </select>
                    </div>
                    <button type="submit" name="run_simulation" class="btn">Run Simulation</button>
                </form>
                
                <?php if (isset($simulation_results)): ?>
                <div id="simulation-results" class="simulation-result show">
                    <h4>🎉 Simulation Results</h4>
                    <p><strong>Career Match:</strong> <?php echo $simulation_results['match']; ?></p>
                    <p><strong>Expected Salary:</strong> <?php echo $simulation_results['salary']; ?></p>
                    <p><strong>Job Market Demand:</strong> <?php echo $simulation_results['demand']; ?></p>
                    <p><strong>Required Skills:</strong> <?php echo $simulation_results['skills']; ?></p>
                    <p><strong>Recommended Courses:</strong> <?php echo $simulation_results['courses']; ?></p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Learning Progress -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon"><i class="bi bi-book"></i></div>
                    <div class="card-title">My Learning Progress</div>
                </div>
                <div class="progress-section">
                    <label>Current Course: Business Information Technology</label>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 65%"></div>
                    </div>
                    <small>Year 2 - 65% Complete</small>
                </div>
                <div class="progress-section">
                    <label>Technical Skills Development</label>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 78%"></div>
                    </div>
                    <small>78% Complete</small>
                </div>
                <div class="progress-section">
                    <label>Career Readiness</label>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 55%"></div>
                    </div>
                    <small>55% Complete</small>
                </div>
                <div class="progress-section">
                    <label>Industry Connections</label>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 42%"></div>
                    </div>
                    <small>42% Complete</small>
                </div>
                <button class="btn">View Detailed Progress</button>
                <button class="btn btn-secondary">Download Progress Report</button>
            </div>

            <!-- Recent Recommendations -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon"><i class="bi bi-lightbulb"></i></div>
                    <div class="card-title">Recent Recommendations</div>
                </div>
                <div class="recommendations-list">
                    <?php foreach ($recommendations as $recommendation): ?>
                    <div class="recommendation-item">
                        <h4><?php echo htmlspecialchars($recommendation['title']); ?></h4>
                        <p><?php echo htmlspecialchars($recommendation['source']); ?></p>
                        <small style="color: var(--primary-blue);"><?php echo htmlspecialchars($recommendation['date']); ?></small>
                    </div>
                    <?php endforeach; ?>
                </div>
                <button class="btn">View All Recommendations</button>
                <button class="btn btn-secondary">Message Counsellor</button>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="#" class="action-btn">
                <span class="action-icon"><i class="bi bi-bar-chart"></i></span>
                <div>View Analytics</div>
            </a>
            <a href="#" class="action-btn">
                <span class="action-icon"><i class="bi bi-calendar"></i></span>
                <div>Schedule Meeting</div>
            </a>
            <a href="#" class="action-btn">
                <span class="action-icon"><i class="bi bi-journal-text"></i></span>
                <div>Learning Resources</div>
            </a>
            <a href="#" class="action-btn">
                <span class="action-icon"><i class="bi bi-mortarboard"></i></span>
                <div>Career Library</div>
            </a>
            <a href="#" class="action-btn">
                <span class="action-icon"><i class="bi bi-chat-dots"></i></span>
                <div>Peer Connect</div>
            </a>
            <a href="#" class="action-btn">
                <span class="action-icon"><i class="bi bi-gear"></i></span>
                <div>Settings</div>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animate progress bars on load
        window.addEventListener('load', () => {
            document.querySelectorAll('.progress-fill').forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });
        });
    </script>
</body>
</html>