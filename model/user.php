<?php

include_once 'config/conn.php';

class User {
    static function login($data=[]) {
        extract($data);
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];
            if (password_verify($password, $hashedPassword)) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    static function register($data=[]) {
        extract($data);
        global $conn;

        $inserted_at = date('Y-m-d H:i:s');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, inserted_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $name, $email, $hashedPassword, $inserted_at);
        $stmt->execute();

        return $stmt->affected_rows === 1 ? true : false;
    }

    static function getPassword($email) { 
        global $conn;
        $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows === 1 ? true : false;
    }

    static function update($data=[]) {}

    static function delete($id='') {}
}
?>
