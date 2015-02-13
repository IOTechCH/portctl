<?php
session_start();
if(!isset($_SESSION['portctl']))
{
	header('Location: index.php');
	echo "Doh! You need to login!";
	exit();
}
require_once('../includes/database.php'); $db = database();
require_once('../includes/getconfig.php');
require_once('../includes/ipfunctions.php'); handleCFIPs();
require_once('../includes/hooks.php'); $hooks = new Hook();
?>
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Support | <?php echo $sitename; ?></title>

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->		
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />		<link rel="stylesheet" href="assets/vendor/morris/morris.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
		<link rel="stylesheet" href="assets/stylesheets/custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="dashboard.php" class="logo">
						<img src="assets/images/logo.png" height="35" alt="<?php echo $sitename; ?>" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<form action="pages-search-results.html" class="search nav-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>
			
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="index.html#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="assets/images/!logged-user.jpg" alt="m"e class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="" data-lock-email="">
								<span class="name"><?php echo $_SESSION['user']; ?></span>
								<span class="role"><?php if($_SESSION['acl'] == "0") {echo "staff";} else {echo "administrator";}?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="">
										<a href="dashboard.php">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li class="">
										<a href="pending.php">
											<span class="pull-right label label-primary"><?php
												$q = $db->prepare('SELECT * FROM `orders` WHERE `order_status` = "0"');
												$q->execute(array());
												echo $q->rowCount();
											?></span>
											<i class="fa fa-envelope" aria-hidden="true"></i>
											<span>Orders Pending</span>
										</a>
									</li>
									<?php
										if($_SESSION['acl'] == "1")
										{
											// SUPERUSER
											?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>Superuser</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="staff.php?do=view">
													 View Staff
												</a>
											</li>
											<li>
												<a href="staff.php?do=add">
													 Add Staff Member
												</a>
											</li>
											<li>
												<a href="config.php?do=edit">
													 Site Configuration
												</a>
											</li>
											<li>
												<a href="products.php?do=edit&what=categories">
													 Edit Product Categories
												</a>
											</li>
											<li>
												<a href="products.php?do=edit&what=products">
													 Edit Products
												</a>
											</li>
											<li>
												<a href="products.php?do=add">
													 Add Products/Categories
												</a>
											</li>
											<li>
												<a href="modules.php">
													Module Configuration
												</a>
											</li>
										</ul>
									</li>
											<?php
										}
									?>
									<?php 
										$hooks->getHooks("admin", "admin_page_nav");
									?>
									<li class="nav-parent nav-active">
										<a>
											<i class="fa fa-tasks" aria-hidden="true"></i>
											<span>Customer</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="pending.php">
													 View Pending Orders
												</a>
											</li>
											<li>
												<a href="customer_search.php">
													Search Customers
												</a>
											</li>
											<li>
												<a href="email.php">
													 Email Customer
												</a>
											</li>
											<li>
												<a href="support.php">
													 Support Tickets
												</a>
											</li>
											<li>
												<a href="live.php">
													Live Support
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-list-alt" aria-hidden="true"></i>
											<span>News</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="news.php?do=add">
													 Add News Item
												</a>
											</li>
											<li>
												<a href="../news.php">
													View News
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-table" aria-hidden="true"></i>
											<span>Blog</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="blog.php?do=add">
													 Add Blog Post
												</a>
											</li>
											<li>
												<a href="blog.php?do=list">
													 Edit Blog Post
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</nav>
				
							<hr class="separator" />
				
							<div class="sidebar-widget widget-tasks">
								<div class="widget-header">
									<h6>Projects</h6>
									<div class="widget-toggle">+</div>
								</div>
								<div class="widget-content">
									<ul class="list-unstyled m-none">
										<li><a href="#">PortCTL Admin</a></li>
									</ul>
								</div>
							</div>
						</div>
				
					</div>
				
				</aside>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Dashboard</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Dashboard</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<div class="row">
						<div class="col-md-6 col-lg-12 col-xl-6">
							<section class="panel">
								<?php echo $adminmsg; ?>
							</section>
						</div>
						<div class="col-md-6 col-lg-12 col-xl-6">
							<section class="panel">
								<?php 
									// Support Panel
									if(isset($_GET['tid']))
									{
										$tid = $_GET['tid'];
										if(!is_numeric($tid)) {exit("Ticket ID (tid) not defined.");}
										$query = $db->prepare('SELECT * FROM `support_tickets` WHERE `id` = ?');
										$query->execute(array($tid));
										foreach($query as $row)
										{
											// List Main Ticket
											echo '<b>Ticket #'.$row['id'].'</b> | Sent By: '.htmlspecialchars($row['name'], ENT_QUOTES).' (<b>'.htmlspecialchars($row['email'], ENT_QUOTES).'</b>)<br>';
											echo "<b>".htmlspecialchars($row['message'], ENT_QUOTES)."</b><br>";
										}
										// Fetch Replies
										$replies = $db->prepare('SELECT * FROM `support_ticket_replies` WHERE `ticket_id` = ?');
										$replies->execute(array($tid));
										foreach($replies as $row)
										{
											echo "<b>Reply from ".htmlspecialchars($row['name'], ENT_QUOTES)."</b><br>".htmlspecialchars($row['message'], ENT_QUOTES)."<br>";
										}
										// Allow for more replies
										if(isset($_POST['send_reply']))
										{
											// Add a response to ticket
											$response = htmlspecialchars($_POST['response'], ENT_QUOTES);
											$q = $db->prepare('INSERT INTO `support_ticket_replies`(`id`, `ticket_id`, `name`, `message`) VALUES (NULL, ?, ?, ?)');
											$q->execute(array($tid, "Staff", $response));
											// Update ticket status
											$qa = $db->prepare('UPDATE `support_tickets` SET `status`="1" WHERE `id` = ?');
											$qa->execute(array($tid));
											echo "Response added successfully.";
										}
										else
										{
											// Show response form
											?>
												<form method="POST">
													<textarea style="width:100%;" name="response"></textarea><br>
													<input type="submit" name="send_reply" value="Reply" class="btn btn-primary">
												</form>
											<?php
										}
									}
									else
									{
										// list all open tickets
										$query = $db->prepare('SELECT * FROM `support_tickets` WHERE `status` = "0"');
										$query->execute(array());
										if($query->rowCount() == 0)
										{
											echo "No support tickets awaiting response.";
										}
										foreach($query as $row)
										{
											echo "<a href='support.php?tid=".$row['id']."' class='btn btn-primary'>View Ticket #".$row['id']." sent by ".$row['email']." (".$row['name'].")</a><br>";
										}
									}
								?>
							</section>
						</div>
					</div>

					<!-- end: page -->
				</section>
			</div>
		</section>
		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>		<script src="assets/vendor/jquery-cookie/jquery.cookie.js"></script>		<script src="assets/vendor/style-switcher/style.switcher.js"></script>		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>		<script src="assets/vendor/jquery-appear/jquery.appear.js"></script>		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>		<script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>		<script src="assets/vendor/flot/jquery.flot.js"></script>		<script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>		<script src="assets/vendor/flot/jquery.flot.pie.js"></script>		<script src="assets/vendor/flot/jquery.flot.categories.js"></script>		<script src="assets/vendor/flot/jquery.flot.resize.js"></script>		<script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>		<script src="assets/vendor/raphael/raphael.js"></script>		<script src="assets/vendor/morris/morris.js"></script>		<script src="assets/vendor/gauge/gauge.js"></script>		<script src="assets/vendor/snap-svg/snap.svg.js"></script>		<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>		<script src="assets/vendor/jqvmap/jquery.vmap.js"></script>		<script src="assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>		<script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		<!-- Examples -->
		<script src="assets/javascripts/dashboard/examples.dashboard.js"></script>
	</body>
</html>