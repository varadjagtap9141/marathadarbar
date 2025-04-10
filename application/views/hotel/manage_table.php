<div class="row">
    <div class="card card-body">
        <h4>Add Tables</h4>
        <hr />
        <form action="<?=base_url('hotel/save_table')?>" method="POST">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="table_no">Table Number</label>
                        <input type="text" name="table_no" class="form-control shadow-none" id="table_no" placeholder="Enter table number" autofocus required>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary float-end">Add Table</button>
        </form>
    </div>
</div>
<div class="row">
   <div class="card card-body table-responsive">
    <div class="col-md-12">
        <h4>Table List</h4>
        <table class="table table-bordered text-center table-hover">
            <thead>
                <tr>
                    <th>Sr.No.</th>
                    <th>Table Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($tables as $key=>$value)
                {
                    ?>
                    <tr>
                    <td><?=$key+1?></td>
                    <td><?=$value['table_no']?></td>
                    <td>
                        <a href="<?=base_url('hotel/edit_table')?>/<?=$value['table_id']?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="<?=base_url('hotel/delete_table')?>/<?=$value['table_id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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