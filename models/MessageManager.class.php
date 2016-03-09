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
		$content = mysqli_real_escape_string($this->db, $message->getContent());
		$id_user = intval($message->getUser()->getId());
		$query = "INSERT INTO message (content, id_user) VALUES('".$content."', '".$id_user."')";
		$result = mysqli_query($this->db, $query);
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
		$res = mysqli_query($this->db, $query);
		if($res)
		{
			$messages = [];
			while ($message = mysqli_fetch_object($res, 'Message', [$this->db]))
			{
				$messages[] = $message;
			}
			return $messages;
		}
		else throw new Exception("erreur interne");
	}
}
?>