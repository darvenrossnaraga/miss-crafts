<?php 

require_once 'database/connection.php';

class Packages {

    public function countTotalPackages() {

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "SELECT COUNT(*) as total_packages FROM packages";
        
        $stmt = $conn->prepare($query);
        
        $stmt->execute();
        
        $total_packages = $stmt->fetch(PDO::FETCH_ASSOC);

        $database->closeConnection();
        
        return $total_packages;
    }


    public function getPackages() {

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "SELECT    packages.id as package_id,
                            packages.name as package_name,
                            products.name as product_name,
                            products.id as product_id
                 FROM packages
                 INNER JOIN products
                 ON products.id = packages.product_id";
        
        $stmt = $conn->prepare($query);
        
        $stmt->execute();
        
        $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $database->closeConnection();
        
        return $packages;
    }

    public function addPackage($name, $product_id) {
        
        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "INSERT INTO packages (name, product_id) VALUES (:name, :product_id)";
        
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':product_id', $product_id);
        
        $stmt->execute();

        $database->closeConnection();

        $_SESSION['message'] = 'Product Added Successfully';
        
        return 'success';

    }

    public function updatePackage($id, $name, $product_id) {

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "UPDATE packages SET name = :name, product_id = :product_id WHERE id = :id";
        
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();

        $database->closeConnection();

        $_SESSION['message'] = 'Package Updated Successfully';
        
        return 'success';

    }

    public function deletePackage($id) {

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "DELETE FROM packages WHERE id = :id";
        
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();

        $database->closeConnection();

        $_SESSION['message'] = 'Package Deleted Successfully';
        
        return 'success';

    }


}