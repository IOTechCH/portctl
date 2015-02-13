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
              <li class=""><a href="index.php">Home</a></li>
              <li class=""><a href="balance.php">My Balance</a></li>
              <li class="active"><a href="invoices.php">Invoices</a></li>
              <li><a href="support.php">Support Tickets</a></li>
              <?php
                $hooks->getHooks("client", "client_page_nav");
              ?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div>
            <p>
              <h3>My Invoices</h3>
              <?php
                if(isset($_GET['inv_id']))
                {
                  // Payment Processing VALID
                  $inv_id = $_GET['inv_id'];
                  $inv_type = $_GET['inv_type'];
                  $inv_ip = $_GET['ip'];
                  if(!is_numeric($inv_id) or !is_numeric($inv_type))
                  {
                    exit("You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near LIMIT 1");
                  }
                  if($inv_ip != $_SERVER['REMOTE_ADDR'])
                  {
                    exit("Purchase declined. IP mismatch.");
                  }
                  else
                  {
                    // Update invoice, generate ticket
                    $query = $db->prepare('UPDATE `customer_invoices` SET `status` = "1" WHERE `id` = ? AND `customer_id` = ?');
                    $query->execute(array($inv_id, $_SESSION['portcust']));
                    // Obtain customer email
                    $customer_id = $_SESSION['portcust'];
                    $qcust = $db->prepare('SELECT * FROM `customers` WHERE `customer_id` = ?');
                    $qcust->execute(array($customer_id));
                    foreach($qcust as $row)
                    {
                      $cust_email = $row['customer_email'];
                    }
                    $cust_msg = "Invoice #".$inv_id." paid successfully for customer #".$customer_id;
                    // Open support ticket
                    $qone = $db->prepare('INSERT INTO `support_tickets`(`id`, `name`, `email`, `message`, `status`) VALUES (NULL, ?, ?, ?, "0")');
                    $qone->execute(array($customer_id, $cust_email, $cust_msg));
                    // Tell customer it was paid successfully
                    echo "Invoice paid successfully. Please allow up to 24 hours for processing of purchase as we currently do anti-fraud checks.";
                  }
                }
                if(isset($_GET['do']))
                {
                  $do = $_GET['do'];
                  if($do == "pay")
                  {
                    $id = $_GET['id'];
                    if(!is_numeric($id))
                    {
                      // honeypot
                      exit("You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near LIMIT 1");
                    }
                    // send payment method options
                    $query = $db->prepare('SELECT * FROM `customer_invoices` WHERE `customer_id` = ? AND `id` = ?');
                    $query->execute(array($_SESSION['portcust'], $id));
                    foreach($query as $row)
                    {
                      $invoice_cost = $row['invoice_cost'];
                      $inv_type = $row['product_id'];
                    }
                    $hooks->getHooks("client", "client_invoicepayment_processing");
                    ?>
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="<?php echo $paypal_address; ?>">
                    <input type="hidden" name="lc" value="CA">
                    <input type="hidden" name="item_name" value="Payment for Invoice <?php echo $id; ?>">
                    <input type="hidden" name="amount" value="<?php echo $invoice_cost; ?>">
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="hidden" name="button_subtype" value="services">
                    <input type="hidden" name="no_note" value="0">
                    <input type="hidden" name="cn" value="Add special instructions to the seller:">
                    <input type="hidden" name="no_shipping" value="2">
                    <input type="hidden" name="rm" value="1">
                    <input type="hidden" name="return" value="<?php echo $baseurl; ?>clients/invoices.php?inv_id=<?php echo $id; ?>&inv_type=<?php echo $inv_type; ?>&ip=<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form>

                    <?php
                  }
                }
                $balquery = $db->prepare('SELECT * FROM `customer_invoices` WHERE `customer_id` = ? AND `status` = "0"');
                $balquery->execute(array($_SESSION['portcust']));
                foreach($balquery as $row)
                {
                  echo "<a href='?do=pay&id=".$row['id']."' class='btn btn-primary'>Invoice #".$row['id']." - Amount: $".$row['invoice_cost']."</a> ";
                  echo "<br>";
                }
              ?>
            </p>
          </div>
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
