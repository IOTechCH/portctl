<?php
session_start();
require_once('includes/database.php'); $db = database();
require_once('includes/ipfunctions.php'); handleCFIPs();
require_once('includes/getconfig.php'); 
?>
<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<title>Products & Services | <?php echo $sitename; ?></title>		
		<meta name="keywords" content="<?php echo $sitename; ?>,hosting,vps,dedicated,custom,coding,whmcs,cpanel,hostbillapp,hostbill,blesta,license" />
		<meta name="description" content="<?php echo $sitename; ?>">
		<meta name="author" content="<?php echo $sitename; ?>">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/bootstrap.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css">
		<link rel="stylesheet" href="vendor/owlcarousel/owl.carousel.min.css" media="screen">
		<link rel="stylesheet" href="vendor/owlcarousel/owl.theme.default.min.css" media="screen">
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" media="screen">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">
		<link rel="stylesheet" href="css/theme-animate.css">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="css/new.css">
		
		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>

		<!--[if IE]>
			<link rel="stylesheet" href="css/ie.css">
		<![endif]-->

		<!--[if lte IE 8]>
			<script src="vendor/respond/respond.js"></script>
			<script src="vendor/excanvas/excanvas.js"></script>
		<![endif]-->

	</head>
	<body>

		<div class="body">
			<header id="header">
				<div class="container">
					<div class="logo">
						<a href="index.php">
							<img alt="<?php echo $sitename; ?>" width="111" height="54" data-sticky-width="82" data-sticky-height="40" src="img/logo.png">
						</a>
					</div>
					<nav>
						<ul class="nav nav-pills nav-top">
							<li>
								<a href="about.php"><i class="fa fa-angle-right"></i>About Us</a>
							</li>
							<li>
								<a href="contact.php"><i class="fa fa-angle-right"></i>Contact Us</a>
							</li>
						</ul>
					</nav>
					<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>
				<div class="navbar-collapse nav-main-collapse collapse">
					<div class="container">
						<ul class="social-icons">
							<li class="facebook"><a href="#" target="_blank" title="Facebook">Facebook</a></li>
							<li class="twitter"><a href="#" target="_blank" title="Twitter">Twitter</a></li>
							<li class="linkedin"><a href="#" target="_blank" title="Linkedin">Linkedin</a></li>
						</ul>
						<nav class="nav-main mega-menu">
							<ul class="nav nav-pills nav-main" id="mainMenu">
								<li class="dropdown active">
									<a class="dropdown-toggle" href="index.php">
										Home
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu">
										<li><a href="index.php">Home</a></li>
										<li><a href="about.php">About Us</a></li>
										<li><a href="contact.php">Contact Us</a></li>
									</ul>
								</li>
								<li class="dropdown mega-menu-item mega-menu-fullwidth">
									<a class="dropdown-toggle" href="index.html#">
										Products & Services
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu">
										<li>
											<div class="mega-menu-content">
												<div class="row">
													<div class="col-md-3">
														<ul class="sub-menu">
															<li>
																<span class="mega-menu-sub-title">Product and Services</span>
																<ul class="sub-menu">
																	<li><a href="pricing.php">All Products and Services List</a></li>
																</ul>
															</li>
														</ul>
													</div>
													<div class="col-md-3">
														<ul class="sub-menu">
															<li>
																<span class="mega-menu-sub-title">Customers</span>
																<ul class="sub-menu">
																	<li><a href="clients/index.php">Customer Login</a></li>
																</ul>
															</li>
														</ul>
													</div>
													
													<div class="col-md-3">
														<ul class="sub-menu">
															<li>
																<span class="mega-menu-sub-title">Resources</span>
																<ul class="sub-menu">
																	<li><a href="blog.php">Blog</a></li>
																</ul>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</li>
								<li class="dropdown">
									<a class="dropdown-toggle" href="#">
										Links
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu">
										<li><a href="news.php">News</a></li>
										<li><a href="blog.php">Blog</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</header>

			<div role="main" class="main">

				<section class="page-top">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="index.php">Home</a></li>
									<li class="active">Products & Services</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1>Products & Services</h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<?php
							if(isset($_GET['tab']))
							{
								if(!is_numeric($_GET['tab']))
								{
									// HONEYPOT
									echo "You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near LIMIT 1";
									exit();
								}
								$tab = $_GET['tab'];
								if($tab == "50")
								{
									// ORDER FORM
									$pid = $_GET['pid'];
									if(!is_numeric($pid))
									{
										echo "You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near LIMIT 1";
										exit();
									}
									if(!isset($_POST['submit']))
									{
										echo "Thanks for your order, please enter a few details so we can process your order.";	
										?>
											<form method="POST" action="pricing.php?tab=50&pid=<?php echo $pid; ?>">
												Email Address<br> <input type="email" name="email" value="" placeholder="email@address.com"><br>
												<input type="submit" name="submit" value="Finalize Order" class="btn btn-primary">
											</form>
										<?php
									}
									else
									{
										// SQL query to add order to be processed
										$email = $_POST['email']; if(empty($email) or !isset($email)) { echo "Email not supplied or not valid."; return; }
										if(!filter_var($email, FILTER_VALIDATE_EMAIL))
										{
											exit("Email format invalid.");
										}
										$data = array($email, $pid);
										$query = $db->prepare('INSERT INTO `orders`(`id`, `order_email`, `order_pid`, `order_status`) VALUES (NULL, ?, ?,"0")');
										$query->execute($data);
										echo "Thank you. We will be in touch within 24 hours with more information.";
										unset($_POST);
									}
								} else {
									$query = $db->prepare('SELECT * FROM `product_info` WHERE `cat_id` = ? LIMIT 3');
									$query->execute(array($tab));
									// display results
									?>
<table class="table table-bordered">
											<thead>
												<tr>
													<td>&nbsp;</td>
													<td>Description</td>
													<td>Price</td>
													<td>Order</td>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($query->fetchAll() as $row)
													{
														?>
															<tr>
																<td>
																	<?php echo $row['name']; ?>
																</td>
																<td>
																	<?php echo $row['description']; ?>
																</td>
																<td>
																	$<?php echo $row['price']; ?>
																</td>
																<td>
																	<a href="pricing.php?tab=50&pid=<?php echo $row['id']; ?>"><button class="btn btn-primary">Order</button></a>
																</td>
															</tr>
														<?php
													}
												?>
												<tr>
													<td colspan="4">
														<center><a href="pricing.php"><button class="btn btn-primary">Back to products & services list</button></a></center>
													</td>
												</tr>
											</tbody>
										</table>
									<?php
								}
							} else {
											?><font color="#000">Please select a category:<br></font><?php
											$query = $db->query('SELECT * FROM `product_categories`');
											foreach($query as $row)
											{
												echo '<button class="btn btn-primary"><a href="pricing.php?tab='.$row['id'].'"><font color="white">'.$row['category_name'].'</font></a></button> ';
											}
										}								
							
						?>
					</div>		
				</div>
			</div>

			<footer id="footer">
				<div class="container">
					<div class="row">
						<div class="footer-ribbon">
							<span>Get in Touch</span>
						</div>
						<div class="col-md-3">
							<div class="newsletter">
								<h4>Newsletter</h4>
								<p>Keep up on our always evolving product features and technology. Enter your e-mail and subscribe to our newsletter.</p>
			
								<div class="alert alert-success hidden" id="newsletterSuccess">
									<strong>Success!</strong> You've been added to our email list.
								</div>
			
								<div class="alert alert-danger hidden" id="newsletterError"></div>
			
								<form id="newsletterForm" action="#" method="POST">
									<div class="input-group">
										<input class="form-control" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit">Go!</button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-3">
							<h4>Cookie Policy</h4>
							<div id="tweet">
								<p>This website uses cookies to allow us to see how the site is used. The cookies cannot identify you. If you continue to use this site we will assume that you are happy with this. </p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="contact-details">
								<h4>Contact Us</h4>
								<ul class="contact">
									<li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:<?php echo $adminemail; ?>"><?php echo $adminemail; ?></a></p></li>
								</ul>
							</div>
						</div>
						<div class="col-md-2">
							<h4>Follow Us</h4>
							<div class="social-icons">
								<ul class="social-icons">
									<li class="facebook"><a href="#" target="_blank" data-placement="bottom" data-tooltip title="Facebook">Facebook</a></li>
									<li class="twitter"><a href="#" target="_blank" data-placement="bottom" data-tooltip title="Twitter">Twitter</a></li>
									<li class="linkedin"><a href="#" target="_blank" data-placement="bottom" data-tooltip title="Linkedin">Linkedin</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="col-md-1">
								<a href="index.php" class="logo">
									<img alt="<?php echo $sitename; ?>" class="img-responsive" src="img/logo-footer.png">
								</a>
							</div>
							<div class="col-md-7">
								<p>© Copyright 2015. All Rights Reserved.</p>
							</div>
							<div class="col-md-4">
								<nav id="sub-menu">
									
								</nav>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.js"></script>
		<script src="vendor/jquery.appear/jquery.appear.js"></script>
		<script src="vendor/jquery.easing/jquery.easing.js"></script>
		<script src="vendor/jquery-cookie/jquery-cookie.js"></script>
		<script src="master/style-switcher/style.switcher.js"></script>
		<script src="vendor/bootstrap/bootstrap.js"></script>
		<script src="vendor/common/common.js"></script>
		<script src="vendor/jquery.validation/jquery.validation.js"></script>
		<script src="vendor/jquery.stellar/jquery.stellar.js"></script>
		<script src="vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="vendor/jquery.gmap/jquery.gmap.js"></script>
		<script src="vendor/isotope/jquery.isotope.js"></script>
		<script src="vendor/owlcarousel/owl.carousel.js"></script>
		<script src="vendor/jflickrfeed/jflickrfeed.js"></script>
		<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="vendor/vide/vide.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		
		<!-- Specific Page Vendor and Views -->
		<script src="vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script src="vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
		<script src="vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script>
		<script src="js/views/view.home.js"></script>
		
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

	</body>
</html>