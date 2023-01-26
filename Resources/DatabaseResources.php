<?php

/*

What I think I have right about my application securty:
- Escaping every SQL query
- Checking authentication on every page other then index (login),
  RegisterView (signup), and Register.php (backend of registration)

*/

class CS_Database_Object
{
	private $dbServer = "127.0.0.1";
	private $dbName = "msucsclub";
	private $dbPort = 3309;
	private $Database;

	private $dbRegistrationUser = "RegistrationUser";
	private $dbRegistrationPass = "Change this to the password of your RegistrationUser";

	private $dbEventUser = "EventUser";
	private $dbEventPass = "Change this to the password of your EventUser";

	function __destruct()
	{
		mysqli_close($this->Database);
	}

    private function ReturnDBConnection($User)
    {
		$Pass = "";

		if ($User == "RegistrationUser")
		{
			$Pass = $this->dbRegistrationPass;
		}
		else if ($User == "EventUser")
		{
			$Pass = $this->dbEventPass;
		}

		$this->Database = new mysqli(
			$this->dbServer,
			$User,
			$Pass,
			$this->dbName,
			$this->dbPort
		);

        return $this->Database;
    }

	function FindEventsOnDate($DisplayType, $Month, $Day, $Year)
	{
		$Database = $this->ReturnDBConnection("EventUser");

		$SQLQueryDate = "$Year-$Month-$Day";
		

		if ($DisplayType == "Large")
		{
			$SQL = "SELECT `Name`, `Location`, `Description`, RecurringCode, StartDate, EndDate, StartTime, Start_AM_PM, EndTime, End_AM_PM ";
		}
		else if ($DisplayType == "Small")
		{
			$SQL = "SELECT `Name`, 3DPrinting, Robotics, VideoGameDev, AI, MobileAppDev, WebDev, OtherInterest ";
		}
		
		$SQL = $SQL . "FROM Events WHERE Events.StartDate = '$SQLQueryDate';";
		$Results = $Database->query($SQL);

		if ($Results)
		{
			return $Results;
		}
		else
		{
			echo "Error: " . $Database->error;
			exit();
		}
	}

	function CreateEvent($ClubID, $Name, $Location, $Description, $RecurringCode, $StartDate, $EndDate, $StartTime, $Start_AM_PM, $EndTime, $End_AM_PM, $_3DPrinting, $Robotics, $VideoGameDev, $AI, $MobileAppDev, $WebDev, $OtherInterest)
	{
		$Database = $this->ReturnDBConnection("EventUser");

		$SQL = "INSERT INTO `Events` VALUES (
				NULL,
				$ClubID,
				'$Name',
				'$Location',
				'$Description',
				$RecurringCode,
				'$StartDate', 
				";

				if ($EndDate == 'NULL')
				{
					$SQL = $SQL . "$EndDate, ";
				}
				else
				{
					$SQL = $SQL . "'$EndDate', ";
				}

		$SQL = $SQL . 
				"
				'$StartTime',
				'$Start_AM_PM',
				'$EndTime',
				'$End_AM_PM',
				$_3DPrinting,
				$Robotics,
				$VideoGameDev,
				$AI,
				$MobileAppDev,
				$WebDev,
				'$OtherInterest'
				);";

		$Database->real_escape_string($SQL);
		$Result = $Database->query($SQL);

