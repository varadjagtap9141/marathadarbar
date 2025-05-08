<div class="row">
    <div class="card card-body  rounded-0 shadow-lg">
        <div class="row">
            <?php
        
        foreach($tables as $row)
        {
            $sql="SELECT * ,(SELECT SUM(total) FROM order_product where order_product.order_id=order_table.order_id) as ttl
        
            FROM order_table WHERE status='active' AND table_id='".$row['table_id']."'";
           $orders= $this->db->query($sql)->result_array();
            ?>
            <div class="col-sm-4 col-lg-3">
                <div style="border:1px solid #AE8C4D" class="card card-body shadow-lg position-relative">
                    <mark class="fw-bold w-50"><?=$row['table_no']
                    ?></mark>
                    <?php
                    // print_r($orders);
                    if(isset($orders[0]['ttl']))
                    {
                        ?>
                    <strong
                        class="text-center mt-3 fs-3 fw-semibold">&#8377.<?=number_format($orders[0]['ttl'])?></strong>
                    <div style="width:25px;height:25px;"
                        class=" bg-success py-2 position-absolute top-0 end-0 me-2 mt-2 rounded-circle">
                    </div>
                    <div class="mt-2 d-flex justify-content-between">
                        <a href="<?=base_url('hotel/order_details')?>/<?=$orders[0]['order_id']?>"
                            class="btn btn-primary rounded-0 fs-4 text-decoration-none" title="Order Details"><i
                                class='bx bx-detail'></i></a>
                        <a href="upi://pay?pa=varadjagtap31@okicici&pn=Maratha_Darbar&am=<?=number_format($orders[0]['ttl'])?>&tn=Visit_Again&cu=INR"
                            class="btn btn-primary rounded-0 fs-4 text-decoration-none" id="payNowBtn" title="Pay Now">
                            <i class='bx bx-rupee'></i>
                            

                        </a>
                        <a href="<?=base_url('hotel/generate_bill')?>/<?=$orders[0]['order_id']?>"
                            class="btn btn-secondary rounded-0 fs-4" title="Generate Bill">
                            
                            <i class='bx bxs-check-circle'></i></a>
                    </div>
                    <?php
                    }
                    else
                    {
                        ?>
                    <strong class="text-center mt-3 fs-3 fw-semibold">&#8377.0</strong>
                    <div class="mt-2 d-flex justify-content-between">
                        <a href="#" class="btn btn-primary rounded-0 fs-4 text-decoration-none" title="Order Details"><i
                                class='bx bx-detail'></i></a>
                        <a href="#" class="btn btn-secondary rounded-0 fs-4" title="Generate Bill"><i
                                class='bx bxs-check-circle'></i></a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
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

<!-- Bootstrap Modal for QR Code -->
<div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="qrModalLabel">Scan to Pay</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="qrcode"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger rounded-0" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
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
        legend: {
            display: false
        },
        title: {
            display: true,
            text: "Hotel Order Chart"
        }
    }
});
</script>


<script>
// Function to show QR code modal
function showQR(link) {
    // Clear previous QR code if any
    document.getElementById('qrcode').innerHTML = "";
    // Generate new QR code
    new QRCode(document.getElementById("qrcode"), {
        text: link,
        width: 200,
        height: 200
    });
    // Open Bootstrap modal
    var qrModal = new bootstrap.Modal(document.getElementById('qrModal'));
    qrModal.show();
}

// Attach click event to all Pay Now buttons (because multiple tables)
document.querySelectorAll('a[href^="upi://pay"]').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const upiLink = this.getAttribute('href');
        showQR(upiLink);
    });
});
</script>