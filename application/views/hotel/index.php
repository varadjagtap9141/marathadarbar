<div class="row">
   <div class="card card-body  rounded-0 shadow-lg">
    <div class="row">
        <?php
        
        foreach($tables as $row)
        {
            $sql="SELECT * ,(SELECT SUM(total) FROM order_product where order_product.order_id=order_table.order_id)
        
            FROM order_table WHERE status='active' AND hotel_table_id='".$row['table_id']."'";
            ?>
            <div class="col-md-3">
                <div style="border:1px solid #AE8C4D" class="card card-body shadow-lg">
                    <strong><?=$row['table_no']
                    ?></strong>
                    <?php
                    echo($sql);
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
   </div>
</div>