		if ($Result)
		{
			return $Result;
		}
		else
		{
			echo "SQL Error: " . $Database->error;
			exit();
		}
	}

	function ReturnCSClubID($LoginID)
	{
		$Database = $this->ReturnDBConnection("RegistrationUser");
		$SQL = "SELECT CSClubID FROM People WHERE People.StudentID =  '$LoginID' OR People.EMail = '$LoginID';";
		
		$Database->real_escape_string($SQL);
		$Table = $Database->query($SQL);

		if ($Table)
		{
			if ($Table->num_rows > 0)
			{
				$User = $Table->fetch_row();
				
				return $User[0];
			}
		}
		else
		{
			echo "SQL Error <br> $SQL <br>";
			exit();
		}
	}

	function GetPasswordHash($CSClubID)
	{
		$Database = $this->ReturnDBConnection("RegistrationUser");
		$SQL = "SELECT PasswordHash FROM People WHERE People.CSClubID = $CSClubID;";

		$Database->real_escape_string($SQL);
		$Table = $Database->query($SQL);

		if ($Table)
		{
			if ($Table->num_rows > 0)
			{
				$Result = $Table->fetch_row();
				
				return $Result[0];
			}
		}
		
		return 0;
	}

	function AuthenticateUser($LoginID, $PasswordAttempt)
	{
		// Codes
		// 1 - Success
		// 2 - Incorrect password
		// 3 - User does not exist
		$Database = $this->ReturnDBConnection("RegistrationUser");
		$SQL = "SELECT PasswordHash, CSClubID FROM People WHERE People.StudentID =  '$LoginID' OR People.EMail = '$LoginID';";
		
		$Database->real_escape_string($SQL);
		$Table = $Database->query($SQL);

		if ($Table)
		{
			if ($Table->num_rows > 0)
			{
				$Result = $Table->fetch_row();
				$PassHash = $Result[0];
				$CSClubID = $Result[1];

				if (password_verify($PasswordAttempt, $PassHash))
				{
					AuthenticateSession($C8SClubID, $PasswordAttempt); // Start session here

					return 1;
				}
				else
				{
					return 2; // Incorrect password
				}
			}
			else
			{
				return 3; // No user found
			}
		}
		else
		{
			echo "SQL Error! <br> $SQL <br>";
			exit();
		}
	}

	function CheckUserExists($Email, $Phone, $StudentID)
	{
		$Database = $this->ReturnDBConnection("RegistrationUser");
		$SQL = "SELECT CSClubID, FirstName, LastName FROM `People` WHERE People.EMail = '$Email' OR People.Phone = '$Phone' or People.StudentID = '$StudentID';";

		$Database->real_escape_string($SQL);
		$Result = $Database->query($SQL);
		
		if ($Result)
		{
			if ($Result->num_rows > 0)
			{
				$User = $Result->fetch_row();

				echo "User: $User[1] $User[2] already exists. If you are seeing this, there was an error redirecting back to the reigstration form view. <br>";
				echo "CS Club ID: $User[0]";

				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			echo "MySQL issue in CheckUserExists() <br>";
			echo "SQL Query: $SQL <br><br>";
			
			exit();
		}
	}

	function RegisterUser($FN, $LN, $StudentID, $Email, $Phone, $DOB, $JoinedClub, $StudentAthlete, $Sport, $CurrentGrade, $ExpectedGrad, $Major, $Pass1, $ThreeDPrinting, $Robotics, $VideoGameDev, $AI, $MobileAppDev, $WebDev, $OtherInterest)
	{
		$Database = $this->ReturnDBConnection("RegistrationUser");

		$CheckUserExists = "SELECT * FROM `People` WHERE People.EMail = $Email OR People.Phone = $Phone or People.StudentID = $StudentID;";
		$SQL = "INSERT INTO `People` VALUES (
		NULL, 
		20,
		'$FN',
		'$LN',
		$StudentID,
		'$Email',
		'$Phone',
		'$DOB',
		'$JoinedClub',
		$StudentAthlete,
		";
	
		if ($StudentAthlete)
		{
			$SQL = $SQL . "'$Sport', ";
		}
		else
		{
			$SQL = $SQL . "NULL, ";
		}
	
		$SQL = $SQL . 
		"
		$CurrentGrade,
		$ExpectedGrad,
		'$Major', ";
		
		$PasswordHash = password_hash($Pass1, PASSWORD_DEFAULT);
	
		$SQL = $SQL .
		"
		$ThreeDPrinting, 
		$Robotics, 
		$VideoGameDev, 
		$AI, 
		$MobileAppDev, 
		$WebDev, ";

		if ($OtherInterest != "")
		{
			$SQL = $SQL . "'$OtherInterest', ";
		}
		else
		{
			$SQL = $SQL . "NULL, ";
		}

		$SQL = $SQL . "'$PasswordHash');";

		echo $SQL . "<br><br>";

		$Database->real_escape_string($SQL);
		$Result = $Database->query($SQL);

		if ($Result)
		{
			echo "Success";
			return $Result;
		}
		else
		{
			echo "SQL Error: " . $Database->error;
			exit();
		}
	}

	function SelectUser($CSClubID, $SelectionSQL)
	{
		// Error codes
		// -1 No result
		$Database = $this->ReturnDBConnection("RegistrationUser");
		$SelectionSQL = "SELECT $SelectionSQL FROM `People` WHERE `People`.CSClubID = $CSClubID;";
		$Table = $Database->query($SelectionSQL);
		
		if ($Table)
		{
			if ($Table->num_rows > 0)
			{
				$User = $Table->fetch_row();
				return $User;
			}
			else
			{
				return -1;
			}
		}
		else
		{
			echo "SQL Error: " . $Database->error;
			exit();
		}
	}
}


?>
