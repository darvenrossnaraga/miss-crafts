<?php 

require_once 'database/connection.php';

class PackageMaterials {

    public function getPackageMaterials() {

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "SELECT 
                    package_materials.id as package_material_id,
                    products.id AS product_id,
                    packages.id AS package_id,
                    materials.id AS material_id,
                    products.name AS product_name,
                    packages.name AS package_name,
                    materials.name AS material_name
                FROM package_materials
                LEFT JOIN products ON package_materials.product_id = products.id
                LEFT JOIN packages ON package_materials.package_id = packages.id
                LEFT JOIN materials ON package_materials.material_id = materials.id;";
        
        $stmt = $conn->prepare($query);
        
        $stmt->execute();
        
        $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $database->closeConnection();
        
        return $packages;
    }

    public function addPackageMaterial($package_id, $product_id, $material_id) {
        
        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "INSERT INTO package_materials (package_id, product_id, material_id) VALUES (:package_id, :product_id, :material_id)";
        
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':package_id', $package_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':material_id', $material_id);
        
        $stmt->execute();

        $package_material_id = $conn->lastInsertId();

        $inventory_query = "INSERT INTO inventory (package_material_id, stock_quantity) VALUES (:package_material_id, 0)";
        $inventory_stmt = $conn->prepare($inventory_query);
        $inventory_stmt->bindParam(':package_material_id', $package_material_id);
        $inventory_stmt->execute();

        $database->closeConnection();

        $_SESSION['message'] = 'Product Added Successfully';
        
        return 'success';

    }


    public function editPackageMaterial($package_material_id, $package_id, $product_id, $material_id) {

        $database = new Database();
        $conn = $database->getConnection();

        $query = "UPDATE package_materials SET package_id = :package_id, product_id = :product_id, material_id = :material_id WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':package_id', $package_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':material_id', $material_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $package_material_id, PDO::PARAM_INT);

        $stmt->execute();

        $database->closeConnection();

        $_SESSION['message'] = 'Product Updated Successfully';

        return 'success';

    }

    public function deletePackageMaterial ($package_material_id) {

        $database = new Database();
        $conn = $database->getConnection();

        $query = "DELETE FROM package_materials WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id', $package_material_id, PDO::PARAM_INT);

        $stmt->execute();

        $database->closeConnection();

        $_SESSION['message'] = 'Product Deleted Successfully';

        return 'success';

    }


}