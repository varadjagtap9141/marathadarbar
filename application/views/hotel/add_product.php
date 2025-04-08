<div class="row">
    <div class="card card-body">
        <h4>Add Categories</h4>
        <hr />
        <form action="<?=base_url('hotel/save_category')?>" method="POST">
            <div class="row">
            <div class="col-md-8 mb-3">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" class="form-control shadow-none" id="product_name" placeholder="Enter Product Name" autofocus required>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label for="category_name">Select Category</label>
                        <select class="form-control shadow-none" name="category_id" id="category_id">
                            <option value="">Select Category</option>
                        </select>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary float-end">Add Category</button>
        </form>
    </div>
</div>