<!DOCTYPE html>
<html>
	<head>
		<title>CS Club Registration</title>

		<link rel="stylesheet" type="text/css" href="../Style/DefaultStyle.css">
		<link rel="stylesheet" type="text/css" href="../Style/RegisterStyle.css">
	</head>

	<body>
		<div class="FormFrame">
			<div class="FrameInfo">
				<br>
				<span class="InlineCenter" id="Title">Minot State</span>
				<p>
					<span class="InlineCenter"><img class="Logo" src="../Media/2022 Logo.png"></span>
				</p>
				
				<!--
				<a href="Club Documents/TOS.html">terms and conditions</a>
				<a href="Club Documents/ClubConstitution.html">club constitution</a>
				<a href="Club Documents/MemberHandbook.html">member handbook</a>
				-->
			</div>

			<?php
				// Session prepare
				include '../Resources/SessionResources.php';

				$FN = "";
				$LN = "";
				$StudentID = "";
				$Email = "";
				$Phone = "";
				$Birthday = "";
				$StudentAthlete = false;
				$Sport = "";
				$Grade = "";
				$ExpectedGrad = "";
				$Major = "";

				if (isset($_SESSION["RegistrationFormLoaded"]))
				{
					$FN = $_SESSION["FN"];
					$LN = $_SESSION["LN"];

					$StudentID = $_SESSION["SID"];
					$Email = $_SESSION["Email"];
					$Phone = $_SESSION["Phone"];
					$Birthday = $_SESSION["Birthday"];
					$StudentAthlete = $_SESSION["Athlete"];
					$Grade = $_SESSION["CurrentGrade"];
					$ExpectedGrad = $_SESSION["ExpectedGrad"];
					$Major = $_SESSION["Major"];

					ClearFormFillSessions();
				}
			?>
			<form action="../Objects/Register.php" method="POST">
				<div class="HorizontalForm">
					<div class="VerticalForm">
						First Name:
						<input type="text" name="FirstName" value="<?=$FN?>" required>
						<br>
						
						Last Name
						<input type="text" name="LastName" value="<?=$LN?>" required>
						<br>
						
						Student ID
						<input type="text" name="StudentID" value="<?=$StudentID?>" required>
						<br>

						MSU E-Mail
						<input type="email" name="Email" value="<?=$Email?>" required>
						<br>

						Phone Number
						<input type="tel" name="Phone" value="<?=$Phone?>" required>
						<br>

						Birthday
						<input type="date" name="Birthday" value="<?=$Birthday?>" required>
						<br>

						<span>
							<input class="Athlete" type="checkbox" name="Athlete" value="Athlete">
							Student Athlete
						</span>
						<br>

						<select name="Sport" class="Sport" style="display: none;">
							<option disabled selected>Pick your sport</option>
							<option value="Golf">Golf</option>
							<option value="Football">Football</option>
							<option value="Basketball">Basketball</option>
							<option value="Wrestling">Wrestling</option>
							<option value="Baseball">Baseball</option>
							<option value="TrackCX">Track / Cross Country</option>
							<option value="Hockey">Hockey</option>
							<option value="Soccer">Soccer</option>
							<option value="Volleyball">Volleyball</option>							
						</select>

						<br class="SportHide" style="display: none;">

						<script>
							// Get the radio input and select box
							const radioInput = document.querySelector('input.Athlete');
							const selectBox = document.querySelector('select.Sport');
							const lineBreak = document.querySelector('br.SportHide');

							radioInput.addEventListener('click', function() {
								if (this.checked)
								{
									selectBox.style.display = 'block';
									lineBreak.style.display = 'block';
								}
								else
								{
									selectBox.style.display = 'none';
									lineBreak.style.display = 'none';
								}
							});
						</script>
					
						Current year in college
						<input class="Short" type="number" name="CurrentGrade" value=<?=$Grade?> required>
						<br>

						Expected graduation
						<select name="ExpectedGrade">
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>
							<option value="2025">2025</option>
							<option value="2026">2026</option>
							<option value="2027+">2027+</option>
						</select>
						<!--<input class="Short" type="number" name="ExpectedGrade" value=<?=$ExpectedGrad?> required>-->
						<br>
						
						Major(s)
						<input type="Major" name="Major" value="<?=$Major?>" required>
						<br>

						<span class="InlineCenter">-- Optional --</span>

						<span>
							<input class="Optional" type="checkbox">
							Fill out information on personal interests?
						</span>
						<br class="MinorHide" style="display: none;">

						<div class="Optional" style="display: none;">
							Select all your interests
							<br>
							<span>
								<input type="checkbox" name="3DPrinting">3D Printing
							</span>
							<br>
							
							<span>
								<input type="checkbox" name="Robotics">Robotics
							</span>
							<br>
							
							<span>
								<input type="checkbox" name="VideoGameDev">Video Game Development
							</span>
							<br>

							<span>
								<input type="checkbox" name="AI">Aritifical Intelligence
							</span>
							<br>

							<span>
								<input type="checkbox" name="MobileAppDev">Mobile Application Development
							</span>
							<br>
							
							<span>
								<input type="checkbox" name="WebDev">Web Development
							</span>
							<br>
							
							<span>
								<input type="text" name="OtherInterest" class="Radio" placeholder="Other">
							</span>
							<br>
						</div>
						<br>

						<script>
							const optionalRadioInput = document.querySelector('input.Optional');
							const optionalSelectBox = document.querySelector('div.Optional');
							const optionalLineBreak = document.querySelector('br.MinorHide');

							//optionalRadioInput.value = false;

							optionalRadioInput.addEventListener('click', function() {
								if (this.checked)
								{
									optionalSelectBox.style.display = 'block';
									optionalLineBreak.style.display = 'block';
								}
								else
								{
									optionalSelectBox.style.display = 'none';
									optionalLineBreak.style.display = 'none';
								}
							});
						</script>

						<span class="InlineCenter">-- Password --</span>

						Enter a Password
						<input type="password" name="Pass1" required>
						<br>

						Confirm Password
						<input type="password" name="Pass2" required>
						<br>
						
						<span class="InlineCenter"><input type="submit" class="Submit" value="Register"></span>
						<br>

<?php					$Warning = filter_input(INPUT_GET, "Warning");
						$WarningMessage = "";

						if (isset($Warning))
						{						
?>							<span class="InlineCenter">
								<div class="WarningBox">
									<span class="Warning">
<?php									if ($Warning == 1)
										{
											$WarningMessage = "Warning: Passwords do not match!";
										}
										else if ($Warning == 2)
										{
											$WarningMessage = "Warning: User already exists!</span><span class='InlineCenter'><a class='bluelink' href='LoginHelpView.php'>Need help logging in?</a>";
										}

										echo $WarningMessage;
?>									</span>
								</div>
							</span>
							<br>
<?php						}
?>						<br>
					</div>
				</div>
			</form>

			<span class="InlineCenter"><a href="../index.php">Return to login</a></span>
		</div>
	</body>
</html>