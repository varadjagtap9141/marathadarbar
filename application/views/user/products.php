<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Maratha Darbar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style> 
    .category_scroll_wrapper {
      overflow-x: auto;
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    .category_scroll_wrapper::-webkit-scrollbar {
      display: none;
    }

    .category_scroll {
      display: flex;
      flex-wrap: nowrap;
      scroll-behavior: smooth;
      padding-bottom: 10px;
      padding-left: 10px;
    }

    .category_button {
      flex: 0 0 auto;
      width: 90px;
      height: 90px;
      display: flex;
      align-items: center;
      justify-content: center;
      white-space: nowrap;
      text-align: center;
      padding: 10px;
    }

    .product-card-img {
      width: 90px;
      height: 90px;
      object-fit: cover;
    }
  </style>
</head>

<body>
  <header class="sticky-top bg-black py-1">
    <nav class="navbar shadow">
      <div class="container">
        <a class="navbar-brand text-center w-100" href="#">
          <img width="auto" height="60" src="<?=base_url()?>upload/logo_new.png" alt="Logo">
        </a>
      </div>
    </nav>
  </header>

  <div class="container py-4">
    <!-- Category Buttons -->
    <div class="row mb-4">
      <div class="category_scroll_wrapper w-100">
        <div role="group" id="categoryButtons" class="category_scroll d-flex gap-4">
          <?php $first = true; foreach($category as $row): ?>
            <button class="btn <?= $first ? 'btn-primary active' : 'btn-outline-primary' ?> rounded-circle shadow-none category_button fw-semibold fs-6"
              onclick="showProducts(<?=$row['category_id']?>, this)">
              <?=$row['category_name']?>
            </button>
          <?php $first = false; endforeach; ?>
        </div>
      </div>
    </div>
    
    <!-- Products Grid -->
    <div class="row" id="productContainer">
      <?php foreach($products as $row){
        if(isset($_SESSION['cart'][$row['product_id']]))
        {
          $qty = $_SESSION['cart'][$row['product_id']];
        }
        else
        {
          $qty = 0;
        }
        ?>
        <div class="col-md-6 mb-4 box box_category <?=$row['category_id']?> product-item" style="display: none;">
          <div class="card border-0 shadow p-3">
            <div class="d-flex align-items-center">
              <div class="me-3">
                <img src="<?=base_url()?>upload/<?=$row['product_img']?>" class="img-fluid product-card-img" alt="<?=$row['product_name']?>">
              </div>
              <div class="flex-grow-1">
                <h5 class="mb-1"><?=$row['product_name']?></h5>
                <p class="mb-2 text-muted"><strong>₹.<?=$row['product_price']?></strong></p>
              

                <div class="d-flex gap-2">
                  <button class="btn btn-outline-secondary rounded-circle" style=" max-width: fit-content" onclick="decreaseQty(this,<?=$row['product_id']?>)"><i class='bx bx-minus'></i></button>
                  <input type="number" class="form-control form-control-sm text-center rounded-0 border border-dark" value="<?=$qty?>" min="0" style="width:100px;">
                  <button class="btn btn-outline-secondary rounded-circle" style=" max-width: fit-content" onclick="increaseQty(this,<?=$row['product_id']?>)"><i class='bx bx-plus'></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <div class="container">
    <div class="w-100 text-center shadow-lg p-3 fixed-bottom">
  <button class="btn btn-primary w-50">Send To Kitchen</button>
  </div>

  <script>
    function showProducts(categoryId, btn) {
      // Update active button styling
      const buttons = document.querySelectorAll('#categoryButtons .btn');
      buttons.forEach(b => {
        b.classList.remove('active', 'btn-primary');
        b.classList.add('btn-outline-primary');
      });
      btn.classList.remove('btn-outline-primary');
      btn.classList.add('btn-primary', 'active');

      // Filter products
      const products = document.querySelectorAll('.product-item');
      products.forEach(product => {
        product.style.display = product.classList.contains(categoryId.toString()) ? 'block' : 'none';
      });
    }

    function increaseQty(button,product_id) {

      const input = button.previousElementSibling;
      input.value = parseInt(input.value) + 1;

      $.ajax({
        "url":"<?=base_url()?>user/add_product_session",
        "data":{"product_id":product_id,"qty":input.value}
      }).done(function(res){
        console.log(res);
      });
    }

    function decreaseQty(button,product_id) {
      const input = button.nextElementSibling;
      const currentVal = parseInt(input.value);
      if (currentVal > 0) input.value = currentVal - 1;
    }

    // Optionally auto-select first category on load
    window.addEventListener('DOMContentLoaded', () => {
      const firstBtn = document.querySelector('#categoryButtons .btn');
      if (firstBtn) {
        const firstCategoryId = firstBtn.getAttribute('onclick').match(/\d+/)[0];
        showProducts(firstCategoryId, firstBtn);
      }
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
