<?php
		function ClubNewsletter()
		{	
			$Month = "March'23";
			
			if ($Month == "Jan'23")
			{
				ContentTitle("January 2023 CS Club Newsletter");

?>				<h2 class="Newsletter">Welcome back!</h2>
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
<?php		}
			else if ($Month == "Feb'23")
			{}
			else if ($Month == "March'23")
			{
				
				ContentTitle("March 2023 CS Club Newsletter");
?>
				<p>
					March is going to be our biggest month yet! We have MICS robotics coming up in Indiana.
					The CS Club Website is pushing it's biggest update yet! There site is still under lots of construction,
					so if you're interested in helping, start by taking the LAMP stack tutorial under the Software Development tab of Learning CS, and contact
					<a class="BlueLink" href="?Selected=Members&Username=travismith">travismith</a>
				</p>
<?php		}
		}
?>