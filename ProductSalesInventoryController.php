<?php 

require_once 'database/connection.php';

class ProductSalesInventory {

    public function getProductSalesInventory() {

        $database = new Database();
        $conn = $database->getConnection();
    
        $query = "SELECT 
                    pr.id AS product_id,
                    p.id AS package_id, 
                    p.name AS package_name, 
                    pr.name AS product_name
                  FROM packages p
                  LEFT JOIN products pr ON p.product_id = pr.id";
    
        $stmt = $conn->prepare($query);
        $stmt->execute();
    
        $product_packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $database->closeConnection();
    
        return $product_packages;
    }
    

    function getMaterialsByProductAndPackage($product_id, $package_id) {
       
        $database = new Database();
        $conn = $database->getConnection();
    
            // Fetch materials for the selected product & package
            $database = new Database();
            $conn = $database->getConnection();

            $query = "SELECT 
                        pm.id AS package_material_id,
                        m.id AS material_id,
                        m.name AS material_name,
                        i.stock_quantity,
                        p.name AS package_name,
                        pr.name AS product_name
                    FROM package_materials pm
                    LEFT JOIN materials m ON pm.material_id = m.id
                    LEFT JOIN inventory i ON i.package_material_id = pm.id
                    LEFT JOIN packages p ON pm.package_id = p.id
                    LEFT JOIN products pr ON pm.product_id = pr.id
                    WHERE pm.product_id = :product_id AND pm.package_id = :package_id";

            $stmt = $conn->prepare($query);
            $stmt->execute([
                'product_id' => $product_id,
                'package_id' => $package_id
            ]);

        $inventoryMaterials = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all materials

        $database->closeConnection();

        return $inventoryMaterials;

    }

    function getInventoryDetails($product_id, $package_id) {
        require 'functions/Database.php';
        $database = new Database();
        $conn = $database->getConnection();
    
        $query = "SELECT 
                    pm.id AS package_material_id,
                    m.id AS material_id,
                    m.name AS material_name,
                    i.stock_quantity,
                    p.name AS package_name,
                    pr.name AS product_name
                  FROM package_materials pm
                  LEFT JOIN materials m ON pm.material_id = m.id
                  LEFT JOIN inventory i ON i.package_material_id = pm.id
                  LEFT JOIN packages p ON pm.package_id = p.id
                  LEFT JOIN products pr ON pm.product_id = pr.id
                  WHERE pm.product_id = :product_id AND pm.package_id = :package_id";
    
        $stmt = $conn->prepare($query);
        $stmt->execute([
            'product_id' => $product_id,
            'package_id' => $package_id
        ]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Returns multiple materials under the same product & package
    }
    


}