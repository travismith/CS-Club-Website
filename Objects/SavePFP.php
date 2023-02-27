<?php
	include '../Resources/SessionResources.php';

	$Authenticated = CheckAuthentication();
	if (!$Authenticated)
	{
		Header('Location: ../Objects/Logout.php');
		exit();
	}
	
	$CSClubID = $_SESSION["SessionID"];

	if (isset($_SESSION["SessionID"])) // AUTHENTICATION LOCATION
	{
		$uploadFile = "../Media/PFPs/$CSClubID";
		$FileType = $_FILES["PFPFile"]["type"];
		
		$Extension = NULL;

		if (file_exists($uploadFile . ".png"))
		{
			echo "UNLINKING";
			unlink($uploadFile . ".png");
		}
		else if (file_exists($uploadFile . ".jpeg"))
		{
			echo "UNLINKING";
			unlink($uploadFile . ".jpeg");
		}
		else if (file_exists($uploadFile . ".jpg"))
		{
			echo "UNLINKING";
			unlink($uploadFile . ".jpg");
		}

		foreach ($_FILES["PFPFile"] as $Key => $Value)
		{
			echo $Key . ": " . $Value . "<br>";
		}

		if ($_FILES["PFPFile"]["type"] == "image/png")
		{
			$Extension = ".png";
		}
		else if ($_FILES["PFPFile"]["type"] == "image/jpeg" )
		{
			$Extension = ".jpeg";
		}
		else if ($_FILES["PFPFile"]["type"] == "image/jpg" )
		{
			$Extension = ".jpg";
		}
		else
		{
			echo "here";
			exit();
			Header('Location: ../Views/Home.php?Selected=MyProfile&Warning=Invalid file');
			exit();
		}
		
		echo '<pre>';

		if (move_uploaded_file($_FILES['PFPFile']['tmp_name'], $uploadFile . $Extension))
		{
			echo "File is valid, and was successfully uploaded.\n";
		}
		else
		{
			echo "Possible file upload attack!\n";
		}

		echo 'Here is some more debugging info:';
		print_r($_FILES);
		print "</pre>";
	}
	
	Header('Location: ../Views/Home.php?Selected=MyProfile');
?>

<?php
	
	
?>