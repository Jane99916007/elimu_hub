<?php
// Start session and check authentication
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Check if user is an administrator
if ($_SESSION['user']['role'] !== 'admin') {
    header('Location: unauthorized.php');
    exit;
}

// Database connection (example - replace with your actual connection)
require_once 'db_config.php';

// Get admin data from database
$admin_id = $_SESSION['user']['id'];
$admin_name = "Administrator"; // Replace with database query

// Get system statistics from database
$total_students = 1347; // Replace with database query
$active_counsellors = 47; // Replace with database query
$simulations_run = 4129; // Replace with database query
$system_uptime = "99.7%"; // Replace with database query

// Get recent activities from database
$activities = [
    [
        'type' => 'user',
        'icon' => '👤',
        'title' => 'New Student Registration',
        'description' => 'Peter Mwangi registered for Data Science program',
        'time' => '5 min ago'
    ],
    [
        'type' => 'system',
        'icon' => '🔧',
        'title' => 'System Backup Completed',
        'description' => 'Automated daily backup finished successfully',
        'time' => '2 hours ago'
    ],
    [
        'type' => 'user',
        'icon' => '💬',
        'title' => 'Bulk Recommendations Sent',
        'description' => 'Mr. Mungai sent guidance to 15 students',
        'time' => '3 hours ago'
    ],
    [
        'type' => 'alert',
        'icon' => '⚠️',
        'title' => 'High Server Load Detected',
        'description' => 'CPU usage reached 75% during peak hours',
        'time' => '5 hours ago'
    ]
];

// Get system alerts from database
$alerts = [
    [
        'type' => 'warning',
        'title' => 'Scheduled Maintenance',
        'message' => 'System maintenance scheduled for this Sunday 2:00-4:00 AM.'
    ],
    [
        'type' => 'success',
        'title' => 'Security Update',
        'message' => 'All security patches have been successfully applied.'
    ],
    [
        'type' => 'danger',
        'title' => 'License Expiry',
        'message' => 'Premium features license expires in 15 days. Please renew.'
    ]
];

