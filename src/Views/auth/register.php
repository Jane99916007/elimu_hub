<?php
// File: src/Views/auth/register.php
session_start();

// Include required files (adjust paths as needed)
$baseDir = dirname(__DIR__, 3);
if (file_exists($baseDir . '/src/Config/Database.php')) {
    require_once $baseDir . '/src/Config/Database.php';
}
if (file_exists($baseDir . '/src/Utils/Validator.php')) {
    require_once $baseDir . '/src/Utils/Validator.php';
}
if (file_exists($baseDir . '/src/Utils/Auth.php')) {
    require_once $baseDir . '/src/Utils/Auth.php';
}

// Initialize variables
$errors = [];
$success = false;
$name = '';
$email = '';
$role = 'student';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'] ?? 'student';

    // Basic validation (fallback if Validator class not available)
    if (strlen($name) < 2 || strlen($name) > 50) {
        $errors['name'] = 'Name must be 2-50 characters';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }

    if (strlen($password) < 8 || !preg_match('/\d/', $password)) {
        $errors['password'] = 'Password must be 8+ characters with at least 1 number';
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

    // If no errors, simulate successful registration
    if (empty($errors)) {
        // For demo purposes, we'll just set success and redirect
        // In a real app, you would save to database here
        $success = true;
        
        // Store user data in session
        $_SESSION['user'] = [
            'name' => $name,
            'email' => $email,
            'role' => $role
        ];
        
        // Redirect based on role after 2 seconds
        $redirectUrl = '';
        switch ($role) {
            case 'student':
                $redirectUrl = '../student/dashboard.php';
                break;
            case 'counsellor':
                $redirectUrl = '../counsellor/dashboard.php';
                break;
            case 'admin':
                $redirectUrl = '../admin/dashboard.php';
                break;
        }
        
        if ($redirectUrl) {
            header("Refresh: 2; url=$redirectUrl");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Elimu Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #007bff;
            --light-blue: #a3d8f4;
        }

        body {
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--primary-blue) 100%);
            min-height: 100vh;
            padding-top: 80px;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: var(--primary-blue) !important;
            font-weight: 600;
        }

        .nav-link {
            color: var(--primary-blue) !important;
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: var(--primary-blue) !important;
            color: white !important;
        }

        .header-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px 0;
            text-align: center;
            color: #fff;
            margin-bottom: 40px;
        }

        .header-section h1 {
            font-size: 2.5rem;
            margin: 0;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .header-section p {
            font-size: 1.1rem;
            margin: 10px 0 0;
            opacity: 0.9;
        }

        .graduation-cap {
            width: 60px;
            height: auto;
            margin-bottom: 15px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(45deg, var(--primary-blue), #0056b3);
            color: #fff;
            text-align: center;
            padding: 25px;
            border: none;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 400;
        }

        .card-body {
            padding: 40px;
        }

        .form-label {
            color: #555;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            background: white;
        }

        .btn-primary {
            background: var(--primary-blue);
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }

        .card-footer {
            background: #f8f9fa;
            border: none;
            padding: 20px;
            text-align: center;
            color: #666;
        }

        .card-footer a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            body {
                padding-top: 60px;
            }
            
            .header-section h1 {
                font-size: 2rem;
            }
            
            .card-body {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../../../public/index.php">
                <span>←</span> Back to Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="login.php">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="header-section">
        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjUwIiBoZWlnaHQ9IjUwIiByeD0iMTAiIGZpbGw9IndoaXRlIiBmaWxsLW9wYWNpdHk9IjAuOSIvPgo8cGF0aCBkPSJNMTUgMjBIMzVWMjJIMTVWMjBaIiBmaWxsPSIjNGY2ZmY3Ii8+CjxwYXRoIGQ9Ik0xNSAyNUgzNVYyN0gxNVYyNVoiIGZpbGw9IiM0ZjZmZjciLz4KPHA=" alt="Graduation Cap" class="graduation-cap">
        <h1>Elimu Hub</h1>
        <p>Educational Path Simulator for Kenyan Higher Learning Institutions</p>
    </header>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Your Account</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($success): ?>
                            <div class="alert alert-success text-center">
                                <strong>Registration successful!</strong><br>
                                Redirecting to your dashboard...
                            </div>
                        <?php else: ?>
                            <?php if (!empty($errors['database'])): ?>
                                <div class="alert alert-danger text-center"><?= htmlspecialchars($errors['database']) ?></div>
                            <?php endif; ?>

                            <form method="POST" action="register.php" id="registerForm" novalidate>
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                                           id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
                                    <?php if (isset($errors['name'])): ?>
                                        <div class="invalid-feedback"><?= htmlspecialchars($errors['name']) ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                                           id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                                    <div class="invalid-feedback" id="emailFeedback"></div>
                                    <?php if (isset($errors['email'])): ?>
                                        <div class="invalid-feedback"><?= htmlspecialchars($errors['email']) ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" 
                                           id="password" name="password" required>
                                    <div class="invalid-feedback" id="passwordFeedback"></div>
                                    <?php if (isset($errors['password'])): ?>
                                        <div class="invalid-feedback"><?= htmlspecialchars($errors['password']) ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>" 
                                           id="confirm_password" name="confirm_password" required>
                                    <div class="invalid-feedback" id="confirmPasswordFeedback"></div>
                                    <?php if (isset($errors['confirm_password'])): ?>
                                        <div class="invalid-feedback"><?= htmlspecialchars($errors['confirm_password']) ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="role" class="form-label">I am a:</label>
                                    <select class="form-select" id="role" name="role">
                                        <option value="student" <?= $role === 'student' ? 'selected' : '' ?>>Student</option>
                                        <option value="counsellor" <?= $role === 'counsellor' ? 'selected' : '' ?>>Counsellor</option>
                                        <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>Administrator</option>
                                    </select>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Create Account</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        Already have an account? <a href="login.php">Log in here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('registerForm');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');
            const emailFeedback = document.getElementById('emailFeedback');
            const passwordFeedback = document.getElementById('passwordFeedback');
            const confirmPasswordFeedback = document.getElementById('confirmPasswordFeedback');

            function validateEmail() {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email.value)) {
                    email.classList.add('is-invalid');
                    emailFeedback.textContent = 'Please enter a valid email address';
                    return false;
                }
                email.classList.remove('is-invalid');
                emailFeedback.textContent = '';
                return true;
            }

            function validatePassword() {
                const passwordPattern = /^(?=.*\d).{8,}$/;
                if (!passwordPattern.test(password.value)) {
                    password.classList.add('is-invalid');
                    passwordFeedback.textContent = 'Password must be 8+ characters with at least 1 number';
                    return false;
                }
                password.classList.remove('is-invalid');
                passwordFeedback.textContent = '';
                return true;
            }

            function validateConfirmPassword() {
                if (confirmPassword.value !== password.value) {
                    confirmPassword.classList.add('is-invalid');
                    confirmPasswordFeedback.textContent = 'Passwords do not match';
                    return false;
                }
                confirmPassword.classList.remove('is-invalid');
                confirmPasswordFeedback.textContent = '';
                return true;
            }

            email.addEventListener('input', validateEmail);
            password.addEventListener('input', validatePassword);
            confirmPassword.addEventListener('input', validateConfirmPassword);

            form.addEventListener('submit', function (e) {
                const isEmailValid = validateEmail();
                const isPasswordValid = validatePassword();
                const isConfirmPasswordValid = validateConfirmPassword();

                if (!isEmailValid || !isPasswordValid || !isConfirmPasswordValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>