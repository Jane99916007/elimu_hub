<?php
// PHP variables for dynamic content
$pageTitle = "Elimu Hub - System";
$adminName = "Administrator";
$adminInitials = "AD";
$currentDate = date("Y-m-d H:i:s");
$serverHealth = "99.8%";
$lastBackup = "2h ago";
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
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        /* Rest of your CSS remains exactly the same */
        /* ... (all your CSS styles from the original file) ... */
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Elimu Hub</div>
        <nav class="nav">
            <a href="dashboard.html" class="nav-item">Dashboard</a>
            <a href="users.html" class="nav-item">Users</a>
            <a href="#" class="nav-item active">System</a>
            <a href="reports.html" class="nav-item">Reports</a>
            <a href="settings.html" class="nav-item">Settings</a>
        </nav>
        <div class="user-info">
            <div class="user-avatar"><?php echo $adminInitials; ?></div>
            <span><?php echo $adminName; ?></span>
        </div>
    </div>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">System Management</h1>
            <p class="page-description">Monitor system health, manage services, and maintain platform infrastructure for optimal performance.</p>
        </div>

        <div class="system-stats">
            <div class="stat-card">
                <div class="stat-icon server">🖥️</div>
                <div class="stat-title">Server Health</div>
                <div class="stat-value"><?php echo $serverHealth; ?></div>
                <div class="stat-status status-healthy">Healthy</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon database">💾</div>
                <div class="stat-title">Database Status</div>
                <div class="stat-value">Active</div>
                <div class="stat-status status-healthy">Online</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon security">🔒</div>
                <div class="stat-title">Security Score</div>
                <div class="stat-value">A+</div>
                <div class="stat-status status-healthy">Secure</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon backup">💿</div>
                <div class="stat-title">Last Backup</div>
                <div class="stat-value"><?php echo $lastBackup; ?></div>
                <div class="stat-status status-healthy">Success</div>
            </div>
        </div>

        <div class="maintenance-card">
            <div class="maintenance-title">System Maintenance</div>
            <p>Scheduled maintenance window: Sunday 2:00 AM - 4:00 AM</p>
            <button class="maintenance-btn">Schedule Maintenance</button>
            <button class="maintenance-btn">Emergency Shutdown</button>
        </div>

        <div class="content-section">
            <h2 class="section-title">System Services</h2>
            
            <div class="system-tabs">
                <button class="tab-btn active" onclick="showTab('services')">Services</button>
                <button class="tab-btn" onclick="showTab('logs')">System Logs</button>
                <button class="tab-btn" onclick="showTab('monitoring')">Monitoring</button>
                <button class="tab-btn" onclick="showTab('backup')">Backup & Recovery</button>
            </div>

            <div id="services" class="tab-content active">
                <div class="system-grid">
                    <div class="system-module">
                        <div class="module-header">
                            <div class="module-title">Web Server</div>
                            <div class="module-status status-healthy">Running</div>
                        </div>
                        <div class="module-description">Apache HTTP Server handling web requests and serving the application.</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 85%"></div>
                        </div>
                        <div class="module-actions">
                            <button class="action-btn btn-restart">Restart</button>
                            <button class="action-btn btn-configure">Configure</button>
                        </div>
                    </div>

                    <div class="system-module">
                        <div class="module-header">
                            <div class="module-title">Database Server</div>
                            <div class="module-status status-healthy">Running</div>
                        </div>
                        <div class="module-description">MySQL database server managing all application data and user information.</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 92%"></div>
                        </div>
                        <div class="module-actions">
                            <button class="action-btn btn-restart">Restart</button>
                            <button class="action-btn btn-configure">Configure</button>
                        </div>
                    </div>

                    <div class="system-module">
                        <div class="module-header">
                            <div class="module-title">Email Service</div>
                            <div class="module-status status-warning">Warning</div>
                        </div>
                        <div class="module-description">SMTP service for sending notifications and system emails to users.</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 65%"></div>
                        </div>
                        <div class="module-actions">
                            <button class="action-btn btn-restart">Restart</button>
                            <button class="action-btn btn-configure">Configure</button>
                        </div>
                    </div>

                    <div class="system-module">
                        <div class="module-header">
                            <div class="module-title">File Storage</div>
                            <div class="module-status status-healthy">Running</div>
                        </div>
                        <div class="module-description">File system managing user uploads, reports, and application assets.</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 78%"></div>
                        </div>
                        <div class="module-actions">
                            <button class="action-btn btn-update">Optimize</button>
                            <button class="action-btn btn-configure">Configure</button>
                        </div>
                    </div>

                    <div class="system-module">
                        <div class="module-header">
                            <div class="module-title">Security Scanner</div>
                            <div class="module-status status-healthy">Active</div>
                        </div>
                        <div class="module-description">Continuous security monitoring and threat detection system.</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 96%"></div>
                        </div>
                        <div class="module-actions">
                            <button class="action-btn btn-update">Update</button>
                            <button class="action-btn btn-configure">Configure</button>
                        </div>
                    </div>

                    <div class="system-module">
                        <div class="module-header">
                            <div class="module-title">Cache System</div>
                            <div class="module-status status-healthy">Running</div>
                        </div>
                        <div class="module-description">Redis cache system improving application performance and response times.</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 88%"></div>
                        </div>
                        <div class="module-actions">
                            <button class="action-btn btn-restart">Restart</button>
                            <button class="action-btn btn-configure">Configure</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="logs" class="tab-content">
                <div class="logs-container">
                    <div class="log-entry log-info">[<?php echo $currentDate; ?>] INFO: System backup completed successfully</div>
                    <div class="log-entry log-info">[<?php echo date("Y-m-d H:i:s", strtotime("-5 minutes")); ?>] INFO: Database optimization completed</div>
                    <div class="log-entry log-warning">[<?php echo date("Y-m-d H:i:s", strtotime("-10 minutes")); ?>] WARN: Email service queue reaching capacity (85%)</div>
                    <div class="log-entry log-info">[<?php echo date("Y-m-d H:i:s", strtotime("-15 minutes")); ?>] INFO: User session cleanup completed</div>
                    <div class="log-entry log-info">[<?php echo date("Y-m-d H:i:s", strtotime("-20 minutes")); ?>] INFO: Security scan completed - no threats detected</div>
                    <div class="log-entry log-info">[<?php echo date("Y-m-d H:i:s", strtotime("-25 minutes")); ?>] INFO: Cache cleared and rebuilt</div>
                    <div class="log-entry log-warning">[<?php echo date("Y-m-d H:i:s", strtotime("-30 minutes")); ?>] WARN: High CPU usage detected on web server</div>
                    <div class="log-entry log-info">[<?php echo date("Y-m-d H:i:s", strtotime("-35 minutes")); ?>] INFO: Student simulation request processed</div>
                    <div class="log-entry log-info">[<?php echo date("Y-m-d H:i:s", strtotime("-40 minutes")); ?>] INFO: New user registration completed</div>
                    <div class="log-entry log-info">[<?php echo date("Y-m-d H:i:s", strtotime("-45 minutes")); ?>] INFO: System health check passed</div>
                </div>
                <div class="module-actions">
                    <button class="action-btn btn-update">Refresh Logs</button>
                    <button class="action-btn btn-configure">Export Logs</button>
                    <button class="action-btn btn-stop">Clear Logs</button>
                </div>
            </div>

            <div id="monitoring" class="tab-content">
                <div class="system-grid">
                    <div class="system-module">
                        <div class="module-title">CPU Usage</div>
                        <div class="stat-value">67%</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 67%"></div>
                        </div>
                    </div>
                    <div class="system-module">
                        <div class="module-title">Memory Usage</div>
                        <div class="stat-value">54%</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 54%"></div>
                        </div>
                    </div>
                    <div class="system-module">
                        <div class="module-title">Disk Usage</div>
                        <div class="stat-value">78%</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 78%"></div>
                        </div>
                    </div>
                    <div class="system-module">
                        <div class="module-title">Network I/O</div>
                        <div class="stat-value">23%</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 23%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="backup" class="tab-content">
                <div class="system-grid">
                    <div class="system-module">
                        <div class="module-title">Database Backup</div>
                        <div class="module-description">Last backup: <?php echo $lastBackup; ?> (Success)</div>
                        <div class="module-actions">
                            <button class="action-btn btn-update">Backup Now</button>
                            <button class="action-btn btn-configure">Schedule</button>
                        </div>
                    </div>
                    <div class="system-module">
                        <div class="module-title">File System Backup</div>
                        <div class="module-description">Last backup: 6 hours ago (Success)</div>
                        <div class="module-actions">
                            <button class="action-btn btn-update">Backup Now</button>
                            <button class="action-btn btn-configure">Schedule</button>
                        </div>
                    </div>
                    <div class="system-module">
                        <div class="module-title">Configuration Backup</div>
                        <div class="module-description">Last backup: 1 day ago (Success)</div>
                        <div class="module-actions">
                            <button class="action-btn btn-update">Backup Now</button>
                            <button class="action-btn btn-configure">Schedule</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Remove active class from all tab buttons
            const tabButtons = document.querySelectorAll('.tab-btn');
            tabButtons.forEach(btn => btn.classList.remove('active'));
            
            // Show selected tab content
            document.getElementById(tabName).classList.add('active');
            
            // Add active class to clicked button
            event.target.classList.add('active');
        }
    </script>
</body>
</html>