<?php
session_start();
if(isset($_SESSION['portctl']))
{
	header('Location: dashboard.php');
	echo "Doh! You seem to be already logged in. <a href='dashboard.php'>Click here to navigate to the dashboard.</a>";
	exit();
}
require_once('../includes/database.php'); $db = database();
require_once('../includes/getconfig.php');
require_once('../includes/ipfunctions.php'); handleCFIPs();
$ip = $_SERVER['REMOTE_ADDR'];
$_SESSION['login_attempts'] = $_SESSION['LOGIN_ATTEMPTS'] + 1;
if($_SESSION['login_attempts'] == 3 or $_SESSION['login_attempts'] == 4)
{
	session_destroy();
	exit('Too many login attempts. Slow down, and try again in 10 minutes. Your IP '.$ip.' has been logged.');
}
if(isset($_POST['submit']))
{
	$username = $_POST['username']; $password = md5($_POST['password']);
	if(!isset($username) or !isset($password))
	{
		exit("No username/password was sent.");
	}
	// SQL request
	$query = $db->prepare('SELECT * FROM `admin_users` WHERE `username` = ? AND `password` = ?');
	$query->execute(array($username, $password));
	if($query->rowCount() == 0)
	{
		exit("Invalid username and/or password.");
	}
	else
	{
		$_SESSION['portctl'] = "portctl_success";
		foreach($query as $row)
		{
			$dbuser = $row['username'];
			$dbacl = $row['access_level'];
		}
		$_SESSION['user'] = $dbuser;
		$_SESSION['acl'] = $dbacl;
		header('Location: dashboard.php');
		exit('Success! <a href="dashboard.php">Click here to login.</a>');
	}
}
else
{
	echo "No submission detected."; exit();
}
?>