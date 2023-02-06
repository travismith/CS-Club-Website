<?php
		// Homepage displays

		function ContentTitle($Title)
		{?>
			<br>
			<div class="LogoDisplay">
				<img class="ContentLogo" src="../Media/2022 Logo.png">
				<span class="Title"><?=$Title?></span>
				<img class="ContentLogo" src="../Media/2022 Logo.png">
			</div>
			<br>
<?php	}

		function ClubNewsletter()
		{		
			ContentTitle("January 2023 CS Club Newsletter");			

?>			<h2 class="Newsletter">Welcome back!</h2>
			<span class="InlineCenter"><img src="../Media/ClubPhoto.jpeg" class="NewsletterHeader"></span>
			<br>
			<p class="Large">
				Welcome back from Christmas break beavers! We have tons of new and exciting stuff going on
				for The CS Club this semester, take a peak at some of it below:
			</p>
			<br>

			<u><h2>CS Club App!</h2></u>
			<p>
				Welcome back to the new semester beavers! This semester is going to be very big for
				The CS Club! As you can see, we have a new web application! This app is going to help us
				in organizing projects that we are going to be working on this semester. The application
				will allow you guys to collaborate between yourselves and schedule times to work on projects,
				as well as offer you tutorials on different technologies you can use for these projects!
			</p>
			<br>

			<u><h2>Upcoming Elections - DATE</h2></u>
			<p>
				We are going to be having officer elections for this semesters officers on 1/5/23. If you are
				interested in nominating yourself or another for an officer position, please navigate to the
				elections page under the Club tab! There are many positions available in the club that need
				to be filled!
			</p>
<?php	}

		function ClubMembers()
		{
			$CSDatabase = new CS_Database_Object;

			$MemberArray = $CSDatabase->ClubRoster();
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
									<span id='SmallEventName'>No events for this date.</span>
						<?php	}?>
							<br>
						</div>
					</a>
				</div>
			</td>
<?php	}

		function ClubCalendar()
		{
			ContentTitle("2022-2023 Club Calendar");

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
			

?>			<div class="Calendar">
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
							<span class="InlineCenter"><input class="MonthMove" type="date" value="<?=$year?>-<?=$InputDay?>-<?=$InputMonth?>"></span>
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
					<?php
						// Get the current month and year
						$month = filter_input(INPUT_GET, "Month");
						$day = filter_input(INPUT_GET, "Day");
						$year = filter_input(INPUT_GET, "Year");

						$CSDatabase = new CS_Database_Object;
						$CSClubID = $_SESSION["SessionID"];
					?>
					
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

				<br>
				<div class="CalendarDisplaySpace" id="CreateEvent">
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
				<img class="UnderConstruction" src="../Media/UnderConstruction.png">
			</span>
<?php	}

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

						<img src="../Media/PFPs/<?=$CSClubID?>" onerror="this.src='../Media/PFPs/Default'" class="DisplayPFP" id="DisplayPFP">
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