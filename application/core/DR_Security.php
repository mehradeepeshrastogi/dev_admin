<?php 
/* 
file: /application/core/MY_Security.php
*/
class DR_Security extends CI_Security {

	public function csrf_verify()
	{
		// Check if URI has been whitelisted from CSRF checks
		if ($exclude_uris = config_item('csrf_exclude_uris'))
		{
			$uri = load_class('URI', 'core');
			
			// assumes /controller/method in your url. adjust as needed.
			$parts = explode("/",$uri->uri_string());
			if (count($parts) >= 2) {
				if($exclude_uris['for_api'] == $parts[0])
				{
					return $this;
				}
			}
		}
		
		return parent::csrf_verify();
	}
}