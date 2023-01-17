<?php
	// Other
	function NewRegistrationOutput($Email, $Phone, $FN, $LN, $SID, $DOB, $JoinedClub, $StudentAthlete, $ComputerScience, $CyberSecurity, $Math, $OtherMajor, $ThreeDPrinting, $VideoGameDev, $AI, $MobileAppDev, $WebDev, $OtherInterest, $CurrentGrade, $ExpectedGrad, $Pass1, $Pass2, $PasswordHash)
	{
		echo "New Account Information: <br>";

		echo "Email: $Email <br>";
		echo "Phone: $Phone <br><br>";

		echo "First Name: $FN <br>";
		echo "Last Name: $LN <br>";
		
		echo "Student ID: $SID <br>";
		echo "Birthday: $DOB <br>";
		echo "Joined club on: $JoinedClub <br>";

		if ($StudentAthlete)
		{
			echo "Student Athlete: Yes<br>";
			echo "Sport: $Sport<br><br>";
		}
		else
		{
			echo "Student Athlete: No";
		}



		echo "Majors: <br>";
		// MAJORS

		if ($ComputerScience)
		{
			echo "- Computer Science <br>";
		}

		if ($CyberSecurity)
		{
			echo "- Cyber Security <br>";
		}

		if ($Math)
		{
			echo "- Math <br>";
		}

		if ($OtherMajor)
		{
			echo "- $OtherMajor <br>";
		}

		// INTERESTS
		echo "Interests: <br>";

		if ($ThreeDPrinting)
		{
			echo "- 3D Printing <br>";
		}

		if ($Robotics)
		{
			echo "- Robotics <br>";
		}

		if ($VideoGameDev)
		{
			echo "- Video Game Development <br>";
		}

		if ($AI)
		{
			echo "- Artificial Intelligence <br>";
		}

		if ($MobileAppDev)
		{
			echo "- Mobile App Development <br>";
		}

		if ($WebDev)
		{
			echo "- Web Development <br>";
		}

		if ($OtherInterest)
		{
			echo "- $OtherInterest <br>";
		}

		echo "<br>";

		echo "Year in school: $CurrentGrade  / $ExpectedGrad <br>";
		
		echo "Password 1: $Pass1 <br>";
		echo "Password 2: $Pass2 <br><br>";


		echo "Password Hash: $PasswordHash <br>";

		$Matches = password_verify($Pass1, $PasswordHash);

		if ($Matches)
		{
			echo "Password hash matches input! <br><br>";
		}
	}
?>