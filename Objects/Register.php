<?php
	include '../Resources/SessionResources.php';
	include '../Resources/DisplayResources.php';

	$Email = filter_input(INPUT_POST, "Email");
	$Phone = filter_input(INPUT_POST, "Phone");

	$FN = filter_input(INPUT_POST, "FirstName");
	$LN = filter_input(INPUT_POST, "LastName");
	
	$StudentID = filter_input(INPUT_POST, "StudentID");

	$DOB = filter_input(INPUT_POST, "Birthday");
	$JoinedClub = date("Y-m-d H:i:s");
	
	$StudentAthlete = filter_input(INPUT_POST, "Athlete");

	if (isset($StudentAthlete))
	{
		$StudentAthlete = "true";
	}
	else
	{
		$StudentAthlete = "false";
	}

	$Sport = filter_input(INPUT_POST, "Sport");

	$Major = filter_input(INPUT_POST, "Major");
	if ($Major == "")
	{
		$Major = NULL;
	}

	/* Interests */
	$ThreeDPrinting = filter_input(INPUT_POST, "3DPrinting");
	if (isset($ThreeDPrinting))
	{
		$ThreeDPrinting = "true";
	}
	else
	{
		$ThreeDPrinting = "false";
	}

	$Robotics = filter_input(INPUT_POST, "Robotics");
	if (isset($Robotics))
	{
		$Robotics = "true";
	}
	else
	{
		$Robotics = "false";
	}
	
	$VideoGameDev = filter_input(INPUT_POST, "VideoGameDev");
	if (isset($VideoGameDev))
	{
		$VideoGameDev = "true";
	}
	else
	{
		$VideoGameDev = "false";
	}

	$AI =  filter_input(INPUT_POST, "AI");
	if (isset($AI))
	{
		$AI = "true";
	}
	else
	{
		$AI = "false";
	}

	$MobileAppDev =  filter_input(INPUT_POST, "MobileAppDev");
	if (isset($MobileAppDev))
	{
		$MobileAppDev = "true";
	}
	else
	{
		$MobileAppDev = "false";
	}

	$WebDev =  filter_input(INPUT_POST, "WebDev");
	if (isset($WebDev))
	{
		$WebDev = "true";
	}
	else
	{
		$WebDev = "false";
	}

	$OtherInterest =  filter_input(INPUT_POST, "OtherInterest");
	if ($OtherInterest == "")
	{
		$OtherInterest = NULL;
	}

	$CurrentGrade = filter_input(INPUT_POST, "CurrentGrade");
	$ExpectedGrad = filter_input(INPUT_POST, "ExpectedGrade");

	$Pass1 = filter_input(INPUT_POST, "Pass1");
	$Pass2 = filter_input(INPUT_POST, "Pass2");


	PrepareFormFillSessions($FN, $LN, $StudentID, $Email, $Phone, $DOB, $StudentAthlete, $CurrentGrade, $ExpectedGrad, $Major);
	
	if ($Pass1 != $Pass2)
	{
		Header('Location: ../Views/RegisterView.php?Warning=1');
		exit();
	}

	$CSDatabase = new CS_Database_Object;
	$AlreadyExists = $CSDatabase->CheckUserExists($Email, $Phone, $StudentID);

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
		$RegistrationResult = $CSDatabase->RegisterUser($FN, $LN, $StudentID, $Email, $Phone, $DOB, $JoinedClub, $StudentAthlete, $Sport, $CurrentGrade, $ExpectedGrad, $Major, $Pass1, $ThreeDPrinting, $Robotics, $VideoGameDev, $AI, $MobileAppDev, $WebDev, $OtherInterest);
		
		ClearFormFillSessions();

		$CSClubID = $CSDatabase->ReturnCSClubID($StudentID);
		AuthenticateSession($CSClubID, $Pass1);
		
		Header('Location: ../Views/Home.php');
		exit();
	}
?>