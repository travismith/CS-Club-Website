<?php
		// Homepage displays

		function ContentTitle($Title)
		{
?>			<br>
			<!--
			<div class="LogoDisplay">
				<img class="ContentLogo" src="../Media/2022 Logo.png">-->
				<span class="Title"><?=$Title?></span>
				<!--<img class="ContentLogo" src="../Media/2022 Logo.png">
			</div>
			-->
<?php	}

		include 'Modulation/Newsletter.php';

		function ClubMembers()
		{
			$CSDatabase = new CS_Database_Object;
			$SelectedUsername = filter_input(INPUT_GET, "Username");
			if ($SelectedUsername == "")
			{
				ContentTitle("CS Club Members");

?>				<div class="ClubMembers">
					<div class="MemberSearch">
						<span class="InlineCenter">
							<select class="MemberSearch">
								<option selected disabled>Search Filter</option>
								<option value="Name">Name</option>
								<option value="Major">Major</option>
								<option value="Class">Graduating Class</option>
								<option value="Sport">Sport</option>
							</select>

							<input type="text" placeholder="Search" name="Search" class="MemberSearch">
							<button class="MemberSearch" onclick="MemberSearch()">Search</button>
						</span>
					</div>

					<script>
						// Add all the search javascript here
					</script>

					<br>

<?php				$MemberArray = $CSDatabase->ClubRoster();

?>					<div class="ResultDisplay">
<?php					if ($MemberArray)
						{
							foreach ($MemberArray as $Member)
							{
								$Username = $Member["Username"];
								$CSClubID = $Member["CSClubID"];
								$Major = $Member["Major"];
								$FirstName = $Member["FirstName"];
								$LastName = $Member["LastName"];

?>								<a href="./Home.php?Selected=Members&Username=<?=$Username?>" class="MemberButton">
									<div class="ResultContainer">
										<span class="InlineCenter" id="MemberSearchUsername"><?=$Username?></span>
										<span class="InlineCenter"><img src="../Media/PFPs/<?=$CSClubID?>" onerror="this.src='../Media/PFPs/Default'" class="PFPS"></span>
										<span class="InlineCenter" id="MemberSearchName"><?=$FirstName . " " . $LastName?></span>
										
										<!--<span class="InlineCenter"><?=$Major?></span>-->
									</div>
								</a>
								
								<div class="ResultSpacer"></div>
<?php						}
						}
?>					</div>
				</div>
<?php		}
			else
			{
				$Result = $CSDatabase->SelectUser($SelectedUsername, "Username", "CSClubID, FirstName, LastName, StudentAthlete, Sport, Semester, Major");

				if (!$Result)
				{
					Header('Location: ./Home.php?Selected=Members');
					exit();
				}
				else
				{
					$CSClubID = $Result[0];
					$FirstName = $Result[1];
					$LastName = $Result[2];
					$StudentAthlete = $Result[3];
					$Sport = $Result[4];
					$Semester = $Result[5];
					$Major = $Result[6];
?>
					<div class="ProfileHighlight">
						<span class="InlineCenter">
							<div class="ProfileTokenWrapper">
								<span class="InlineCenter"><span class="HighlightUsername"><?=$SelectedUsername?></span></span>
								<span class="InlineCenter"><img src="../Media/PFPs/<?=$CSClubID?>" onerror="this.src='../Media/PFPs/Default'" class="HighlightPFP"></span>
							</div>
						</span>

						<div class="ProfileInformation">
							CS Tokens
							<div class="Tokens">
<?php							$TokenString = "";
								$TokenId = "";
								if ($StudentAthlete)
								{
									$TokenString = "Athlete - " . $Sport;
									$TokenId = "Athlete";
								}

								/*
								if ($ADD TOKENS HERE)
								{

								}
								*/
?>
								<span class="Token" id="<?=$TokenId?>">
										<?=$TokenString?>
								</span>
							</div>
							<br>

							Name: <?=$FirstName . " " . $LastName?>
							<br><br>
							
							Club Position:
							<br><br>

							Interests:
							<br><br><br><br>

							Projects:
							<br><br>

							<img class="UnderConstructionS" src="../Media/UnderConstruction.png">
						</div>
					</div>
<?php			}
			}
		}

		function CalendarDay($MainMonth, $PrintDay, $PrintMonth, $PrintYear)
		{
			// Get the current month and year
			$month = filter_input(INPUT_GET, "Month");
			$day = filter_input(INPUT_GET, "Day");
			$year = filter_input(INPUT_GET, "Year");
			
			//echo $month . " " . $day . " " . $year;

?>			<td
				<?php
					if (!$MainMonth)
					{
						echo "class='Grey'";
					}
					else
					{
						echo "class='White'";
					}
			
					if ($PrintDay == $day && $PrintMonth == $month && $PrintYear == $year)
					{
						echo "id='Selected'";
					}
				?>
			>
				<div class="CalendarDate">
					<a class="CalendarButton" href="?Selected=Calendar&Month=<?=$PrintMonth?>&Day=<?=$PrintDay?>&Year=<?=$PrintYear?>">
						<div class="UpperHalf">
							<span class="InlineRight DayOfMonth"
							<?php
								if ($PrintDay == Date('j') && $PrintMonth == Date('n') && $PrintYear == Date('Y') && $MainMonth)
								{
									echo "id='Today'";
								}
							?>
							>
								<?php
									echo $PrintDay;
								?>
							</span>
						</div>

						<div class="LowerHalf">
							<?php
								$CSDatabase = new CS_Database_Object;
								$Events = $CSDatabase->FindEventsOnDate("Small", $PrintMonth, $PrintDay, $PrintYear);
								//var_dump($Events);

								$DateItems = "";
								if ($Events && $Events->num_rows > 0)
								{
									foreach ($Events as $Event)
									{
										DisplaySmallEvent($Event);
									}
								}
								else
								{?>
									<span id='SmallEventName'></span>
						<?php	}?>
							<br>
						</div>
					</a>
				</div>
			</td>
<?php	}

		function ClubCalendar()
		{
			//ContentTitle("2022-2023 Club Calendar");

			date_default_timezone_set('America/Chicago');

			// Get the current month and year
			$month = filter_input(INPUT_GET, "Month");
			$year = filter_input(INPUT_GET, "Year");
			$day = filter_input(INPUT_GET, "Day");

			// Get the number of days in the month
			$RolledPrevMonth = $month - 1;
			if ($RolledPrevMonth < 1)
			{
				$RolledPrevMonth = $RolledPrevMonth + 12;
			}

			$numDaysPrev = cal_days_in_month(CAL_GREGORIAN, $RolledPrevMonth, $year);
			$numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

			$RolledNextMonth = $month + 1;

			if ($RolledNextMonth > 12)
			{
				$RolledNextMonth = $RolledNextMonth - 12;
			}

			$numDaysNext = cal_days_in_month(CAL_GREGORIAN, $RolledNextMonth, $year);

			// Get the names of the days of the week and the months
			$calInfo = cal_info(0);
			$daysOfWeek = Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
			$months = Array("January", "Februrary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
			
			// Get the current month and year
			$month = filter_input(INPUT_GET, "Month");
			$day = filter_input(INPUT_GET, "Day");
			$year = filter_input(INPUT_GET, "Year");

			$CSDatabase = new CS_Database_Object;
			$CSClubID = $_SESSION["SessionID"];
?>			
			<div class="Calendar">
				<br>
				<span class="InlineCenter">
					<div class="CalendarControls">
						<div class="VerticalCenter">
							<div class="DividerButton">
								<span class="InlineCenter">
									<a class="MonthMove" href="?Selected=Calendar&
										<?php
											$PrevMonth = $month - 1;
											$PrevYear = $year;

											if ($PrevMonth < 1)
											{
												$PrevMonth = $PrevMonth + 12;
												$PrevYear = $PrevYear - 1;
											}

											echo "Month=$PrevMonth&Day=1&Year=$PrevYear";
										?>
									">
										<img src="../Media/CalendarArrowButton.png" class="Rotate180">
									</a>
								</span>
							</div>
						</div>

						<div class="Divider">
							<span class="MonthYearDisplay">
								<?php
									$PrintMonth = $months[$month - 1];
									echo $PrintMonth . " " . $year;
								?>
							</span>
							<br>
							<?php
								$InputDay = $day;

								if ($InputDay <= 9)
								{
									$InputDay = "0" . $InputDay;
								}

								$InputMonth = $month;

								if ($InputMonth <= 9)
								{
									$InputMonth = "0" . $InputMonth;
								}
							?>
							<span class="InlineCenter"><?=$InputMonth?>-<?=$InputDay?>-<?=$year?></span>
							<!--<span class="InlineCenter"><input class="MonthMove" type="date" value="<?=$year?>-<?=$InputDay?>-<?=$InputMonth?>"></span>-->
						</div>

						<div class="VerticalCenter">
							<div class="DividerButton">
								<span class="InlineCenter">
									<a class="MonthMove" href="?Selected=Calendar&
									<?php
										$NextMonth = $month + 1;
										$NextYear = $year;

										if ($NextMonth > 12)
										{
											$NextMonth = $NextMonth - 12;
											$NextYear = $NextYear + 1;
										}

										echo "Month=$NextMonth&Day=1&Year=$NextYear";
									?>
									">
										<img src="../Media/CalendarArrowButton.png">
									</a>
								</span>
							</div>
						</div>
					</div>
				</span>
				
				<br>
				<br>
				<div class="CalendarDisplaySpace">
					<br>
					<div class="Events">
						<?php
							$Events = $CSDatabase->FindEventsOnDate("Large", $month, $day, $year);

							if ($Events->num_rows > 0)
							{
								foreach ($Events as $Event)
								{
									DisplayLargeEvent($Event);
								}
							}
							else
							{
								echo "No results for this date.";
							}
						?>
					</div>
					<br>
				</div>
				
				<br>
				Click on a day of the week you are free to highlight things you're available for!
				<table class='CalendarFrame'>
					<tr class='DayLabel'>
						<?php
								foreach ($daysOfWeek as $WeekdayLabel)
								{?>
									<th class='DayLabel'>
										<?php
											echo $WeekdayLabel;
										?>
									</th>
						<?php 	}?>
					</tr>

					<?php
						$RowCount = 1;
						$CurrentWeekday = 0;

						// Indent the first week with grey squares leading
						// leading up to the date
						
						$WeekdayOfFirst = date('w', mktime(0, 0, 0, $month, 1, $year));//$numDaysPrev - date('w', mktime(0, 0, 0, $month, 1, $year));
						$PrevMonthDay = $numDaysPrev - $WeekdayOfFirst + 1;
						$NumPrevDays = $numDaysPrev - $PrevMonthDay + 1;
					
						if ($NumPrevDays > 0 && $NumPrevDays <= 7)
						{
							for ($X = $PrevMonthDay; $X <= $numDaysPrev; $X++)
							{
								$PrevMonthDay++;
								
								CalendarDay(false, $X, $RolledPrevMonth, $year - 1);
								$CurrentWeekday++;
							}
						}

						// Print the days of the month
						for ($DayOfMonth = 1; $DayOfMonth <= $numDays; $DayOfMonth++)
						{
							// Start a new row on the first day of the week
							if ($CurrentWeekday == 0)
							{
								echo "<tr>";
							}

							CalendarDay(true, $DayOfMonth, $month, $year);
							$CurrentWeekday++;

							// End the row on the last day of the week
							if ($CurrentWeekday == 7)
							{
								echo "</tr>";
								$CurrentWeekday = 0;
							}
						}


						$NextMonthDay = 1;
						if ($CurrentWeekday > 0 && $CurrentWeekday < 7)
						{
							while ($CurrentWeekday < 7 && $CurrentWeekday > 0)
							{
								$CurrentWeekday++;

								CalendarDay(false, $NextMonthDay, $RolledNextMonth, $year + 1);
								$NextMonthDay++;
							}
						}
					?>
				</table>

				<?php
					$UserType = $CSDatabase->GetUserType($CSClubID);
					$EventLead = false;

					if ($UserType > 40)
					{
						$EventLead = true;
					}
				?>

				<br>
				<div class="CalendarDisplaySpace" id="CreateEvent"
					<?php
						if (!$EventLead)
						{
							echo "style='display: none;'";
						}
					?>
				>
					<span class="DisplayHeader">Create an Event</span>

					<span class="InlineCenter">
						<form action="../Objects/Event.php" method="POST" class="CreateEventForm">
							<div class="FormCenter">
								<span class="AlignLeft">
									<label for="EventName">Name</label>
									<input type="text" name="EventName" required>
								</span>

								<span class="AlignLeft">
									<label for="EventLocation">Location</label>
									<input type="text" name="EventLocation" required>
								</span>

								<span class="AlignLeft">
									<label for="EventDescription">Event Description</label>
									<textarea name="EventDescription" required></textarea>
								</span>

								<span class="AlignLeft">
									<label for="StartDate">Start Date</label>
									<input type="Date" name="StartDate" required>
								</span>

								<span class="AlignLeft">
									<input type="checkbox" name="MultiDay" id="JS_RadioInput_Toggle1">
									<label for="MultiDay">Multi Day</label>
								</span>

								<span id="JS_Toggle1" class="AlignLeft" style="display: none;">
									<label for="EndDate">End Date</label>
									<input type="date" name="EndDate">
								</span>

								<script>
									const ToggleDiv = document.getElementById("JS_Toggle1");
									const radioInput = document.getElementById("JS_RadioInput_Toggle1");

									radioInput.addEventListener('click', function() {
										console.log("Clicked!");
										if (this.checked)
										{
											ToggleDiv.style.display = 'block';
											console.log("Showing!");
										}
										else
										{
											ToggleDiv.style.display = 'none';
											console.log("Not showing!");
										}
									});
								</script>

								<span class="AlignLeft">
									<label for="StartTime">Start Time</label>
									<input type="time" name="StartTime" required>
								</span>

								<span class="AlignLeft">
									<label for="EndTime">End Time</label>
									<input type="time" name="EndTime">
								</span>

								<!-- Recurring Selection
								<span class="AlignLeft">
									<label for="Recurring">Recurring</label>
									<select name="Recurring">
										<option value="Once" selected>Once</option>
										<option disabled>More coming soon!</option>

											<option value="Daily">Daily</option>
										<!-/-
											<option value="Weekly">Weekly</option>
											<option value="Monthly">Monthly</option>
										-/->
									</select>
								</span>
								-->

								<div class="InputList">
									<br>
									<u>Event Topics</u>
									
									<span class="AlignLeft">
										<input type="checkbox" name="3DPrinting">
										<label for="3DPrinting">3D Printing</label>
									</span>
									
									<span class="AlignLeft">
										<input type="checkbox" name="Robotics">
										<label for="Robotics">Robotics</label>
									</span>
									
									<span class="AlignLeft">
										<input type="checkbox" name="VideoGameDev">
										<label for="VideoGameDev">Video Game Development</label>
									</span>

									<span class="AlignLeft">
										<input type="checkbox" name="AI">
										<label for="AI">Artificial Intelligence</label>
									</span>
									
									<span class="AlignLeft">
										<input type="checkbox" name="WebDev">
										<label for="WebDev">Web Development</label>
									</span>
									
									<span class="AlignLeft">
										<input type="checkbox" name="MobileAppDev">
										<label for="MobileAppDev">Mobile Application Development</label>
									</span>
								</div>
							</div>

							<input type="submit" value="Create Event">
							<br><br>
						</form>
					</span>
				</div>
				<br>
			</div>
<?php	}

		function DisplaySmallEvent($Event)
		{
			$EventName = $Event['Name'];
			$_3DPrinting = $Event['3DPrinting'];
			$Robotics = $Event['Robotics'];
			$VideoGameDev = $Event['VideoGameDev'];
			$AI = $Event['AI'];
			$MobileAppDev = $Event['MobileAppDev'];
			$WebDev = $Event['WebDev'];

			$Class = "";

			if ($_3DPrinting)
			{
				$Class = "_3DPrinting";
			}
			else if ($Robotics)
			{
				$Class = "Robotics";
			}
			else if ($VideoGameDev)
			{
				$Class = "VideoGameDev";
			}
			else if ($AI)
			{
				$Class = "AI";
			}
			else if ($MobileAppDev)
			{
				$Class = "MobileAppDev";
			}
			else if ($WebDev)
			{
				$Class = "WebDev";
			}

?>			<style>
				span#SmallEventName
				{
					font-size: .8rem;
				}

				span._3DPrinting
				{
					background-color: blue;
				}

				span.Robotics
				{
					background-color: green;
					color: white;
				}

				span.VideoGameDev
				{
					background-color: pink;
				}

				span.AI
				{
					background-color: teal;
					color: white;
				}

				span.MobileAppDev
				{
					background-color: yellow;
				}

				span.WebDev
				{
					background-color: orange;
				}
			</style>
			<span class="<?=$Class?>" id="SmallEventName"><?=$EventName?></span>
<?php	}

		function DisplayLargeEvent($Event)
		{
			$EventName = $Event['Name'];
			$Location = $Event['Location'];
			$Description = $Event['Description'];
			
			$RecurringCode = $Event['RecurringCode'];
			
			$StartDate = $Event['StartDate'];
			$EndDate = $Event['EndDate'];

			$StartTime = $Event['StartTime'];
			$StartAM_PM = $Event['Start_AM_PM'];

			$EndTime = $Event['EndTime'];
			$EndAM_PM = $Event['End_AM_PM'];			

	?>		<div class="EventFrame">
				<span class="EventName"><?=$EventName?></span>
				<br>
				<span class="EventHeader">Location:</span>
				<?=$Location?>
				<br><br>
				
				<span class="EventHeader">Start time:</span>
				<?php
					echo $StartTime . " " . $StartAM_PM
				?>
				<br><br>
				
				<span class="EventHeader">End time:</span>
				<?php
					echo $EndTime . " " . $EndAM_PM
				?>
				<br><br>
				
				<span class="EventHeader">Description:</span>
				<?=$Description?>
			</div>
	<?php
		}

		function UnderConstruction($Page)
		{?>
			<br><br><br>
			<span class="InlineCenter">
				<?=$Page?> -- currently under construction!
			</span>

			<br>

			<span class="InlineCenter">
				<img class="UnderConstructionL" src="../Media/UnderConstruction.png">
			</span>
<?php	}

		function LearnCS()
		{
			$Interest = filter_input(INPUT_GET, "Interest");
			$Tutorial = filter_input(INPUT_GET, "Tutorial");
			
			if ($Interest == "")
			{
				ContentTitle("Learn CS");

	?>			<div class="SelectionTileWrapper">
					<a href="?Selected=Learn&Interest=CAD and 3D Printing" class="CSTile Orbitron CADAnd3DPrinting_Tile">
						CAD and 3D Printing
					</a>

					<a href="?Selected=Learn&Interest=Software Development" class="CSTile Orbitron Development_Tile">
						Software Development
					</a>

					<!--<a href="?Selected=Learn&Interest=Artifical-->
					<a href="https://ai.com" Intelligence class="CSTile Orbitron AI_Tile">
						Artificial Intelligence - Deep Learning
					</a>

					<a href="?Selected=Learn&Interest=Robotics" class="CSTile Orbitron Robotics_Tile">
						Robotics
					</a>

					<a href="?Selected=Learn&Interest=Cyber Security" class="CSTile Orbitron CyberSecurity_Tile">
						Cyber Security
					</a>

					<a href="?Selected=Learn&Interest=System Administration" class="CSTile Orbitron SystemAdmin_Tile">
						System Administration
					</a>

					<a href="?Selected=Learn&Interest=Networking" class="CSTile Orbitron Networking_Tile">
						Networking
					</a>

					<a href="?Selected=Learn&Interest=Data Science" class="CSTile Orbitron DataScience_Tile">
						Data Science
					</a>
				</div>
<?php		}
			else
			{
?>				<!--
				<div class="TopicDiv">
					<span class="InlineCenter TopicTitle">
						<?php
						/*
							if ($Interest == "Modeling and Printing")
							{
								ContentTitle("Computer Modeling and 3D Printing");
							}
							else
							{
								ContentTitle($Interest);
							}
						*/
						?>
					</span>
				</div>	
				-->

				<div class="TopicDiv">
<?php				include 'LearningResources.php';

					if ($Interest == "CAD and 3D Printing")
					{
						if ($Tutorial == "")
						{
							CADAnd3DPrinting();
						}
						else if ($Tutorial == "Fusion360")
						{
							Fusion360();
						}
					}
					else if ($Interest == "Software Development")
					{
						if ($Tutorial == "")
						{
							SoftwareDevelopment();
						}
						else if ($Tutorial == "CPP")
						{
							CPP();
						}
						else if ($Tutorial == "PHP")
						{
							PHP();
						}
						else if ($Tutorial == "Java")
						{
							Java();
						}
						else if ($Tutorial == "Python")
						{
							Python();
						}
						else if ($Tutorial == "Lua")
						{
							Lua();
						}
						else if ($Tutorial == "JS")
						{
							Javascript();
						}
						else if ($Tutorial == "CSharp")
						{
							CSharp();
						}
					}
					else if ($Interest == "Artificial Intelligence")
					{
						AI();
						
					}
					else if ($Interest == "Robotics")
					{
						Robotics();
					}
					else if ($Interest == "Cyber Security")
					{
						CyberSecurity();
					}
					else if ($Interest == "System Administration")
					{
						SystemAdministration();
					}
					else if ($Interest == "Networking")
					{
						Networking();
					}
					else if ($Interest == "Data Science")
					{
						DataScience();
					}
?>				</div>
<?php		}
		}

		function ProfileEditForm($CSDatabase, $CSClubID)
		{
			ContentTitle("Edit Profile");
			
			$UserInfo = $CSDatabase->SelectUser($CSClubID, "CSClubID", "Phone, Birthday, StudentAthlete, Sport, Semester, Major");
			
			// Personal Info
			$Phone = $UserInfo[0];
			$Birthday = $UserInfo[1];
			$StudentAthlete = $UserInfo[2];
			$Sport = $UserInfo[3];
			$Semester = $UserInfo[4];
			$Major = $UserInfo[5];

			if ($Phone == "NULL")
			{
				$Phone = "";
			}
			if ($Sport == "NULL")
			{
				$Sport = "";
			}

			if ($Semester == "NULL")
			{
				$Semester = "";
			}

			if ($Major == "NULL")
			{
				$Major = "";
			}

			if ($Birthday == "NULL")
			{
				$Birthday = "";
			}

?>			<div class="Center">
				<div class="EditProfileForm">
					<div class="SubtitleOrg">
						<span class="FormSubtitle">Update Information</span>
					</div>

					<br>

					<div id="PIEdit" class="Column">
						<form action="../Objects/Update.php" method="POST">
							Phone Number
							<input type="tel" name="Phone" value="<?=$Phone?>">
							<br>

							Birthday
							<input type="date" name="Birthday" value="<?=$Birthday?>">
							<br>

							<span>
								<input type="checkbox" class="Athlete" name="Athlete" <?php if ($StudentAthlete) { echo "checked"; }?>>
								Student Athlete
							</span>
							<br>

							<span id="SportHide" <?php if (!$StudentAthlete) {?> style="display:none;" <?php } ?>>Sport</span>
							<select name="Sport" class="Sport" <?php if (!$StudentAthlete) {?> style="display: none" <?php } ?>>
								<option disabled selected>Pick your sport</option>
								<option <?php if ($Sport == "Golf") { echo "selected"; } ?> value="Golf">Golf</option>
								<option <?php if ($Sport == "Football") { echo "selected"; } ?> value="Football">Football</option>
								<option <?php if ($Sport == "Basketball") { echo "selected"; } ?> value="Basketball">Basketball</option>
								<option <?php if ($Sport == "Wrestling") { echo "selected"; } ?> value="Wrestling">Wrestling</option>
								<option <?php if ($Sport == "Baseball") { echo "selected"; } ?> value="Baseball">Baseball</option>
								<option <?php if ($Sport == "TrackCX") { echo "selected"; } ?> value="TrackCX">Track / Cross Country</option>
								<option <?php if ($Sport == "Hockey") { echo "selected"; } ?> value="Hockey">Hockey</option>
								<option <?php if ($Sport == "Hockey") { echo "selected"; } ?> value="Hockey">Soccer</option>
								<option <?php if ($Sport == "Hockey") { echo "selected"; } ?> value="Hockey">Volleyball</option>							
							</select>
							<br class="SportHide" <?php if (!$StudentAthlete) { ?> style="display:none;" <?php } ?>>

							<script>
								// Get the radio input and select box
								const radioInput = document.querySelector('input.Athlete');
								const selectBox = document.querySelector('select.Sport');
								const selectLabel = document.querySelector('span#SportHide');
								const lineBreak = document.querySelector('br.SportHide');

								radioInput.addEventListener('click', function() {
									if (this.checked)
									{
										selectBox.style.display = 'block';
										selectBox.required = true;
										selectLabel.style.display = 'inline';
										lineBreak.style.display = 'block';
									}
									else
									{
										selectBox.style.display = 'none';
										selectBox.required = false;
										selectLabel.style.display = 'none';
										lineBreak.style.display = 'none';
									}
								});
							</script>

							Semester in College
							<input type="text" name="Semester" value="<?=$Semester?>">

							<br>

							Major
							<br>
							<input type="text" name="Major" value="<?=$Major?>">

							<br>

							<input type="submit">
						</form>

						<br><br>

						<div class="SubtitleOrg">
							<span class="FormSubtitle">Update Profile Picture</span>
						</div>
						
						<br>

						<img src="../Media/PFPs/<?=$CSClubID?>" onerror="this.src='../Media/PFPs/Default.jpg'" class="DisplayPFP" id="DisplayPFP">
						<br>
						<input type="button" class="FileButton" onclick="document.getElementById('FileInput').click()" value="Upload a new profile picture">

						<form enctype="multipart/form-data" action="../Objects/SavePFP.php" method="POST">
							<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
							<input type="file" id="FileInput" accept="image/png" class="FileInput" Name="PFPFile">
							<input type="submit" id="FileSubmit" style="display: none;">
						</form>

						<script>
							
							document.getElementById('FileInput').onchange = function (evt)
							{
								document.getElementById("FileSubmit").click();
								console.log("Here");
								/*
								var tgt = evt.target || window.event.srcElement,
									files = tgt.files;
								
								// FileReader support
								if (FileReader && files && files.length)
								{
									var fr = new FileReader();
									fr.onload = function()
									{
										document.getElementById("DisplayPFP").src = fr.result;

										document.getElementById("FileSubmit").click();
									}

									fr.readAsDataURL(files[0]);
								}
								else // Not supported
								{
									console.log("Some issue");
									// fallback -- perhaps submit the input to an iframe and temporarily store
									// them on the server until the user's session ends.
								}
								*/
							}
						</script>
					</div>

					<script>
						var Editing = false;
						
						var PIDisplay = document.getElementById("PIDisplay");
						var PIEdit = document.getElementById("PIEdit");
						var editButton = document.getElementById("EditButton");

						function EditButton()
						{
							console.log("Clicked!");
							if (Editing)
							{
								Editing = false;
								
								PIDisplay.style.display = "flex";
								PIEdit.style.display = "none";
								
								editButton.innerHTML = "Edit"
							}
							else
							{
								Editing = true;
								
								PIDisplay.style.display = "none";
								PIEdit.style.display = "flex";
								
								editButton.innerHTML = "Stop Editing"
							}
						}
					</script>
					<br>
				</div>
			</div>
<?php	}?>