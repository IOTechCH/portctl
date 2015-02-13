<?php
/**
 * Database Configuration
 * Usage: $db = new database();
 */
function database()
{
	return new PDO('mysql:host=localhost;dbname=dbname', "dbuser", "dbpass");
}
?>
