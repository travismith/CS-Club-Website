<?php
	include '../Resources/SessionResources.php';
	include '../Resources/DisplayResources.php';

	$Selected = filter_input(INPUT_GET, "Selected");

	$CSClubID = NULL;

	$Authenticated = CheckAuthentication();
	
	if ($Authenticated) // AUTHENTICATION LOCATION
	{
		$CSDatabase = new CS_Database_Object;
		$CSClubID = $_SESSION["SessionID"];

		$UserInfo = $CSDatabase->SelectUser($CSClubID, "CSClubID", "Username, FirstName, LastName, Major, AccountType");
	}
	else
	{
		echo "User not authenticated, logging out...";
		
		Header('Location: ../Objects/Logout.php');
		exit();
	}

	$Username = $UserInfo[0];
	$FirstName = $UserInfo[1];
	$LastName = $UserInfo[2];
	$Major = $UserInfo[3];
	$AccountType = $UserInfo[4];
	
	$ImageSrc = "../Media/PFPs/$CSClubID";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>The CS Club</title>
		
		<link rel="stylesheet" type="text/css" href="../Style/DefaultStyle.css">
		<link rel="stylesheet" type="text/css" href="../Style/HomeStyle.css">
		<link rel="stylesheet" type="text/css" href="../Style/ContentStyle.css">

		<link rel="stylesheet" type="text/css" href="../Style/Colors.css">
		<link rel="stylesheet" type="text/css" href="../Style/Fonts.css">
	</head>

	<body>
		<!--
		<div>
			<menu>
			</menu>

			<nav></nav>
			<selection></selection>
		</div>
		-->

		<div class="OutterWrapper">
			<div class="Menu">
				<div class="MenuContent">
					<!--
					<div class="UserInfo">					
						<img  class="PFPL" src="<?=$ImageSrc?>" onerror="this.src='../Media/PFPs/Default'">
						<span class="Username"><?=$Username?></span>
					</div>

					<br>
					-->

					<span class="MenuTitle InlineCenter">Menu</span>
					
					<script>
						var GamesOpen = false;
						var ClubOpen = false;
						var LearningOpen = false;
						var ProjectsOpen = false;
						var ProfileOpen = false;
						var AdminOpen = false;

						function ToggleMenuSection(Section)
						{
							const sectionDisplay = document.getElementById(Section + "Frame");
							const sectionButton = document.getElementById(Section + "Button");

							if (Section == "Games")
							{
								if (GamesOpen)
								{
									GamesOpen = false;

									sectionDisplay.style.display = "none";
									sectionButton.style.transform = "rotate(0deg)";
								}
								else
								{
									GamesOpen = true;

									sectionDisplay.style.display = "flex";
									sectionButton.style.transform = "rotate(90deg)";
								}
							}
							else if (Section == "Club")
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

					<div class="MenuSections">
						<div class="MenuSection">
							<span class="MenuLabel Roboto">
								<button class="HoverTextButton" onClick="ToggleMenuSection('Games')">Games</button>

								<button id="GamesButton" onClick="ToggleMenuSection('Games')" class="SectionMover">
									<img class="Dropdown" src="../Media/Dropdown.png" />
								</button>
							</span>

							<hr>

							<div id="GamesFrame" class="MenuSectionContent">
								<a
									<?php 
										if ($Selected == "CyberSecurity")
										{
											echo "style='text-decoration: underline;'";
										}
									?>

									id="CyberSecurity"
									href="?Selected=CyberSecurity"
								>
									Cyber Security
								</a>


								<a
									<?php 
										if ($Selected == "BrowserGames")
										{
											echo "style='text-decoration: underline;'";
										}
									?>

									id="BrowserGames"
									href="?Selected=BrowserGames"
								>
									Javascript Browser Games
								</a>
							</div>
						</div>

						<br>

						<div class="MenuSection">
							<span class="MenuLabel Roboto">
								<button class="HoverTextButton" onClick="ToggleMenuSection('Club')">Club</button>

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
							<span class="MenuLabel Roboto">
								<button class="HoverTextButton" onClick="ToggleMenuSection('Learning')">Learning</button>

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
							<span class="MenuLabel Roboto">
								<button class="HoverTextButton" onClick="ToggleMenuSection('Projects')">Projects</button>
								
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
							<span class="MenuLabel Roboto">
								<button class="HoverTextButton" onClick="ToggleMenuSection('Profile')">Profile</button>

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
						
<?php	 				if ($AccountType > 50)
						{
?>							<br>

							<div class="MenuSection">
								<span class="MenuLabel Roboto">
									<button class="HoverTextButton" onClick="ToggleMenuSection('Admin')">Admin</button>

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
<?php					}?>

						<script>
							<?php
								if ($Selected == "CyberSecurity" || $Selected == "BrowserGames")
								{
									echo "ToggleMenuSection('Games')";
								}
								else if ($Selected == NULL || $Selected == "Newsletter" || $Selected == "Calendar" || $Selected == "Members" || $Selected == "Documents")
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
	?>					</script>
					</div>
				</div>
			</div>

			<div class="Right">
				<!-- Navbar -->
				<div class="NavBar">
					<div class="ActionBar">
						<div class="ActionBarTab">
							<button onclick="ToggleMenu()" class="ActionButton MenuToggle">
								<span class="InlineCenter">
									<img src="../Media/MenuToggle.png" class="MenuToggle">
								</span>
							</button>
						</div>

						<div class="ActionBarTab">
							<img class="ContentLogo" src="../Media/2022 Logo.png">
						</div>

						<div class="ActionBarTab">
							<img class="PFPS" src="<?=$ImageSrc?>" onerror="this.src='../Media/PFPs/Default'">
							
							<button class="Notifications">
								<img src="../Media/Notifications.png" class="Notifications">

								<span class="NotifCount Roboto">
									<?php
										// Notifications
										echo "0";
									?>
								</span>
							</button>
						</div>

						<!--
						<div class="ActionBarTab">
							<button onClick="" class="ActionButton">
								<span class="InlineCenter">
									<img src="../Media/Notifications.png" class="Notifications">
								</span>
							</button>
						</div>
						-->
					</div>
				</div>

				<!-- MENU SELECTIONS -->
				<div class="SelectionContent">
					<?php
						if ($Selected == NULL || $Selected == "Newsletter")
						{
							ClubNewsletter();
						}
						else if ($Selected == "Under Construction")
						{
							UnderConstruction("The place you traveled to hasn't been built yet!");
						}
						else if ($Selected == "Calendar")
						{
							ClubCalendar();
						}
						else if ($Selected == "Members")
						{
							ClubMembers();
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
							LearnCS();
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

				<script>
					var MenuOpen = false;
					
					const Menu = document.querySelector('div.Menu');
					const Content = document.querySelector('div.Right');
					const SelectionContent = document.querySelector('div.SelectionContent');
					const NavBar = document.querySelector('div.NavBar');
					
					const Button = document.querySelector("button.MenuToggle");


					function ToggleMenu()
					{
						if (MenuOpen)
						{
							MenuOpen = false;

							Menu.style.display = "none";
							Menu.style.width = "0vw";
							
							Content.style.width = "100vw";
							/*
							SelectionContent.style.width = "100vw";
							NavBar.style.width = "100vw";
							*/
							console.log("Closing... content, selection, and nav should be 100");
							
							Button.style.backgroundColor = "rgb(200,0,0)";
							Button.style.border = "none";
						}
						else
						{
							MenuOpen = true;
							
							Menu.style.display = "flex";
							Menu.style.width = "20vw";

							Content.style.width = "79.5vw";
							
							/*
							SelectionContent.style.width = "80vw";
							NavBar.style.width = "80vw";
							*/
							console.log("Closing... content, selection, and nav should be 80");

							Button.style.border = "2px solid black";
						}
					}
				</script>
			</div>
		</div>

		<!--
		<div class="Bottom">
			<!/--<img class="Logo" src="../Media/2022 Logo.png">--/>
			
			<p>
				The MSU CS club web application was written and maintained by Minot State
				Computer Science students! Please report all bugs to the CS Club.
			</p>

			<!/--<img class="Logo" src="../Media/2022 Logo.png">--/>
		</div>
		-->
	</body>
</html>