<?php error_reporting(0); require dirname(__FILE__) . "/../functions/functions.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Make Unique</title><!-- Our CSS stylesheet file -->
	<link href="../assets/css/styles.css" rel="stylesheet">
	<link href="/css/images/delivery_man.ico" rel="icon" type="image/ico">
	<!--[if lt IE 9]>
		  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
	<header>
		<h1>Make Unique</h1>
	</header>

	<nav id="misc_filter">
		<a href="http://10.10.0.138/index.php">Home</a><a class="active" href="#">Make Unique</a>
	</nav>

	<section id="container-misc">
		<div style="text-align: center">
			<?php
				print '<table>';
				print '<form action="" method="post">';
				print "<tr><td><textarea name=\"uniqueData\" cols=\"40\" rows=\"20\" placeholder=\" Paste data to make unique here, \n separated by a new line\">";
				makeUnique();
				print "</textarea></td>";
				print '<tr><td colspan="4"><input type="submit" name="submit" value="Make Unique!" /></td></tr>';
				print '<tr><td colspan="4">';
				makeUniqueCount();
				print '</td></tr>';
				print '</table>';
				print '</form>';
				?>
		</div>
	</section>

	<footer>
		<p class="jsquared">Copyright© 2015 - BEAST Inc. - JÂ²</p>
	</footer><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> <script src="../assets/js/jquery.quicksand.js"></script> <script src="../assets/js/script.js"></script>
</body>
</html>
