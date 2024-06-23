<?php require "connection.php"; 

session_start();

if (isset($_SESSION["au"])) {?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="adminstyle.css">
  <title>Admin Pannel</title>
  <link rel="icon" href="resources/logo.png" />
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>


  <!-- SIDEBAR -->
  <section id="sidebar">
    <a href="#" class="brand">
      <i class='bx bxs-smile'></i>
      <span class="text">Onliner</span>
    </a>
    <ul class="side-menu top">
      <li>
        <a href="adminPanel.php">
          <i class='bx bxs-dashboard'></i>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li class="active">
        <a href="manageProduct.php">
          <i class='bx bxs-shopping-bag-alt'></i>
          <span class="text">Mnage Product</span>
        </a>
      </li>
      <li>
        <a href="manageUser.php">
          <i class='bx bxs-doughnut-chart'></i>
          <span class="text">Manage Users</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bxs-message-dots'></i>
          <span class="text">Message</span>
        </a>
      </li>
    </ul>
    <ul class="side-menu">
      <li>
        <a href="#">
          <i class='bx bxs-cog'></i>
          <span class="text">Settings</span>
        </a>
      </li>
      <li>
        <a onclick="signout();" class="logout" style="cursor: pointer;">
          <i class='bx bxs-log-out-circle'></i>
          <span class="text">Logout</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- SIDEBAR -->



  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class='bx bx-menu'></i>
      <a href="#" class="nav-link">Categories</a>
      <form action="#">
        <div class="form-input">
          <input type="search" placeholder="Search...">
          <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
        </div>
      </form>

      <a href="#" class="notification">
        <i class='bx bxs-bell'></i>
        <span class="num">8</span>
      </a>
      <a href="#" class="profile">
        <img src="resources/logo.png">
      </a>
    </nav>
    <!-- NAVBAR -->
    <?php

    $prs = Database::search("SELECT * FROM `product`");
    $pnum = $prs->num_rows;



    ?>
    <!-- MAIN -->
    <main>

      <div class="col-12">
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr class="bg-primary opacity-75">
                <th scope="col" class="text-white">ID</th>
                <th scope="col" class="text-white">Title</th>
                <th scope="col" class="text-white">Add Date</th>
                <th scope="col" class="text-white">qty</th>
                <th scope="col" class="text-white">Price</th>
                <th scope="col" class="text-white">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              for ($x = 0; $x < $pnum; $x++) {

                $pdata = $prs->fetch_assoc();

              ?>
                <tr>
                  <td class="fw-bold"><?php echo $pdata["id"] ?></td>
                  <td><?php echo $pdata["title"] ?></td>
                  <td><?php echo $pdata["datetimee_added"] ?></td>
                  <td><?php echo $pdata["qty"] ?></td>
                  <td>Rs. <?php echo $pdata["price"] ?></td>
                  <td>
                    <?php
                    if ($pdata["status_id"] == 1) {
                      ?>
                    <button class="btn btn-danger ps-4 pe-4" id="pblock" onclick="blockProduct(<?php echo $pdata['id'] ?>);">Block</button>
                      <?php
                    }else {
                     ?>
                     <button class="btn btn-success" id="pblock" onclick="unblockProduct(<?php echo $pdata['id'] ?>);">Unblock</button>
                     <?php
                    }
                    ?>
                  </td>
                </tr>
              <?php
              }

              ?>

            </tbody>
          </table>
        </div>
      </div>

    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->


  <script src="script.js"></script>
</body>

</html>

<?php
}else {
	header('Location: admin.php');
}?>