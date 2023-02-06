<?php
	include '../Resources/SessionResources.php';
	include '../Resources/DisplayResources.php';

	$Username = filter_input(INPUT_POST, "Username");
	$Email = filter_input(INPUT_POST, "Email");
	$FirstName = filter_input(INPUT_POST, "FirstName");
	$LastName = filter_input(INPUT_POST, "LastName");

	echo "Username: " . $Username . "<br>";
	echo "Email: " . $Email . "<br>";
	
	$Pass1 = filter_input(INPUT_POST, "Pass1");
	$Pass2 = filter_input(INPUT_POST, "Pass2");

	$JoinedClubOn = date("Y-m-d H:i:s");

	if ($Pass1 != $Pass2)
	{
		Header('Location: ../Views/RegisterView.php?Warning=1');
		exit();
	}

	$CSDatabase = new CS_Database_Object;
	$AlreadyExists = $CSDatabase->CheckUserExists($Email, NULL, NULL);

	if ($AlreadyExists)
	{
		// This user is already in the system.

		mysqli_close($CSDatabase);
		Header('Location: ../Views/RegisterView.php?Warning=2');
		
		exit();
	}
	else
	{
		// Clear to register
		$RegistrationResult = $CSDatabase->RegisterUser($Username, $Email, $FirstName, $LastName, $Pass1, $JoinedClubOn);
		
		ClearFormFillSessions();

		$CSClubID = $CSDatabase->ReturnCSClubID($Username);
		AuthenticateSession($CSClubID, $Pass1);
		
		Header('Location: ../Views/Home.php');
		exit();
	}
?>