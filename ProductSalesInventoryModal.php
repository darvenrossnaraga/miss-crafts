<?php 

require_once 'functions/ProductSalesInventoryController.php';

$productSales = new ProductSalesInventory();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_stock'])) {
    
    serialize(array_values($_POST));

    //var_dump('ABOT BA NI '. $_POST['product_id'] . ' and this nigga: ' . $_POST['package_id']);

    $materials = $productSales->getMaterialsByProductAndPackage($_POST['product_id'], $_POST['package_id']);

   // var_dump($materials) and die;

    $_SESSION['token'] = generateRandomString(15);

}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}
?>

<?php if (!empty($materials)) { ?>
<dialog open id="editStockModal" class="modal">
    <div class="modal-box">
        <!-- Header: Product & Package Name -->
        <h3 class="text-lg font-bold">
            <?= htmlspecialchars($materials[0]['product_name']) ?> - 
            <?= htmlspecialchars($materials[0]['package_name']) ?>
        </h3>

        <h3 class="mt-10 text-lg font-bold">Overall Materials Left</h3>

        <hr>

       <!-- Body: Loop Through Materials -->
        <form method="post" action="functions/update_inventory.php">
            <?php foreach ($materials as $material) { ?>
                <div class="flex items-center justify-between p-2 border-b stock-container">
                    <span class="font-medium"><?= htmlspecialchars($material['material_name']) ?></span>
                    <div class="flex gap-2">
                        <button type="button" class="btn btn-error decrease-stock">-</button>
                        <input type="number" name="stock_quantity[<?= $material['material_id'] ?>]" class="input input-bordered text-center w-16 stock-input" value="<?= $material['stock_quantity'] ?>">
                        <button type="button" class="btn btn-success increase-stock">+</button>
                    </div>
                </div>
            <?php } ?>

            <div class="modal-action">
                <button type="submit" name="update_stock" class="btn btn-primary">Update Stock</button>
                <button type="button" class="btn btn-error" onclick="editStockModal.close()">Close</button>
            </div>
        </form>

    </div>
</dialog>
<?php } ?>
