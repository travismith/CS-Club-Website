<?php
	include 'Resources/SessionResources.php';

	if (CheckAuthentication())
	{
		Header('Location: Views/Home.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="Style/DefaultStyle.css" />
		<link rel="stylesheet" type="text/css" href="Style/LoginStyle.css" />

		<title> Welcome to the CS Club </title>
	</head>

	<body>
		<div class="Upper">
			<span class="InlineCenter"><img class="Logo" src="Media/2022 Logo.png"></span>
		</div>
		
		<div class="Lower">
			<?php

				$Warning = filter_input(INPUT_GET, "Warning");

				if ($Warning)
				{
					echo "<br><span class='InlineCenter'><span class='Warning'>$Warning</span></span>";
				}
			?>

			<br>
			<span class="InlineCenter">Please login to continue</span>
			<br>

			<span class="InlineCenter">
				<form action="Objects/Auth.php" method="POST">
					Username | Email
					<input type="text" name="LoginID">
					<br>

					Password
					<input type="password" name="Password">
					<br>

					<span class="InlineCenter"><input class="Submit" type="submit" value="Login"/></span>
					<br>

					<span class="InlineCenter"><a href="Views/RegisterView.php">Don't have an account? Register here!</a>
				</form>
			</span>
		</div>
	</body>
</html>