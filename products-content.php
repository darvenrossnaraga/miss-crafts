<?php 

    include 'functions/ProductsController.php';

    $products = new Products();
    $products = $products->getProducts();

?>

<?php if (isset($_GET['success'])){ ?>

    <div class="toast toast-top toast-end">
        <div class="alert alert-success">
            <span><?php $_SESSION['message'] ?? ''; ?></span>
        </div>
    </div>

<?php }; ?>

    <!-- modals -->
    <?php  include 'modals/ProductModal.php'; ?>

<section class="mt-15 ml-20 bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Product Inventory</h1>

    <div class="button-group mb-4 flex justify-between gap-5">
        <div>
            <button class="btn btn-success" onclick="add_ProductModal.showModal()">Add Item</button>
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
                            Actions
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
              <?php
                foreach ($products as $key => $product) { ?>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= ($key+1); ?></td>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= $product['name'] ?></td>
                    <td>
                        <span class="flex gap-3">
                            <button class="btn btn-primary" onclick="openEditModal(<?= $product['id'] ?>, '<?= $product['name'] ?>')">Edit</button>
                            <button class="btn btn-error" onclick="openDeleteModal(<?= $product['id'] ?>)">Delete</button>
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
            sortable: true,
        });
    }

    function openEditModal(id, name) {
        
        document.getElementById('edit_product_id').value = id;
        document.getElementById('edit_product_name').value = name;

        
        edit_ProductModal.showModal();
        
    }


    function openDeleteModal(id) {
        
        document.getElementById('delete_product_id').value = id;

    
        delete_ProductModal.showModal();
    }


</script>