<?php
class Message
{
	private $id;
	private $id_user;
	private $user;// propriété calculée -> composition // class User
	private $content;
	private $date;
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getUser()
	{
		if ($this->user == null)
		{
			$manager = new UserManager($this->db);
			$this->user = $manager->getById($this->id_user);
		}
		return $this->user;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function getContent()
	{
		return $this->content;
	}
	

	public function setContent($content)
	{
		if (empty($content) || strlen($content) > 2047)
			throw new Exception("Votre message doit être compris entre 1 et 2047 caractères");
		else
			$this->content = $content;
	}
	public function setUser(User $user)
	{
		$this->user = $user;
		$this->id_user = $user->getId();
	}
}
?>