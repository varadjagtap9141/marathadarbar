<div class="row">
    <div class="card card-body">
        <h4>Edit Tables</h4>
        <hr />
        <form action="<?=base_url('hotel/update_table')?>" method="POST">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <input type="hidden" name="table_id" value="<?=$table['table_id']?>">
                        <label for="table_no">Table Number</label>
                        <input type="text" value="<?=$table['table_no']?>" name="table_no" class="form-control shadow-none" id="table_no"
                            placeholder="Enter table number" autofocus required>
                    </div>
                </div>
            </div>
            <button onClick="return confirm('Are You Sure?')" class="btn btn-primary float-end">Update Table</button>
        </form>
    </div>
</div>
