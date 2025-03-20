<?php

include 'functions/ProductSalesInventoryController.php';

$productSalesInventory = new ProductSalesInventory();
$productSalesInventory_lists = $productSalesInventory->getProductSalesInventory();


?>

<?php if (isset($_GET['success'])){ ?>

<div class="toast toast-top toast-end">
    <div class="alert alert-success">
        <span><?php $_SESSION['message'] ?? ''; ?></span>
    </div>
</div>

<?php }; ?>

<!-- modals -->
<?php  include 'modals/ProductSalesInventoryModal.php'; ?>

<section class="mt-20 ml-20 bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Product Sales Inventory</h1>

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
    <?php foreach ($productSalesInventory_lists as $key => $product_sales) { ?>
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= ($key + 1); ?></td>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= $product_sales['product_name'] ?></td>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark"><?= $product_sales['package_name'] ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="product_id" value="<?= $product_sales['product_id'] ?>">
                    <input type="hidden" name="package_id" value="<?= $product_sales['package_id'] ?>">
                    <button type="submit" name="edit_stock" class="btn btn-primary">Edit</button>
                </form>
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
            sortable: true
        });
    }
</script>
<script>

document.addEventListener("DOMContentLoaded", function () {
    // Handle stock increase
    document.querySelectorAll(".increase-stock").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent form submission
            let input = this.closest(".stock-container").querySelector(".stock-input");
            input.value = parseInt(input.value) + 1;
        });
    });

    // Handle stock decrease
    document.querySelectorAll(".decrease-stock").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent form submission
            let input = this.closest(".stock-container").querySelector(".stock-input");
            let newValue = parseInt(input.value) - 1;
            input.value = newValue < 0 ? 0 : newValue; // Prevent negative stock
        });
    });
});


</script>