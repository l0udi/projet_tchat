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
	public function updateCurrentUser()
	{
		$id = intval($_SESSION['id']);
		$query = "UPDATE user SET date=CURRENT_TIMESTAMP WHERE id='".$id."'";
		$this->db->exec($query);
	}
	public function getByLogin($login)
	{
		// $login = mysqli_real_escape_string($this->db, $login);
		$login = $this->db->quote($login);
		$query = "SELECT * FROM user WHERE login=".$login;
		// $res = mysqli_query($this->db, $query);
		$result = $this->db->query($query);
		if ($result)
		{
			// $user = mysqli_fetch_object($result, "User");
			$user = $result->fetchObject("User");
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
	public function getById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM user WHERE id='".$id."'";
		// $res = mysqli_query($this->db, $query);
		$result = $this->db->query($query);
		if ($result)
		{
			// $user = mysqli_fetch_object($result, "User");
			$user = $result->fetchObject("User");
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
		// $login = mysqli_real_escape_string($this->db, $user->getLogin());
		// $hash = mysqli_real_escape_string($this->db, $user->getHash());
		$login = $this->db->quote($user->getLogin());
		$hash = $this->db->quote($user->getHash());

		$query = "INSERT INTO user (login, hash) VALUES(".$login.", ".$hash.")";
		// $result = mysqli_query($this->db, $query);
		$result = $this->db->exec($query);
		if ($result)
		{
			return $this->getByLogin($user->getLogin());
		}
		else
			throw new Exception("Erreur interne");
	}
	public function edit($login, $hash, $confirm)
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
		// $login = mysqli_real_escape_string($this->db, $user->getLogin());
		// $hash = mysqli_real_escape_string($this->db, $user->getHash());
		$login = $this->db->quote($login);
		$hash = $this->db->quote($hash);

		$query = "UPDATE user SET login=".$login.", password=".$hash." WHERE id='".$_SESSION['id']."'";
		// $result = mysqli_query($this->db, $query);
		$result = $this->db->exec($query);
		if ($result)
		{
			return $this->getByLogin($user->getLogin());
		}
		else
			throw new Exception("Erreur interne");
	}
	public function getAll()
	{
		$query = "SELECT *,CURRENT_TIMESTAMP AS now FROM user ORDER BY date DESC";
		// $res = mysqli_query($this->db, $query);
		$result = $this->db->query($query);
		if($result)
		{
			$users = [];
			// while ($message = mysqli_fetch_object($result, 'Message', [$this->db]))
			while ($user = $result->fetchObject("User", [$this->db]))
			{
				$users[] = $user;
			}
			return $users;
		}
		else throw new Exception("erreur interne");
	}

	public function getAdmin()
	{
		$query = "SELECT *,CURRENT_TIMESTAMP AS now FROM user ORDER BY login ASC";
		// $res = mysqli_query($this->db, $query);
		$result = $this->db->query($query);
		if($result)
		{
			$users = [];
			// while ($message = mysqli_fetch_object($result, 'Message', [$this->db]))
			while ($user = $result->fetchObject("User", [$this->db]))
			{
				$users[] = $user;
			}
			return $users;
		}
		else throw new Exception("erreur interne");
	}

	public function editActive(User $user, $active)
	{
		$active = intval($active);
		$id = $user->getId();
		$query = "UPDATE user SET active=".$active." WHERE id='".$id."'";
		var_dump($query);
		$result = $this->db->exec($query);
	}
	public function getActive()
	{
		$query = "SELECT * FROM user";
		$result = $this->db->query($query);
		if($result)
		{
			$users = [];
			while ($user = $result->fetchObject("User", [$this->db]))
			{
				$users[] = $user;
			}
			return $users;
		}
		else throw new Exception("erreur interne");
	}
}
?>