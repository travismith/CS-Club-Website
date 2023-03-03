<?php
		/* Topics */

		function CADAnd3DPrinting()
		{
?>			<a href="?Selected=Learn&Interest=CADAnd3DPrinting&Tutorial=Fusion360" class="TopicTile Orbitron">
				<span class="InlineCenter">Fusion 360</span>
				<br>

				<div class="TileBody">
					<span class="InlineCenter">Learn about Fusion360 from local Minot engineer Jeremy Almond!</span>
				</div>
			</a>
<?php
		}

function SoftwareDevelopment()
{
?>

	<button class="DevTitle" onclick="Languages('ProgrammingLanguages')">
		Learn new Languages
	</button>
	
	<script>
		function Languages(Topic)
		{
			const TopicTile = document.querySelector('div.' + Topic);
			if (TopicTile.style.display == "flex")
			{
				console.log("Closing");
				TopicTile.style.display = "none";
			}
			else
			{
				console.log("Opening");
				TopicTile.style.display = "flex";
			}
		}
	</script>

	<div class="TileWrapper ProgrammingLanguages">
		<div class="TopicTile Orbitron">
			<span class="InlineCenter">Programming Languages</span>

			<div class="TileBody">
				<a class="Tutorial StartHere" href="?Selected=Learn&Interest=Software Development&Tutorial=ProgrammingBasics">Programming Basics</a>
				<br>
				
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=CPP">C++</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=Python">Python</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=CSharp">C#</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=Lua">Lua</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=Java">Java</a>
			</div>
		</div>

		<div href="?Selected=Learn&Language=CPP" class="TopicTile Orbitron">
			<span class="InlineCenter">Web Languages</span>

			<div class="TileBodyRow">
				<div>
					<span class="ColumnTitle">Content</span>

					<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=HTML">HTML</a>
					<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=CSS">CSS</a>
				</div>

				<div>
					<span class="ColumnTitle">Logic</span>
					
					<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=PHP">PHP</a>
					<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=JS">JavaScript</a>
				
					<ul class="JSFrameworks">
						<li><a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=React">React</a></li>
						<li><a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=Angular">Angular</a></li>
						<li><a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=Node">Node</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="TopicTile Orbitron">
			<span class="InlineCenter">Database Languages</span>

			<div class="TileBody">
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=MySQL">MySQL</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=MongoDB">MongoDB</a>
			</div>
		</div>

		<div class="TopicTile Orbitron">
			<span class="InlineCenter">Assembly Languages</span>

			<div class="TileBody">
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=MySQL">1086 Assembly</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=MongoDB">MIPs Assembly</a>
			</div>
		</div>
	</div>
	
	<button class="DevTitle" onclick="Languages('DevSkills')">
		Learn Developer Skills
	</button>

	<div class="TileWrapper DevSkills">
		<div class="TopicTile Orbitron">
			<span class="InlineCenter">Source / Version Control</span>

			<div class="TileBody">
				<a class="Tutorial StartHere" href="?Selected=Learn&Interest=Software Development&Tutorial=Github Desktop">Github Desktop</a>
				<br>
				
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=Git">Git</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=Github Desktop">Github Command Line</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=Github Desktop">Bitbucket</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=Github Desktop">Source Tree</a>
			</div>
		</div>

		<a href="?Selected=Learn&Interest=System Administration" class="TopicTile Orbitron">
			<span class="InlineCenter">System Administration</span>

			<div class="TileBody">
				<span class="InlineCenter">Networking</span>
				<span class="InlineCenter">Command Line</span>
				<span class="InlineCenter">Shell Scripting</span>
			</div>
		</a>
	</div>

	<button class="DevTitle" onclick="Languages('WebStacks')">
		Learn Web Application Stacks
	</button>
	
	<div class="TileWrapper WebStacks">
		<div class="TopicTile Orbitron">
			<span class="InlineCenter">LAMP Stack</span>

			<div class="TileBody">
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=Linux">Linux</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=System Administration&Tutorial=Apache">Apache</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=MySQL">MySQL</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=PHP">PHP</a>
			</div>
		</div>

		<div class="TopicTile Orbitron">
			<span class="InlineCenter">MEAN Stack</span>

			<div class="TileBody">
			<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=MongoDB">MongoDB</a>
			<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=ExpressJS">Express.js</a>
			<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=AngularJS">Angular.js</a>
			<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=NodeJS">Node.js</a>
			</div>
		</div>

		<div class="TopicTile Orbitron">
			<span class="InlineCenter">MERN Stack</span>

			<div class="TileBody">
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=MongoDB">MongoDB</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=ExpressJS">Express.js</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=React">React</a>
				<a class="Tutorial" href="?Selected=Learn&Interest=Software Development&Tutorial=NodeJS">Node.js</a>
			</div>
		</div>

		<a href="" class="TopicTile Orbitron">
			<span class="InlineCenter">Ruby on Rails</span>

			<div class="TileBody">
				<span class="InlineCenter">MongoDB</span>
				<span class="InlineCenter">Express.js</span>
				<span class="InlineCenter">React</span>
				<span class="InlineCenter">Node.js</span>
			</div>
		</a>
	</div>
	
	<button class="DevTitle" onclick="Languages('MobileStacks')">
		Learn Mobile Application Stacks
	</button>
	
	<div class="TileWrapper MobileStacks">
		<a href="?Selected=Learn&Topic=LAMP" class="TopicTile Orbitron">
			<span class="InlineCenter">MobileStack Stack</span>

			<div class="TileBody">
				<span class="InlineCenter">Linux</span>
				<span class="InlineCenter">Apache</span>
				<span class="InlineCenter">MySQL</span>
				<span class="InlineCenter">PHP</span>
			</div>
		</a>
	</div>
	
	<button class="DevTitle" onclick="Languages('SoftwareArchitectures')">
		Learn Software Architectures
	</button>

	<div class="TileWrapper">
		<a href="" class="TopicTile Orbitron">
			<span class="InlineCenter">MVC Architecture</span>

			<div class="TileBody">
				<span class="InlineCenter">Model</span>
				<span class="InlineCenter">View</span>
				<span class="InlineCenter">Controller</span>
			</div>
		</a>

		<a href="?Selected=Learn&Topic=LAMP" class="TopicTile Orbitron">
			<span class="InlineCenter">MVC Architecture</span>

			<div class="TileBody">
				<span class="InlineCenter">Model</span>
				<span class="InlineCenter">View</span>
				<span class="InlineCenter">Controller</span>
			</div>
		</a>
	</div>

<?php
}

		function AI()
		{
			UnderConstruction("Artificial Intelligence");
		}

		function Robotics()
		{
			UnderConstruction("Robotics");
		}

		function CyberSecurity()
		{
			UnderConstruction("Cyber Security");
		}

		function SystemAdministration()
		{
			UnderConstruction("System Administration");
		}

		function Networking()
		{
			UnderConstruction("Networking");
		}

		function DataScience()
		{
			UnderConstruction("Data Science");
		}

		/* Tutorials */

		function CPP()
		{
			$Lesson = filter_input(INPUT_GET, "Lesson");

?>			<div class="TutorialWrapper">
				<div class="TutorialTop">
					<span class="TutorialTitle InlineCenter">C++ Tutorial</span>
				</div>

				<div class="TutorialLower">
					<div class="TutorialLessonNav">
						<!--
							This is a good place to start with creating these tutorials in the database.
							Each Tutorial has the following:
							
							Tutorial:
								- TutorialID Primary Key

								- Lessons 1:n Foriegn Key

								- Tutorial Creator
								- Tutorial Topic
								- Tutorial Name
								- Tutorial Syllabus
								
							Lesson:
								- Lesson Name
								- Lesson Video
								- Lesson Syllabus

							This will lead to the process for creating lessons aswell.
							Iterate through all lessons for the given tutorial and create a link below.
						-->

						<a href="?Selected=Learn&Interest=Software Development&Tutorial=CPP&Lesson=1" class="TutorialLesson">Lesson 1 - Introduction</a>
						<a href="?Selected=Learn&Interest=Software Development&Tutorial=CPP&Lesson=2" class="TutorialLesson">Lesson 2 - Variables and Math</a>
						<a href="?Selected=Learn&Interest=Software Development&Tutorial=CPP&Lesson=3" class="TutorialLesson">Lesson 3 - Input / Output</a>
						<a href="?Selected=Learn&Interest=Software Development&Tutorial=CPP&Lesson=4" class="TutorialLesson">Lesson 4 - Conditionals / Loops</a>
						<a href="?Selected=Learn&Interest=Software Development&Tutorial=CPP&Lesson=5" class="TutorialLesson">Lesson 5 - Functions / Procedures</a>
					</div>

					<div class="LessonContent">
<?php					if ($Lesson == "" || $Lesson == 1)
						{
?>							Introduction to C++
<?php					}
						else if ($Lesson == "2")
						{
?>							Variables and Math
<?php					}
						else if ($Lesson == "3")
						{
?>							Input and Output
<?php					}
						else if ($Lesson == "4")
						{
?>							Conditionals and Loops
<?php					}
						else if ($Lesson == "5")
						{
?>							Functions and Procedures
<?php					}
?>					</div>
				</div>
			</div>
<?php	}

		function CSharp()
		{
?>			
<?php	}

		function Fusion360()
		{
?>			<div class="Video">
				<span class="InlineCenter VideoTitle Roboto">Jeremy Almond Tutorial</span>

				<span class="InlineCenter">
					<video width="640" height="360" controls>
						<source src="../Media/Videos/FusionIntro.mkv" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				</span>
			</div>
<?php	}
?>