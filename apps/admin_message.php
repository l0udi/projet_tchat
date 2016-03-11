<?php
$manager = new MessageManager($db);
$list = $manager->getAll();
$count = 0;
$max = sizeof($list);


while ($count < $max)
{
	$message = $list[$count];
	$time = strtotime($message->getDate());
	$date = date("d-m-Y", $time);
	$heure = date("H:i", $time);
	if ($date == date('d-m-Y'))
		$format = $heure;
	else
		$format = $date.' '.$heure;
	require('views/admin_message.phtml');
	$count++;
}
?>