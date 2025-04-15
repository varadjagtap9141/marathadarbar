<div class="row">
    <div class="card card-body">
        <h4>Add Tables</h4>
        <hr />
        <form action="<?=base_url('hotel/save_table')?>" method="POST">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="table_no">Table Number</label>
                        <input type="text" name="table_no" class="form-control shadow-none" id="table_no"
                            placeholder="Enter table number" autofocus required>
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
                        <td><button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-secondary shadow-none" onClick="show_qr(<?=$value['table_id']?>)"><i class='bx bx-qr fs-4'></i></button></td>
                        <td><?=$key+1?></td>
                        <td><?=$value['table_no']?></td>
                        <td>
                            <a href="<?=base_url('hotel/edit_table')?>/<?=$value['table_id']?>"
                                class="btn btn-primary btn-sm">Edit</a>
                            <a href="<?=base_url('hotel/delete_table')?>/<?=$value['table_id']?>"
                                class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js">
</script>


<script>
    function show_qr(table_id)
    {
        document.getElementById("qrcode").innerHTML = "";
        var qrcode = new QRCode("qrcode",
    "<?=base_url()?>user/index?table_id=" + table_id);
    }
</script>
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Table QR Code</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div id="qrcode"></div>
      </div>
    </div>
  </div>
</div>