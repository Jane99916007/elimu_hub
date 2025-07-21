<?php
// File: src/Views/student/resources.php
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

// Get resources data
$featured_resources = [
    [
        'title' => 'Complete Web Development Bootcamp',
        'description' => 'Master full-stack development with hands-on projects covering modern web technologies used in Kenya\'s tech industry.',
        'type' => 'course',
        'action' => 'bootcamp'
    ],
    [
        'title' => 'AWS Cloud Practitioner Prep',
        'description' => 'Get ready for AWS certification - highly valued by Kenyan employers in fintech and e-commerce sectors.',
        'type' => 'certification',
        'action' => 'aws'
    ],
    [
        'title' => 'Data Structures & Algorithms',
        'description' => 'Master CS fundamentals essential for technical interviews at leading Kenyan tech companies.',
        'type' => 'course',
        'action' => 'dsa'
    ]
];

$categories = [
    [
        'id' => 'programming',
        'icon' => '💻',
        'title' => 'Programming & Development',
        'description' => 'Learn programming languages, frameworks, and development best practices',
        'count' => 45
    ],
    [
        'id' => 'web-dev',
        'icon' => '🌐',
        'title' => 'Web Development',
        'description' => 'Frontend and backend web development technologies',
        'count' => 32
    ],
    [
        'id' => 'database',
        'icon' => '🗄️',
        'title' => 'Database Management',
        'description' => 'SQL, NoSQL, database design, and data modeling',
        'count' => 28
    ],
    [
        'id' => 'business',
        'icon' => '📊',
        'title' => 'Business & Analytics',
        'description' => 'Business analysis, project management, and data analytics',
        'count' => 38
    ],
    [
        'id' => 'career',
        'icon' => '🚀',
        'title' => 'Career Development',
        'description' => 'Resume building, interview prep, and professional skills',
        'count' => 24
    ],
    [
        'id' => 'tools',
        'icon' => '🛠️',
        'title' => 'Tools & Software',
        'description' => 'Development tools, IDEs, and productivity software',
        'count' => 36
    ]
];

