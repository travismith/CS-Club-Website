<?php
	include '../Resources/SessionResources.php';
	include '../Resources/DisplayResources.php';

	$Authenticated = CheckAuthentication();

	if (!$Authenticated)
	{
		Header('Location: ../Objects/Logout.php');
		exit();
	}

	// Form Data //
	$EventName = filter_input(INPUT_POST, "EventName");
	$EventLocation = filter_input(INPUT_POST, "EventLocation");
	$EventDescription = filter_input(INPUT_POST, "EventDescription");
	
	$StartDate = filter_input(INPUT_POST, "StartDate");
	$MultiDay = filter_input(INPUT_POST, "MultiDay");
	$EndDate = filter_input(INPUT_POST, "EndDate");
	$StartTime = filter_input(INPUT_POST, "StartTime");
	$EndTime = filter_input(INPUT_POST, "EndTime");

	$_3DPrinting = filter_input(INPUT_POST, "3DPrinting");
	$Robotics = filter_input(INPUT_POST, "Robotics");
	$VideoGameDev = filter_input(INPUT_POST, "VideoGameDev");
	$AI = filter_input(INPUT_POST, "AI");
	$WebDev = filter_input(INPUT_POST, "WebDev");
	$MobileAppDev = filter_input(INPUT_POST, "MobileAppDev");
	$OtherInterestInput = filter_input(INPUT_POST, "OtherInterestInput");

	$Start_AM_PM = "AM";
	$End_AM_PM = "AM";

	// Form preparation //
	$StartHour = substr($StartTime, 0, 2);
	$EndHour = substr($StartTime, 0, 2);

	if ($StartHour > 12)
	{
		$Start_AM_PM = "PM";
	}

	if ($EndHour > 12)
	{
		$End_AM_PM = "PM";
	}

	if ($MultiDay == "on")
	{
		$MultiDay = "TRUE";
	}
	else
	{
		$MultiDay = "FALSE";
	}

	if ($EndDate == NULL)
	{
		$EndDate = "NULL";
	}

	if ($StartTime == NULL)
	{
		$StartTime = "NULL";
	}

	if ($EndTime == NULL)
	{
		$EndTime = "NULL";
	}

	if ($_3DPrinting == "on")
	{
		$_3DPrinting = "TRUE";
	}
	else
	{
		$_3DPrinting = "FALSE";
	}

	if ($Robotics == "on")
	{
		$Robotics = "TRUE";
	}
	else
	{
		$Robotics = "FALSE";
	}

	if ($VideoGameDev == "on")
	{
		$VideoGameDev = "TRUE";
	}
	else
	{
		$VideoGameDev = "FALSE";
	}

	if ($AI == "on")
	{
		$AI = "TRUE";
	}
	else
	{
		$AI = "FALSE";
	}

	if ($WebDev == "on")
	{
		$WebDev = "TRUE";
	}
	else
	{
		$WebDev = "FALSE";
	}

	if ($MobileAppDev == "on")
	{
		$MobileAppDev = "TRUE";
	}
	else
	{
		$MobileAppDev = "FALSE";
	}

	if (!isset($OtherInterestInput) || $OtherInterestInput == "")
	{
		$OtherInterestInput = NULL;
	}
?>

<html>
	<body>
		<u>Form</u>

		<div>
			Name: <?=$EventName?>
			<br>
			Location: <?=$EventLocation?>
			<br>
			Description: <?=$EventDescription?>

			<br><br>

			Start Date: <?=$StartDate?>
			<br>
			MultiDay: <?=$MultiDay?>
			<br>
			End Date: <?=$EndDate?>

			<br><br>

			<?php

			?>
			Start Time: <?=$StartTime?>
			<br>
			Start AM PM: <?=$Start_AM_PM?>
			<br>
			End Time: <?=$EndTime?>
			<br>
			End AM PM: <?=$End_AM_PM?>
			<br>

			<?php

			?>
			<br><br>

			3D Printing: <?=$_3DPrinting?>
			<br>
			Robotics: <?=$Robotics?>
			<br>
			Video Game Development: <?=$VideoGameDev?>
			<br>
			AI: <?=$AI?>
			<br>
			Web Development: <?=$WebDev?>
			<br>
			Mobile App Development: <?=$MobileAppDev?>
			<br>
			<!--
				Other Interest (Checkbox): //$OtherInterest
				<br>
				Other Interest: //$OtherInterestInput
			-->
		</div>

		<?php
			$CSDatabase = new CS_Database_Object;
			$CSClubID = $_SESSION["SessionID"];

			$Result = $CSDatabase->CreateEvent($CSClubID, $EventName, $EventLocation, $EventDescription, 0 /* Recurring code */, $StartDate, $EndDate, $StartTime,
			$Start_AM_PM, $EndTime, $End_AM_PM, $_3DPrinting, $Robotics, $VideoGameDev, $AI, $MobileAppDev, $WebDev, $OtherInterestInput);

			if ($Result)
			{
				echo $StartDate . "<br>";
				$LinkYear = substr($StartDate, 0, 4);
				$LinkMonth = substr($StartDate, 5, 2);
				$LinkDay = substr($StartDate, 8, 2);

				echo "Day: " . $LinkDay . "<br>";
				echo "Month: " . $LinkMonth . "<br>";
				echo "Year: " . $LinkYear;
				
				Header("Location: ../Views/Home.php?Selected=Calendar&Month=$LinkMonth&Day=$LinkDay&Year=$LinkYear");
			}
			else
			{
				exit();
			}
		?>
	</body>
</html>