<?php
session_start();
if(!file_exists('../includes/database.php'))
{
	exit("Database file does not exist. Please create database and enter login credentials.");
}
require_once('../includes/database.php'); $db = database();
if(!file_exists('../includes/getconfig.php'))
{
	exit("Configuration file does not exist. Please rename getconfig.php.new to getconfig.php and enter the details requested in the file.");
}
require_once('../includes/getconfig.php');
require_once('../includes/ipfunctions.php'); handleCFIPs();
echo "Preparing installer...";
if(file_exists('installer.locked'))
{
	exit("Installer is locked! Cannot proceed.");
}
$SQL_ONE = "CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `access_level` int(11) NOT NULL DEFAULT '0' COMMENT '0 = regular staff, 1 = superuser',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
$db->query($SQL_ONE);
$SQL_TWO = "INSERT INTO `admin_users` (`id`, `username`, `password`, `access_level`) VALUES
(1, 'admin', '78f772bb942ee7404176ff0e09c60951', 1);";
$db->query($SQL_TWO);
echo "<br>Admin details generated. <br>Username: admin<br>Password: admin123!@<br>";
$SQL_THREE = "CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(120) NOT NULL,
  `blog_content` text NOT NULL,
  `blog_author` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$db->query($SQL_THREE);
$SQL_FOUR = "CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(120) NOT NULL,
  `customer_user` varchar(120) NOT NULL,
  `customer_pass` varchar(120) NOT NULL,
  `customer_email` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$db->query($SQL_FOUR);
$SQL_FIVE = "CREATE TABLE IF NOT EXISTS `customer_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(120) NOT NULL,
  `customer_balance` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$db->query($SQL_FIVE);
$SQL_SIX = "CREATE TABLE IF NOT EXISTS `customer_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(120) NOT NULL,
  `product_id` varchar(120) NOT NULL,
  `invoice_cost` varchar(120) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 is unpaid, 1 is paid',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$db->query($SQL_SIX);
$SQL_SEVEN = "CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(120) NOT NULL,
  `news_content` text NOT NULL,
  `news_author` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$db->query($SQL_SEVEN);
$SQL_EIGHT = "CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_email` text NOT NULL,
  `order_pid` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$db->query($SQL_EIGHT);
$SQL_NINE = "CREATE TABLE IF NOT EXISTS `pagehooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interface` varchar(120) NOT NULL,
  `position` varchar(120) NOT NULL,
  `module` varchar(120) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$db->query($SQL_NINE);
$SQL_TEN = "CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$db->query($SQL_TEN);
$SQL_ELEVEN = "CREATE TABLE IF NOT EXISTS `product_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` varchar(120) NOT NULL,
  `price` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$db->query($SQL_ELEVEN);
$SQL_TWELVE = "CREATE TABLE IF NOT EXISTS `support_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `email` varchar(165) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = open, 1 = answered, 2 = closed',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$db->query($SQL_TWELVE);
$SQL_FINALONE = "CREATE TABLE IF NOT EXISTS `support_ticket_replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$db->query($SQL_FINALONE);
echo "<br>Install completed. Generating lock file...<br>";
$mf = fopen("installer.locked", "w") or die("Cannot create installer.locked file, please generate manually.");
$text = "DONE AT ".time();
fwrite($mf, $text);
fclose($mf);
echo "<br>Completed install...";
?>