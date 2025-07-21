<?php
// File: src/Utils/Auth.php

class Auth {
    private static $secret_key = "ElimuHub_Secret_Key_123!";
    
    public static function verifyRole(string $requiredRole): void {
        session_start();
        
        if (!isset($_SESSION['user'])) {
            header("Location: /login.php");
            exit();
        }
        
        if ($_SESSION['user']['role'] !== $requiredRole) {
            header("HTTP/1.1 403 Forbidden");
            echo "You don't have permission to access this page";
            exit();
        }
    }

    public static function redirectToDashboard(string $role): void {
        switch ($role) {
            case 'student':
                header("Location: /student/dashboard.php");
                break;
            case 'counsellor':
                header("Location: /counsellor/dashboard.php");
                break;
            case 'admin':
                header("Location: /admin/dashboard.php");
                break;
            default:
                header("Location: /login.php");
        }
        exit();
    }
}