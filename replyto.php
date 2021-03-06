<?php
//login and logout sessions
	include ('layout_manager.php');
	//all functions are included
	include ('content_function.php');
	//To increment the views count for that topic.
	addview($_GET['cid'], $_GET['scid'], $_GET['tid']);
?>
<html>
<head><title>SIUC Forum</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
<link href="/forum/styles/main.css" type="text/css" rel="stylesheet" />
<body>
	<div class="pane">
		<div class="header"><h1><a href="/forum">SIUC Forum</a></h1></div>
		<div class="loginpane">
			<?php
				session_start();
				//to ensure login successfull and to pass session variable.
				if (isset($_SESSION['username'])) {
					logout();
				} else {
					if (isset($_GET['status'])) {
						if ($_GET['status'] == 'reg-success') {
								//check whether the registered records are inserted are not
							echo "<h1 style='color: green;'>new user registered successfully!</h1>";
							//fails if the registerd records mismatch with login details
						} else if ($_GET['status'] == 'login-fail') {
							echo "<h1 style='color: red;'>invalid username and/or password!</h1>";
						}
					}
					loginform();
				}
			?>
		</div>
		<div class="forumdesc">
			<p>Welcome to the SIUC forum</p>
			<!-- link for find eligible universities-->
			<h2><a href="/forum/gre.php">Click here.. to know eligible universities</a></h2>
			<?php
			//if user is not logged in yet
				if (!isset($_SESSION['username'])) {
					echo "<p>please login first  or <a href='/forum/register.html'>click here</a> to register.</p>";
				}
			?>
		</div>
		<?php

			if (isset($_SESSION['username'])) {
				//reply to the topic
				replytopost($_GET['cid'], $_GET['scid'], $_GET['tid']);
			}
		?>
		<div class="content">
		<!-- display the content of the topic-->
			<?php disptopic($_GET['cid'], $_GET['scid'], $_GET['tid']); ?>
		</div>
	</div>
</body>
</html>