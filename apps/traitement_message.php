<?php
require('models/Message.class.php');
require('models/MessageManager.class.php');

if (isset($_POST['action']))
{
	$action = $_POST['action'];
	$messageManager = new MessageManager($db);

	if ($action == 'sendMessage')
	{
		if (isset($_POST['content']))
		{
			if (isset($_SESSION['id']))
			{
				try
				{
					$message = $messageManager->create($_POST['content'], $_SESSION['id']);
					header('Location: tchat');
					exit;
				}
				catch (Exception $e)
				{
					$error = $e->getMessage();

				}
			}
			else
				$error = "Vous devez etre connecte pour ecrire des messages";
		}
		else
			$error = "Erreur interne (vous avez essayé de m'entuber)";
	}
	else
		$error = "Erreur interne (vous avez essayé de m'entuber)";
}
?>