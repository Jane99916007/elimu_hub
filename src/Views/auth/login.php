<?php
// File: src/Views/auth/login.php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';
    
    // Validate credentials (in a real app, this would check against a database)
    $demoCredentials = [
        'student@elimu.com' => ['password' => 'student123', 'role' => 'student'],
        'admin@elimu.com' => ['password' => 'admin123', 'role' => 'admin'],
        'counsellor@elimu.com' => ['password' => 'counsellor123', 'role' => 'counsellor']
    ];
    
    if (isset($demoCredentials[$email]) && 
        $demoCredentials[$email]['password'] === $password && 
        $demoCredentials[$email]['role'] === $role) {
        
        // Store user data in session
        $_SESSION['user'] = [
            'email' => $email,
            'role' => $role
        ];
        
        // Redirect based on role
        switch($role) {
            case 'student':
                header('Location: ../student/dashboard.php');
                exit;
            case 'admin':
                header('Location: ../admin/dashboard.php');
                exit;
            case 'counsellor':
                header('Location: ../counsellor/dashboard.php');
                exit;
        }
    } else {
        $error = "Invalid credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimu Hub - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #a8d4f0 0%, #d4e7f7 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .nav-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .nav-bar .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-bar .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: #4f6ff7;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-bar .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-bar .nav-links a {
            color: #4f6ff7;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-bar .nav-links a:hover {
            background: #4f6ff7;
            color: white;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
            margin-top: 120px;
        }

        .header img {
            width: 50px;
            height: 50px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: white;
            font-size: 3rem;
            font-weight: 300;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            font-weight: 300;
        }

        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 0;
            width: 100%;
            max-width: 450px;
            overflow: hidden;
        }

        .login-header {
            background: #4f6ff7;
            color: white;
            text-align: center;
            padding: 25px;
            font-size: 1.5rem;
            font-weight: 400;
        }

        .login-form {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            background: #f8f9fa;
        }

        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            background: #f8f9fa;
            cursor: pointer;
        }

        .form-group select:focus {
            outline: none;
            border-color: #4f6ff7;
            background: white;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4f6ff7;
            background: white;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 30px;
        }

        .forgot-password a {
            color: #4f6ff7;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            background: #4f6ff7;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }

        .login-btn:hover {
            background: #3d5af1;
        }

        .signup-link {
            text-align: center;
            padding: 20px;
            border-top: 1px solid #e1e5e9;
            background: #f8f9fa;
            color: #666;
            font-size: 0.95rem;
        }

        .signup-link a {
            color: #4f6ff7;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #e74c3c;
            background-color: #fdecea;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .nav-bar .container {
                flex-direction: column;
                gap: 10px;
            }
            
            .header {
                margin-top: 140px;
            }
            
            .header h1 {
                font-size: 2.5rem;
            }
            
            .login-form {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <div class="nav-bar">
        <div class="container">
            <a href="../../../public/index.php" class="logo">
                <span>←</span> Back to Dashboard
            </a>
            <div class="nav-links">
                <a href="register.php">Register</a>
            </div>
        </div>
    </div>

    <div class="header">
        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjUwIiBoZWlnaHQ9IjUwIiByeD0iMTAiIGZpbGw9IndoaXRlIiBmaWxsLW9wYWNpdHk9IjAuOSIvPgo8cGF0aCBkPSJNMTUgMjBIMzVWMjJIMTVWMjBaIiBmaWxsPSIjNGY2ZmY3Ii8+CjxwYXRoIGQ9Ik0xNSAyNUgzNVYyN0gxNVYyNVoiIGZpbGw9IiM0ZjZmZjciLz4KPHA=" alt="Graduation Cap">
        <h1>Elimu Hub</h1>
        <p>Educational Path Simulator for Kenyan Higher Learning Institutions</p>
    </div>

    <div class="login-container">
        <div class="login-header">
            Welcome Back
        </div>
        
        <form class="login-form" method="POST" action="login.php">
            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="role">I am a:</label>
                <select id="role" name="role" required>
                    <option value="">Select your role</option>
                    <option value="student" <?php echo (isset($_POST['role']) && $_POST['role'] === 'student') ? 'selected' : ''; ?>>Student</option>
                    <option value="admin" <?php echo (isset($_POST['role']) && $_POST['role'] === 'admin') ? 'selected' : ''; ?>>Administrator</option>
                    <option value="counsellor" <?php echo (isset($_POST['role']) && $_POST['role'] === 'counsellor') ? 'selected' : ''; ?>>Counsellor</option>
                </select>
            </div>

            <div class="forgot-password">
                <a href="forgot-password.php">Forgot Password?</a>
            </div>

            <button type="submit" class="login-btn">Log In</button>
        </form>

        <div class="signup-link">
            Don't have an account? <a href="register.php">Sign up</a>
        </div>
    </div>
</body>
</html>