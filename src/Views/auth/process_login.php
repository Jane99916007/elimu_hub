<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection and utilities
$baseDir = dirname(__DIR__, 2);
require_once $baseDir . '/src/Config/Database.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';
    
    // Initialize error message
    $error = '';
    
    // Basic validation
    if (empty($email) || empty($password) || empty($role)) {
        $error = "All fields are required.";
    } else {
        try {
            // Get database connection
            $db = Database::getConnection();
            
            // Prepare and execute query to find user
            $stmt = $db->prepare("SELECT user_id, name, email, password, role FROM Users WHERE email = ? AND role = ?");
            $stmt->bindValue(1, $email, PDO::PARAM_STR);
            $stmt->bindValue(2, $role, PDO::PARAM_STR);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Store user data in session
                    $_SESSION['user'] = [
                        'user_id' => $user['user_id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'role' => $user['role']
                    ];
                    
                    // Redirect based on role
                    switch($user['role']) {
                        case 'student':
                            header('Location: student-dashboard.php');
                            exit();
                        case 'admin':
                            header('Location: admin-dashboard.php');
                            exit();
                        case 'counsellor':
                            header('Location: counsellor-dashboard.php');
                            exit();
                        default:
                            $error = "Invalid role specified.";
                            break;
                    }
                } else {
                    $error = "Invalid email or password.";
                }
            } else {
                $error = "No account found with this email and role combination.";
            }
            
        } catch (Exception $e) {
            $error = "Login error: " . $e->getMessage();
        }
    }
    
    // If we reach here, there was an error - redirect back to login with error
    if (!empty($error)) {
        $_SESSION['login_error'] = $error;
        $_SESSION['login_form_data'] = [
            'email' => $email,
            'role' => $role
        ];
        header('Location: login.php');
        exit();
    }
} else {
    // If not POST request, redirect to login
    header('Location: login.php');
    exit();
}
?>