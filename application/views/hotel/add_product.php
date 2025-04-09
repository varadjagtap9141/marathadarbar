<div class="row">
    <div class="card card-body">
        <h4>Add Products</h4>
        <hr />
        <form action="<?=base_url('hotel/save_product')?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">

                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" class="form-control shadow-none" id="product_name"
                        placeholder="Enter Product Name" autofocus required>

                </div>
                <div class="col-md-6 mb-3">

                    <label for="category_name">Select Category</label>
                    <select class="form-control shadow-none" name="category_id" id="category_id">
                        <option value="" selected disabled>Select Category</option>
                        <?php
                        foreach($category as $row)
                        {
                            ?>
                            <option value="<?=$row['category_id']?>"><?=$row['category_name']?></option>
                            <?php
                        }
                        ?>
                    </select>

                </div>
                <div class="col-md-6 mb-3">
                    <label for="product_price">Product Price</label>
                    <input type="text" name="product_price" class="form-control shadow-none" id="product_price"
                        placeholder="Enter Product Price" autofocus required>

                </div>
                <div class="col-md-6 mb-3">

                    <label for="product_img">Product Image</label>
                    <input type="file" name="product_img" class="form-control shadow-none" id="product_img"
                        placeholder="" autofocus required>

                </div>
                <div class="col-md-2">
                <button class="btn btn-primary">Add Product</button>
                </div>
            </div>
        </form>
    </div>
</div>