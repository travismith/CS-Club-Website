<?php
	include '../Resources/SessionResources.php';

	$CSDatabase = new CS_Database_Object;
	
	$LoginID = filter_input(INPUT_POST, "LoginID");
	$PasswordAttempt = filter_input(INPUT_POST, "Password");

	echo "Login Student ID : " . $LoginID . "<br>";
	echo "Login password: " . $PasswordAttempt;

	$Authenticated = $CSDatabase->AuthenticateUser($LoginID, $PasswordAttempt);
	
	echo "<br> Auth result: $Authenticated <br>";
	if ($Authenticated == 1)
	{
		// Success!
		echo "Authentication Success! <br><br>";
		Header('Location: ../Views/Home.php');
		exit();
	}
	else if ($Authenticated == 2)
	{
		Header("Location: ../index.php?Warning=Incorrect password");
		exit();
	}
	else if ($Authenticated == 3)
	{
		Header("Location: ../index.php?Warning=User not found");
		exit();
	}
	
?>