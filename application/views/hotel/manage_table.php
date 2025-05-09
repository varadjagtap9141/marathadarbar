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
                        <th>QR</th>
                        <th>Sr.No.</th>
                        <th>Table Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tables as $key=>$value): ?>
                    <tr>
                        <td>
                            <button class="btn btn-sm btn-secondary shadow-none"
                                onClick="show_qr(<?=$value['table_id']?>)">
                                <i class='bx bx-qr fs-4'></i>
                            </button>
                        </td>
                        <td><?=$key + 1?></td>
                        <td><?=$value['table_no']?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="<?=base_url('hotel/edit_table')?>/<?=$value['table_id']?>" class="btn btn-primary rounded-0"><i class='bx bxs-edit'></i></a>
                            <a href="<?=base_url('hotel/delete_table')?>/<?=$value['table_id']?>" class="btn btn-danger rounded-0" onclick="return confirm('Are you sure?')"><i class="bx bxs-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Custom QR Modal -->
<div id="customQrModal" class="custom-modal">
    <div class="custom-modal-content d-flex flex-column align-items-center">
        <span class="custom-close" onclick="closeQrModal()">&times;</span>
        <h5 class="text-center">Table QR</h5>
        <div id="qrcode" class="text-center mt-3"></div>
    </div>
</div>

<!-- QR Code JS Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<!-- Custom Modal CSS -->
<style>
.custom-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.6);
}

.custom-modal-content {
    background-color: #fff;
    margin: auto;
    padding: 20px 30px;
    border-radius: 10px;
    width: 300px;
    position: relative;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.custom-close {
    color: #aaa;
    font-size: 24px;
    font-weight: bold;
    position: absolute;
    right: 20px;
    top: 15px;
    cursor: pointer;
}

.custom-close:hover {
    color: #000;
}
</style>

<!-- QR Modal Script -->
<script>
function show_qr(table_id) {
    document.getElementById("qrcode").innerHTML = ""; // Clear previous
    document.getElementById("customQrModal").style.display = "block"; // Show modal

    // Generate QR
    new QRCode(document.getElementById("qrcode"), "<?=base_url()?>user/index?table_id=" + table_id);
}

function closeQrModal() {
    document.getElementById("customQrModal").style.display = "none";
}
</script>
