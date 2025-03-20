<?php

include 'database/connection.php';

try {
   
    $conn = new Database();

    $pdo = $conn->getConnection();

    // User details
    $name = "femcelz";
    $username = "admin";
    $password = "admin123"; // Plaintext password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $role = "admin";
    $created_at = date("Y-m-d");
    $updated_at = date("Y-m-d");

    // Insert query
    $sql = "INSERT INTO users (name, username, password, role, created_at, updated_at) 
            VALUES (:name, :username, :password, :role, :created_at, :updated_at)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'username' => $username,
        'password' => $hashedPassword,
        'role' => $role,
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ]);

    echo "User inserted successfully!";

    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
