<?php
if (isset($_SESSION['id']))
{
	$query = "SELECT * FROM user WHERE id='".$_SESSION['id']."'";
	$result = mysqli_query($db, $query);


	$client = mysqli_fetch_assoc($result);
	require('views/monCompte.phtml');
}
?>

