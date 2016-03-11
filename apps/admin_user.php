<?php 

$manager = new UserManager($db);
$list = $manager->getAdmin();
$count = 0;
$max = sizeof($list);

while ($count < $max)
{
	$user = $list[$count];
	$buttonvalue = "1";
	$buttontext = "Activer";
 	if ($user->isActive() == true)
 	{
	 	$buttonvalue = "0";
	 	$buttontext = "Desactiver";
 	}
	require('views/admin_user.phtml');
	$count++;
}
?>