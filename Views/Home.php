<!DOCTYPE html>
<html>
	<head>
		<title>The CS Club</title>
		
		<link rel="stylesheet" type="text/css" href="../Style/DefaultStyle.css">
		<link rel="stylesheet" type="text/css" href="../Style/HomeStyle.css">
		<link rel="stylesheet" type="text/css" href="../Style/ContentStyle.css">
	</head>

	<body>
		<div class="Top">
			<?php
				include '../Resources/SessionResources.php';
				include '../Resources/DisplayResources.php';

				$Selected = filter_input(INPUT_GET, "Selected");

				$UserInfo = NULL;

				$Authenticated = CheckAuthentication();
				
				if ($Authenticated) // AUTHENTICATION LOCATION
				{
					$CSDatabase = new CS_Database_Object;
					$CSClubID = $_SESSION["SessionID"];

					$UserInfo = $CSDatabase->SelectUser($CSClubID, "FirstName, LastName, Major, Membership");
				}
				else
				{
					Header('Location: ../Objects/Logout.php');
					exit();
				}

				$FirstName = $UserInfo[0];
				$LastName = $UserInfo[1];
				$Major = $UserInfo[2];
				$Membership = $UserInfo[3];
			?>

			<!-- MENU -->

			<div class="Menu">
				<div class="MenuContent">
					<div class="UserInfo">
						<div class="PicDivider">
							<span class="Q"></span>
							
							<span class="H">
								<!--<img class="PFP" src="../Media/PFPs/_<?=$CSClubID?>" alt="../Media/PFPs/Default.jpg">-->
								<?php
									$ImageSrc = "../Media/PFPs/Default.jpg";

									if (file_exists("../Media/PFPs/$CSClubID"))
									{
										$ImageSrc = "../Media/PFPs/$CSClubID";
									}
								?>

								<img src="../Media/PFPs/<?=$CSClubID?>" onerror="this.src='../Media/PFPs/Default'" class="PFP">
							</span>
							
							<span class="Q">
								<button onClick="" class="Notifications">
									<img class="Notifications" src="../Media/Notifications.png">

									
								</button>
							</span>
						</div>

						<br>
						<span><?="$FirstName $LastName"?></span>
						<span class="Major"><?=$Major?></span>
					</div>
			
					<hr>
					<br>
					<script>
						var ClubOpen = false;
						var LearningOpen = false;
						var ProjectsOpen = false;
						var ProfileOpen = false;
						var AdminOpen = false;

						function ToggleMenuSection(Section)
						{
							const sectionDisplay = document.getElementById(Section + "Frame");
							const sectionButton = document.getElementById(Section + "Button");

							if (Section == "Club")
							{
								if (ClubOpen)
								{
									ClubOpen = false;

									sectionDisplay.style.display = "none";
									sectionButton.style.transform = "rotate(0deg)";
								}
								else
								{
									ClubOpen = true;

									sectionDisplay.style.display = "flex";
									sectionButton.style.transform = "rotate(90deg)";
								}
							}
							else if (Section == "Learning")
							{
								if (LearningOpen)
								{
									LearningOpen = false;

									sectionDisplay.style.display = "none";
									sectionButton.style.transform = "rotate(0deg)";
								}
								else
								{
									LearningOpen = true;

									sectionDisplay.style.display = "flex";
									sectionButton.style.transform = "rotate(90deg)";
								}
							}
							else if (Section == "Projects")
							{
								if (ProjectsOpen)
								{
									ProjectsOpen = false;

									sectionDisplay.style.display = "none";
									sectionButton.style.transform = "rotate(0deg)";
								}
								else
								{
									ProjectsOpen = true;
									sectionDisplay.style.display = "flex";
									sectionButton.style.transform = "rotate(90deg)";
								}
							}
							else if (Section == "Profile")
							{
								if (ProfileOpen)
								{
									ProfileOpen = false;

									sectionDisplay.style.display = "none";
									sectionButton.style.transform = "rotate(0deg)";
								}
								else
								{
									ProfileOpen = true;

									sectionDisplay.style.display = "flex";
									sectionButton.style.transform = "rotate(90deg)";
								}
							}
							else if (Section == "Admin")
							{
								if (AdminOpen)
								{
									AdminOpen = false;

									sectionDisplay.style.display = "none";
									sectionButton.style.transform = "rotate(0deg)";
								}
								else
								{
									AdminOpen = true;

									sectionDisplay.style.display = "flex";
									sectionButton.style.transform = "rotate(90deg)";
								}
							}
						}
					</script>

					<div class="MenuSection">
						<span class="MenuLabel">
							Club
							
							<button id="ClubButton" onClick="ToggleMenuSection('Club')" class="SectionMover">
								<img class="Dropdown" src="../Media/Dropdown.png" />
							</button>
						</span>

						<hr>

						<div id="ClubFrame" class="MenuSectionContent">
							<a <?php if ($Selected == "Newsletter" || $Selected == NULL) { echo "style='text-decoration: underline;'"; }?> id="Newsletter" href="?Selected=Newsletter">Newsletter</a></u>
							<a <?php if ($Selected == "Calendar") { echo "style='text-decoration: underline;'"; }?> id="Calendar" href="?Selected=Calendar&Month=<?=Date('n')?>&Day=<?=Date('j')?>&Year=<?=Date('Y')?>">Calendar</a>
							<a <?php if ($Selected == "Members") { echo "style='text-decoration: underline;'"; }?> id="Members" href="?Selected=Members">Members</a>
							<a <?php if ($Selected == "Documents") { echo "style='text-decoration: underline;'"; }?> id="Documents" href="?Selected=Documents">Documents</a>
						</div>
					</div>

					<br>

					<div class="MenuSection">
						<span class="MenuLabel">
							Learning

							<button id="LearningButton" onClick="ToggleMenuSection('Learning')" class="SectionMover">
								<img class="Dropdown" src="../Media/Dropdown.png" />
							</button>
						</span>

						<hr>

						<div id="LearningFrame" class="MenuSectionContent">
							<a <?php if ($Selected == "Learn") { echo "style='text-decoration: underline;'"; }?> href="?Selected=Learn">Learn CS</a>
							<a <?php if ($Selected == "Tutoring") { echo "style='text-decoration: underline;'"; }?> href="?Selected=Tutoring">Tutoring</a>
						</div>
					</div>

					<br>

					<div class="MenuSection">
						<span class="MenuLabel">
							Projects
						
							<button id="ProjectsButton" onClick="ToggleMenuSection('Projects')" class="SectionMover">
								<img class="Dropdown" src="../Media/Dropdown.png" />
							</button>
						</span>

						<hr>

						<div id="ProjectsFrame" class="MenuSectionContent">
							<a <?php if ($Selected == "Projects") { echo "style='text-decoration: underline;'"; }?> href="?Selected=Projects">My Projects</a>
							<a <?php if ($Selected == "OtherProjects") { echo "style='text-decoration: underline;'"; }?> href="?Selected=OtherProjects">Other Club Projects</a>
							<a <?php if ($Selected == "StartProject") { echo "style='text-decoration: underline;'"; }?> href="?Selected=StartProject">Start a Project</a>
						</div>
					</div>
					
					<br>

					<div class="MenuSection">
						<span class="MenuLabel">
							Profile
							<br>

							<button id="ProfileButton" onClick="ToggleMenuSection('Profile')" class="SectionMover">
								<img class="Dropdown" src="../Media/Dropdown.png" />
							</button>
						</span>

						<hr>

						<div id="ProfileFrame" class="MenuSectionContent">
							<a <?php if ($Selected == "MyProfile") { echo "style='text-decoration: underline;'"; }?> href="?Selected=MyProfile">My Profile</a>
							<a href="../Objects/Logout.php">Logout</a>
						</div>
					</div>
					
					<?php
						if ($Membership > 50)
						{	
					?>		<br>

							<div class="MenuSection">
								<span class="MenuLabel">
									Admin
									
									<button id="AdminButton" onClick="ToggleMenuSection('Admin')" class="SectionMover">
										<img class="Dropdown" src="../Media/Dropdown.png" />
									</button>
								</span>

								<hr>

								<div id="AdminFrame" class="MenuSectionContent">
									<a <?php if ($Selected == "Admin1" || $Selected == NULL) { echo "style='text-decoration: underline;'"; }?> id="Newsletter" href="?Selected=Newsletter">Admin1</a></u>
									<a <?php if ($Selected == "Admin2") { echo "style='text-decoration: underline;'"; }?> id="Calendar" href="?Selected=Calendar&Month=<?=Date('n')?>&Day=<?=Date('j')?>&Year=<?=Date('Y')?>">Admin2</a>
								</div>
							</div>
					<?php	
						}
					?>

					<script>
						<?php
							if ($Selected == NULL || $Selected == "Newsletter" || $Selected == "Calendar" || $Selected == "Members" || $Selected == "Documents")
							{
								
								echo "ToggleMenuSection('Club');";
							}
							else if ($Selected == "Learn" || $Selected == "Tutoring")
							{
								
								echo "ToggleMenuSection('Learning');";
							}
							else if ($Selected == "Projects" || $Selected == "OtherProjects" || $Selected == "StartProject")
							{
								echo "ToggleMenuSection('Projects');";
							}
							else if ($Selected == "MyProfile")
							{
								echo "ToggleMenuSection('Profile');";
							}
							else if ($Selected == "Admin1" || $Selected == "Admin2")
							{
								echo "ToggleMenuSection('Admin');";
							}
						?>
					</script>
				</div>
			</div>
			
			<!-- MENU SELECTIONS -->

			<div class="SelectionContent">
				<?php
					if ($Selected == NULL || $Selected == "Newsletter")
					{
						ClubNewsletter();
					}
					if ($Selected == "Calendar")
					{
						ClubCalendar();
					}
					else if ($Selected == "Members")
					{
						UnderConstruction("Club Members Search");
					}
					else if ($Selected == "Documents")
					{
						UnderConstruction("Club Documents");
					}
					else if ($Selected == "Admin")
					{
						UnderConstruction("Admin Pannel");
					}
					else if ($Selected == "Learn")
					{
						UnderConstruction("Learn CS");
					}
					else if ($Selected == "Tutoring")
					{
						UnderConstruction("CS Club Tutoring");
					}
					else if ($Selected == "Projects")
					{
						UnderConstruction("My Projects");
					}
					else if ($Selected == "OtherProjects")
					{
						UnderConstruction("Other Club Projects");
					}
					else if ($Selected == "StartProject")
					{
						UnderConstruction("Start New Project");
					}
					else if ($Selected == "MyProfile")
					{
						ProfileEditForm($CSDatabase, $CSClubID);
					}
				?>
			</div>
		</div>

		<div class="Bottom">
			<!--<img class="Logo" src="../Media/2022 Logo.png">-->
			
			<p>
				The MSU CS club web application was written and maintained by Minot State
				Computer Science students! Please report all bugs to the CS Club.
			</p>

			<!--<img class="Logo" src="../Media/2022 Logo.png">-->
		</div>
	</body>
</html>