<?php
function handleCFIPs()
{
	if($_SERVER['REMOTE_ADDR'] == "0.0.0.0" OR $_SERVER['REMOTE_ADDR'] == "::1")
	{
		$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
	}
	else
	{
		$_SERVER['REMOTE_ADDR'] = isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER["REMOTE_ADDR"];
	}
}
?>