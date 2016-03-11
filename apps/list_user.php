<?php
$user = new UserManager($db);
$list = $user->getAll();
$count = 0;
$max = sizeof($list);


while ($count < $max)
{
	$user = $list[$count];
	$connected = "";
	if (strtotime($user->getDate()) > strtotime($user->now) - 30)
		$connected = "online";
	require('views/user.phtml');
	$count++;
}
?>