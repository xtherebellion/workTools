<?php  require dirname(__FILE__) . "/../functions/functions.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>IP Route - Cables</title><!-- Our CSS stylesheet file -->
	<link href="../assets/css/styles.css" rel="stylesheet">
	<link href="/css/images/delivery_man.ico" rel="icon" type="image/ico"><!--[if lt IE 9]>
		  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>

<body>
	<header>
		<h1>IP Route - Cables</h1>
	</header>

	<nav id="nofilter">
		<a href="http://10.10.0.138/index.php">Home</a><a class="active" href="#">IP Route - Cables</a>
	</nav>

	<section id="container-delivery">
		<div style="text-align: center">
			<?php
				print '<table>';
				print '<form action="" method="post">';
				print "<tr><td><textarea name=\"ipRanges\" cols=\"40\" rows=\"20\" placeholder=\" Paste IPs to route here, including CIDR\n 10.10.0/24\"></textarea></td>";
				$cols = 60;
				print "<td><textarea name=\"result1\" cols=\"$cols\" rows=\"20\" placeholder=' IP Add commands will go here'>";
				getIPAdd();
				print '</textarea></td>';
				print '<td><textarea name="result2" cols="40" rows="20" placeholder=" Unroute commands will go here">';
				getIPDel();
				print '</textarea></td></tr>';
				print '<tr><td><input type="text" name="ethDev" placeholder="eth0:X" size="40"/></td>';
				print '<td><input type="text" name="startIP" placeholder="1st IP - Default 1" size="60" /></td></tr>';
				print '<tr><td colspan="4"><input type="submit" name="submit" value="Get IPs" /></td></tr>';
				print '<tr><td colspan="4">';
				getRoute();
				print '</td></tr>';
				print '</table>';
				print '</form>';
				?>
		</div>
	</section>

	<footer>
		<p class="jsquared">Copyright© 2015 - BEAST Inc. - J²</p>
	</footer><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> <script src="../assets/js/jquery.quicksand.js"></script> <script src="../assets/js/script.js"></script>
</body>
</html>
