<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include required files
$baseDir = dirname(__DIR__, 2);
require_once $baseDir . '/src/Config/Database.php';
require_once $baseDir . '/src/Utils/Validator.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $role = $_POST['role'] ?? 'student';
    
    // Initialize errors array
    $errors = [];
    
    // Validate inputs
    if (!Validator::validateName($name)) {
        $errors['name'] = 'Name must be 2-50 characters';
    }

    if (!Validator::validateEmail($email)) {
        $errors['email'] = 'Invalid email format';
    }

    if (!Validator::validatePassword($password)) {
        $errors['password'] = 'Password must be 8+ characters with at least 1 number';
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

    if (!in_array($role, ['student', 'counsellor', 'admin'])) {
        $errors['role'] = 'Invalid role selected';
    }
    
    // If no validation errors, attempt to register
    if (empty($errors)) {
        try {
            $db = Database::getConnection();
            
            // Check if email already exists
            $stmt = $db->prepare("SELECT user_id FROM Users WHERE email = ?");
            $stmt->bindValue(1, $email, PDO::PARAM_STR);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $errors['email'] = 'Email already registered';
            } else {
                // Hash password and insert new user
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                
                $stmt = $db->prepare("INSERT INTO Users (name, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())");
                $stmt->bindValue(1, $name, PDO::PARAM_STR);
                $stmt->bindValue(2, $email, PDO::PARAM_STR);
                $stmt->bindValue(3, $hashed_password, PDO::PARAM_STR);
                $stmt->bindValue(4, $role, PDO::PARAM_STR);
                
                if ($stmt->execute()) {
                    // Get the new user ID
                    $user_id = $db->lastInsertId();
                    
                    // Store user data in session
                    $_SESSION['user'] = [
                        'user_id' => $user_id,
                        'name' => $name,
                        'email' => $email,
                        'role' => $role
                    ];
                    
                    // Set success message
                    $_SESSION['registration_success'] = true;
                    
                    // Redirect based on role
                    switch($role) {
                        case 'student':
                            header('Location: student-dashboard.php');
                            exit();
                        case 'counsellor':
                            header('Location: counsellor-dashboard.php');
                            exit();
                        case 'admin':
                            header('Location: admin-dashboard.php');
                            exit();
                        default:
                            $errors['database'] = 'Invalid role specified';
                            break;
                    }
                } else {
                    $errors['database'] = 'Registration failed. Please try again.';
                }
            }
        } catch (Exception $e) {
            $errors['database'] = 'Registration error: ' . $e->getMessage();
        }
    }
    
    // If we reach here, there were errors - store them in session and redirect back
    if (!empty($errors)) {
        $_SESSION['registration_errors'] = $errors;
        $_SESSION['registration_form_data'] = [
            'name' => $name,
            'email' => $email,
            'role' => $role
        ];
        header('Location: register.php');
        exit();
    }
    
} else {
    // If not POST request, redirect to register
    header('Location: register.php');
    exit();
}
?>