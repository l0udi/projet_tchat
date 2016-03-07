<?php
if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'comment')
	{
		if (isset($_POST['selectPlat'], $_POST['name'], $_POST['description'], $_POST['date']))
		{
			$date = $_POST['selectPlat'];
			$name = $_POST['name'];
			$description = $_POST['description'];
			$date = $_POST['date'];
			if (strlen($name) < 2 || strlen($name) > 31)
				$error = "Votre titre doit être compris entre 2 et 31 caractères inclus !";
			else if (strlen($description) < 2 || strlen($description) > 31)
				$error = "Votre contenu doit être compris entre 2 et 31 caractères inclus !";
			else
			{
				$name = mysqli_real_escape_string($db, $name);
				$description = mysqli_real_escape_string($db, $description);
				$date = mysqli_real_escape_string($db, $date);
				$query = "INSERT INTO plats (date, name, description) VALUES('".$date."','".$name."','".$description."')";

				$result = mysqli_query($db, $query);
				if ($result === false)
					$error = "Erreur interne au serveur";
				else
				{

					header('Location: newMenu');
					exit;
				}
			}
		}
	}
	else if ($action == 'transmis')
	{
		// en attente -> transmission
		$id_panier = intval($_POST['id_panier']);
		$query = "UPDATE panier SET status='transmis' WHERE id='".$id_panier."'";
		$result = mysqli_query($db, $query);
		header('Location: listCom');
		exit;
	}
	else if ($action == 'livrer')
	{
		// transmission -> livrer
		$id_panier = intval($_POST['id_panier']);
		$query = "UPDATE panier SET status='livrer' WHERE id='".$id_panier."'";
		$result = mysqli_query($db, $query);
		header('Location: listCom');
		exit;
	}
	else if ($action == 'payer')
	{
		// livrer -> terminer
		$id_panier = intval($_POST['id_panier']);
		$query = "UPDATE panier SET status='terminer' WHERE id='".$id_panier."'";
		$result = mysqli_query($db, $query);// paiement -> termine
		header('Location: listCom');
		exit;
	}
	else{
		$error = "Erreur interne";
	}
}
?>