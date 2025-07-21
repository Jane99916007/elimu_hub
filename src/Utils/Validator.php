<?php
// File: src/Utils/Validator.php

namespace ElimuHub\Utils;

class Validator {
    public static function validateName(string $name): bool {
        return preg_match('/^[a-zA-Z\s]{2,50}$/', $name);
    }

    public static function validateEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validatePassword(string $password): bool {
        return preg_match('/^(?=.*\d).{8,}$/', $password);
    }
}