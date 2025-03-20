<?php

include 'functions/PackagesController.php';

$package = new Packages();
$packages_list = $package->getPackages();


?>

<?php if (isset($_GET['success'])){ ?>

<div class="toast toast-top toast-end">
    <div class="alert alert-success">
        <span><?php $_SESSION['message'] ?? ''; ?></span>
    </div>
</div>

<?php }; ?>

<!-- modals -->
<?php  include 'modals/PackageModal.php'; ?>

<section class="mt-20 ml-20 bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Packages Inventory</h1>

    <div class="button-group mb-4 flex justify-between gap-5">
        <div>
            <button class="btn btn-success" 
                onclick="add_packageModal.showModal()">Add Item</button>
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
                            Package Name
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Product Name
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
                <?php foreach ($packages_list as $key => $package) { ?>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= ($key + 1); ?></td>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= $package['package_name'] ?></td>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= $package['product_name'] ?></td>
                        <td>
                            <span class="flex gap-3">
                                <button class="btn btn-primary" onclick="editPackage(<?= $package['package_id'] ?>, '<?= $package['package_name'] ?>', <?= $package['product_id'] ?>)">Edit</button>
                                <button class="btn btn-error" onclick="deletePackage(<?= $package['package_id'] ?>)">Delete</button>
                            </span>
                        </td>
                    </tr>
                <?php }  ?>
            </tbody>
        </table>
    </div>

    <!-- modals -->

</section>


<script type="module" src="https://unpkg.com/cally"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
<script>
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#search-table", {
            searchable: true,
            sortable: true
        });
    }
</script>
<script>

    function editPackage(id, name, product_id) {

        document.getElementById('edit_package_id').value = id;
        document.getElementById('edit_package_name').value = name;
        document.getElementById('edit_product_id').value = product_id;

        edit_packageModal.showModal();
    }

    function deletePackage(id) {

        document.getElementById('delete_package_id').value = id;

        delete_PackageModal.showModal();
    }




</script>