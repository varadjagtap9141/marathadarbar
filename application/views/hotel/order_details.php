<div class="row">
    <div class="card card-body rounded-0 shadow-lg table-responsive">
        <h4 class="fw-bold text-center">   
        Order Details #MD00<?=$order['order_id']?>
    </h4>
        <hr />
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <strong>Date: <?=$order['order_date']?></strong>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <strong>Order Time: <?=$order['order_time']?></strong>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <strong>Order Status: <span
                        class="badge bg-success text-capitalize"><?=$order['status']?></span></strong>
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
                    <td>&#8377.<?=$row['product_price']?></td>
                    <td>&#8377.<?=$row['total']?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end fs-4 fw-bold">Total Amount:</td>
                    <td class="fs-4 fw-bold">&#8377.<?=number_format($total_amt)?></td>
                </tr>
            </tfoot>
        </table>
        <div>
        <button class="btn btn-secondary text-decoration-none float-end shadow-none"><a
                    href="<?=base_url('hotel/index')?>"><i class='bx bx-arrow-back text-white'></i></a></button>
        </div> 
    </div>
</div>