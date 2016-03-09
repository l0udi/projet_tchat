<?php
$query = "SELECT * FROM message LEFT JOIN user ON user.id=message.id_user ORDER BY message.id ASC";
$res = mysqli_query($db, $query);
while ($message = mysqli_fetch_assoc($res))
	require('views/message.phtml');
?>