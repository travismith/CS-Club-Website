<?php

function Tutorial()
{
	$Lesson = filter_input(INPUT_GET, "Lesson");

?>

	<div class="TutorialWrapper">
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

				<?php
				if ($Lesson == "" || $Lesson == 1)
				{
				?>

					Introduction to C++

				<?php
				}
				else if ($Lesson == "2")
				{
				?>

					Variables and Math

				<?php
				}
				else if ($Lesson == "3")
				{
				?>

					Input and Output

				<?php
				}
				else if ($Lesson == "4")
				{
				?>

					Conditionals and Loops

				<?php
				}
				else if ($Lesson == "5")
				{
				?>

					Functions and Procedures

				<?php
				}
				?>

			</div>
		</div>
	</div>
<?php	
}
?>