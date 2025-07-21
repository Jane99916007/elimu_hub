<?php
// File: src/Views/student/progress.php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimu Hub - My Progress</title>
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

        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-header {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .page-header h1 {
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
            font-size: 2rem;
        }

        .page-header p {
            color: #666;
            font-size: 1.1rem;
        }

        .progress-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .overview-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .overview-card:hover {
            transform: translateY(-5px);
        }

        .overview-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient);
        }

        .overview-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }

        .overview-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .overview-value {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .overview-description {
            color: #666;
            font-size: 0.9rem;
        }

        .progress-sections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .progress-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .progress-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
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

        .progress-item {
            margin-bottom: 1.5rem;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .progress-bar {
            background: #e9ecef;
            border-radius: 10px;
            height: 12px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            background: var(--gradient);
            height: 100%;
            border-radius: 10px;
            transition: width 1s ease;
            position: relative;
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.3) 50%, transparent 70%);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .milestone-list {
            list-style: none;
            padding: 0;
        }

        .milestone-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: background-color 0.3s ease;
        }

        .milestone-item:hover {
            background: #f8f9fa;
        }

        .milestone-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .milestone-completed {
            background: #d4edda;
            color: #155724;
        }

        .milestone-current {
            background: #fff3cd;
            color: #856404;
        }

        .milestone-pending {
            background: #f1f3f4;
            color: #666;
        }

        .milestone-content h4 {
            margin-bottom: 0.25rem;
            color: #333;
        }

        .milestone-content p {
            color: #666;
            font-size: 0.9rem;
            margin: 0;
        }

        .milestone-date {
            margin-left: auto;
            font-size: 0.8rem;
            color: #999;
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
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-success {
            background: #28a745;
        }

        @media (max-width: 768px) {
            .progress-overview {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .progress-sections {
                grid-template-columns: 1fr;
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
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                    <a class="nav-link" href="simulations.php">Simulations</a>
                    <a class="nav-link active" href="progress.php">Progress</a>
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

    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>My Academic Progress</h1>
            <p>Track your learning journey, milestones, and achievements. Monitor your development toward your academic and career goals.</p>
        </div>

        <!-- Progress Overview -->
        <div class="progress-overview">
            <div class="overview-card">
                <span class="overview-icon">🎯</span>
                <div class="overview-title">Overall Progress</div>
                <div class="overview-value">73%</div>
                <div class="overview-description">Year 2 of 4 • On Track</div>
            </div>
            <div class="overview-card">
                <span class="overview-icon">📚</span>
                <div class="overview-title">Courses Completed</div>
                <div class="overview-value">12</div>
                <div class="overview-description">of 16 total courses</div>
            </div>
            <div class="overview-card">
                <span class="overview-icon">⭐</span>
                <div class="overview-title">Current GPA</div>
                <div class="overview-value">3.7</div>
                <div class="overview-description">Above average performance</div>
            </div>
            <div class="overview-card">
                <span class="overview-icon">🏆</span>
                <div class="overview-title">Achievements</div>
                <div class="overview-value">8</div>
                <div class="overview-description">Badges earned</div>
            </div>
        </div>

        <!-- Academic Progress -->
        <div class="progress-sections">
            <div class="progress-card">
                <div class="card-header">
                    <div class="card-icon"><i class="bi bi-book"></i></div>
                    <div class="card-title">Current Semester Progress</div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>Database Management Systems</span>
                        <span>92%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 92%"></div>
                    </div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>Web Development</span>
                        <span>88%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 88%"></div>
                    </div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>Business Analysis</span>
                        <span>75%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>Project Management</span>
                        <span>82%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 82%"></div>
                    </div>
                </div>
            </div>

            <div class="progress-card">
                <div class="card-header">
                    <div class="card-icon"><i class="bi bi-mortarboard"></i></div>
                    <div class="card-title">Degree Milestones</div>
                </div>
                
                <ul class="milestone-list">
                    <li class="milestone-item">
                        <div class="milestone-icon milestone-completed">✓</div>
                        <div class="milestone-content">
                            <h4>Foundation Courses</h4>
                            <p>Completed all prerequisite courses</p>
                        </div>
                        <div class="milestone-date">Completed</div>
                    </li>
                    <li class="milestone-item">
                        <div class="milestone-icon milestone-completed">✓</div>
                        <div class="milestone-content">
                            <h4>Core Programming</h4>
                            <p>Java, Python, and database fundamentals</p>
                        </div>
                        <div class="milestone-date">Completed</div>
                    </li>
                    <li class="milestone-item">
                        <div class="milestone-icon milestone-current">📍</div>
                        <div class="milestone-content">
                            <h4>Advanced Development</h4>
                            <p>Web technologies and system design</p>
                        </div>
                        <div class="milestone-date">In Progress</div>
                    </li>
                    <li class="milestone-item">
                        <div class="milestone-icon milestone-pending">⏳</div>
                        <div class="milestone-content">
                            <h4>Specialization</h4>
                            <p>Choose major specialization track</p>
                        </div>
                        <div class="milestone-date">Next Semester</div>
                    </li>
                    <li class="milestone-item">
                        <div class="milestone-icon milestone-pending">⏳</div>
                        <div class="milestone-content">
                            <h4>Final Project</h4>
                            <p>Capstone project and graduation</p>
                        </div>
                        <div class="milestone-date">Year 4</div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Skills Development -->
        <div class="progress-sections">
            <div class="progress-card">
                <div class="card-header">
                    <div class="card-icon"><i class="bi bi-cpu"></i></div>
                    <div class="card-title">Technical Skills</div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>Programming (Java, Python)</span>
                        <span>Advanced - 85%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 85%"></div>
                    </div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>Database Design & Management</span>
                        <span>Intermediate - 78%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 78%"></div>
                    </div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>Web Development (HTML, CSS, JS)</span>
                        <span>Intermediate - 72%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 72%"></div>
                    </div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>System Analysis & Design</span>
                        <span>Beginner - 65%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 65%"></div>
                    </div>
                </div>
            </div>

            <div class="progress-card">
                <div class="card-header">
                    <div class="card-icon"><i class="bi bi-people"></i></div>
                    <div class="card-title">Soft Skills</div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>Problem Solving</span>
                        <span>Strong - 88%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 88%"></div>
                    </div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>Team Collaboration</span>
                        <span>Strong - 82%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 82%"></div>
                    </div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>Communication</span>
                        <span>Good - 75%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>
                </div>
                
                <div class="progress-item">
                    <div class="progress-label">
                        <span>Leadership</span>
                        <span>Developing - 58%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 58%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="progress-sections">
            <div class="progress-card">
                <div class="card-header">
                    <div class="card-icon"><i class="bi bi-bar-chart"></i></div>
                    <div class="card-title">Progress Reports</div>
                </div>
                <p style="margin-bottom: 1.5rem; color: #666;">
                    Generate detailed reports of your academic progress and achievements.
                </p>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="#" class="btn">Download Progress Report</a>
                    <a href="#" class="btn btn-secondary">Share with Counsellor</a>
                </div>
            </div>

            <div class="progress-card">
                <div class="card-header">
                    <div class="card-icon"><i class="bi bi-bullseye"></i></div>
                    <div class="card-title">Set New Goals</div>
                </div>
                <p style="margin-bottom: 1.5rem; color: #666;">
                    Define your academic and career objectives for the upcoming semester.
                </p>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="#" class="btn">Academic Goals</a>
                    <a href="simulations.php" class="btn btn-success">Run New Simulation</a>
                </div>
            </div>
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