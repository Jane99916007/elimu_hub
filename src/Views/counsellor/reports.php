<?php
// PHP variables for dynamic content
$pageTitle = "Elimu Hub - Counsellor Reports";
$teacherName = "Mr. Joseph Mungai";
$teacherInitials = "JM";
$totalStudents = 28;
$totalSessions = 156;
$satisfactionRating = "4.6/5";
$successRate = "89%";
$currentDate = date("F j, Y");
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
                <a href="#">Analytics</a>
                <a href="#" class="active">Reports</a>
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
            <h1>Reports Dashboard</h1>
            <p>Generate comprehensive reports, track progress, and create detailed analytics for student performance and counselling effectiveness at Strathmore University.</p>
        </div>

        <!-- Analytics Summary -->
        <div class="analytics-summary">
            <h2 style="margin-bottom: 1.5rem; color: #333;">Monthly Performance Summary</h2>
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-value"><?php echo $totalStudents; ?></div>
                    <div class="summary-label">Total Students</div>
                    <div class="summary-change">+3 from last month</div>
                </div>
                <div class="summary-card">
                    <div class="summary-value"><?php echo $totalSessions; ?></div>
                    <div class="summary-label">Sessions Conducted</div>
                    <div class="summary-change">+12% increase</div>
                </div>
                <div class="summary-card">
                    <div class="summary-value"><?php echo $satisfactionRating; ?></div>
                    <div class="summary-label">Satisfaction Rating</div>
                    <div class="summary-change">+0.3 improvement</div>
                </div>
                <div class="summary-card">
                    <div class="summary-value"><?php echo $successRate; ?></div>
                    <div class="summary-label">Success Rate</div>
                    <div class="summary-change">+5% improvement</div>
                </div>
            </div>
        </div>

        <!-- Quick Reports -->
        <div class="quick-reports">
            <div class="quick-report-card" onclick="generateQuickReport('student-progress')">
                <span class="report-icon">👥</span>
                <div class="report-title">Student Progress</div>
                <div class="report-desc">Individual student performance and milestones</div>
            </div>
            <div class="quick-report-card" onclick="generateQuickReport('simulation-analysis')">
                <span class="report-icon">🎯</span>
                <div class="report-title">Simulation Analysis</div>
                <div class="report-desc">Career simulation outcomes and trends</div>
            </div>
            <div class="quick-report-card" onclick="generateQuickReport('counselling-impact')">
                <span class="report-icon">💡</span>
                <div class="report-title">Counselling Impact</div>
                <div class="report-desc">Effectiveness of counselling sessions</div>
            </div>
            <div class="quick-report-card" onclick="generateQuickReport('academic-performance')">
                <span class="report-icon">📊</span>
                <div class="report-title">Academic Performance</div>
                <div class="report-desc">GPA trends and course completion rates</div>
            </div>
            <div class="quick-report-card" onclick="generateQuickReport('career-readiness')">
                <span class="report-icon">🚀</span>
                <div class="report-title">Career Readiness</div>
                <div class="report-desc">Skills assessment and job market preparation</div>
            </div>
            <div class="quick-report-card" onclick="generateQuickReport('intervention-needed')">
                <span class="report-icon">⚠️</span>
                <div class="report-title">Intervention Report</div>
                <div class="report-desc">Students requiring immediate attention</div>
            </div>
        </div>

        <!-- Custom Report Builder -->
        <div class="report-builder">
            <div class="builder-header">
                <div class="builder-title">Custom Report Builder</div>
                <button class="btn" onclick="openReportPreview()">Preview Report</button>
            </div>
            <div class="builder-grid">
                <div class="form-group">
                    <label>Report Type</label>
                    <select class="form-control" id="reportType">
                        <option value="comprehensive">Comprehensive Analysis</option>
                        <option value="student-specific">Student-Specific Report</option>
                        <option value="program-comparison">Program Comparison</option>
                        <option value="trend-analysis">Trend Analysis</option>
                        <option value="intervention-summary">Intervention Summary</option>
                        <option value="department-overview">Department Overview</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Time Period</label>
                    <select class="form-control" id="timePeriod">
                        <option value="current-semester">Current Semester</option>
                        <option value="last-30-days">Last 30 Days</option>
                        <option value="last-90-days">Last 90 Days</option>
                        <option value="academic-year">Full Academic Year</option>
                        <option value="custom">Custom Range</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Students</label>
                    <select class="form-control" id="studentFilter">
                        <option value="all">All My Students</option>
                        <option value="year-1">Year 1 Students</option>
                        <option value="year-2">Year 2 Students</option>
                        <option value="year-3">Year 3 Students</option>
                        <option value="bit">Business IT Students</option>
                        <option value="cs">Computer Science Students</option>
                        <option value="at-risk">At-Risk Students</option>
                        <option value="high-performers">High Performers</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Export Format</label>
                    <select class="form-control" id="exportFormat">
                        <option value="pdf">PDF Document</option>
                        <option value="excel">Excel Spreadsheet</option>
                        <option value="powerpoint">PowerPoint Presentation</option>
                        <option value="word">Word Document</option>
                    </select>
                </div>
            </div>
            <div style="margin-top: 1.5rem;">
                <button class="btn" onclick="generateCustomReport()">Generate Report</button>
                <button class="btn btn-outline" onclick="saveReportTemplate()">Save Template</button>
                <button class="btn btn-secondary" onclick="scheduleReport()">Schedule Report</button>
            </div>
        </div>

        <!-- Recent Reports History -->
        <div class="reports-history">
            <div class="history-header">
                <div class="history-title">Recent Reports</div>
                <button class="btn btn-outline" onclick="viewAllReports()">View All</button>
            </div>
            <ul class="report-list">
                <li class="report-item">
                    <div class="report-info">
                        <h4>Monthly Student Progress Report - <?php echo date("F Y"); ?></h4>
                        <p>Comprehensive analysis of all <?php echo $totalStudents; ?> students including academic performance, simulation results, and counselling impact for Business IT program.</p>
                        <div class="report-meta">
                            <span>Generated: <?php echo $currentDate; ?></span>
                            <span>Size: 2.4 MB</span>
                            <span>Pages: 45</span>
                        </div>
                    </div>
                    <div class="report-actions">
                        <span class="report-status status-completed">Completed</span>
                        <button class="btn btn-sm" onclick="downloadReport('march-progress')">Download</button>
                        <button class="btn btn-sm btn-secondary" onclick="shareReport('march-progress')">Share</button>
                        <button class="btn btn-sm btn-outline" onclick="viewReport('march-progress')">View</button>
                    </div>
                </li>
                <li class="report-item">
                    <div class="report-info">
                        <h4>At-Risk Students Intervention Report</h4>
                        <p>Detailed analysis of 5 students requiring immediate intervention with recommended action plans and family contact strategies.</p>
                        <div class="report-meta">
                            <span>Generated: <?php echo date("F j, Y", strtotime("-2 days")); ?></span>
                            <span>Size: 892 KB</span>
                            <span>Pages: 15</span>
                        </div>
                    </div>
                    <div class="report-actions">
                        <span class="report-status status-completed">Completed</span>
                        <button class="btn btn-sm" onclick="downloadReport('intervention')">Download</button>
                        <button class="btn btn-sm btn-secondary" onclick="shareReport('intervention')">Share</button>
                        <button class="btn btn-sm btn-outline" onclick="viewReport('intervention')">View</button>
                    </div>
                </li>
                <li class="report-item">
                    <div class="report-info">
                        <h4>Career Simulation Effectiveness Analysis</h4>
                        <p>Analysis of simulation outcomes and their correlation with student career choices and academic performance in Kenyan tech industry.</p>
                        <div class="report-meta">
                            <span>Scheduled: <?php echo date("F j, Y", strtotime("+3 days")); ?></span>
                            <span>Estimated Size: 1.8 MB</span>
                            <span>Status: Processing</span>
                        </div>
                    </div>
                    <div class="report-actions">
                        <span class="report-status status-processing">Processing</span>
                        <button class="btn btn-sm btn-warning" onclick="cancelReport('simulation-analysis')">Cancel</button>
                        <button class="btn btn-sm btn-outline" onclick="editReport('simulation-analysis')">Edit</button>
                    </div>
                </li>
                <li class="report-item">
                    <div class="report-info">
                        <h4>Quarterly Department Comparison</h4>
                        <p>Comparative analysis of counselling effectiveness across Business IT, Computer Science, and Software Engineering departments.</p>
                        <div class="report-meta">
                            <span>Scheduled: <?php echo date("F j, Y", strtotime("first day of next month")); ?></span>
                            <span>Frequency: Quarterly</span>
                            <span>Auto-generated</span>
                        </div>
                    </div>
                    <div class="report-actions">
                        <span class="report-status status-scheduled">Scheduled</span>
                        <button class="btn btn-sm btn-outline" onclick="modifyReport('dept-comparison')">Modify</button>
                        <button class="btn btn-sm btn-danger" onclick="cancelReport('dept-comparison')">Cancel</button>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Scheduled Reports -->
        <div class="scheduled-reports">
            <div class="history-header">
                <div class="history-title">Scheduled Reports</div>
                <button class="btn btn-outline" onclick="addScheduledReport()">Add Schedule</button>
            </div>
            <div class="schedule-item">
                <div class="schedule-info">
                    <h4>Weekly Student Check-in Report</h4>
                    <p>Every Monday at 9:00 AM • Next: <?php echo date("F j, Y", strtotime("next Monday")); ?> • Auto-email to Department Head</p>
                </div>
                <div class="schedule-actions">
                    <button class="btn btn-sm btn-outline" onclick="editSchedule('weekly-checkin')">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteSchedule('weekly-checkin')">Delete</button>
                </div>
            </div>
            <div class="schedule-item">
                <div class="schedule-info">
                    <h4>Monthly Performance Summary</h4>
                    <p>Last day of each month • Next: <?php echo date("F j, Y", strtotime("last day of this month")); ?> • PDF format with charts</p>
                </div>
                <div class="schedule-actions">
                    <button class="btn btn-sm btn-outline" onclick="editSchedule('monthly-summary')">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteSchedule('monthly-summary')">Delete</button>
                </div>
            </div>
            <div class="schedule-item">
                <div class="schedule-info">
                    <h4>Semester Career Readiness Assessment</h4>
                    <p>End of each semester • Next: <?php echo date("F j, Y", strtotime("July 15, 2025")); ?> • Include industry trends</p>
                </div>
                <div class="schedule-actions">
                    <button class="btn btn-sm btn-outline" onclick="editSchedule('career-assessment')">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteSchedule('career-assessment')">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Preview Modal -->
    <div id="reportModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Report Preview</h2>
                <button class="close-btn" onclick="closeReportModal()">&times;</button>
            </div>
            
            <div class="report-preview">
                <div class="preview-section">
                    <h4>Report Summary</h4>
                    <p id="reportSummary">This comprehensive report covers student performance metrics, counselling session effectiveness, and career development progress for the selected time period at Strathmore University.</p>
                </div>
                
                <div class="preview-section">
                    <h4>Key Metrics</h4>
                    <div class="preview-data">
                        <div class="data-point">
                            <div class="data-value" id="metricStudents"><?php echo $totalStudents; ?></div>
                            <div class="data-label">Students Covered</div>
                        </div>
                        <div class="data-point">
                            <div class="data-value" id="metricSessions"><?php echo $totalSessions; ?></div>
                            <div class="data-label">Sessions Analyzed</div>
                        </div>
                        <div class="data-point">
                            <div class="data-value" id="metricSimulations">89</div>
                            <div class="data-label">Simulations Reviewed</div>
                        </div>
                        <div class="data-point">
                            <div class="data-value" id="metricProgress"><?php echo $successRate; ?></div>
                            <div class="data-label">Avg. Progress</div>
                        </div>
                    </div>
                </div>
                
                <div class="preview-section">
                    <h4>Report Contents</h4>
                    <ul style="color: #666; line-height: 1.6;">
                        <li>Executive Summary</li>
                        <li>Individual Student Profiles & Academic Journey</li>
                        <li>Academic Performance Analysis by Program</li>
                        <li>Career Simulation Results & Industry Alignment</li>
                        <li>Counselling Session Impact Assessment</li>
                        <li>Recommendations & Action Plan</li>
                    </ul>
                </div>
                
                <div class="preview-section">
                    <h4>Export Options</h4>
                    <div class="export-options">
                        <button class="btn" onclick="exportReport('pdf')">Export as PDF</button>
                        <button class="btn btn-secondary" onclick="exportReport('excel')">Export as Excel</button>
                        <button class="btn btn-success" onclick="exportReport('powerpoint')">Export as PowerPoint</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript functions remain exactly the same
        function generateQuickReport(type) {
            showNotification(`Generating ${type.replace('-', ' ')} report...`);
            // Simulate report generation
            setTimeout(() => {
                showNotification(`${type.replace('-', ' ')} report generated successfully!`);
            }, 2000);
        }

        function openReportPreview() {
            document.getElementById('reportModal').classList.add('show');
        }

        function closeReportModal() {
            document.getElementById('reportModal').classList.remove('show');
        }

        function generateCustomReport() {
            const reportType = document.getElementById('reportType').value;
            const timePeriod = document.getElementById('timePeriod').value;
            const studentFilter = document.getElementById('studentFilter').value;
            const exportFormat = document.getElementById('exportFormat').value;
            
            showNotification(`Generating ${reportType} report for ${studentFilter} (${timePeriod}) as ${exportFormat.toUpperCase()}...`);
            
            // Simulate report generation
            setTimeout(() => {
                showNotification(`Report generated successfully! Download will start shortly.`);
                closeReportModal();
            }, 3000);
        }

        function saveReportTemplate() {
            showNotification('Report template saved successfully');
        }

        function scheduleReport() {
            showNotification('Report scheduling form opened');
        }

        function viewAllReports() {
            showNotification('Opening all reports archive');
        }

        function downloadReport(reportId) {
            showNotification(`Downloading ${reportId} report...`);
        }

        function shareReport(reportId) {
            showNotification(`Sharing options for ${reportId} report`);
        }

        function viewReport(reportId) {
            showNotification(`Opening ${reportId} report in viewer`);
            openReportPreview();
        }

        function cancelReport(reportId) {
            showNotification(`Cancelled ${reportId} report generation`);
        }

        function editReport(reportId) {
            showNotification(`Editing ${reportId} report parameters`);
        }

        function modifyReport(reportId) {
            showNotification(`Modifying scheduled ${reportId} report`);
        }

        function addScheduledReport() {
            showNotification('Opening new report schedule form');
        }

        function editSchedule(scheduleId) {
            showNotification(`Editing ${scheduleId} schedule`);
        }

        function deleteSchedule(scheduleId) {
            showNotification(`Deleted ${scheduleId} schedule`);
        }

        function exportReport(format) {
            showNotification(`Exporting report as ${format.toUpperCase()}...`);
            closeReportModal();
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

        // Initialize page with animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate quick report cards
            document.querySelectorAll('.quick-report-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.4s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Animate report items
            document.querySelectorAll('.report-item').forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(30px)';
                
                setTimeout(() => {
                    item.style.transition = 'all 0.5s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, (index * 150) + 500);
            });
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
    </script>
</body>
</html>