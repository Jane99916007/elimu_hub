<?php
// File: src/Views/auth/logout.php
session_start();

// Store logout message
$_SESSION['logout_message'] = 'You have been successfully logged out.';

// Clear user session
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

// Redirect to home page
header('Location: ../../../public/index.php');
exit();
?>