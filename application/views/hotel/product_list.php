<div class="row">
   <div class="card card-body table-responsive">
    <div class="col-md-12">
        <h4>Product List</h4>
        <table class="table table-bordered text-center table-hover">
            <thead>
                <tr>
                    <th>Sr.No.</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($products as $key=>$row)
                {
                    ?>
                    <tr>
                    <td><?=$key+1?></td>
                    <td><?=$row['product_name']?></td>
                    <td><?=$row['category_name']?></td>
                    <td>
                        <a href="<?=base_url('hotel/edit_product')?>/<?=$row['product_id']?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="<?=base_url('hotel/delete_product')?>/<?=$row['product_id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
   </div>
</div>