<?php
print_r($category)
?>
<div class="row">
    <div class="card card-body">
        <h4>Add Categories</h4>
        <hr />
        <form action="<?=base_url('hotel/update_category')?>" method="POST">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <input type="hidden" name="category_id" value="<?=$category['category_id']?>">
                    <div class="form-group">
                        <label for="category_name">Edit Category</label>
                        <input type="text" name="category_name" class="form-control shadow-none" id="category_name" value="<?=$category['category_name']?>" placeholder="Enter Category" autofocus required>
                    </div>
                </div>
            </div>
            <button onClick="return confirm('Are You Sure?')" class="btn btn-primary float-end">Update Category</button>
        </form>
    </div>
</div>