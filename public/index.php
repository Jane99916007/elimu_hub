<?php
// File: public/index.php
session_start();

// Check if user is already logged in and redirect to appropriate dashboard
if (isset($_SESSION['user']) && isset($_SESSION['user']['role'])) {
    // Update these paths to match your actual dashboard locations
    switch($_SESSION['user']['role']) {
        case 'student':
            header("Location: ../src/Views/student/dashboard.php");
            break;
        case 'admin':
            header("Location: ../src/Views/admin/dashboard.php");
            break;
        case 'counsellor':
            header("Location: ../src/Views/counsellor/dashboard.php");
            break;
    }
    exit();
}

// Check for logout message
$logout_message = '';
if (isset($_SESSION['logout_message'])) {
    $logout_message = $_SESSION['logout_message'];
    unset($_SESSION['logout_message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimu Hub - Academic Path Simulator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-blue: #007bff;
            --light-blue: #a3d8f4;
            --gradient: linear-gradient(135deg, #a8d4f0 0%, #d4e7f7 100%);
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        
        .hero-section {
            background: var(--gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: white;
            padding: 4rem 0;
        }
        
        .navbar-dark {
            background: rgba(0, 0, 0, 0.1) !important;
            backdrop-filter: blur(10px);
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 6px;
            margin: 0 5px;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }
        
        .nav-pills .nav-link.active {
            background-color: var(--primary-blue);
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: var(--primary-blue);
        }
        
        .hero-illustration {
            text-align: center;
            font-size: 8rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-primary {
            background: var(--primary-blue);
            border: var(--primary-blue);
            padding: 12px 30px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none !important;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
            text-decoration: none !important;
        }

        .btn-outline-light {
            padding: 12px 30px;
            font-weight: 500;
            border-radius: 8px;
            border-width: 2px;
            transition: all 0.3s ease;
            text-decoration: none !important;
        }

        .btn-outline-light:hover {
            transform: translateY(-2px);
            text-decoration: none !important;
        }

        .btn-outline-primary {
            padding: 12px 30px;
            font-weight: 500;
            border-radius: 8px;
            border-width: 2px;
            transition: all 0.3s ease;
            text-decoration: none !important;
        }

        .btn-outline-primary:hover {
            transform: translateY(-2px);
            text-decoration: none !important;
        }

        .card {
            border: none;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .alert-info {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            color: #0056b3;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .hero-illustration {
                font-size: 4rem;
                margin-top: 2rem;
            }
            
            .display-4 {
                font-size: 2.5rem;
            }
        }
        
        /* Force links to work properly */
        a {
            cursor: pointer !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-mortarboard me-2"></i>Elimu Hub
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../src/Views/<?= $_SESSION['user']['role'] ?>/dashboard.php">
                                <i class="bi bi-speedometer2 me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../src/Views/auth/logout.php">
                                <i class="bi bi-box-arrow-right me-1"></i>Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../src/Views/auth/login.php">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../src/Views/auth/register.php">
                                <i class="bi bi-person-plus me-1"></i>Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <?php if ($logout_message): ?>
                <div class="alert alert-info text-center">
                    <i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($logout_message) ?>
                </div>
            <?php endif; ?>
            
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Shape Your Academic Future</h1>
                    <p class="lead mb-4">
                        Elimu Hub is the premier educational path simulator, helping students 
                        make informed decisions about their higher education and career trajectories 
                        in Kenya's dynamic educational landscape.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <?php if (isset($_SESSION['user'])): ?>
                            <a href="../src/Views/<?= $_SESSION['user']['role'] ?>/dashboard.php" class="btn btn-primary btn-lg px-4">
                                Continue to Dashboard <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        <?php else: ?>
                            <a href="../src/Views/auth/register.php" class="btn btn-primary btn-lg px-4">
                                Get Started <i class="bi bi-rocket ms-2"></i>
                            </a>
                            <a href="#features" class="btn btn-outline-light btn-lg px-4">
                                Learn More <i class="bi bi-book ms-2"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-illustration">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-4">Our Mission</h2>
                    <p class="lead mb-4">
                        Born out of the need to address career guidance gaps in higher education, 
                        Elimu Hub leverages data-driven simulations to help students visualize the 
                        consequences of academic choices.
                    </p>
                    <p>
                        We understand that choosing the right educational path can be overwhelming. 
                        That's why we've created a platform that combines cutting-edge technology 
                        with local expertise to guide you every step of the way.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <h3 class="h5 mb-4"><i class="bi bi-target text-primary me-2"></i>Key Milestones</h3>
                            <ul class="list-unstyled">
                                <li class="mb-3 d-flex align-items-start">
                                    <i class="bi bi-check-circle text-success me-3 mt-1"></i>
                                    <div>
                                        <strong>Phase 1:</strong> Conceptualization and research phase
                                        <small class="d-block text-muted">Market analysis and stakeholder interviews completed</small>
                                    </div>
                                </li>
                                <li class="mb-3 d-flex align-items-start">
                                    <i class="bi bi-check-circle text-success me-3 mt-1"></i>
                                    <div>
                                        <strong>Phase 2:</strong> Pilot program launch
                                        <small class="d-block text-muted">Beta testing with select institutions</small>
                                    </div>
                                </li>
                                <li class="mb-3 d-flex align-items-start">
                                    <i class="bi bi-arrow-right text-primary me-3 mt-1"></i>
                                    <div>
                                        <strong>Phase 3:</strong> Full system rollout
                                        <small class="d-block text-muted">Nationwide deployment in progress</small>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">How Elimu Hub Helps You</h2>
                <p class="lead text-muted">Powerful tools for academic success and career planning</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <h3 class="h5 mb-3">Path Simulation</h3>
                            <p class="text-muted">
                                Test different course combinations and see potential career 
                                outcomes before making real academic decisions. Our AI-powered 
                                simulations provide insights based on real market data.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <h3 class="h5 mb-3">Expert Guidance</h3>
                            <p class="text-muted">
                                Get personalized recommendations from certified career 
                                counselors based on your simulation results. Connect with 
                                mentors and industry professionals.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <h3 class="h5 mb-3">Kenyan Context</h3>
                            <p class="text-muted">
                                Our algorithms use localized data specific to Kenyan higher 
                                education institutions and job market realities. Make decisions 
                                based on local opportunities.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container py-4">
            <div class="row text-center">
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="stat-number text-white">5,000+</div>
                    <p class="mb-0">Students Helped</p>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="stat-number text-white">20+</div>
                    <p class="mb-0">Partner Institutions</p>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="stat-number text-white">94%</div>
                    <p class="mb-0">Satisfaction Rate</p>
                </div>
                <div class="col-md-3">
                    <div class="stat-number text-white">150+</div>
                    <p class="mb-0">Career Paths</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-4">Ready to Start Your Journey?</h2>
                    <p class="lead mb-4">
                        Join thousands of students who have already discovered their perfect academic path 
                        through Elimu Hub's innovative simulation platform.
                    </p>
                    <?php if (!isset($_SESSION['user'])): ?>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="../src/Views/auth/register.php" class="btn btn-primary btn-lg px-4">
                                Create Free Account <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                            <a href="../src/Views/auth/login.php" class="btn btn-outline-primary btn-lg px-4">
                                Sign In <i class="bi bi-box-arrow-in-right ms-2"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h3 class="h5 mb-3">
                        <i class="bi bi-mortarboard me-2"></i>Elimu Hub
                    </h3>
                    <p class="text-light opacity-75">
                        Empowering Kenyan students to make informed academic and career 
                        decisions through data-driven simulations and expert guidance.
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-white-50"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white-50"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="text-white-50"><i class="bi bi-linkedin fs-5"></i></a>
                        <a href="#" class="text-white-50"><i class="bi bi-instagram fs-5"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h3 class="h6 mb-3">Platform</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-1">
                            <a href="../src/Views/auth/login.php" class="nav-link ps-0 text-white-50">Login</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="../src/Views/auth/register.php" class="nav-link ps-0 text-white-50">Register</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="#features" class="nav-link ps-0 text-white-50">Features</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h3 class="h6 mb-3">Company</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-1">
                            <a href="#about" class="nav-link ps-0 text-white-50">About Us</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="#" class="nav-link ps-0 text-white-50">Contact</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="#" class="nav-link ps-0 text-white-50">Careers</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h3 class="h6 mb-3">Legal</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-1">
                            <a href="#" class="nav-link ps-0 text-white-50">Privacy Policy</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="#" class="nav-link ps-0 text-white-50">Terms of Service</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="#" class="nav-link ps-0 text-white-50">Cookie Policy</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h3 class="h6 mb-3">Support</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-1">
                            <a href="#" class="nav-link ps-0 text-white-50">Help Center</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="#" class="nav-link ps-0 text-white-50">Documentation</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="#" class="nav-link ps-0 text-white-50">Community</a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 opacity-25">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <small class="text-white-50">
                        &copy; <?= date('Y') ?> Elimu Hub. All rights reserved. 
                        Empowering education in Kenya.
                    </small>
                </div>
                <div class="col-md-4 text-md-end">
                    <small class="text-white-50">
                        Made with <i class="bi bi-heart-fill text-danger"></i> in Kenya
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>