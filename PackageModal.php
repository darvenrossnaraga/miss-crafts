<?php 

require_once 'functions/PackagesController.php';
require_once 'functions/ProductsController.php';

$package = new Packages();
$products = new Products();

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
        case 'add_package':
            $response = $package->addPackage($_POST['package_name'], $_POST['package_id']);
            break;
        case 'edit_package':
            $response = $package->updatePackage($_POST['edit_package_id'], $_POST['edit_package_name'], $_POST['edit_product_id']);
            break;
        case 'delete_package':
            $response = $package->deletePackage($_POST['delete_package_id']);
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


<!-- Add Modal -->
<dialog id="add_packageModal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Add New Package</h3>
        <form method="post">
            <div class="py-4">
                <!-- Package Name Input -->
                <label for="package_name" class="block text-sm font-medium text-gray-700">Package Name</label>
                <input type="text" id="package_name" name="package_name" class="input input-bordered w-full mt-1" required>

                <!-- package ID Dropdown -->
                <label for="package_id" class="block text-sm font-medium text-gray-700 mt-3">Select Product to Package</label>
                <select id="package_id" name="package_id" class="select select-bordered w-full mt-1" required>
                    <option value="">-- Select Product to Package --</option>

                    <?php foreach ($products->getProducts() as $product) { ?>
                        <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
                    <?php } ?>
                  
                </select>

                <input type="hidden" name="data" value="add_package">
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-success">Add Package</button>
                <button type="button" class="btn btn-error" onclick="add_packageModal.close()">Close</button>
            </div>
        </form>
    </div>
</dialog>


<!-- Edit Modal -->
<dialog id="edit_packageModal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Edit Package</h3>
        <form method="post">
            <div class="py-4">
                <!-- Package Name Input -->
                <label for="package_name" class="block text-sm font-medium text-gray-700">Package Name</label>
                <input type="text" id="edit_package_name" name="edit_package_name" class="input input-bordered w-full mt-1" required>

                <!-- package ID Dropdown -->
                <label for="package_id" class="block text-sm font-medium text-gray-700 mt-3">Select Product to Package</label>
                <select id="edit_product_id" name="edit_product_id" class="select select-bordered w-full mt-1" required>
                    <option value="">-- Select Product From the Package --</option>

                    <?php foreach ($products->getProducts() as $product) { ?>
                        <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
                    <?php } ?>
                  
                </select>

                <input type="hidden" name="data" value="edit_package">
                <input type="hidden" id="edit_package_id" name="edit_package_id" value="edit_package_id">
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-success">Edit Package</button>
                <button type="button" class="btn btn-error" onclick="edit_packageModal.close()">Close</button>
            </div>
        </form>
    </div>
</dialog>


<!-- Delete Modal -->
<dialog id="delete_PackageModal" class="modal">
    <div class="modal-box text-center">
        <h3 class="text-lg font-bold">Are you sure you want to delete this Package?</h3>
        <form method="post" class="text-center">
            <div class="py-4">
                <input type="hidden" id="delete_package_id" name="delete_package_id">
                <input type="hidden" name="data" value="delete_package">
            </div>
            <div class="modal-action justify-center">
                <button type="submit" class="btn btn-success">🚮 Yes, Delete</button>
                <button type="button" class="btn btn-error" onclick="delete_ProductModal.close()">❌ Cancel</button>
            </div>
        </form>
    </div>
</dialog>