$resources = [
    [
        'category' => 'programming',
        'type' => 'course',
        'title' => 'Java Programming Masterclass for Kenya Developers',
        'description' => 'Complete Java development course covering fundamentals to enterprise applications.',
        'meta' => 'Updated: Mar 2025',
        'rating' => '4.8 (2,340 reviews)',
        'bookmarked' => false
    ],
    [
        'category' => 'web-dev',
        'type' => 'video',
        'title' => 'React.js for East African E-commerce',
        'description' => 'Learn React from scratch with practical e-commerce projects.',
        'meta' => '12 hours • 45 videos',
        'rating' => '4.9 (1,890 reviews)',
        'bookmarked' => false
    ],
    [
        'category' => 'database',
        'type' => 'article',
        'title' => 'SQL Best Practices for Banking Systems',
        'description' => 'Comprehensive guide to writing efficient SQL queries for financial systems.',
        'meta' => '15 min read • Expert level',
        'rating' => '4.7 (892 likes)',
        'bookmarked' => false
    ],
    [
        'category' => 'business',
        'type' => 'course',
        'title' => 'Project Management for Startups',
        'description' => 'Learn project management skills with real examples from successful startups.',
        'meta' => '8 weeks • Certificate available',
        'rating' => '4.6 (1,456 reviews)',
        'progress' => 65,
        'bookmarked' => true
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimu Hub - Learning Resources</title>
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

        .search-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .search-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .search-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
        }

        .search-input:focus {
            border-color: var(--primary-blue);
            outline: none;
        }

        .filter-tags {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .filter-tag {
            padding: 0.5rem 1rem;
            background: #f8f9fa;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .filter-tag.active {
            background: var(--primary-blue);
            color: white;
        }

        .quick-access {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .quick-access-item {
            background: rgba(255, 255, 255, 0.95);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .quick-access-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .quick-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .quick-title {
            font-weight: 600;
            color: #333;
        }

        .featured-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .featured-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .featured-icon {
            font-size: 2rem;
            margin-right: 1rem;
        }

        .featured-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .featured-item {
            padding: 1.5rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .featured-item:hover {
            border-color: var(--primary-blue);
            transform: translateY(-3px);
        }

        .resource-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .category-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .category-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            display: block;
        }

        .category-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .category-description {
            color: #666;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .category-count {
            color: var(--primary-blue);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .resources-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .resource-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
        }

        .resource-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .bookmark-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #ccc;
            transition: color 0.3s ease;
        }

        .bookmark-btn.bookmarked {
            color: #ffd700;
        }

        .resource-type {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .type-course { background: #e3f2fd; color: #1565c0; }
        .type-video { background: #fce4ec; color: #c2185b; }
        .type-article { background: #e8f5e8; color: #388e3c; }
        .type-tool { background: #fff3e0; color: #f57c00; }

        .resource-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .resource-description {
            color: #666;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .resource-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.8rem;
            color: #999;
        }

        .resource-rating {
            color: var(--primary-blue);
        }

        .resource-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn {
            background: var(--gradient);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-blue);
            border: 1px solid var(--primary-blue);
        }

        .progress-indicator {
            margin-top: 1rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .progress-bar {
            background: #e9ecef;
            border-radius: 10px;
            height: 6px;
            margin-top: 0.5rem;
        }

        .progress-fill {
            background: var(--gradient);
            height: 100%;
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        @media (max-width: 768px) {
            .search-container {
                flex-direction: column;
            }
            
            .featured-grid,
            .resource-categories,
            .resources-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-access {
                grid-template-columns: repeat(3, 1fr);
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
                    <a class="nav-link" href="progress.php">Progress</a>
                    <a class="nav-link active" href="resources.php">Resources</a>
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
            <h1>Learning Resources</h1>
            <p>Discover curated educational materials, tools, and resources to enhance your learning journey and career development.</p>
        </div>

        <!-- Search Section -->
        <div class="search-section">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search for courses, articles, videos, tools..." onkeyup="searchResources(this.value)">
                <button class="btn"><i class="bi bi-search"></i> Search</button>
            </div>
            <div class="filter-tags">
                <span class="filter-tag active" onclick="filterResources('all', this)">All Resources</span>
                <span class="filter-tag" onclick="filterResources('video', this)">Videos</span>
                <span class="filter-tag" onclick="filterResources('article', this)">Articles</span>
                <span class="filter-tag" onclick="filterResources('course', this)">Courses</span>
                <span class="filter-tag" onclick="filterResources('tool', this)">Tools</span>
            </div>
        </div>

        <!-- Quick Access -->
        <div class="quick-access">
            <?php foreach ($categories as $category): ?>
            <div class="quick-access-item" onclick="showCategoryResources('<?php echo $category['id']; ?>')">
                <span class="quick-icon"><?php echo $category['icon']; ?></span>
                <div class="quick-title"><?php echo htmlspecialchars($category['title']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Featured Resources -->
        <div class="featured-section">
            <div class="featured-header">
                <div class="featured-icon">⭐</div>
                <div class="featured-title">Featured This Week</div>
            </div>
            <div class="featured-grid">
                <?php foreach ($featured_resources as $resource): ?>
                <div class="featured-item">
                    <h4><?php echo htmlspecialchars($resource['title']); ?></h4>
                    <p><?php echo htmlspecialchars($resource['description']); ?></p>
                    <div style="margin-top: 1rem;">
                        <span class="resource-type type-<?php echo $resource['type']; ?>"><?php echo ucfirst($resource['type']); ?></span>
                        <button class="btn btn-sm" onclick="startLearning('<?php echo $resource['action']; ?>')">Learn More</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Resource Categories -->
        <div class="resource-categories">
            <?php foreach ($categories as $category): ?>
            <div class="category-card" onclick="showCategoryResources('<?php echo $category['id']; ?>')">
                <span class="category-icon"><?php echo $category['icon']; ?></span>
                <div class="category-title"><?php echo htmlspecialchars($category['title']); ?></div>
                <div class="category-description"><?php echo htmlspecialchars($category['description']); ?></div>
                <div class="category-count"><?php echo $category['count']; ?> resources available</div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- All Resources Grid -->
        <div class="resources-grid" id="resources-container">
            <?php foreach ($resources as $resource): ?>
            <div class="resource-card" data-category="<?php echo $resource['category']; ?>" data-type="<?php echo $resource['type']; ?>">
                <button class="bookmark-btn <?php echo $resource['bookmarked'] ? 'bookmarked' : ''; ?>" onclick="toggleBookmark(this)">
                    <?php echo $resource['bookmarked'] ? '★' : '☆'; ?>
                </button>
                <div class="resource-header">
                    <span class="resource-type type-<?php echo $resource['type']; ?>"><?php echo ucfirst($resource['type']); ?></span>
                </div>
                <div class="resource-title"><?php echo htmlspecialchars($resource['title']); ?></div>
                <div class="resource-description"><?php echo htmlspecialchars($resource['description']); ?></div>
                <div class="resource-meta">
                    <span><?php echo htmlspecialchars($resource['meta']); ?></span>
                    <div class="resource-rating">
                        ⭐ <?php echo htmlspecialchars($resource['rating']); ?>
                    </div>
                </div>
                <div class="resource-actions">
                    <button class="btn btn-sm" onclick="startLearning('<?php echo htmlspecialchars($resource['title']); ?>')">
                        <?php echo $resource['type'] === 'course' ? 'Start Learning' : ($resource['type'] === 'video' ? 'Watch Now' : ($resource['type'] === 'article' ? 'Read Article' : 'Download')); ?>
                    </button>
                    <button class="btn btn-sm btn-outline">
                        <?php echo $resource['type'] === 'course' ? 'Preview' : 'Share'; ?>
                    </button>
                </div>
                <?php if (isset($resource['progress'])): ?>
                <div class="progress-indicator">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                        <span style="font-size: 0.9rem;">Progress: <?php echo $resource['progress']; ?>%</span>
                        <span style="font-size: 0.9rem;"><?php echo floor($resource['progress'] / 12.5); ?>/8 modules</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo $resource['progress']; ?>%"></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchResources(query) {
            console.log("Searching for: " + query);
            // Filter resources based on search query
            const cards = document.querySelectorAll('.resource-card');
            cards.forEach(card => {
                const title = card.querySelector('.resource-title').textContent.toLowerCase();
                const description = card.querySelector('.resource-description').textContent.toLowerCase();
                if (title.includes(query.toLowerCase()) || description.includes(query.toLowerCase())) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function filterResources(type, element) {
            document.querySelectorAll('.filter-tag').forEach(tag => {
                tag.classList.remove('active');
            });
            element.classList.add('active');
            
            const cards = document.querySelectorAll('.resource-card');
            cards.forEach(card => {
                if (type === 'all' || card.dataset.type === type) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function showCategoryResources(category) {
            console.log("Showing resources for category: " + category);
            // Filter by category or redirect to category page
        }

        function toggleBookmark(button) {
            button.textContent = button.textContent === '☆' ? '★' : '☆';
            button.classList.toggle('bookmarked');
        }

        function startLearning(resourceName) {
            alert("Starting: " + resourceName);
            // In real app, redirect to learning page
        }
    </script>
</body>
</html>