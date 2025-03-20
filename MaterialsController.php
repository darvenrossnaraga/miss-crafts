
<?php 

require_once 'database/connection.php';

class Materials {

    public function countTotalMaterials() {

        $database = new Database();
        $conn = $database->getConnection();
    
        $query = "SELECT COUNT(*) AS total_materials FROM materials";
    
        $stmt = $conn->prepare($query);
        $stmt->execute();
    
        $total_materials = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $database->closeConnection();
    
        return $total_materials;
    }

    public function getMaterials() {

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "SELECT * FROM materials";
        
        $stmt = $conn->prepare($query);
        
        $stmt->execute();
        
        $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $database->closeConnection();
        
        return $packages;
    }

    public function addMaterial($name, $unit) {
        
        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "INSERT INTO materials (name, unit) VALUES (:name, :unit)";
        
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':unit', $unit);
        
        $stmt->execute();

        $database->closeConnection();

        $_SESSION['message'] = 'Material Added Successfully';
        
        return 'success';

    }

    public function updateMaterial($id, $name, $product_id) {

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "UPDATE materials SET name = :name, unit = :unit WHERE id = :id";
        
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':unit', $product_id);
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();

        $database->closeConnection();

        $_SESSION['message'] = 'Materials Updated Successfully';
        
        return 'success';

    }

    public function deleteMaterial($id) {

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "DELETE FROM materials WHERE id = :id";
        
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();

        $database->closeConnection();

        $_SESSION['message'] = 'Material Deleted Successfully';
        
        return 'success';

    }


}