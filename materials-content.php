<?php

include 'functions/MaterialsController.php';

$materials = new Materials();
$material_lists = $materials->getMaterials();

?>

<?php if (isset($_GET['success'])){ ?>

<div class="toast toast-top toast-end">
    <div class="alert alert-success">
        <span><?php $_SESSION['message'] ?? ''; ?></span>
    </div>
</div>

<?php }; ?>

<!-- modals -->
<?php  include 'modals/MaterialsModal.php'; ?>


<section class="mt-20 ml-20 bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">
        Raw Material Inventory
        <div class="tooltip" data-tip="This is the Raw Materials.">
             <button class="btn btn-accent">?</button>
        </div>
    </h1>

    <div class="button-group mb-4 flex justify-between gap-5">
        <div>
            <button class="btn btn-success" onclick="add_Materialmodal.showModal()">Add Item</button>
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
                    Name
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Unit
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
    <?php foreach ($material_lists as $key => $material) { ?>
            <tr>
                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= ($key+1) ?></td>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= $material['name'] ?></td>
                    <td><?= $material['unit'] ?></td>
                    <td>
                        <span class="flex gap-3">
                        <button class="btn btn-primary" onclick="editModal(<?= $material['id'] ?>, '<?= $material['name'] ?>', '<?= $material['unit'] ?>')">Edit</button>
                            <button class="btn btn-error" onclick="deleteModal(<?= $material['id'] ?>)">Delete</button>
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

    function editModal(id, name, unit) {

        document.getElementById('edit_material_id').value = id;
        document.getElementById('edit_material_name').value = name;
        document.getElementById('edit_material_unit').value = unit;

        edit_Materialmodal.showModal();

    }

    function deleteModal(id) {

        document.getElementById('delete_material_id').value = id;

        delete_Materialmodal.showModal();

    }

</script>
