<?php
session_start();
if(!isset($_SESSION['portcust']))
{
  header('Location: login.php');
  echo "Doh! You need to login!";
  exit();
}
require_once('../includes/database.php'); $db = database();
require_once('../includes/getconfig.php');
require_once('../includes/ipfunctions.php'); handleCFIPs();
require_once('../includes/hooks.php'); $hooks = new Hook();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Client Area | <?php echo $sitename; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php"><?php echo $sitename; ?></a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              <button class="btn btn-warning">Customer #<?php echo $_SESSION['portcust']; ?></button>
            </p>
            <ul class="nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="../index.php">Main Website</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Main</li>
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="balance.php">My Balance</a></li>
              <li><a href="invoices.php">Invoices</a></li>
              <li><a href="support.php">Support Tickets</a></li>
              <?php
                $hooks->getHooks("client", "client_page_nav");
              ?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <p>Welcome to <?php echo $sitename; ?> Client Area. If you need help, feel free to open a support ticket.</p>
          </div>
          <div class="row-fluid">
            <div class="span4">
              <h2>Balance</h2>
              <p>Top up your balance at any point, with a few clicks!</p>
              <p><a class="btn btn-primary" href="balance.php">Add funds &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Invoices</h2>
              <p>With our simple tool, we make accessing and paying your invoices as easy as sending an email.</p>
              <p><a class="btn btn-danger" href="invoices.php">Pay Invoices &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Support</h2>
              <p>Need some help? Open a ticket, we'll help you.</p>
              <p><a class="btn btn-warning" href="support.php">View Support Centre &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->
          <?php
            $hooks->getHooks("client", "page_content_below");
          ?>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2015</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
  </body>
</html>
