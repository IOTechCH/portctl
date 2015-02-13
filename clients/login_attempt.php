<?php
session_start();
require_once('../includes/database.php'); $db = database();
require_once('../includes/getconfig.php');
require_once('../includes/ipfunctions.php'); handleCFIPs();
if(isset($_POST['submit']))
{
	$customer_id = $_POST['cust_id'];
	if(!is_numeric($customer_id)) {
		echo "Input declined.";
	}
	else
	{
		// Process login
		$password = md5($_POST['password']);
		$query = $db->prepare('SELECT * FROM `customers` WHERE `customer_id` = ? AND `customer_pass` = ?');
		$query->execute(array($customer_id, $password));
		if($query->rowCount() == 0)
		{
			echo "Customer ID / Password invalid."; header('Location: login.php');
		}
		else
		{
			$_SESSION['portcust'] = $customer_id;
			header('Location: index.php');
			echo "Logged in.";
		}
	}
}
else
{
	exit("Input declined.");
}
?>