<div class="row">
   <div class="card card-body  rounded-0 shadow-lg">
    <div class="row">
        <?php
        
        foreach($tables as $row)
        {
            $sql="SELECT * ,(SELECT SUM(total) FROM order_product where order_product.order_id=order_table.order_id) as ttl
        
            FROM order_table WHERE status='active' AND table_id='".$row['table_id']."'";
           $orders= $this->db->query($sql)->result_array();
            ?>
            <div class="col-sm-4 col-lg-3">
                <div style="border:1px solid #AE8C4D" class="card card-body shadow-lg position-relative">
                <mark class="fw-bold w-50"><?=$row['table_no']
                    ?></mark>
                    <?php
                    // print_r($orders);
                    if(isset($orders[0]['ttl']))
                    {
                        ?>
                        <strong class="text-center mt-3 fs-3 fw-semibold">&#8377.<?=$orders[0]['ttl']?></strong>
                        <div style="width:25px;height:25px;" class=" bg-success py-2 position-absolute top-0 end-0 me-2 mt-2 rounded-circle">
                        </div>
                        <div class="mt-2 d-flex justify-content-between">
                            <a href="<?=base_url('hotel/order_details')?>/<?=$orders[0]['order_id']?>" class="btn btn-primary rounded-0 fs-4 text-decoration-none" title="Order Details"><i class='bx bx-detail'></i></a>
                            <a href="<?=base_url('hotel/generate_bill')?>/<?=$orders[0]['order_id']?>" class="btn btn-secondary rounded-0 fs-4" title="Generate Bill"><i class='bx bx-rupee'></i></a>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <strong class="text-center mt-3 fs-3 fw-semibold">&#8377.0</strong>
                        <div class="mt-2 d-flex justify-content-between">
                            <a href="<?=base_url('hotel/order_details')?>/" class="btn btn-primary rounded-0 fs-4 text-decoration-none" title="Order Details"><i class='bx bx-detail'></i></a>
                            <a href="<?=base_url('hotel/generate_bill')?>/" class="btn btn-secondary rounded-0 fs-4" title="Generate Bill"><i class='bx bx-rupee'></i></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
   </div>
</div>


