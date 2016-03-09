<?php

$error = '';
spl_autoload_register(function($class)
{
    require('models/'.$class.'.class.php');
});
/*	AVANT :
function __autoload($class)
{
    require('models/'.$class.'.class.php');
}
*/

session_start();

$db = mysqli_connect("192.168.1.93", "Tchat_Gg", "tchatgg", "Tchat_Gg");
$page = "login";
$access = ['login', 'create', 'logout', 'monCompte', 'tchat', 'list'];
if (isset($_GET['page']))
{
	if (in_array($_GET['page'], $access))
		$page = $_GET['page'];
	else
	{
		header('Location: login');
		exit;
	}
}
$traitements = ['login'=>'user','create'=>'user','logout'=>'user','monCompte'=>'user', 'tchat'=>'message'];
if (isset($traitements[$page]))
	require('apps/traitement_'.$traitements[$page].'.php');
if (isset($_GET['ajax']))
	require('apps/'.$page.'.php');
else
	require('apps/skel.php');
?>