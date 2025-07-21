<?php
// Database connection and data fetching would typically go here
$users = [
    [
        'name' => 'Jane Karani',
        'email' => 'jane.karani@strathmore.edu',
        'role' => 'student',
        'status' => 'active',
        'last_active' => '2 hours ago'
    ],
    [
        'name' => 'Dr. Sarah Mwangi',
        'email' => 's.mwangi@strathmore.edu',
        'role' => 'counselor',
        'status' => 'active',
        'last_active' => '1 hour ago'
    ],
    [
        'name' => 'Michael Ochieng',
        'email' => 'm.ochieng@strathmore.edu',
        'role' => 'student',
        'status' => 'active',
        'last_active' => '3 hours ago'
    ],
    [
        'name' => 'Prof. David Kimani',
        'email' => 'd.kimani@strathmore.edu',
        'role' => 'counselor',
        'status' => 'inactive',
        'last_active' => '2 days ago'
    ],
    [
        'name' => 'Admin User',
        'email' => 'admin@strathmore.edu',
        'role' => 'admin',
        'status' => 'active',
        'last_active' => '30 minutes ago'
    ]
];

// Stats data
$stats = [
    'total_students' => 1347,
    'active_counselors' => 47,
    'administrators' => 8,
    'active_users_percentage' => 94.2
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimu Hub - Users</title>
    <style>
        /* All your CSS styles remain exactly the same */
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
            <a href="users.php" class="nav-item active">Users</a>
            <a href="system.php" class="nav-item">System</a>
            <a href="reports.php" class="nav-item">Reports</a>
            <a href="settings.php" class="nav-item">Settings</a>
        </nav>
        <div class="user-info">
            <div class="user-avatar">AD</div>
            <span>Administrator</span>
        </div>
    </div>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Users Management</h1>
            <p class="page-description">Manage student, counselor, and administrator accounts across the platform.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?= number_format($stats['total_students']) ?></div>
                <div class="stat-label">Total Students</div>
                <div class="stat-change">↗ +12% this month</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $stats['active_counselors'] ?></div>
                <div class="stat-label">Active Counselors</div>
                <div class="stat-change">↗ +3 new this week</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $stats['administrators'] ?></div>
                <div class="stat-label">Administrators</div>
                <div class="stat-change">↗ +1 this month</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $stats['active_users_percentage'] ?>%</div>
                <div class="stat-label">Active Users</div>
                <div class="stat-change">↗ +2.1% this week</div>
            </div>
        </div>

        <div class="content-section">
            <h2 class="section-title">User Management</h2>
            
            <button class="add-user-btn" onclick="location.href='add_user.php'">+ Add New User</button>
            
            <form method="GET" action="users.php" class="filters">
                <input type="text" name="search" class="search-bar" placeholder="Search users by name or email..." 
                       value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <select name="role" class="filter-select">
                    <option value="">All Roles</option>
                    <option value="student" <?= ($_GET['role'] ?? '') === 'student' ? 'selected' : '' ?>>Students</option>
                    <option value="counselor" <?= ($_GET['role'] ?? '') === 'counselor' ? 'selected' : '' ?>>Counselors</option>
                    <option value="admin" <?= ($_GET['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Administrators</option>
                </select>
                <select name="status" class="filter-select">
                    <option value="">All Status</option>
                    <option value="active" <?= ($_GET['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= ($_GET['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
                <button type="submit" style="display:none;">Filter</button>
            </form>

            <div class="table-container">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td>
                                <span class="user-role role-<?= $user['role'] ?>">
                                    <?= ucfirst($user['role']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge status-<?= $user['status'] ?>">
                                    <?= ucfirst($user['status']) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($user['last_active']) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit" 
                                            onclick="location.href='edit_user.php?id=<?= urlencode($user['email']) ?>'">
                                        Edit
                                    </button>
                                    <button class="btn btn-delete" 
                                            onclick="confirmDelete('<?= htmlspecialchars($user['email']) ?>')">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(email) {
            if (confirm('Are you sure you want to delete user ' + email + '?')) {
                window.location.href = 'delete_user.php?email=' + encodeURIComponent(email);
            }
        }
        
        // Auto-submit form when filters change
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', function() {
                this.form.submit();
            });
        });
    </script>
</body>
</html>