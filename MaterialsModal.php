<?php 

require_once 'functions/MaterialsController.php';

$materials = new Materials();

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
        case 'add_material':
            $response = $materials->addMaterial($_POST['material_name'], $_POST['material_unit']);
            break;
        case 'edit_material':
            $response = $materials->updateMaterial($_POST['edit_material_id'], $_POST['edit_material_name'], $_POST['edit_material_unit']);
            break;
        case 'delete_material':
            $response = $materials->deleteMaterial($_POST['delete_material_id']);
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
<dialog id="add_Materialmodal" class="modal">
    <div class="modal-box p-6">
        <h3 class="text-lg font-bold mb-4">Add New Material</h3>
        <form method="post">
            <div class="py-4 space-y-4">
                <!-- Package Name Input -->
                <label for="material_name" class="block text-sm font-medium text-gray-700">Material Name</label>
                <input type="text" id="material_name" name="material_name" class="input input-bordered w-full mt-1" required>
                
                <label for="material_unit" class="block text-sm font-medium text-gray-700">Material Unit</label>
                <input type="text" id="material_unit" name="material_unit" class="input input-bordered w-full mt-1" required>

                <input type="hidden" name="data" value="add_material">
            </div>
            <div class="modal-action mt-6">
                <button type="submit" class="btn btn-success">Add Material</button>
                <button type="button" class="btn btn-error" onclick="add_Materialmodal.close()">Close</button>
            </div>
        </form>
    </div>
</dialog>


<!-- Edit Modal -->
<dialog id="edit_Materialmodal" class="modal">
    <div class="modal-box p-6">
        <h3 class="text-lg font-bold mb-4">Add New Material</h3>
        <form method="post">
            <div class="py-4 space-y-4">
                <!-- Package Name Input -->
                <label for="edit_material_name" class="block text-sm font-medium text-gray-700">Material Name</label>
                <input type="text" id="edit_material_name" name="edit_material_name" class="input input-bordered w-full mt-1" required>
                
                <label for="edit_material_unit" class="block text-sm font-medium text-gray-700">Material Unit</label>
                <input type="text" id="edit_material_unit" name="edit_material_unit" class="input input-bordered w-full mt-1" required>

                <input type="hidden" name="data" value="edit_material">
                <input type="hidden" id="edit_material_id" name="edit_material_id" value="edit_material_id">
            </div>
            <div class="modal-action mt-6">
                <button type="submit" class="btn btn-success">Edit Material</button>
                <button type="button" class="btn btn-error" onclick="edit_Materialmodal.close()">Close</button>
            </div>
        </form>
    </div>
</dialog>


<!-- Delete Modal -->
<dialog id="delete_Materialmodal" class="modal">
    <div class="modal-box text-center">
        <h3 class="text-lg font-bold">Are you sure you want to delete this Material?</h3>
        <form method="post" class="text-center">
            <div class="py-4">
                <input type="hidden" id="delete_material_id" name="delete_material_id">
                <input type="hidden" name="data" value="delete_material">
            </div>
            <div class="modal-action justify-center">
                <button type="submit" class="btn btn-success">🚮 Yes, Delete</button>
                <button type="button" class="btn btn-error" onclick="delete_Materialmodal.close()">❌ Cancel</button>
            </div>
        </form>
    </div>
</dialog>
