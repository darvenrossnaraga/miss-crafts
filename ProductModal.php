<?php 

require_once 'functions/ProductsController.php';

$product = new Products();

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
        case 'add_product':
           $response = $product->addProduct($_POST['product_name']);
            break;
        case 'edit_product':
            $response = $product->UpdateProductData($_POST['edit_product_id'], $_POST['edit_product_name']);
            break;
        case 'delete_product':
            $response = $product->deleteProduct($_POST['delete_product_id']);
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
<dialog id="add_ProductModal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Add New Product</h3>
        <form method="post">
            <div class="py-4">
                <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" id="product_name" name="product_name" class="input input-bordered w-full mt-1" required>
                <input type="hidden" name="data" value="add_product">
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-success">Add Product</button>
                <button type="button" class="btn btn-error" onclick="add_ProductModal.close()">Close</button>
            </div>
        </form>
    </div>
</dialog>


<!-- Edit Modal -->
<dialog id="edit_ProductModal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Edit New Product</h3>
        <form method="post">
            <div class="py-4">
                <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" id="edit_product_name" name="edit_product_name" class="input input-bordered w-full mt-1" required>
                <input type="hidden" id="edit_product_id" name="edit_product_id">
                <input type="hidden" name="data" value="edit_product">
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-success">Add Product</button>
                <button type="button" class="btn btn-error" onclick="edit_ProductModal.close()">Close</button>
            </div>
        </form>
    </div>
</dialog>


<!-- Delete Modal -->
<dialog id="delete_ProductModal" class="modal">
    <div class="modal-box text-center">
        <h3 class="text-lg font-bold">Are you sure you want to delete this product?</h3>
        <form method="post" class="text-center">
            <div class="py-4">
                <input type="hidden" id="delete_product_id" name="delete_product_id">
                <input type="hidden" name="data" value="delete_product">
            </div>
            <div class="modal-action justify-center">
                <button type="submit" class="btn btn-success">🚮 Yes, Delete</button>
                <button type="button" class="btn btn-error" onclick="delete_ProductModal.close()">❌ Cancel</button>
            </div>
        </form>
    </div>
</dialog>
