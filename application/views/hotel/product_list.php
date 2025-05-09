<div class="row">
    <div class="card card-body table-responsive">
        <div class="col-md-12">
            <div class="d-flex mb-3">
                <div class="me-auto p-2">
                    <h4>Product List
                    </h4>
                </div>
                <div class="p-2">
                    <form class="d-flex float-end" method="get" action="<?=base_url('hotel/product_list')?>">
                        <input class="form-control me-1 shadow-none" name="search" type="search" placeholder="Search" />
                        <button class="btn bg-primary text-white shadow-none"><i class="bx bx-search"></i></button>
                    </form>
                </div>
            </div>
            <table class="table table-bordered text-center table-hover">
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Product Image</th>
                        <th>Price</th>
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
                        <td><img height="auto" width="50" src="<?=base_url()?>upload/<?=$row['product_img']?>" alt="">
                        </td>
                        <td>&#8377; <?=$row['product_price']?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="<?=base_url('hotel/edit_product')?>/<?=$row['product_id']?>"
                                    class="btn btn-primary btn-sm">Edit</a>
                                <a href="<?=base_url('hotel/delete_product')?>/<?=$row['product_id']?>"
                                    class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </div>
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