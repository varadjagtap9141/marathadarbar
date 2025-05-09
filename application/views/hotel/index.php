<div class="row">
    <div class="card card-body  rounded-0 shadow-lg">
        <div class="row">
            <?php
            foreach($tables as $row) {
                $sql="SELECT * ,(SELECT SUM(total) FROM order_product where order_product.order_id=order_table.order_id) as ttl
                FROM order_table WHERE status='active' AND table_id='".$row['table_id']."'";
                $orders= $this->db->query($sql)->result_array();
            ?>
            <div class="col-sm-4 col-lg-3">
                <div style="border:1px solid #AE8C4D" class="card card-body shadow-lg position-relative">
                    <mark class="fw-bold w-50"><?=$row['table_no']?></mark>
                    <?php if(isset($orders[0]['ttl'])) { ?>
                    <strong class="text-center mt-3 fs-3 fw-semibold">&#8377.<?=number_format($orders[0]['ttl'])?></strong>
                    <div style="width:25px;height:25px;" class=" bg-success py-2 position-absolute top-0 end-0 me-2 mt-2 rounded-circle"></div>
                    <div class="mt-2 d-flex justify-content-between">
                        <a href="<?=base_url('hotel/order_details')?>/<?=$orders[0]['order_id']?>" class="btn btn-primary rounded-0 fs-4 shadow-none text-decoration-none" title="Order Details"><i class='bx bx-detail'></i></a>
                        <a href="upi://pay?pa=varadjagtap31@okicici&pn=Maratha_Darbar&am=<?=number_format($orders[0]['ttl'])?>&tn=Visit_Again&cu=INR" class="btn btn-primary rounded-0 fs-4 shadow-none text-decoration-none payNowBtn" title="Pay Now">
                            <i class='bx bx-rupee'></i>
                        </a>
                        <a href="<?=base_url('hotel/generate_bill')?>/<?=$orders[0]['order_id']?>" class="btn btn-secondary rounded-0 fs-4 shadow-none" title="Generate Bill">
                            <i class='bx bxs-check-circle'></i></a>
                    </div>
                    <?php } else { ?>
                    <strong class="text-center mt-3 fs-3 fw-semibold">&#8377.0</strong>
                    <div class="mt-2 d-flex justify-content-between">
                        <a href="#" class="btn btn-primary rounded-0 fs-4 shadow-none text-decoration-none" title="Order Details"><i class='bx bx-detail'></i></a>
                        <a href="#" class="btn btn-secondary rounded-0 fs-4 shadow-none" title="Generate Bill"><i class='bx bxs-check-circle'></i></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="card card-body rounded-0 shadow-lg mt-3">
        <div class="row d-flex align-items-center">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Custom QR Modal -->
<div id="customQrModal" class="custom-modal">
    <div class="custom-modal-content d-flex flex-column align-items-center">
        <span class="custom-close" onclick="closeQrModal()">&times;</span>
        <h5 class="text-center mb-3">Scan to Pay</h5>
        <div id="qrcode" class="text-center"></div>
    </div>
</div>

<!-- QR Code JS & Chart JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<!-- Custom Modal CSS -->
<style>
.custom-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    padding-top: 200px;
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
    padding: 20px 20px;
    border-radius: 12px;
    width: 280px;
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
    top: 10px;
    cursor: pointer;
}

.custom-close:hover {
    color: #000;
}
</style>

<!-- Chart Script -->
<script>
var xValues = [<?="'".implode("', '",$x_axis)."'"?>];
var yValues = [<?="'".implode("', '",$y_axis)."'"?>];

new Chart("myChart", {
    type: "line",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: 'rgba(0,0,255,0.1)',
            borderColor: "#D3A757",
            data: yValues
        }]
    },
    options: {
        legend: { display: false },
        title: { display: true, text: "Hotel Order Chart" }
    }
});
</script>

<!-- QR Modal Script -->
<script>
// Function to show QR code
function showQR(link) {
    document.getElementById('qrcode').innerHTML = ""; // Clear previous
    document.getElementById("customQrModal").style.display = "block"; // Show modal

    new QRCode(document.getElementById("qrcode"), {
        text: link,
        width: 200,
        height: 200
    });
}

// Function to close QR modal
function closeQrModal() {
    document.getElementById("customQrModal").style.display = "none";
}

// Attach click event to all Pay Now buttons
document.querySelectorAll('.payNowBtn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const upiLink = this.getAttribute('href');
        showQR(upiLink);
    });
});
</script>
