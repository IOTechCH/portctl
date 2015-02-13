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
		<title><?php echo $sitename; ?></title>		
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

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="vendor/rs-plugin/css/settings.css" media="screen">
		<link rel="stylesheet" href="vendor/circle-flip-slideshow/css/component.css" media="screen">

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
				<div class="slider-container">
					<div class="slider" id="revolutionSlider" data-plugin-revolution-slider data-plugin-options='{"startheight": 500}'>
						<ul>
							<li data-transition="fade" data-slotamount="13" data-masterspeed="300" >
				
								<img src="img/slides/slide-bg.jpg" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
				
								<div class="tp-caption sft stb visible-lg"
									 data-x="177"
									 data-y="180"
									 data-speed="300"
									 data-start="1000"
									 data-easing="easeOutExpo"><img src="img/slides/slide-title-border.png" alt=""></div>
				
								<div class="tp-caption top-label lfl stl"
									 data-x="227"
									 data-y="180"
									 data-speed="300"
									 data-start="500"
									 data-easing="easeOutExpo">DO YOU NEED A NEW</div>
				
								<div class="tp-caption sft stb visible-lg"
									 data-x="477"
									 data-y="180"
									 data-speed="300"
									 data-start="1000"
									 data-easing="easeOutExpo"><img src="img/slides/slide-title-border.png" alt=""></div>
				
								<div class="tp-caption main-label sft stb"
									 data-x="135"
									 data-y="210"
									 data-speed="300"
									 data-start="1500"
									 data-easing="easeOutExpo">PROVIDER?</div>
				
								<div class="tp-caption bottom-label sft stb"
									 data-x="185"
									 data-y="280"
									 data-speed="500"
									 data-start="2000"
									 data-easing="easeOutExpo">Check us our for reliable service.</div>
				
								<div class="tp-caption randomrotate"
									 data-x="905"
									 data-y="248"
									 data-speed="500"
									 data-start="2500"
									 data-easing="easeOutBack"><img src="img/slides/slide-concept-2-1.png" alt=""></div>
				
								<div class="tp-caption sfb"
									 data-x="955"
									 data-y="200"
									 data-speed="400"
									 data-start="3000"
									 data-easing="easeOutBack"><img src="img/slides/slide-concept-2-2.png" alt=""></div>
				
								<div class="tp-caption sfb"
									 data-x="925"
									 data-y="170"
									 data-speed="700"
									 data-start="3150"
									 data-easing="easeOutBack"><img src="img/slides/slide-concept-2-3.png" alt=""></div>
				
								<div class="tp-caption sfb"
									 data-x="875"
									 data-y="130"
									 data-speed="1000"
									 data-start="3250"
									 data-easing="easeOutBack"><img src="img/slides/slide-concept-2-4.png" alt=""></div>
				
								<div class="tp-caption sfb"
									 data-x="605"
									 data-y="80"
									 data-speed="600"
									 data-start="3450"
									 data-easing="easeOutExpo"><img src="img/slides/slide-concept-2-5.png" alt=""></div>
				
								<div class="tp-caption blackboard-text lfb "
									 data-x="635"
									 data-y="300"
									 data-speed="500"
									 data-start="3450"
									 data-easing="easeOutExpo" style="font-size: 37px;">Think</div>
				
								<div class="tp-caption blackboard-text lfb "
									 data-x="660"
									 data-y="350"
									 data-speed="500"
									 data-start="3650"
									 data-easing="easeOutExpo" style="font-size: 47px;">Outside</div>
				
								<div class="tp-caption blackboard-text lfb "
									 data-x="685"
									 data-y="400"
									 data-speed="500"
									 data-start="3850"
									 data-easing="easeOutExpo" style="font-size: 32px;">The box :)</div>
							</li>
							<li data-transition="fade" data-slotamount="5" data-masterspeed="1000" >
				
								<img src="img/slides/slide-bg.jpg" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
				
									<div class="tp-caption sft stb"
										 data-x="155"
										 data-y="100"
										 data-speed="600"
										 data-start="100"
										 data-easing="easeOutExpo"><img src="img/slides/slide-concept.png" alt=""></div>
				
									<div class="tp-caption blackboard-text sft stb"
										 data-x="285"
										 data-y="180"
										 data-speed="900"
										 data-start="1000"
										 data-easing="easeOutExpo" style="font-size: 30px;">easy to</div>
				
									<div class="tp-caption blackboard-text sft stb"
										 data-x="285"
										 data-y="220"
										 data-speed="900"
										 data-start="1200"
										 data-easing="easeOutExpo" style="font-size: 40px;">customize!</div>
				
									<div class="tp-caption main-label sft stb"
										 data-x="685"
										 data-y="190"
										 data-speed="300"
										 data-start="900"
										 data-easing="easeOutExpo">Open Source</div>
				
									<div class="tp-caption bottom-label sft stb"
										 data-x="685"
										 data-y="250"
										 data-speed="500"
										 data-start="2000"
										 data-easing="easeOutExpo">All our products are 100% open source.</div>
				
							</li>
						</ul>
					</div>
				</div>
				<div class="home-intro" id="home-intro">
					<div class="container">
				
						<div class="row">
							<div class="col-md-8">
								<p>
									The fastest way to grow your business with the leader in with the latest <em>Technology</em>
									<span>We'll help you every step of the way.</span>
								</p>
							</div>
							<div class="col-md-4">
								<div class="get-started">
									<a href="pricing.php" class="btn btn-lg btn-primary">Get Started Now!</a>
								</div>
							</div>
						</div>
				
					</div>
				</div>
				
				<div class="container">
				
					<div class="row center">
						<div class="col-md-12">
							<h1 class="short word-rotator-title">
								<?php echo $sitename; ?> is
								<strong class="inverted">
									<span class="word-rotate" data-plugin-options='{"delay": 2000, "animDelay": 300}'>
										<span class="word-rotate-items">
											<span><font color="">incredibly</font></span>
											<span><font color="">extremely</font></span>
										</span>
									</span>
								</strong>
								fast and efficient.
							</h1>
							<p class="featured lead">
								We use a three-step process to ensure you get what you need, when you need it. Always on time.
							</p>
						</div>
					</div>
				
				</div>
				
				<div class="home-concept">
					<div class="container">
				
						<div class="row center">
							<span class="sun"></span>
							<span class="cloud"></span>
							<div class="col-md-2 col-md-offset-1">
								<div class="process-image" data-appear-animation="bounceIn">
									<img src="img/home-concept-item-1.png" alt="" />
									<strong>Strategy</strong>
								</div>
							</div>
							<div class="col-md-2">
								<div class="process-image" data-appear-animation="bounceIn" data-appear-animation-delay="200">
									<img src="img/home-concept-item-2.png" alt="" />
									<strong>Planning</strong>
								</div>
							</div>
							<div class="col-md-2">
								<div class="process-image" data-appear-animation="bounceIn" data-appear-animation-delay="400">
									<img src="img/home-concept-item-3.png" alt="" />
									<strong>Build</strong>
								</div>
							</div>
							<div class="col-md-4 col-md-offset-1">
								<div class="project-image">
									<div id="fcSlideshow" class="fc-slideshow">
										<ul class="fc-slides">
											<li><a href="portfolio-single-project.html"><img class="img-responsive" src="img/projects/project-home-1.jpg" /></a></li>
											<li><a href="portfolio-single-project.html"><img class="img-responsive" src="img/projects/project-home-2.jpg" /></a></li>
											<li><a href="portfolio-single-project.html"><img class="img-responsive" src="img/projects/project-home-3.jpg" /></a></li>
										</ul>
									</div>
									<strong class="our-work">Our Work</strong>
								</div>
							</div>
						</div>
				
					</div>
				</div>
				
				<div class="container">
				
					<div class="row">
						<hr class="tall" />
					</div>
				
				</div>
				
				<div class="container">
				
					<div class="row">
						<div class="col-md-8">
							<h2>Our <strong>Features</strong></h2>
							<div class="row">
								<div class="col-sm-6">
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="fa fa-group"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Customer Support</h4>
											<p class="tall">Customer satisfaction are our #1 priority.</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="fa fa-file"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">HTML5 / CSS3 / JS / PHP</h4>
											<p class="tall">Custom coding for any project of any size.</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="fa fa-google-plus"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Always On Time</h4>
											<p class="tall">We guarantee you will recieve what you ordered, on time.</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="fa fa-adjust"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Anytime, Anywhere</h4>
											<p class="tall">We are available at anytime, anywhere you are.</p>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="fa fa-film"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Affordable</h4>
											<p class="tall">We promise the best service, for the most affordable prices.</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="fa fa-user"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Hosting</h4>
											<p class="tall">We offer hosting to suit your needs, in over 10 locations.</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="fa fa-bars"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Virtual Machines</h4>
											<p class="tall">We offer fast, never-oversold virtual machines at a affordable rate.</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="fa fa-desktop"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Technical Support</h4>
											<p class="tall">Get remote help, for a fraction of the cost.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<h2>and more...</h2>
				
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="index.html#collapseOne">
												<i class="fa fa-usd"></i>
												Dedicated Servers
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="accordion-body collapse in">
										<div class="panel-body">
											Get a dedicated server, using one of our many payment methods.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="index.html#collapseTwo">
												<i class="fa fa-comment"></i>
												Variety of locations
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="accordion-body collapse">
										<div class="panel-body">
											We offer a variety of locations for hosting, including the United States, Canada, Europe, and France.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="index.html#collapseThree">
												<i class="fa fa-laptop"></i>
												Refund Policy
											</a>
										</h4>
									</div>
									<div id="collapseThree" class="accordion-body collapse">
										<div class="panel-body">
											Fully refund within 15 days (<b>does not apply to dedicated servers, and virtual machines, and hosting.</b>)
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				
					<hr class="tall" />
				
					<div class="row center">
						<div class="col-md-12">
							<h2 class="short word-rotator-title">
								We're not the only ones
								<strong>
									<span class="word-rotate" data-plugin-options='{"delay": 3500, "animDelay": 400}'>
										<span class="word-rotate-items">
											<span>excited</span>
											<span>happy</span>
										</span>
									</span>
								</strong>
								about <?php echo $sitename; ?>...
							</h2>
							<h4 class="lead tall">Over 100 customers in 25 countries use <?php echo $sitename; ?>.</h4>
						</div>
					</div>
					<!--<div class="row center">
						<div class="owl-carousel" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 3000}'>
							<div>
								<img class="img-responsive" src="img/logos/logo-1.png" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-2.png" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-3.png" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-4.png" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-5.png" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-6.png" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-4.png" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-2.png" alt="">
							</div>
						</div>
					</div>
					-->
				</div>
				
				<div class="map-section">
					<section class="featured footer map">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									
								</div>
								<div class="col-md-6">
									<h2><strong>What</strong> Client’s Say</h2>
									<div class="row">
										<div class="owl-carousel push-bottom" data-plugin-options='{"items": 1}'>
											<div>
												<div class="col-md-12">
													<blockquote class="testimonial">
													<p>After weeks of searching, I found <?php echo $sitename; ?> and contacted them for a quote. Within 20 minutes I received a quote, and one month later, my project was completed.</p>
													</blockquote>
													<div class="testimonial-arrow-down"></div>
													<div class="testimonial-author">
														<div class="img-thumbnail img-thumbnail-small">
															<img src="img/clients/client-1.jpg" alt="">
														</div>
														<p><strong>John Flarity</strong><span>Customer, 2015</span></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
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