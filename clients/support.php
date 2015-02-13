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
              <li class=""><a href="invoices.php">Invoices</a></li>
              <li class="active"><a href="support.php">Support Tickets</a></li>
              <?php
                $hooks->getHooks("client", "client_page_nav");
              ?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div>
            <p>
              <h3>Support Tickets</h3>
              <?php
                if(isset($_GET['ticket_id']))
                {
                  $tid = $_GET['ticket_id'];
                  if(!is_numeric($tid))
                  {
                    exit("You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near LIMIT 1");
                  }
                  // Display ticket
                  $customer_id = $_SESSION['portcust'];
                  $query = $db->prepare('SELECT * FROM `customers` WHERE `customer_id` = ?');
                  $query->execute(array($customer_id));
                  foreach($query as $row)
                  {
                    $customer_email = $row['customer_email'];
                  }
                  // Show first message
                  $qget = $db->prepare('SELECT * FROM `support_tickets` WHERE `id` = ? AND `name` = ? AND `email` = ?');
                  $qget->execute(array($tid, $customer_id, $customer_email));
                  foreach($qget as $row)
                  {
                    echo "<b>".$row['name']."</b><br>".htmlspecialchars(strip_tags($row['message']), ENT_QUOTES);
                  }
                  echo "<br>";
                  $qreplies = $db->prepare('SELECT * FROM `support_ticket_replies` WHERE `ticket_id` = ?');
                  $qreplies->execute(array($tid));
                  foreach($qreplies as $row)
                  {
                    $row['message'] = str_replace("I'm", "I am", $row['message']);
                    $row['message'] = str_replace("I&#039;m", "I am", $row['message']);
                    echo "<b>".$row['name']."</b><br>".htmlspecialchars(strip_tags($row['message']), ENT_QUOTES)."<br>";
                  }
                  if(isset($_POST['submit']))
                  {
                    // ADD REPLY
                    $response = htmlspecialchars(strip_tags($_POST['response']), ENT_QUOTES);
                    $sql = "INSERT INTO `support_ticket_replies`(`id`, `ticket_id`, `name`, `message`) VALUES (NULL, ?, ?, ?)";
                    $query = $db->prepare($sql);
                    $query->execute(array($tid, $customer_id, $response));
                    // Update ticket status
                    $sql2 = "UPDATE `support_tickets` SET `status` = '0' WHERE `id` = ?";
                    $q = $db->prepare($sql2);
                    $q->execute(array($tid));
                    echo "Response added successfully.";
                  }
                  else
                  {
                    // SHOW FORM
                    ?>
                    <form method="POST">
                      <textarea name="response"></textarea>
                      <br><input type="submit" name="submit" value="Reply" class="btn btn-primary">
                    </form>
                    <?php
                  }
                }
                else
                {
                  $customer_id = $_SESSION['portcust'];
                  $query = $db->prepare('SELECT * FROM `customers` WHERE `customer_id` = ?');
                  $query->execute(array($customer_id));
                  foreach($query as $row)
                  {
                    $customer_email = $row['customer_email'];
                  }
                  $qget = $db->prepare('SELECT * FROM `support_tickets` WHERE `email` = ? AND `name` = ? ORDER BY `id` DESC');
                  $qget->execute(array($customer_email, $customer_id));
                  if($qget->rowCount() == 0)
                  {
                    echo "No tickets found.";
                  }
                  else
                  {
                    foreach($qget as $row)
                    {
                      echo "<a href='support.php?ticket_id=".$row['id']."' class='btn btn-primary'>Ticket #".$row['id']."</a> <br><br>";
                    }
                  }
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
