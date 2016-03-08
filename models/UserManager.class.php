<?php
class UserManager
{
	// Déclarer les propriétés
	private $db;

	// Constructeur
	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getByLogin($login)
	{
		$login = mysqli_real_escape_string($this->db, $login);
		$query = "SELECT * FROM user WHERE login='".$login."'";
		$res = mysqli_query($this->db, $query);
		if ($res)
		{
			$user = mysqli_fetch_object($res, "User");
			if ($user)
			{
				return $user;
			}
			else
				throw new Exception("Utilisateur non existant");
		}
		else
			throw new Exception("Erreur interne");
	}
	public function create($login, $hash, $confirm)
	{
		$user = new User();
		try
		{
			$user->setLogin($login);
			$user->initPassword($hash, $confirm);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		$login = mysqli_real_escape_string($this->db, $user->getLogin());
		$hash = mysqli_real_escape_string($this->db, $user->getHash());
		$query = "INSERT INTO user (login, hash) VALUES('".$login."', '".$hash."')";
		$result = mysqli_query($this->db, $query);
		if ($result)
		{
			return $this->getByLogin($user->getLogin());
		}
		else
			throw new Exception("Erreur interne");
	}
	public function modif($login, $hash, $confirm)
	{
		$user = new User();
		try
		{
			$user->setLogin($login);
			$user->editPassword($hash);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		$login = mysqli_real_escape_string($this->db, $user->getLogin());
		$hash = mysqli_real_escape_string($this->db, $user->getHash());
		$query = "UPDATE user SET login='".$login."', ='".$hash."' WHERE id='".$_SESSION['id']."'";
		$result = mysqli_query($this->db, $query);
		if ($result)
		{
			return $this->getByLogin($user->getLogin());
		}
		else
			throw new Exception("Erreur interne");
	}
	
}
?>