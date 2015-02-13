<?php
class Hook {
	function __construct()
	{
		global $db; // to fix any possible issues when accessing $db object
		$this->db = $db;
		$this->mods_already_loaded = array();
	}	
	public function getHooks($interface, $position)
	{
		// @param interface refers to client side or admin side (client / admin)
		// @param position refers to where to look (menu/content)
		$hookquery = $this->db->prepare('SELECT * FROM `pagehooks` WHERE `interface` = ? AND `position` = ? AND `status` = "1"');
		$hookquery->execute(array($interface, $position));
		if($hookquery->rowCount() != 0)
		{
			// Hooks exist
			foreach($hookquery as $hookrow)
			{
				$module = $hookrow['module'];
				if(file_exists('../includes/modules/mod_'.$module.'.php'))
				{
					$modfull = "mod_".$module;
					if(!in_array($modfull, $this->mods_already_loaded)) {
						require_once('../includes/modules/mod_'.$module.'.php');
						$this->$modfull = new $modfull;
						$this->mods_already_loaded['mod_'.$module] = "mod_loaded_successfully";
					}
					if($hookrow['position'] == "client_page_nav")
					{
						$this->$modfull->client_navigation();
					}
					else if($hookrow['position'] == "admin_page_nav")
					{
						$this->$modfull->admin_navigation();
					}
					else if($hookrow['position'] == "page_content_below")
					{
						$this->$modfull->main_below();
					}
					else if($hookrow['position'] == "client_invoicepayment_processing")
					{
						$this->$modfull->invoice_processing();
					}
					else
					{
						$this->$modfull->main();
					}
				}
				else
				{
					exit("File does not exist.");
				}
			}
		}
	}
	public function dbInsertHook($interface, $position, $module, $status)
	{
		// Used for adding hooks to database, only call upon install of module!
		$installquery = $this->db->prepare('INSERT INTO `pagehooks`(`id`, `interface`, `position`, `module`, `status`) VALUES (NULL, ?, ?, ?, ?)');
		if(!is_numeric($status))
		{
			echo "status variable must be 1 or 0";
			return false;
		}
		else
		{
			$installquery->execute(array($interface, $position, $module, $status));
			return true;
		}
		return false;
	}
}
?>