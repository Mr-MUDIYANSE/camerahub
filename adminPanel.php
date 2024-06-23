<?php require "connection.php"; 

session_start();

if (isset($_SESSION["au"])) {
	?>
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
			<span class="text">Camerahub</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
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
				<a class="logout" onclick="signout();" style="cursor: pointer;">
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

		$today = date("Y-m-d");
		$thismonth = date("m");
		$thisyear = date("Y");

		$a = "0";
		$b = "0";
		$c = "0";
		$e = "0";
		$f = "0";

		$invoice_rs = Database::search("SELECT * FROM `invoice`");
		$invoice_num = $invoice_rs->num_rows;

		for ($x = 0; $x <  $invoice_num; $x++) {
			$invoice_data = $invoice_rs->fetch_assoc();

			$f = $f + $invoice_data["qty"]; //total qty

			$d = $invoice_data["date"];
			$splitDate = explode(" ", $d); // sepaate date from time
			$pdate = $splitDate[0]; //total date

			if ($pdate == $today) {
				$a = $a + $invoice_data["total"];
				$c = $c + $invoice_data["qty"];
			}

			$splitMonth = explode("-", $pdate); //separate date as year, month, date
			$pyear = $splitMonth[0]; //year
			$pmonth = $splitMonth[1]; //month

			if ($pyear == $thisyear) {
				if ($pmonth == $thismonth) {
					$b = $b + $invoice_data["total"];
					$e = $e + $invoice_data["qty"];
				}
			}
		}

		?>

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>

			</div>

			<ul class="box-info">
				<li class="justify-content-center">
					<span class="text">
						<h3><?php echo $c ?></h3>
						<p>Total Selling</p>
					</span>
				</li>
				<li class="justify-content-center">
					<span class="text">
						<h3><?php echo $b ?></h3>
						<p>Monthly Earnings</p>
					</span>
				</li>
				<li class="justify-content-center">
					<span class="text">
						<h3><?php echo $b; ?></h3>
						<p>Total Year Earnings</p>
					</span>
				</li>
			</ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
					</div>
					<table>
						<thead>
							<tr>
								<th class="text-primary fs-5">Order ID</th>
								<th class="text-primary fs-5">Date and Time</th>
								<th class="text-primary fs-5">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$o_rs = Database::search("SELECT * FROM `invoice` WHERE `status` = '0'");
							$o_num = $o_rs->num_rows;

							for ($x = 0; $x < $o_num; $x++) {
								$o_data = $o_rs->fetch_assoc();

							?>

								<tr>
									<td>
										<p class="fw-bold"><?php echo $o_data["order_id"] ?></p>
									</td>
									<td><?php echo $o_data["date"] ?></td>
									<?php

									if ($o_data["status"] == 0) {
									?>
										<td><span class="status completed bg-danger">Not Completed</span></td>

									<?php
									} else {
									?>
										<td><span class="status completed">Completed</span></td>
									<?php
									}

									?>
								</tr>

							<?php
							}

							?>

						</tbody>
					</table>
				</div>

				<?php
				$freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `value_occurence` FROM `invoice` WHERE
				 `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurence` DESC LIMIT 1");


				$freq_num = $freq_rs->num_rows;

				if ($freq_num > 0) {

					$profile_rs = Database::search("SELECT * FROM `profile_image` WHERE
					`user_email`='" . $invoice_data["user_email"] . "'");
					$profile_data  = $profile_rs->fetch_assoc();

					$user_rs1 = Database::search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "'");
					$user_data1  = $user_rs1->fetch_assoc();


				?>
					<div class="todo">
						<div class="head">
							<div class="col-12">
								<div class="row text-center">
									<h3>Most Famous Seller</h3>
								</div>
								<div class="row mt-4">
									<div class="col-12 d-flex justify-content-center">
										<div class="row">
											<div class="col-12">
												<img class="border border-primary border-2 rounded-circle sellerimg" src="<?php echo $profile_data["path"] ?>" /> <br>
												<div class="text-center mt-4 p-1">
												<span class="fs-5 fw-bold"><?php echo $user_data1["fname"] . " " . $user_data1["lname"] ?></span><br />
												<span class="fs-6 fw-bold"><?php echo $user_data1["email"] ?></span><br />
												<span class="fs-6 fw-bold"><?php echo $user_data1["mobile"] ?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				<?php
				}
				?>
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

