<div class="row">
    <div class="card card-body">
        <h4>Add Categories</h4>
        <hr />
        <form action="<?=base_url('hotel/save_category')?>" method="POST">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="category_name">Add Category</label>
                        <input type="text" name="category_name" class="form-control shadow-none" id="category_name" placeholder="Enter Category" autofocus required>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary float-end">Add Category</button>
        </form>
    </div>
</div>
<div class="row">
   <div class="card card-body table-responsive">
    <div class="col-md-12">
        <div class="d-flex mb-3">
                <div class="me-auto p-2">
                    <h4>Category List
                    </h4>
                </div>
                <div class="p-2">
                    <form class="d-flex float-end" method="get" action="<?=base_url('hotel/manage_category')?>">
                        <input class="form-control me-1 shadow-none" name="search" type="search" placeholder="Search" />
                        <button class="btn bg-primary text-white shadow-none"><i class="bx bx-search"></i></button>
                    </form>
                </div>
            </div>
        <table class="table table-bordered text-center table-hover">
            <thead>
                <tr>
                    <th>Sr.No.</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($category as $key=>$row)
                {
                    ?>
                    <tr>
                    <td><?=$key+1?></td>
                    <td><?=$row['category_name']?></td>
                    <td>
                        <a href="<?=base_url('hotel/edit_category')?>/<?=$row['category_id']?>" class="btn btn-primary rounded-0 text-white"><i class='bx bxs-edit'></i></a>
                        <a href="<?=base_url('hotel/delete_category')?>/<?=$row['category_id']?>" class="btn btn-danger rounded-0" onclick="return confirm('Are you sure?')"><i class="bx bxs-trash"></i></a>
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