<?php
// ---------------------LOGIN---------------------
if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'login')
	{
		if (isset($_POST['login'], $_POST['hash']))
		{
			$login = $_POST['login'];
			$hash = $_POST['hash'];

			$user = new User();
			$user->setLogin($login);
			$user->initPassword($hash, $confirm);

			$login = mysqli_real_escape_string($db, $login);
			$query = "SELECT * FROM user WHERE login='".$login."'";
			$result = mysqli_query($db, $query);
			if ($result)
			{
				$users = mysqli_fetch_assoc($result);
				if ($users)
				{
					$_SESSION['id'] = $users['id'];
					$_SESSION['login'] = $users['login'];
					$_SESSION['admin'] = $users['admin'];
					header('Location: home');
					exit;
				}
				else
					$error = "Erreur interne au serveur";
			}
		}
	}
// ----------------------CREER UN COMPTE -----------------
	else if ($action == 'create')
	{
		if (isset($_POST['login'], $_POST['hash'], $_POST['confirm']))
		{	
			$login = $_POST['login'];
			$hash = $_POST['hash'];
			$confirm = $_POST['confirm'];

			$user = new User();
			$user->setLogin($login);
			$user->initPassword($hash, $confirm);


			$login = mysqli_real_escape_string($db, $login);
			$hash = mysqli_real_escape_string($db, $hash);

			$query = "INSERT INTO user (login, hash) VALUES('".$login."', '".$hash."')";
			$result = mysqli_query($db, $query);
			if ($result === false)
				$error = "Erreur interne au serveur";
			else
			{

				header('Location: login');
				exit;
			}
		
		}
	}

// -------------MODIFICATION DU COMPTE (LOGIN)-------------
else if ($action == 'modifPw')
	{
		if (isset($_POST['login'], $_POST['hash'], $_POST['confirm']))
		{
			$hash = $_POST['hash'];
			$login = $_POST['login'];
			$confirm = $_POST['confirm'];

			$user = new User();
			$user->setLogin($login);
			$user->initPassword($hash, $confirm);

			$login = mysqli_real_escape_string($db, $login);
			$hash = mysqli_real_escape_string($db, $hash);

			$query = "UPDATE user SET login='".$login."', ='".$hash."' WHERE id='".$_SESSION['id']."'";
			$result = mysqli_query($db, $query);
			if ($result === false)
				$error = "Erreur interne au serveur";
			else
			{
				header('Location: monCompte');
				exit;
			}
			
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