<?php
session_start();

// Middleware class to check if the user is logged in
class Middleware {

        public static function auth() {
            
            // Check if the user is logged in
            if (! isset($_SESSION['user'])) {
                header("Location: index.php"); 
                exit();
            }

        }

        public static function admin() {
            
            self::auth(); // Ensure user is logged in first
            if ($_SESSION['role'] !== 'admin') {
                echo "Access Denied: Admins only.";
                sleep(3);
                header("Location: index.php"); 
                exit();
            }

        }
        
}


?>
