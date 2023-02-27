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
	private $dbName = "MSUCSClub";
	private $dbPort = 3309;
	private $dbSocket = "/var/run/mysqld/mysqld.sock";
	private $Database;

	private $dbRegistrationUser = "RegistrationUser";
	private $dbEventUser = "EventUser";

	function __destruct()
	{
		if ($this->Database)
		{
			mysqli_close($this->Database);
		}
	}

    private function ReturnDBConnection($User)
    {
		if (strpos(php_uname(), 'Windows') !== false)
		{
			include "C:\Users\Travis\Documents\DatabasePasswords.php";
			$Pass = "";

			if ($User == "RegistrationUser")
			{
				$Pass = $dbRegistrationPass;
			}
			else if ($User == "EventUser")
			{
				$Pass = $dbEventPass;
			}
			
			// Connect to the MySql server using port number
			$this->Database = new mysqli(
				$this->dbServer,
				$User,
				$Pass,
				$this->dbName,
				$this->dbPort
			);
		}
		else
		{
			include "/var/wwwResources/DatabasePasswords.php";
			$Pass = "";

			if ($User == "RegistrationUser")
			{
				$Pass = $dbRegistrationPass;
			}
			else if ($User == "EventUser")
			{
				$Pass = $dbEventPass;
			}
			
			// Connect to the MySql server using socket
			$this->Database = new mysqli(
				$this->dbServer,
				$User,
				$Pass,
				$this->dbName
			);
		}

        return $this->Database;
    }

	function ClubRoster()
	{
		$Database = $this->ReturnDBConnection("RegistrationUser");

		$SQL = "SELECT Username, CSClubID, Major, FirstName, LastName FROM People;";

		$MembersList = $Database->query($SQL);

		if ($MembersList)
		{
			return $MembersList;
		}
		else
		{
			echo "There was an error while retreiving club roster information.";
			return 0;
		}

	}

	function GetUserType($CSClubID)
	{
		$Database = $this->ReturnDBConnection("RegistrationUser");
		$SQL = "SELECT AccountType FROM People WHERE People.CSClubID = $CSClubID;";

		$Result = $Database->query($SQL);

		if ($Result)
		{
			$User = $Result->fetch_row();
			$AccountType = $User[0];

			return $AccountType;
		}
		else
		{
			return 0;
		}
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
		$SQL = "SELECT CSClubID FROM People WHERE People.Username =  '$LoginID' OR People.EMail = '$LoginID';";
		
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
		$SQL = "SELECT PasswordHash FROM People WHERE People.CSClubID = '$CSClubID';";

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
		$SQL = "SELECT PasswordHash, CSClubID FROM People WHERE People.Username =  '$LoginID' OR People.EMail = '$LoginID';";
		
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

					AuthenticateSession($CSClubID, $PasswordAttempt); // Start session here
				
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

	function CheckUserExists($Email, $Phone)
	{
		$Database = $this->ReturnDBConnection("RegistrationUser");
		$SQL = "SELECT CSClubID, Username FROM `People` WHERE People.EMail = '$Email' OR People.Phone = '$Phone';";

		$Database->real_escape_string($SQL);
		$Result = $Database->query($SQL);
		
		if ($Result)
		{
			if ($Result->num_rows > 0)
			{
				$User = $Result->fetch_row();

				echo "User: $User[1] already exists. If you are seeing this, there was an error redirecting back to the reigstration form view. <br>";
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

	function RegisterUser($Username, $Email, $FirstName, $LastName, $Password, $JoinedOn)
	{
		$Database = $this->ReturnDBConnection("RegistrationUser");

		$PasswordHash = password_hash($Password, PASSWORD_DEFAULT);

		$SQL = "INSERT INTO `People` (Username, EMail, FirstName, LastName, CSClubID, AccountType, PasswordHash, JoinedOn) VALUES
		('$Username', '$Email', '$FirstName', '$LastName', NULL, 20, '$PasswordHash', '$JoinedOn');";

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

	function UpdateUser($CSClubID, $Phone, $Birthday, $Athlete, $Sport, $Semester, $Major)
	{
		$Database = $this->ReturnDBConnection("RegistrationUser");

		$SQL = "
		UPDATE People
		SET Phone = '$Phone', ";
		
		if ($Birthday == "NULL")
		{
			$SQL = $SQL . "Birthday = $Birthday, ";
		}
		else
		{
			$SQL = $SQL . "Birthday = '$Birthday', ";
		}
		
		$SQL = $SQL . "StudentAthlete = $Athlete, Sport = '$Sport', Semester = $Semester, Major = '$Major'
		WHERE CSClubID = $CSClubID;";

		echo "<br><br>";
		echo "SQL: " . $SQL;

		echo "<br>";

		$Result = $Database->query($SQL);

		if ($Result)
		{
			return $Result;
		}
		else
		{
			echo "SQL Error: " . $Database->error;
			//exit();
			return false;
		}
	}

	function SelectUser($ID, $ID_Type, $SelectionSQL)
	{
		// Error codes
		// -1 No result

		$Database = $this->ReturnDBConnection("RegistrationUser");
		
		if ($ID_Type == "Username")
		{
			$SelectionSQL = "SELECT $SelectionSQL FROM `People` WHERE People.Username = '$ID';";
		}
		else if ($ID_Type == "CSClubID")
		{
			$SelectionSQL = "SELECT $SelectionSQL FROM `People` WHERE People.CSClubID = '$ID';";
		}

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
				echo "An error has occured.";
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