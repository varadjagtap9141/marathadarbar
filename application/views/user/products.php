<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        /* gap: 10px; */
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
    </style>
</head>

<body>
<header class="sticky-top bg-white">
<nav class="navbar shadow">
  <div class="container">
    <a class="navbar-brand text-center w-100" href="#">
      <img width="auto" height="50" src="<?=base_url()?>upload/logo_new.png" alt="Bootstrap">
    </a>
  </div>
</nav>
</header>
    <div class="container py-4">
        <!-- Category Buttons -->
        <div class="row mb-4">
    <div class="category_scroll_wrapper w-100">
        <div role="group" id="categoryButtons" class="category_scroll d-flex gap-4">
            <?php foreach($category as $row): ?>
            <button class="btn btn-outline-primary rounded-circle shadow-none category_button fw-semibold fs-6"
                onClick="showProducts(<?=$row['category_id']?>, this)">
                <?=$row['category_name']?>
            </button>
            <?php endforeach; ?>
        </div>
    </div>
</div>

        <!-- Products Grid -->
        <div class="row" id="productContainer">
            <?php foreach($products as $row): ?>
            <div class=" col-md-3 mb-4 box box_category <?=$row['category_id']?> product-item">
                <div class="card text-center border-0 shadow">
                    <img src="<?=base_url()?>upload/<?=$row['product_img']?>" class=" img-fluid" alt="<?=$row['product_name']?>">
                    <div class="card-body">
                        <h5 class="card-title"><?=$row['product_name']?></h5>
                        <p class="card-text"><strong>₹.<?=$row['product_price']?></strong></p>
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <button class="btn btn-outline-secondary btn-sm" onclick="decreaseQty(this)">-</button>
                            <input type="number" class="form-control w-25 text-center" value="1" min="1">
                            <button class="btn btn-outline-secondary btn-sm" onclick="increaseQty(this)">+</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
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
            if (product.classList.contains(categoryId.toString())) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    function increaseQty(button) {
        const input = button.previousElementSibling;
        input.value = parseInt(input.value) + 1;
    }

    function decreaseQty(button) {
        const input = button.nextElementSibling;
        const currentVal = parseInt(input.value);
        if (currentVal > 1) input.value = currentVal - 1;
    }
</script>

</body>

</html>