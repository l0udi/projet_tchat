<?php
class MessageManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}
	public function create($content, User $user)
	{
		$message = new Message($this->db);
		try
		{
			$message->setContent($content);
			$message->setUser($user);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		// $content = mysqli_real_escape_string($this->db, $message->getContent());
		$content = $this->db->quote($message->getContent());
		$id_user = intval($message->getUser()->getId());
		$query = "INSERT INTO message (content, id_user) VALUES(".$content.", '".$id_user."')";
		// $result = mysqli_query($this->db, $query);
		$result = $this->db->exec($query);
		if ($result)
		{
			// return $this->getByIdUser($message->getIdUser());
		}
		else
			throw new Exception("Erreur interne");
	}
	public function getAll()
	{
		$query = "SELECT * FROM message";
		// $res = mysqli_query($this->db, $query);
		$result = $this->db->query($query);
		if($result)
		{
			$messages = [];
			// while ($message = mysqli_fetch_object($result, 'Message', [$this->db]))
			while ($message = $result->fetchObject("Message", [$this->db]))
			{
				$messages[] = $message;
			}
			return $messages;
		}
		else throw new Exception("erreur interne");
	}
	public function getId($id)
	{
		$query = "SELECT * FROM message WHERE id='".intval($id)."'";
		// $res = mysqli_query($this->db, $query);
		$result = $this->db->query($query);
		if ($result)
		{
			// $user = mysqli_fetch_object($result, "User");
			$message = $result->fetchObject("Message", [$this->db]);
			if ($message)
			{
				return $message;
			}
			else
				throw new Exception("Message n'existe pas");
		}
		else
			throw new Exception("Erreur interne");
	}
	public function removeMessage(Message $message)
	{
		$id = $message->getId();
		$query = "DELETE FROM message WHERE id='".$id."' ";
		$result = $this->db->exec($query);
	}
}
?>