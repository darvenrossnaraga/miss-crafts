<?php 

require_once 'functions/ProductsController.php';
require_once 'functions/PackagesController.php';
require_once 'functions/MaterialsController.php';

$products = new Products();
$packages = new Packages();
$materials = new Materials();

?>


<section class="mt-20 ml-20 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

    <div class="col-span-full text-center mb-10">
        <h1 class="text-4xl font-bold">Welcome, <?= htmlspecialchars($_SESSION['user']); ?>!</h1>
        <p class="text-lg text-gray-600">We're glad to see you back!</p>
    </div>

    <div class="stats shadow mb-6">
        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
            </div>
            <div class="stat-title">Total Products</div>
            <div class="stat-value"><?= $products->countTotalProducts()['total_products']; ?></div>
            <div class="stat-desc">This month.</div>
        </div>
    </div>

    <div class="stats shadow mb-6">
        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    class="inline-block h-8 w-8 stroke-current">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
            </div>
            <div class="stat-title">Total Packages</div>
            <div class="stat-value"><?= $packages->countTotalPackages()['total_packages']; ?></div>
            <div class="stat-desc">This month.</div>
        </div>
    </div>

    <div class="stats shadow mb-6">
        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    class="inline-block h-8 w-8 stroke-current">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                </svg>
            </div>
            <div class="stat-title">Total Raw Materials</div>
            <div class="stat-value"><?= $materials->countTotalMaterials()['total_materials'] ?></div>
            <div class="stat-desc">This month.</div>
        </div>
    </div>
</section>