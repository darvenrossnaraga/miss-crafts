<section class="mt-20 ml-20 bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Materials</h1>

    <div class="button-group mb-4 flex justify-between gap-5">
        <div>
            <button class="btn btn-success">Add Item</button>
        </div>

        <div class="flex gap-0">
            <button class="btn btn-secondary rounded-r-none" onclick="printDates()">Print Dates</button>
            <button popovertarget="cally-popover1" class="btn btn-outline rounded-l-none" id="cally1" style="anchor-name:--cally1">
                Pick a date
            </button>
            <div popover id="cally-popover1" class="dropdown bg-base-100 rounded-box shadow-lg p-2" style="position-anchor:--cally1">
                <calendar-date class="cally" onchange="document.getElementById('cally1').innerText = this.value">
                    <svg aria-label="Previous" class="fill-current size-4" slot="previous" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                    </svg>
                    <svg aria-label="Next" class="fill-current size-4" slot="next" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
                    </svg>
                    <calendar-month></calendar-month>
                </calendar-date>
            </div>
        </div>
        <script>
            function printDates() {
                const date = document.getElementById('cally1').innerText;
                console.log('Selected Date:', date);
                alert('Selected Date: ' + date);
            }
        </script>
    </div>

    <div class="overflow-x-auto">
       
<table id="search-table">
    <thead>
        <tr>
            <th>
                <span class="flex items-center">
                    Company Name
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Ticker
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Stock Price
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Market Capitalization
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
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark">The Coca-Cola Company</td>
            <td>KO</td>
            <td>$61.37</td>
            <td>$265.00B</td>
            <td>
                <span class="flex gap-3">
                   <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-error">Delete</button>
                </span>
            </td>
        </tr>
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark">Oracle Corporation</td>
            <td>ORCL</td>
            <td>$118.36</td>
            <td>$319.00B</td>
            <td>
                <span class="flex gap-3">
                   <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-error">Delete</button>
                </span>
            </td>
        </tr>
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark">Merck & Co., Inc.</td>
            <td>MRK</td>
            <td>$109.12</td>
            <td>$276.00B</td>
            <td>
                <span class="flex gap-3">
                   <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-error">Delete</button>
                </span>
            </td>
        </tr>
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark">Broadcom Inc.</td>
            <td>AVGO</td>
            <td>$861.80</td>
            <td>$356.00B</td>
            <td>
                <span class="flex gap-3">
                   <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-error">Delete</button>
                </span>
            </td>
        </tr>
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-dark">Mastercard Incorporated</td>
            <td>MA</td>
            <td>$421.44</td>
            <td>$396.00B</td>
            <td>
                <span class="flex gap-3">
                   <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-error">Delete</button>
                </span>
            </td>
        </tr>
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
