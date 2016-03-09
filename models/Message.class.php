<?php
class Message
{
	private $id;
	private $id_user;
	private $content;
	private $date;

	public function __construct()
	{
		
	}

	public function getId()
	{
		return $this->id;
	}
	public function getIdUser()
	{
		return $this->id_user;
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
	public function setIdUser($id_user)
	{
		if ($id_user > 0)
			$this->id_user = $id_user;
		else
			throw new Exception("Auteur du message non trouve");
	}

	
}
?>