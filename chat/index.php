<?php



	// Redirect to install if the installation hasn't been completed or admin if it has
	if (!file_exists("includes" . DIRECTORY_SEPARATOR . "config.php")) 
	{
		if (file_exists("install" . DIRECTORY_SEPARATOR . "index.php")) 
		{
			header("Location: " . "install" . DIRECTORY_SEPARATOR);
		} 
		else 
		{
			echo "We have detected that chat installer has not been run, but there is no install directory";
		}
	} 
	else 
	{
		header("Location: " . "admin" . DIRECTORY_SEPARATOR);
	}

?>
