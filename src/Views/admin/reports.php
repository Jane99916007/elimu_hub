<?php
// Sample report data - in a real app this would come from a database
$recentReports = [
    [
        'name' => 'Monthly Usage Report - June 2025',
        'type' => 'usage',
        'generated' => '2 hours ago',
        'size' => '2.4 MB',
        'file' => 'monthly_usage_june_2025.pdf'
    ],
    [
        'name' => 'System Performance Q2 2025',
        'type' => 'performance',
        'generated' => '1 day ago',
        'size' => '1.8 MB',
        'file' => 'performance_q2_2025.xlsx'
    ],
    [
        'name' => 'Student Engagement Analysis',
        'type' => 'engagement',
        'generated' => '3 days ago',
        'size' => '3.1 MB',
        'file' => 'student_engagement_analysis.pdf'
    ],
    [
        'name' => 'Weekly Activity Summary',
        'type' => 'usage',
        'generated' => '1 week ago',
        'size' => '890 KB',
        'file' => 'weekly_activity_summary.csv'
    ],
    [
        'name' => 'Counselor Effectiveness Report',
        'type' => 'performance',
        'generated' => '2 weeks ago',
        'size' => '2.7 MB',
        'file' => 'counselor_effectiveness.pdf'
    ]
];

// Report statistics
$reportStats = [
    'usage' => 2847,
    'performance' => '99.2%',
    'engagement' => '87%',
    'outcomes' => '94%'
];

