<?php
class mod_exmodule {
	public function __construct()
	{
		$this->basename = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);
	}
	public function main()
	{
		echo "Loaded main function";
	}
	public function main_below()
	{
		echo "Example Module BELOW content - at end of page!";
	}
	public function client_navigation()
	{
		if($this->basename == "balance")
		{
			echo "<li><a href='example.php'>Page-specific linking</a></li>";
		}
		// Handles all navigation inputs
		echo "<li><a href='example.php'>Menu Item Loaded</a></li>";
	}
	public function admin_navigation()
	{
		// Handles all admin navigation inputs
		echo "<li><a href='example.php'>Menu Item Loaded</a></li>";
	}
}