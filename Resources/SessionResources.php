<?php
	session_start();
	include 'DatabaseResources.php';

	function AuthenticateSession($CSClubID, $PasswordAttempt)
	{
		$_SESSION["SessionID"] = $CSClubID;
		$_SESSION["SessionPasswordAttempt"] = $PasswordAttempt;
	}

	function CheckAuthentication()
	{
		if (isset($_SESSION["SessionID"]) && isset($_SESSION["SessionPasswordAttempt"]))
		{
			$ClubID = $_SESSION["SessionID"];
			$Password = $_SESSION["SessionPasswordAttempt"];

			$CSDatabase = new CS_Database_Object;
			$Hash = $CSDatabase->GetPasswordHash($ClubID);

			$Check = password_verify($Password, $Hash);

			return $Check;
		}
		
		return false; // Something was unset
	}

	function UnauthenticateSession()
	{
		unset($_SESSION["SessionID"]);
		unset($_SESSION["SessionPasswordAttempt"]);
	}

	function PrepareFormFillSessions($FN, $LN, $SID, $Email, $Phone, $Birthday, $Athlete, $CurrentGrade, $ExpectedGrad, $Major)
	{
		$_SESSION["RegistrationFormLoaded"] = true;

		$_SESSION["FN"] = $FN;
		$_SESSION["LN"] = $LN;
		$_SESSION["SID"] = $SID;
		$_SESSION["Email"] = $Email;
		$_SESSION["Phone"] = $Phone;
		$_SESSION["Birthday"] = $Birthday;
		$_SESSION["Athlete"] = $Athlete;
		$_SESSION["CurrentGrade"] = $CurrentGrade;
		$_SESSION["ExpectedGrad"] = $ExpectedGrad;
		$_SESSION["Major"] = $Major;
	}

	function ClearFormFillSessions()
	{
		unset($_SESSION["RegistrationFormLoaded"]);
		
		$_SESSION["FN"] = "";
		$_SESSION["LN"] = "";
		$_SESSION["SID"] = "";
		$_SESSION["Email"] = "";
		$_SESSION["Phone"] = "";
		$_SESSION["Birthday"] = "";
		$_SESSION["Athlete"] = "";
		$_SESSION["CurrentGrade"] = "";
		$_SESSION["ExpectedGrad"] = "";
		$_SESSION["Major"] = "";
	}
?>