<?php
	include '../Resources/SessionResources.php';
	include '../Resources/DisplayResources.php';

	$Authenticated = CheckAuthentication();

	if (!$Authenticated)
	{
		Header('Location: ../Objects/Logout.php');
		exit();
	}
	
	// Form Data
	$Phone = filter_input(INPUT_POST, "Phone");
	$Birthday = filter_input(INPUT_POST, "Birthday");
	$Athlete = filter_input(INPUT_POST, "Athlete");
	$Sport = filter_input(INPUT_POST, "Sport");
	$Semester = filter_input(INPUT_POST, "Semester");
	$Major = filter_input(INPUT_POST, "Major");

	if ($Phone == "")
	{
		$Phone = "NULL";
	}

	if ($Birthday == "")
	{
		$Birthday = "NULL";
	}

	if ($Athlete == "on")
	{
		$Athlete = "TRUE";
	}
	else
	{
		$Athlete = "FALSE";
		$Sport = "NULL";
	}

	if ($Semester == "")
	{
		$Semester = "NULL";
	}

	if ($Major == "")
	{
		$Major = "NULL";
	}

	echo "Phone: " . $Phone . "<br>";
	echo "Birthday: " . $Birthday . "<br>";
	echo "Athlete: " . $Athlete . "<br>";
	echo "Sport: " . $Sport . "<br>";
	echo "Semester: " . $Semester . "<br>";
	echo "Major: " . $Major . "<br>";

	$CSDatabase = new CS_Database_Object;
	$CSClubID = $_SESSION["SessionID"];

	$Result = $CSDatabase->UpdateUser($CSClubID, $Phone, $Birthday, $Athlete, $Sport, $Semester, $Major);

	if ($Result)
	{
		echo "Succesful update!";
		Header('Location: ../Views/Home.php?Selected=MyProfile');
	}
?>