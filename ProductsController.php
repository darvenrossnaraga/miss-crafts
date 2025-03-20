<?php

//error_reporting(0);


require_once 'database/connection.php';

class Products {

    
    public function countTotalProducts() {
        
        $database = new Database();
        $conn = $database->getConnection();
    
        $query = "SELECT COUNT(*) AS total_products FROM products";
    
        $stmt = $conn->prepare($query);
        $stmt->execute();
    
        $total_products = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $database->closeConnection();
    
        return $total_products;
    }

    public function getProducts() {

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "SELECT * FROM products";
        
        $stmt = $conn->prepare($query);
        
        $stmt->execute();
        
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $database->closeConnection();
        
        return $products;

    }

    public function UpdateProductData($id, $name) {

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "UPDATE products SET name = :name WHERE id = :id";
        
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();

        $database->closeConnection();

        $_SESSION['message'] = 'Product Updated Successfully';
        
        return 'success';

    }

    public function addProduct($name) {
        
        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "INSERT INTO products (name) VALUES (:name)";
        
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':name', $name);
        
        $stmt->execute();

        $database->closeConnection();

        $_SESSION['message'] = 'Product Edited Successfully';

        return 'success';

    }

    public function editProduct($id, $name) {
        
        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "UPDATE products SET name = :name WHERE id = :id";
        
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        
        $stmt->execute();

        $database->closeConnection();

    }

    public function deleteProduct($id) {
        
        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "DELETE FROM products WHERE id = :id";
        
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();

        $database->closeConnection();

    }
}
?>