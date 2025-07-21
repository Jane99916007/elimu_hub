<?php
// PHP variables for dynamic content
$pageTitle = "Elimu Hub - Settings";
$adminName = "Administrator";
$adminInitials = "AD";
$institutionName = "Strathmore University";
$platformName = "Elimu Hub";
$contactEmail = "admin@strathmore.edu";
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
            <a href="system.html" class="nav-item">System</a>
            <a href="reports.html" class="nav-item">Reports</a>
            <a href="#" class="nav-item active">Settings</a>
        </nav>
        <div class="user-info">
            <div class="user-avatar"><?php echo $adminInitials; ?></div>
            <span><?php echo $adminName; ?></span>
        </div>
    </div>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">System Settings</h1>
            <p class="page-description">Configure platform settings, manage system preferences, and customize the Elimu Hub experience.</p>
        </div>

        <div class="settings-grid">
            <div class="settings-sidebar">
                <h3 class="sidebar-title">Settings Categories</h3>
                <ul class="settings-menu">
                    <li><a href="#" class="active" onclick="showSection('general')">General Settings</a></li>
                    <li><a href="#" onclick="showSection('security')">Security & Privacy</a></li>
                    <li><a href="#" onclick="showSection('notifications')">Notifications</a></li>
                    <li><a href="#" onclick="showSection('integrations')">Integrations</a></li>
                    <li><a href="#" onclick="showSection('appearance')">Appearance</a></li>
                    <li><a href="#" onclick="showSection('advanced')">Advanced</a></li>
                </ul>
            </div>

            <div class="settings-content">
                <div id="general" class="content-section active">
                    <h2 class="section-title">General Settings</h2>
                    
                    <div class="info-card">
                        <div class="info-card-title">Platform Information</div>
                        <div class="info-card-text">Configure basic platform settings and institutional information.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Institution Name</label>
                        <input type="text" class="form-input" value="<?php echo $institutionName; ?>" placeholder="Enter institution name">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Platform Name</label>
                        <input type="text" class="form-input" value="<?php echo $platformName; ?>" placeholder="Enter platform name">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact Email</label>
                        <input type="email" class="form-input" value="<?php echo $contactEmail; ?>" placeholder="Enter contact email">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Default Language</label>
                        <select class="form-select">
                            <option selected>English</option>
                            <option>Swahili</option>
                            <option>French</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Time Zone</label>
                        <select class="form-select">
                            <option selected>Africa/Nairobi (EAT)</option>
                            <option>UTC</option>
                            <option>Europe/London</option>
                        </select>
                    </div>

                    <button class="save-btn">Save Changes</button>
                </div>

                <div id="security" class="content-section">
                    <h2 class="section-title">Security & Privacy</h2>
                    
                    <div class="warning-card">
                        <div class="warning-card-title">Security Notice</div>
                        <div class="warning-card-text">These settings affect platform security. Please review carefully before making changes.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password Policy</label>
                        <div class="form-checkbox">
                            <input type="checkbox" checked>
                            <label>Require minimum 8 characters</label>
                        </div>
                        <div class="form-checkbox">
                            <input type="checkbox" checked>
                            <label>Require uppercase letters</label>
                        </div>
                        <div class="form-checkbox">
                            <input type="checkbox" checked>
                            <label>Require special characters</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Session Timeout (minutes)</label>
                        <input type="number" class="form-input" value="60" placeholder="Session timeout in minutes">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Two-Factor Authentication</label>
                        <div class="form-checkbox">
                            <input type="checkbox">
                            <label>Enable 2FA for all administrators</label>
                        </div>
                        <div class="form-checkbox">
                            <input type="checkbox">
                            <label>Enable 2FA for counselors</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Data Retention Period (days)</label>
                        <input type="number" class="form-input" value="365" placeholder="Data retention period">
                    </div>

                    <button class="save-btn">Update Security Settings</button>
                </div>

                <div id="notifications" class="content-section">
                    <h2 class="section-title">Notification Settings</h2>
                    
                    <div class="form-group">
                        <label class="form-label">Email Notifications</label>
                        <div class="form-checkbox">
                            <input type="checkbox" checked>
                            <label>System alerts</label>
                        </div>
                        <div class="form-checkbox">
                            <input type="checkbox" checked>
                            <label>New user registrations</label>
                        </div>
                        <div class="form-checkbox">
                            <input type="checkbox">
                            <label>Weekly usage reports</label>
                        </div>
                        <div class="form-checkbox">
                            <input type="checkbox" checked>
                            <label>Security notifications</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">SMTP Server</label>
                        <input type="text" class="form-input" value="smtp.strathmore.edu" placeholder="SMTP server address">
                    </div>

                    <div class="form-group">
                        <label class="form-label">SMTP Port</label>
                        <input type="number" class="form-input" value="587" placeholder="SMTP port">
                    </div>

                    <button class="save-btn">Save Notification Settings</button>
                </div>

                <div id="integrations" class="content-section">
                    <h2 class="section-title">External Integrations</h2>
                    
                    <div class="stats-row">
                        <div class="stat-item">
                            <div class="stat-value">3</div>
                            <div class="stat-label">Active Integrations</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">7</div>
                            <div class="stat-label">Available APIs</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Student Information System</label>
                        <select class="form-select">
                            <option>None</option>
                            <option selected>Canvas LMS</option>
                            <option>Moodle</option>
                            <option>Blackboard</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Career Database API</label>
                        <input type="text" class="form-input" value="https://api.careerdatabase.ke/v1" placeholder="API endpoint">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Analytics Platform</label>
                        <div class="form-checkbox">
                            <input type="checkbox" checked>
                            <label>Enable Google Analytics</label>
                        </div>
                        <div class="form-checkbox">
                            <input type="checkbox">
                            <label>Enable Microsoft Clarity</label>
                        </div>
                    </div>

                    <button class="save-btn">Update Integrations</button>
                </div>

                <div id="appearance" class="content-section">
                    <h2 class="section-title">Appearance Settings</h2>
                    
                    <div class="form-group">
                        <label class="form-label">Theme</label>
                        <select class="form-select">
                            <option selected>Light Theme</option>
                            <option>Dark Theme</option>
                            <option>Auto (System)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Primary Color</label>
                        <input type="color" class="form-input" value="#667eea" style="height: 50px;">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Logo Upload</label>
                        <input type="file" class="form-input" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Custom CSS</label>
                        <textarea class="form-textarea" placeholder="Add custom CSS here..."></textarea>
                    </div>

                    <button class="save-btn">Apply Changes</button>
                </div>

                <div id="advanced" class="content-section">
                    <h2 class="section-title">Advanced Settings</h2>
                    
                    <div class="warning-card">
                        <div class="warning-card-title">Caution Required</div>
                        <div class="warning-card-text">Advanced settings can affect system stability. Only modify if you understand the implications.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Database Optimization</label>
                        <div class="form-checkbox">
                            <input type="checkbox" checked>
                            <label>Enable automatic optimization</label>
                        </div>
                        <div class="form-checkbox">
                            <input type="checkbox">
                            <label>Enable query caching</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">API Rate Limiting (requests/hour)</label>
                        <input type="number" class="form-input" value="1000" placeholder="API rate limit">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Debug Mode</label>
                        <div class="form-checkbox">
                            <input type="checkbox">
                            <label>Enable debug logging</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Maintenance Mode</label>
                        <button class="danger-btn">Enable Maintenance Mode</button>
                    </div>

                    <button class="save-btn">Save Advanced Settings</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            // Hide all content sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => section.classList.remove('active'));
            
            // Remove active class from all menu items
            const menuItems = document.querySelectorAll('.settings-menu a');
            menuItems.forEach(item => item.classList.remove('active'));
            
            // Show selected section
            document.getElementById(sectionId).classList.add('active');
            
            // Add active class to clicked menu item
            event.target.classList.add('active');
        }
    </script>
</body>
</html>