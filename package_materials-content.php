<?php

include 'functions/PackageMaterialsController.php';

$package_material = new PackageMaterials();
$package_material_lists = $package_material->getPackageMaterials();


?>

<?php if (isset($_GET['success'])){ ?>

<div class="toast toast-top toast-end">
    <div class="alert alert-success">
        <span><?php $_SESSION['message'] ?? ''; ?></span>
    </div>
</div>

<?php }; ?>


<?php  include 'modals/PackageMaterialModal.php'; ?>


<section class="mt-20 ml-20 bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Package Materials Inventory</h1>

    <div class="button-group mb-4 flex justify-between gap-5">
        <div>
            <button class="btn btn-success" onclick="add_package_MaterialModal.showModal()">Add Item</button>
        </div>
    </div>

    <div class="overflow-x-auto">
       
<table id="search-table">
    <thead>
        <tr>
            <th>
                <span class="flex items-center">
                   #
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Material Name
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Product Name
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Package Name
                </span>
            </th>
            <th>
                <span class="flex items-center">
                   Action
                </span>
            </th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($package_material_lists as $key => $package_materials) { ?>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= ($key + 1); ?></td>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= $package_materials['material_name'] ?></td>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= $package_materials['product_name'] ?></td>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= $package_materials['package_name'] ?></td>
                    <td>
                        <span class="flex gap-3">
                            <button class="btn btn-primary" onclick="editModal(<?= $package_materials['package_material_id']; ?>, <?= $package_materials['product_id']; ?>, <?= $package_materials['package_id']; ?>, <?= $package_materials['material_id']; ?>)">Edit</button>
                            <button class="btn btn-error" onclick="deleteModal(<?= $package_materials['package_material_id']; ?>)">Delete</button>
                        </span>
                    </td>
                </tr>
        <?php } ?>
    </tbody>
</table>
    </div>
</section>


<script type="module" src="https://unpkg.com/cally"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
<script>
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
    const dataTable = new simpleDatatables.DataTable("#search-table", {
        searchable: true,
        sortable: false
    });
}
</script>
<script>
    
    function editModal(package_material_id, product_id, package_id, material_id) {

        document.getElementById('edit_product_id').value = product_id;
        document.getElementById('edit_package_id').value = package_id;
        document.getElementById('edit_material_id').value = material_id;
        document.getElementById('edit_package_material_id').value = package_material_id;

    
        edit_package_MaterialModal.showModal();
        
    }

    function deleteModal(package_material_id) {
        
        document.getElementById('delete_package_material_id').value = package_material_id;

        delete_PackageMaterialmodal.showModal();
    }



</script>
