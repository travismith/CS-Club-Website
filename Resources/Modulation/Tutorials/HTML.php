<?php

function Tutorial()
{
	$Lesson = filter_input(INPUT_GET, "Lesson");

?>

	<div class="TutorialWrapper">
		<div class="TutorialTop">
			<span class="TutorialTitle InlineCenter">HTML Tutorial</span>
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

				<a href="?Selected=Learn&Interest=Software Development&Tutorial=HTML&Lesson=1" class="TutorialLesson">
					<span class="LessonNumber">Lesson 1</span>
					<span class="LessonTitle">Introduction and First Website</span>
				</a>

				<a href="?Selected=Learn&Interest=Software Development&Tutorial=HTML&Lesson=2" class="TutorialLesson">
					<span class="LessonNumber">Lesson 2</span>
					<span class="LessonTitle">Elements, Tags, and Attributes</span>
				</a>
				
				<a href="?Selected=Learn&Interest=Software Development&Tutorial=HTML&Lesson=3" class="TutorialLesson">
					<span class="LessonNumber">Lesson 3</span>
					<span class="LessonTitle">Content Elements</span>
				</a>
				
				<a href="?Selected=Learn&Interest=Software Development&Tutorial=HTML&Lesson=4" class="TutorialLesson">
					<span class="LessonNumber">Lesson 4</span>
					<span class="LessonTitle">Head Element</span>
				</a>
				
				<a href="?Selected=Learn&Interest=Software Development&Tutorial=HTML&Lesson=5" class="TutorialLesson FinalTutorialLesson">
					<span class="LessonNumber">Lesson 5</span>
					<span class="LessonTitle">Input</span>
				</a>
			</div>

			<div class="LessonContent">

				<?php
				if ($Lesson == "" || $Lesson == 1)
				{
				?>

					Introduction and First Website

				<?php
				}
				else if ($Lesson == "2")
				{
				?>

					Elements, Tags, and Attributes

				<?php
				}
				else if ($Lesson == "3")
				{
				?>

					Content Elements

				<?php
				}
				else if ($Lesson == "4")
				{
				?>

					Head Element

				<?php
				}
				else if ($Lesson == "5")
				{
				?>

					Input

				<?php
				}
				?>

			</div>
		</div>
	</div>
<?php	
}
?>