// Get users for user management
$users = [
    [
        'name' => 'Jane Karani',
        'role' => 'Student',
        'status' => 'Active'
    ],
    [
        'name' => 'Mr. Joseph Mungai',
        'role' => 'Counsellor',
        'status' => 'Active'
    ],
    [
        'name' => 'Dr. Sarah Wanjiku',
        'role' => 'Counsellor',
        'status' => 'Active'
    ]
];

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_user'])) {
        // Process user creation form
        $role = $_POST['role'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $institution = $_POST['institution'];
        
        // In a real application, you would save this to the database
        $success = true; // Simulate successful creation
        
        if ($success) {
            $success_message = "User created successfully!";
            // Update user count
            $total_students++;
        }
    }
    
    if (isset($_POST['generate_report'])) {
        // Process report generation form
        $report_type = $_POST['report_type'];
        $date_range = $_POST['date_range'];
        $output_format = $_POST['output_format'];
        
        // In a real application, you would generate the report
        $success = true; // Simulate successful report generation
        
        if ($success) {
            $report_message = "Report generated successfully!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimu Hub - Administrator Dashboard</title>
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
                <a href="users.php">Users</a>
                <a href="system.php">System</a>
                <a href="reports.php">Reports</a>
                <a href="settings.php">Settings</a>
            </div>
            <div class="user-info">
                <div class="avatar"><?php echo substr($admin_name, 0, 1); ?></div>
                <span><?php echo htmlspecialchars($admin_name); ?></span>
            </div>
        </div>
    </nav>

    <div class="dashboard-container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Administrator Dashboard</h1>
            <p>Manage the Elimu Hub system, monitor performance, and oversee user activities across the platform.</p>
        </div>

        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number"><?php echo number_format($total_students); ?></span>
                <div class="stat-label">Total Students</div>
                <div class="stat-trend trend-up">↗ +12% this month</div>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo $active_counsellors; ?></span>
                <div class="stat-label">Active Counsellors</div>
                <div class="stat-trend trend-up">↗ +3 new this week</div>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo number_format($simulations_run); ?></span>
                <div class="stat-label">Simulations Run</div>
                <div class="stat-trend trend-up">↗ +289 this week</div>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?php echo $system_uptime; ?></span>
                <div class="stat-label">System Uptime</div>
                <div class="stat-trend trend-up">↗ Excellent</div>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="dashboard-grid">
            <!-- User Management -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">👤</div>
                    <div class="card-title">User Management</div>
                </div>
                
                <div class="tabs">
                    <button class="tab-btn active" onclick="switchTab('add-user')">Add User</button>
                    <button class="tab-btn" onclick="switchTab('user-list')">User List</button>
                </div>

                <div id="add-user-tab" class="tab-content active">
                    <?php if (isset($success_message)): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>User Role</label>
                            <select class="form-control" name="role" required>
                                <option value="Student">Student</option>
                                <option value="Counsellor">Counsellor</option>
                                <option value="Administrator">Administrator</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter full name" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email address" required>
                        </div>
                        <div class="form-group">
                            <label>Institution/Department</label>
                            <input type="text" class="form-control" name="institution" placeholder="e.g., Strathmore University">
                        </div>
                        <button type="submit" name="create_user" class="btn">Create User</button>
                        <button type="button" class="btn btn-secondary">Import from CSV</button>
                    </form>
                </div>

                <div id="user-list-tab" class="tab-content">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search users..." onkeyup="filterUsers(this.value)">
                    </div>
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="user-table-body">
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td>
                                    <span class="user-role role-<?php echo strtolower($user['role']); ?>">
                                        <?php echo htmlspecialchars($user['role']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($user['status']); ?></td>
                                <td>
                                    <a href="edit_user.php?name=<?php echo urlencode($user['name']); ?>" class="btn btn-sm btn-secondary">Edit</a>
                                    <a href="disable_user.php?name=<?php echo urlencode($user['name']); ?>" class="btn btn-sm btn-danger">Disable</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- System Configuration -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">⚙️</div>
                    <div class="card-title">System Configuration</div>
                </div>
                
                <div class="form-group">
                    <label>Career Path Management</label>
                    <a href="manage_paths.php" class="btn btn-secondary">Manage Career Paths</a>
                    <a href="update_job_data.php" class="btn btn-secondary">Update Job Market Data</a>
                </div>
                
                <div class="form-group">
                    <label>Database Operations</label>
                    <div class="backup-status">
                        <strong>Last Backup:</strong> Today at 3:00 AM ✅
                    </div>
                    <a href="backup_db.php" class="btn btn-warning">Backup Database Now</a>
                    <a href="db_maintenance.php" class="btn btn-secondary">Database Maintenance</a>
                </div>
                
                <div class="form-group">
                    <label>System Maintenance</label>
                    <a href="health_check.php" class="btn btn-success">Run Health Check</a>
                    <a href="clear_cache.php" class="btn btn-secondary">Clear Cache</a>
                </div>
                
                <div class="form-group">
                    <label>Platform Updates</label>
                    <a href="check_updates.php" class="btn">Check for Updates</a>
                    <a href="update_history.php" class="btn btn-secondary">View Update History</a>
                </div>
            </div>

            <!-- Reports Generation -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">📈</div>
                    <div class="card-title">Generate Reports</div>
                </div>
                
                <?php if (isset($report_message)): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($report_message); ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Report Type</label>
                        <select class="form-control" name="report_type" required>
                            <option value="User Activity Report">User Activity Report</option>
                            <option value="Simulation Statistics">Simulation Statistics</option>
                            <option value="System Performance Report">System Performance Report</option>
                            <option value="Counsellor Effectiveness Report">Counsellor Effectiveness Report</option>
                            <option value="Student Progress Report">Student Progress Report</option>
                            <option value="Platform Usage Analytics">Platform Usage Analytics</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Date Range</label>
                        <select class="form-control" name="date_range" required>
                            <option value="Last 7 Days">Last 7 Days</option>
                            <option value="Last 30 Days">Last 30 Days</option>
                            <option value="Last 3 Months">Last 3 Months</option>
                            <option value="Last 6 Months">Last 6 Months</option>
                            <option value="Last Year">Last Year</option>
                            <option value="Custom Range">Custom Range</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Output Format</label>
                        <select class="form-control" name="output_format" required>
                            <option value="PDF Report">PDF Report</option>
                            <option value="Excel Spreadsheet">Excel Spreadsheet</option>
                            <option value="CSV Data">CSV Data</option>
                            <option value="PowerPoint Presentation">PowerPoint Presentation</option>
                        </select>
                    </div>
                    
                    <button type="submit" name="generate_report" class="btn">Generate Report</button>
                    <a href="schedule_reports.php" class="btn btn-success">Schedule Automatic Reports</a>
                </form>
            </div>
        </div>

        <!-- System Status & Analytics -->
        <div class="chart-container">
            <h3>System Status Overview</h3>
            
            <div class="system-status">
                <div class="status-item">
                    <div class="status-label">Database Status</div>
                    <div class="status-value">✅ Operational</div>
                </div>
                <div class="status-item">
                    <div class="status-label">API Services</div>
                    <div class="status-value">✅ All Services Running</div>
                </div>
                <div class="status-item warning">
                    <div class="status-label">Server Load</div>
                    <div class="status-value warning">⚠️ Moderate Load</div>
                    <div class="progress-bar">
                        <div class="progress-fill warning" style="width: 68%"></div>
                    </div>
                    <small>68% CPU Usage</small>
                </div>
                <div class="status-item">
                    <div class="status-label">Storage</div>
                    <div class="status-value">📦 Available</div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 45%"></div>
                    </div>
                    <small>45% Used (12.3GB of 27.5GB)</small>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">📊</div>
                    <div class="card-title">Recent System Activity</div>
                </div>
                <div class="activity-list">
                    <?php foreach ($activities as $activity): ?>
                    <div class="activity-item">
                        <div class="activity-icon activity-<?php echo $activity['type']; ?>"><?php echo $activity['icon']; ?></div>
                        <div class="activity-info">
                            <h4><?php echo htmlspecialchars($activity['title']); ?></h4>
                            <p><?php echo htmlspecialchars($activity['description']); ?></p>
                        </div>
                        <div class="activity-time"><?php echo htmlspecialchars($activity['time']); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <a href="activity_log.php" class="btn btn-secondary">View Full Activity Log</a>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">🚨</div>
                    <div class="card-title">System Alerts & Notifications</div>
                </div>
                
                <?php foreach ($alerts as $alert): ?>
                <div class="alert alert-<?php echo $alert['type']; ?>">
                    <strong><?php echo htmlspecialchars($alert['title']); ?>:</strong> <?php echo htmlspecialchars($alert['message']); ?>
                </div>
                <?php endforeach; ?>
                
                <a href="manage_notifications.php" class="btn">Manage Notifications</a>
                <a href="all_alerts.php" class="btn btn-warning">View All Alerts</a>
            </div>
        </div>

        <!-- Platform Analytics -->
        <div class="chart-container">
            <h3>Platform Analytics & Performance</h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number">2,847</span>
                    <div class="stat-label">Total Active Users</div>
                    <div class="stat-trend trend-up">↗ +5.2% this month</div>
                </div>
                <div class="stat-card">
                    <span class="stat-number">92%</span>
                    <div class="stat-label">User Satisfaction Rate</div>
                    <div class="stat-trend trend-up">↗ +2% improvement</div>
                </div>
                <div class="stat-card">
                    <span class="stat-number">156</span>
                    <div class="stat-label">Daily Simulations</div>
                    <div class="stat-trend trend-up">↗ Average per day</div>
                </div>
                <div class="stat-card">
                    <span class="stat-number">1.2s</span>
                    <div class="stat-label">Average Response Time</div>
                    <div class="stat-trend trend-up">↗ 15% faster</div>
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

        function filterUsers(searchTerm) {
            const tableBody = document.getElementById('user-table-body');
            const rows = tableBody.getElementsByTagName('tr');
            
            for (let row of rows) {
                const name = row.cells[0].textContent.toLowerCase();
                const role = row.cells[1].textContent.toLowerCase();
                
                if (name.includes(searchTerm.toLowerCase()) || role.includes(searchTerm.toLowerCase())) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }

        // Simulate real-time updates
        function updateSystemStats() {
            // Simulate CPU usage fluctuation
            const cpuBar = document.querySelector('.progress-fill.warning');
            const currentWidth = parseInt(cpuBar.style.width);
            const newWidth = Math.max(45, Math.min(85, currentWidth + (Math.random() - 0.5) * 10));
            cpuBar.style.width = newWidth + '%';
            cpuBar.parentElement.nextElementSibling.textContent = `${Math.round(newWidth)}% CPU Usage`;
            
            // Update response time occasionally
            if (Math.random() < 0.1) {
                const responseTimeElements = document.querySelectorAll('.stat-number');
                const responseTimeElement = Array.from(responseTimeElements).find(el => el.textContent.includes('s'));
                if (responseTimeElement) {
                    const newTime = (0.8 + Math.random() * 0.8).toFixed(1);
                    responseTimeElement.textContent = newTime + 's';
                }
            }
        }

        // Update stats every 5 seconds
        setInterval(updateSystemStats, 5000);

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