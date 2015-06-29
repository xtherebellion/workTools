<?php require dirname(__FILE__) . "/../functions/functions.php"; error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Static IP Configuration</title><!-- Our CSS stylesheet file -->
	<link href="../assets/css/styles.css" rel="stylesheet">
	<link href="/css/images/delivery_man.ico" rel="icon" type="image/ico">
	<!--[if lt IE 9]>
		  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
	<header>
		<h1>Static IP Configuration Generator</h1>
	</header>

	<nav id="devfilter">
		<a href="http://10.10.0.138/index.php">Home</a><a class="active" href="#">Static IP</a>
	</nav>

	<section id="container-dev">
		<div style="text-align: center">
			<form action="" method="post">
				<table>
					<tr>
						<th colspan="4">Static IP Configuration for Linux</th>
					</tr>

					<tr>
						<td colspan="2">IP/CIDR:</td>

						<td colspan="2"><input maxlength="64" name="network" placeholder="10.10.0.0/24" type="text"></td>
					</tr>

					<tr>
						<td colspan="4"><input name="submit" type="submit" value="Generate"></td>
					</tr>

					<tr>
						<td colspan="4"></td>
					</tr><?php
						
						if(isset($_POST['submit'])) {
							
							if (empty($_POST['network'])){
								print '<tr><td colspan="4"><font color="red"> Please enter an IP / CIDR </font></td></tr>';
							}

							elseif (validateIP($_POST['network']) == "False") {
								print '<tr><td colspan="4"><font color="red"> Invalid IP/CIDR </font></td></tr>';
							}

							$maxSubNets = '2048';
							// Stop memory leak from invalid input or large ranges
							$superNet = $_POST['network'];
							$superNetMask = '255.255.255.0';
							// optional
							$subNetCdr = '/24';
							$subNetMask = '255.555.255.0';
							// optional
							$ip = strtok($superNet, '/');
							// Calculate supernet mask and cdr
							
							if (ereg('/',$superNet)){
								//if cidr type mask
								$charHost = inet_pton(strtok($superNet, '/'));
								$charMask = _cdr2Char(strtok('/'),strlen($charHost));
							} else {
								$charHost = inet_pton($superNet);
								$charMask = inet_pton($superNetMask);
							}

							// Single host mask used for hostmin and hostmax bitwise operations
							$charHostMask = substr(_cdr2Char(127),-strlen($charHost));
							$charWC = ~$charMask;
							// Supernet wildcard mask
							$charNet = $charHost & $charMask;
							// Supernet network address
							$charBcst = $charNet | ~$charMask;
							// Supernet broadcast
							$charHostMin = $charNet | ~$charHostMask;
							// Minimum host
							$charHostMax = $charBcst & $charHostMask;
							// Maximum host
							
							if(!empty($superNet) && validateIP($superNet) == 'True'){
								//Display Results
								print '<tr><td colspan="4"></td></tr>';
								print '<tr><td colspan="4">';
								print '<textarea rows="20" cols="30">';
								print "auto eth0 \n";
								print 'iface eth0 inet static' . "\n";
								print 'address '. $ip . "\n";
								print 'network '.inet_ntop($charNet) . "\n";
								print 'netmask '.inet_ntop($charMask) . "\n";
								print 'broadcast '.inet_ntop($charBcst) . "\n";
								print "gateway Gateway Address \n";
								print '</textarea>';
								print '</td></tr>';
							}

							// Calculate subnet mask and cdr
							
							if ($subNetCdr) {
								preg_match('/\d+/',$subNetCdr,$cdr);
								$subNetCdr = $cdr[0];
								$charSubMask = _cdr2Char($subNetCdr,strlen($charHost));
								//$charSubWC = ~$charSubMask; // Subnet wildcard mask
								$superNetMask = inet_ntop($charSubMask);
							} else {
							}

							// Convert to unsigned short so we can do some math
							$intNet=_unpackBytes($charNet);
							$intSubWC=_unpackBytes($charSubWC=0);
							// Set up initial subnet address, it will be the same as the supernet address
							$intSub = $intNet;
							$charSub = $charNet;
							$charSubs = array();
							// Generate adjacent subnets until we leave the supernet
							$n = 0;
							while ((($charSub & $charMask) == $charNet) && $n < $maxSubNets) {
								array_push($charSubs,$charSub);
								$intSub = _addBytes($intSub,$intSubWC);
								$charSub = _packBytes($intSub);
								$n++;
							}

							// Output result
							//foreach ( $charSubs as $charSub ) {
							//  tr('Network:','<a href="?network='.urlencode(inet_ntop( $charSub)."/"._char2Cdr($charSubMask)).'">'.inet_ntop( $charSub)."/"._char2Cdr($charSubMask)."</a></font>");
							//}
							//
						}

						?>
				</table>
			</form>
		</div>
	</section>

	<footer>
		<p class="jsquared">Copyright© 2015 - BEAST Inc. - JÂ²</p>
	</footer><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> <script src="../assets/js/jquery.quicksand.js"></script> <script src="../assets/js/script.js"></script>
</body>
</html>
