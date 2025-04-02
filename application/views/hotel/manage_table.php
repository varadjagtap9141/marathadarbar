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