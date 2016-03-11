<?php
// ---------------------LOGIN---------------------
if (isset($_POST['action']))
{
	$action = $_POST['action'];
	$userManager = new UserManager($db);

	if ($action == 'login')
	{
		if (isset($_POST['login'], $_POST['password']))
		{
			try
			{
				$user = $userManager->getByLogin($_POST['login']);
				if ($user->verifPassword($_POST['password']))
				{
					$_SESSION['id'] = $user->getId();
					$_SESSION['login'] = $user->getLogin();
					header('Location: tchat');
					exit;
				}
			}
			catch (Exception $e)
			{
				$error = $e->getMessage();
			}
		}
		
	}
// ----------------------CREER UN COMPTE -----------------
	else if ($action == 'create')
	{
		if (isset($_POST['login'], $_POST['hash'], $_POST['confirm']))
		{	
			try
			{
				$user = $userManager->create($_POST['login'],$_POST['hash'], $_POST['confirm']);
				header('Location: login');
				exit;
			}
			catch (Exception $e)
			{
				$error = $e->getMessage();
			}
			// $login = $_POST['login'];
			// $hash = $_POST['hash'];
			// $confirm = $_POST['confirm'];

			// $user = new User();
			// $user->setLogin($login);
			// $user->initPassword($hash, $confirm);


			// $login = mysqli_real_escape_string($db, $login);
			// $hash = mysqli_real_escape_string($db, $hash);

			// $query = "INSERT INTO user (login, hash) VALUES('".$login."', '".$hash."')";
			// $result = mysqli_query($db, $query);
			// if ($result === false)
			// 	$error = "Erreur interne au serveur";
			// else
			// {

			// 	header('Location: login');
			// 	exit;
			// }
		
		}
	}

// -------------MODIFICATION DU COMPTE (LOGIN)-------------
else if ($action == 'modifPw')
	{
		if (isset($_POST['login'], $_POST['oldpassword'],$_POST['newPassword1'],$_POST['newPassword2']))
		{
			try
			{
				$user = $userManager->edit($_POST['login'],$_POST['oldpassword'],$_POST['newPassword1'],$_POST['newPassword2']);
				header('Location: login');
				exit;
			}
			catch (Exception $e)
			{
				$error = $e->getMessage();
			}
			
			// $hash = $_POST['hash'];
			// $login = $_POST['login'];
			// $confirm = $_POST['confirm'];

			// $user = new User();
			// $user->setLogin($login);
			// $user->editPassword($hash, $confirm);

			// $login = mysqli_real_escape_string($db, $login);
			// $hash = mysqli_real_escape_string($db, $hash);

			// $query = "UPDATE user SET login='".$login."', ='".$hash."' WHERE id='".$_SESSION['id']."'";
			// $result = mysqli_query($db, $query);
			// if ($result === false)
			// 	$error = "Erreur interne au serveur";
			// else
			// {
			// 	header('Location: monCompte');
			// 	exit;
			// }
			
		}
	}	




// ---------ERREUR DE CONNEXION --------
	else
		$error = "Erreur interne";
}
// -----------DECONNEXION------------------
else if ($page == 'logout')
{
	session_destroy();
	$_SESSION = array();
	header('Location: home');
	exit;
}	
?>