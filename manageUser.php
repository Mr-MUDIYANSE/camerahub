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
      <li>
        <a href="manageProduct.php">
          <i class='bx bxs-shopping-bag-alt'></i>
          <span class="text">Mnage Product</span>
        </a>
      </li>
      <li class="active">
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

    $rs = Database::search("SELECT * FROM `user`");
    $num = $rs->num_rows;


    ?>
    <!-- MAIN -->
    <main>

      <div class="col-12">
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr class="bg-primary opacity-75">
                <th scope="col" class="text-white">First Name</th>
                <th scope="col" class="text-white">Last Name</th>
                <th scope="col" class="text-white">enail</th>
                <th scope="col" class="text-white">Mobile</th>
                <th scope="col" class="text-white">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              for ($x = 0; $x < $num; $x++) {

                $data = $rs->fetch_assoc();

              ?>
                <tr>
                  <td><?php echo $data["fname"] ?></td>
                  <td><?php echo $data["lname"] ?></td>
                  <td><?php echo $data["email"] ?></td>
                  <td><?php echo $data["mobile"] ?></td>
                  <td>
                    <?php
                    if ($data["status"] == 1) {
                      ?>
                    <button class="btn btn-danger ps-4 pe-4" id="pblock" onclick="blockUser(`<?php echo $data['email'] ?>`);">Block</button>
                      <?php
                    }else {
                     ?>
                     <button class="btn btn-success" id="pblock" onclick="unblockUser(`<?php echo $data['email'] ?>`);">Unblock</button>
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