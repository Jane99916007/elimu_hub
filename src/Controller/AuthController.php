<?php
namespace ElimuHub\Controllers;

use ElimuHub\Models\User;
use ElimuHub\Utils\Auth;

class AuthController {
    public function login() {
        // Validate input
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';
        
        // Authenticate
        $user = (new User())->authenticate($email, $password);
        
        if ($user) {
            $jwt = Auth::generateJWT($user);
            setcookie('elimu_token', $jwt, [
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            header('Location: /dashboard');
        }
    }
}
?>