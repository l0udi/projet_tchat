<?php
class MessageManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}
	public function create($content, $id_user)
	{
		$message = new Message();
		try
		{
			$message->setContent($content);
			$message->setIdUser($id_user);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		$content = mysqli_real_escape_string($this->db, $message->getContent());
		$id_user = intval($message->getIdUser());
		$query = "INSERT INTO message (content, id_user) VALUES('".$content."', '".$id_user."')";
		$result = mysqli_query($this->db, $query);
		if ($result)
		{
			// return $this->getByIdUser($message->getIdUser());
		}
		else
			throw new Exception("Erreur interne");
	}
	// public function create($content)
	// {
	// 	$content = mysqli_real_escape_string($this->db, $content);
	// 	$query = "INSERT INTO message (content, id_user) VALUES('".$content."', '".$_SESSION['id']."')";
	// 	$result = mysqli_query($this->db, $query);
	// 	if ($result)
	// 	{
	// 		$message = mysqli_fetch_object($result, "Message");
	// 		if ($message)
	// 		{
	// 			return $message;
	// 		}
	// 		else
	// 			throw new Exception("");
	// 	}
	// 	else
	// 		throw new Exception("Erreur interne");
	// }
	
}
?>