<?php
// Static utility class for validating passwords
// must be 16-30 characters, 1+ symbol, 1+ upper, 1+ lower, 1+ number
class PasswordManager {

    public static function isValid(string $password) : bool {
        // TODO: logic to verify that the password passed is valid
        return true;
    }

    private function validLength(string $password) : bool {
        // TODO: logic to verify that password is a valid length
        return true;
    }

    private function validCharacters(string $password) : bool {
        // TODO: logic to verify password contains required characters
        return true;
    }
}