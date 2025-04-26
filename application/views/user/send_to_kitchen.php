<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header class="sticky-top bg-white py-1">
    <nav class="navbar shadow">
      <div class="container">
        <a class="navbar-brand d-flex justify-content-center w-100" href="#">
          <img  width="auto" height="60" src="<?=base_url()?>assets/img/icons/hotel_logo.png" alt="Logo">
        </a>
       
      </div>
    </nav>
  </header>
  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h2>order deldkfkjsjfisdfsiuf</h2>
                <a href="<?=base_url('user/index?table_id='.$_SESSION['table_id'])?>">
            <button class="btn btn-primary send_to_kitchen">back</button>
        </a>
            </div>
        </div>
    </div>
  </div>
</body>
</html>