// Get filter values from query parameters
$reportType = $_GET['report_type'] ?? '';
$dateRange = $_GET['date_range'] ?? '';
$userType = $_GET['user_type'] ?? '';
$department = $_GET['department'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimu Hub - Reports</title>
    <style>
        /* All CSS styles remain exactly the same */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        /* ... rest of your CSS ... */
        
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Elimu Hub</div>
        <nav class="nav">
            <a href="dashboard.php" class="nav-item">Dashboard</a>
            <a href="users.php" class="nav-item">Users</a>
            <a href="system.php" class="nav-item">System</a>
            <a href="reports.php" class="nav-item active">Reports</a>
            <a href="settings.php" class="nav-item">Settings</a>
        </nav>
        <div class="user-info">
            <div class="user-avatar">AD</div>
            <span>Administrator</span>
        </div>
    </div>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Reports & Analytics</h1>
            <p class="page-description">Generate comprehensive reports and analyze platform usage, performance metrics, and user engagement data.</p>
        </div>

        <div class="reports-grid">
            <div class="report-card" onclick="location.href='generate_report.php?type=usage'">
                <div class="report-icon usage">📊</div>
                <div class="report-title">Usage Analytics</div>
                <div class="report-description">Track platform usage patterns, login frequencies, and feature adoption rates.</div>
                <div class="report-stats">
                    <div class="stat-number"><?= $reportStats['usage'] ?></div>
                    <button class="generate-btn">Generate</button>
                </div>
            </div>
            <div class="report-card" onclick="location.href='generate_report.php?type=performance'">
                <div class="report-icon performance">⚡</div>
                <div class="report-title">System Performance</div>
                <div class="report-description">Monitor system response times, server load, and technical performance metrics.</div>
                <div class="report-stats">
                    <div class="stat-number"><?= $reportStats['performance'] ?></div>
                    <button class="generate-btn">Generate</button>
                </div>
            </div>
            <div class="report-card" onclick="location.href='generate_report.php?type=engagement'">
                <div class="report-icon engagement">❤️</div>
                <div class="report-title">User Engagement</div>
                <div class="report-description">Analyze simulation completion rates, counselor interactions, and user satisfaction.</div>
                <div class="report-stats">
                    <div class="stat-number"><?= $reportStats['engagement'] ?></div>
                    <button class="generate-btn">Generate</button>
                </div>
            </div>
            <div class="report-card" onclick="location.href='generate_report.php?type=outcomes'">
                <div class="report-icon outcomes">🎯</div>
                <div class="report-title">Academic Outcomes</div>
                <div class="report-description">Track decision-making improvements, career path selections, and success rates.</div>
                <div class="report-stats">
                    <div class="stat-number"><?= $reportStats['outcomes'] ?></div>
                    <button class="generate-btn">Generate</button>
                </div>
            </div>
        </div>

        <div class="content-section">
            <h2 class="section-title">Custom Report Generator</h2>
            
            <form method="GET" action="reports.php" class="filter-controls">
                <div class="filter-group">
                    <label class="filter-label">Report Type</label>
                    <select name="report_type" class="filter-select">
                        <option value="usage" <?= $reportType === 'usage' ? 'selected' : '' ?>>Usage Analytics</option>
                        <option value="performance" <?= $reportType === 'performance' ? 'selected' : '' ?>>System Performance</option>
                        <option value="engagement" <?= $reportType === 'engagement' ? 'selected' : '' ?>>User Engagement</option>
                        <option value="outcomes" <?= $reportType === 'outcomes' ? 'selected' : '' ?>>Academic Outcomes</option>
                        <option value="financial" <?= $reportType === 'financial' ? 'selected' : '' ?>>Financial Overview</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Date Range</label>
                    <select name="date_range" class="filter-select">
                        <option value="7days" <?= $dateRange === '7days' ? 'selected' : '' ?>>Last 7 days</option>
                        <option value="30days" <?= $dateRange === '30days' ? 'selected' : '' ?>>Last 30 days</option>
                        <option value="3months" <?= $dateRange === '3months' ? 'selected' : '' ?>>Last 3 months</option>
                        <option value="6months" <?= $dateRange === '6months' ? 'selected' : '' ?>>Last 6 months</option>
                        <option value="1year" <?= $dateRange === '1year' ? 'selected' : '' ?>>Last year</option>
                        <option value="custom" <?= $dateRange === 'custom' ? 'selected' : '' ?>>Custom range</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">User Type</label>
                    <select name="user_type" class="filter-select">
                        <option value="all" <?= $userType === 'all' ? 'selected' : '' ?>>All Users</option>
                        <option value="students" <?= $userType === 'students' ? 'selected' : '' ?>>Students only</option>
                        <option value="counselors" <?= $userType === 'counselors' ? 'selected' : '' ?>>Counselors only</option>
                        <option value="admins" <?= $userType === 'admins' ? 'selected' : '' ?>>Administrators</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Department</label>
                    <select name="department" class="filter-select">
                        <option value="all" <?= $department === 'all' ? 'selected' : '' ?>>All Departments</option>
                        <option value="business_it" <?= $department === 'business_it' ? 'selected' : '' ?>>Business IT</option>
                        <option value="computer_science" <?= $department === 'computer_science' ? 'selected' : '' ?>>Computer Science</option>
                        <option value="engineering" <?= $department === 'engineering' ? 'selected' : '' ?>>Engineering</option>
                        <option value="business" <?= $department === 'business' ? 'selected' : '' ?>>Business</option>
                    </select>
                </div>
                <button type="submit" style="display:none;">Apply Filters</button>
            </form>

            <div class="export-controls">
                <button class="export-btn export-pdf" onclick="exportReport('pdf')">📄 Export PDF</button>
                <button class="export-btn export-excel" onclick="exportReport('excel')">📊 Export Excel</button>
                <button class="export-btn export-csv" onclick="exportReport('csv')">📋 Export CSV</button>
            </div>

            <div class="chart-container">
                <div class="chart-title">User Activity Trends</div>
                <div class="chart-placeholder">
                    <?php if ($reportType): ?>
                        Interactive Chart for <?= ucfirst($reportType) ?> Report
                    <?php else: ?>
                        Select report type to view chart
                    <?php endif; ?>
                </div>
            </div>

            <div class="chart-container">
                <div class="chart-title">Simulation Completion Rates</div>
                <div class="chart-placeholder">
                    <?php if ($reportType): ?>
                        Simulation Analytics for <?= ucfirst($reportType) ?> Report
                    <?php else: ?>
                        Select report type to view analytics
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="content-section">
            <h2 class="section-title">Recent Reports</h2>
            
            <div class="table-container">
                <table class="reports-table">
                    <thead>
                        <tr>
                            <th>Report Name</th>
                            <th>Type</th>
                            <th>Generated</th>
                            <th>Size</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentReports as $report): ?>
                        <tr>
                            <td><?= htmlspecialchars($report['name']) ?></td>
                            <td>
                                <span class="report-type type-<?= $report['type'] ?>">
                                    <?= ucfirst($report['type']) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($report['generated']) ?></td>
                            <td><?= htmlspecialchars($report['size']) ?></td>
                            <td>
                                <button class="download-btn" 
                                        onclick="downloadReport('<?= htmlspecialchars($report['file']) ?>')">
                                    Download
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Auto-submit form when filters change
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', function() {
                this.form.submit();
            });
        });

        function exportReport(format) {
            const reportType = document.querySelector('[name="report_type"]').value;
            const dateRange = document.querySelector('[name="date_range"]').value;
            const userType = document.querySelector('[name="user_type"]').value;
            const department = document.querySelector('[name="department"]').value;
            
            // In a real app, this would redirect to a report generation endpoint
            alert(`Generating ${format.toUpperCase()} report with current filters...`);
            // window.location.href = `generate_report.php?type=${reportType}&format=${format}&date_range=${dateRange}&user_type=${userType}&department=${department}`;
        }

        function downloadReport(filename) {
            // In a real app, this would download the actual file
            alert(`Downloading report: ${filename}`);
            // window.location.href = `download_report.php?file=${encodeURIComponent(filename)}`;
        }
    </script>
</body>
</html>