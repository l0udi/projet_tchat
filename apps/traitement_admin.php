 <?php

$userManager = new UserManager($db);
$messageManager = new MessageManager($db);

 if (isset($_POST['action']))
 {

	$action = $_POST['action'];

	if ($action == 'activer_user')
	{
		if (isset($_POST['isActive']))
		{
			try
			{
				$activer = intval($_POST['isActive']);
				$id = intval($_POST['userid']);
				$user = $userManager->getById($id);
				$userManager->editActive($user, $activer);
				// $query = "UPDATE users SET isActive_user=".$activer." WHERE id_user='".$id_user."'";
				// $result = $this->db->exec($query);
				header('Location: gestion_user');
				exit;
				
			}
			catch (Exception $e)
			{
				$error = $e->getMessage();
			}
		}
	}
	else if ($action == 'supprimer')
	{
		if (isset($_POST['supprimer']))
		{
			try
			{
				$message = $messageManager->getId($_POST['supprimer']);
				$messageManager->removeMessage($message);
				header('Location: gestion_message');
				exit;
				
			}
			catch (Exception $e)
			{
					$error = $e->getMessage();
		var_dump($error);
		exit;
			}
		}
		
	}
}


?>