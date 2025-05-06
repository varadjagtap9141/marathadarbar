<div class="row">
    <div class="card card-body rounded-0 shadow-lg table-responsive">
        <!-- Order Details Heading (visible on screen, hidden in print) -->
        <h4 class="fw-bold text-center no-print">   
            Order Details #MD00<?=$order['order_id']?>
        </h4>

        <!-- Print Header (hidden on screen, visible in print) -->
        <div class="print-header d-none">
            <header class="py-1">
                <nav class="navbar">
                    <div class="container">
                        <a class="navbar-brand d-flex justify-content-center w-100" href="#">
                            <img width="auto" height="60" src="<?=base_url()?>assets/img/icons/hotel_logo.png" alt="Logo">
                        </a>
                    </div>
                </nav>
            </header>
        </div>

        <hr />
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <strong>Date: <?=$order['order_date']?></strong>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <strong>Order Time: <?=$order['order_time']?></strong>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <strong>Order Status: <span class="badge bg-success text-capitalize"><?=$order['status']?></span></strong>
            </div>
        </div>
        <table class="table table-bordered mt-4">
            <thead class="table-primary">
                <tr>
                    <th>SrNo</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_amt=0;
                foreach($order_product as $key=>$row): 
                    $total_amt += $row['total'];
                ?>
                <tr>
                    <td><?=$key+1?></td>
                    <td><?=$row['product_name']?></td>
                    <td><?=$row['qty']?></td>
                    <td>&#8377;<?=number_format($row['product_price'])?></td>
                    <td>&#8377;<?=number_format($row['total'])?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end fs-4 fw-bold">Total Amount:</td>
                    <td class="fs-4 fw-bold">&#8377;<?=number_format($total_amt)?></td>
                </tr>
            </tfoot>
        </table>

        <!-- Button container -->
        <div class="gap-2 justify-content-between d-flex no-print">
            <?php $isCompleted = ($order['status'] == 'completed'); ?>
            <button 
                onClick="print_bill()" 
                class="btn btn-primary text-decoration-none float-end shadow-none"
                <?= $isCompleted ? '' : 'disabled' ?>
                title="<?= $isCompleted ? 'Print the bill' : 'Complete the order first to enable printing' ?>"
            >
                <i class='bx bx-printer text-white'></i>
            </button>

            <button class="btn btn-secondary text-decoration-none float-end shadow-none">
                <a href="<?=base_url('hotel/index')?>"><i class='bx bx-arrow-back text-white'></i></a>
            </button>
        </div> 
    </div>
</div>

<!-- JavaScript Function -->
<script>
function print_bill() {
    var card = document.querySelector('.card').cloneNode(true);

    // Replace heading <h4> with the print header
    var h4Element = card.querySelector('h4');
    var printHeader = document.querySelector('.print-header').innerHTML;
    if (h4Element) {
        h4Element.outerHTML = printHeader;
    }

    // Remove print buttons in cloned version
    var buttons = card.querySelectorAll('.no-print');
    buttons.forEach(el => el.remove());

    // Open a new window
    var printWindow = window.open('', '', 'width=900,height=600');

    // Write the modified content into the new window
    printWindow.document.write(`
        <html>
            <head>
                <title>Order Details</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                <style>
                    body { padding: 20px; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { padding: 8px; text-align: center; }
                </style>
            </head>
            <body>
                ${card.innerHTML}
            </body>
        </html>
    `);

    printWindow.document.close();

    printWindow.focus();
    setTimeout(function() {
        printWindow.print();
        printWindow.close();
    }, 500);
}
</script>

<!-- CSS to hide elements in print -->
<style>
@media print {
    .no-print {
        display: none !important;
    }
}
</style>
