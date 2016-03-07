<?php
require_once('models/User.class.php');

session_start();

$db = mysqli_connect("192.168.1.93", "Tchat_Gg", "tchatgg", "Tchat_Gg");
$page = "";
$access = ['login', 'create', 'logout', 'monCompte', 'tchat'];
if (isset($_GET['page']))
{
	if (in_array($_GET['page'], $access))
		$page = $_GET['page'];
	else
	{
		header('Location: home');
		exit;
	}
}
$traitements = ['login'=>'user','create'=>'user','logout'=>'user','monCompte'=>'user', 'tchat'=>'user'];
if (isset($traitements[$page]))
	require('apps/traitement_'.$traitements[$page].'.php');

require('apps/skel.php');
?>