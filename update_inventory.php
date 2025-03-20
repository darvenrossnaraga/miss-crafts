<?php 

require '../database/connection.php';

$database = new Database();
$conn = $database->getConnection();

//var_dump('but why') and die;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_stock'])) {

    //var_dump('but why here') and die;

    try {
        foreach ($_POST['stock_quantity'] as $material_id => $new_stock_quantity) {

            $query = "UPDATE inventory SET stock_quantity = :stock_quantity 
                      WHERE package_material_id IN (SELECT id FROM package_materials WHERE material_id = :material_id)";


            $stmt = $conn->prepare($query);
            $stmt->execute([
                'stock_quantity' => $new_stock_quantity,
                'material_id' => $material_id
            ]);

            echo "<script>console.log('".$new_stock_quantity." and material id is ".$material_id."')</script>";
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    header("Location: ../product_sales_inventory.php");
    exit();
}
else
{
    http_response_code(404);
}