<?php 

require_once 'functions/PackagesController.php';
require_once 'functions/ProductsController.php';
require_once 'functions/MaterialsController.php';
require_once 'functions/PackageMaterialsController.php';


$packages = new Packages();
$products = new Products();
$materials = new Materials();
$package_materials = new PackageMaterials();

if (isset($_SESSION['token']) || isset($_GET['token'])) {
    if (isset($_SESSION['token']) && isset($_GET['token']) && $_SESSION['token'] === $_GET['token']) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
} else {
    $_SESSION['token'] = generateRandomString(15);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    serialize(array_values($_POST));
    $data = $_POST['data'] ?? '';

    switch ($data) {
        case 'add_package_material':
            $response = $package_materials->addPackageMaterial($_POST['package_id'], $_POST['product_id'], $_POST['material_id']);
            break;
        case 'edit_package_material':
            $response = $package_materials->editPackageMaterial($_POST['edit_package_material_id'], $_POST['edit_package_id'], $_POST['edit_product_id'], $_POST['edit_material_id']);
            break;
        case 'delete_package':
             $response = $package_materials->deletePackageMaterial($_POST['delete_package_material_id']);
            break;
    }

    $_SESSION['token'] = generateRandomString(15);

     // Move the redirect here after processing the request
     header("Location: " . $_SERVER['PHP_SELF'] . "?response=" . urlencode($response) . "&token=" . $_SESSION['token']);
     exit();
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


<!-- Add Package Material Modal -->
<dialog id="add_package_MaterialModal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Add Package Material</h3>
        <form method="post">
            <div class="py-4">
                <!-- Select Product -->
                <label for="product_id" class="block text-sm font-medium text-gray-700">Select Product</label>
                <select id="product_id" name="product_id" class="select select-bordered w-full mt-1" required>
                    <option value="">-- Select Product --</option>
                    <?php foreach ($products->getProducts() as $product) { ?>
                        <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
                    <?php } ?>
                </select>

                <!-- Select Package -->
                <label for="package_id" class="block text-sm font-medium text-gray-700 mt-3">Select Package</label>
                <select id="package_id" name="package_id" class="select select-bordered w-full mt-1" required>
                    <option value="">-- Select Package --</option>
                    <?php foreach ($packages->getPackages() as $package) { ?>
                        <option value="<?= $package['package_id'] ?>"><?= $package['package_name'] ?></option>
                    <?php } ?>
                </select>

                <!-- Select Material -->
                <label for="material_id" class="block text-sm font-medium text-gray-700 mt-3">Select Material</label>
                <select id="material_id" name="material_id" class="select select-bordered w-full mt-1" required>
                    <option value="">-- Select Material --</option>
                    <?php foreach ($materials->getMaterials() as $material) { ?>
                        <option value="<?= $material['id'] ?>"><?= $material['name'] ?></option>
                    <?php } ?>
                </select>

                <input type="hidden" name="data" value="add_package_material">
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-success">Add Package Material</button>
                <button type="button" class="btn btn-error" onclick="add_package_MaterialModal.close()">Close</button>
            </div>
        </form>
    </div>
</dialog>


<!-- Edit Package Material Modal -->
<dialog id="edit_package_MaterialModal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Add Package Material</h3>
        <form method="post">
            <div class="py-4">
                <!-- Select Product -->
                <label for="product_id" class="block text-sm font-medium text-gray-700">Select Product</label>
                <select id="edit_product_id" name="edit_product_id" class="select select-bordered w-full mt-1" required>
                    <option value="">-- Select Product --</option>
                    <?php foreach ($products->getProducts() as $product) { ?>
                        <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
                    <?php } ?>
                </select>

                <!-- Select Package -->
                <label for="package_id" class="block text-sm font-medium text-gray-700 mt-3">Select Package</label>
                <select id="edit_package_id" name="edit_package_id" class="select select-bordered w-full mt-1" required>
                    <option value="">-- Select Package --</option>
                    <?php foreach ($packages->getPackages() as $package) { ?>
                        <option value="<?= $package['package_id'] ?>"><?= $package['package_name'] ?></option>
                    <?php } ?>
                </select>

                <!-- Select Material -->
                <label for="material_id" class="block text-sm font-medium text-gray-700 mt-3">Select Material</label>
                <select id="edit_material_id" name="edit_material_id" class="select select-bordered w-full mt-1" required>
                    <option value="">-- Select Material --</option>
                    <?php foreach ($materials->getMaterials() as $material) { ?>
                        <option value="<?= $material['id'] ?>"><?= $material['name'] ?></option>
                    <?php } ?>
                </select>

                <input type="hidden" name="data" value="edit_package_material">
                <input type="hidden" id="edit_package_material_id" name="edit_package_material_id" value="edit_package_material_id">
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-success">Edit Package Material</button>
                <button type="button" class="btn btn-error" onclick="edit_package_MaterialModal.close()">Close</button>
            </div>
        </form>
    </div>
</dialog>



<!-- Delete Modal -->
<dialog id="delete_PackageMaterialmodal" class="modal">
    <div class="modal-box text-center">
        <h3 class="text-lg font-bold">Are you sure you want to delete this Package Material?</h3>
        <form method="post" class="text-center">
            <div class="py-4">
                <input type="hidden" id="delete_package_material_id" name="delete_package_material_id">
                <input type="hidden" name="data" value="delete_package">
            </div>
            <div class="modal-action justify-center">
                <button type="submit" class="btn btn-success">🚮 Yes, Delete</button>
                <button type="button" class="btn btn-error" onclick="delete_ProductModal.close()">❌ Cancel</button>
            </div>
        </form>
    </div>
</dialog>