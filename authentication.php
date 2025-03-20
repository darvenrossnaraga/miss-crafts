<?php
session_start();

class Authentication {
    
    public static function login($username, $password) {
        require 'database/connection.php';
        
        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "SELECT * FROM users WHERE username = :username";
        
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':username', $username);
        
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            header("Location: dashboard.php");
        } else {
            $_SESSION['message'] = "Invalid username or password";
        }
    }
    
    public static function logout() {
        session_destroy();
        header("Location: ../index.php");
    }

    public static function register($username, $password) {
        require 'database/connection.php';
        
        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
        
        $stmt = $conn->prepare($query);
        
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        
        if ($stmt->execute()) {
            echo "Registration successful";
        } else {
            echo "Registration failed";
        }
    }
    
}



?>