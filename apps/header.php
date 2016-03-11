<?php
if (isset($_SESSION['id']))
{
	$manager = new UserManager($db);
	$currentUser = $manager->getById($_SESSION['id']);
  	if ($currentUser->isAdmin())
  	{
  		require('views/header_admin.phtml');
 	} 
  	else
  	{
   		require('views/header_in.phtml');
 	} 
}
else
{
  require('views/header.phtml');
}
?>