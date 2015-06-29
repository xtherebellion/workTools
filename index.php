<?php require_once dirname(__FILE__) . "/functions/functions.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        
        <title> Scripts</title>
        
        <!-- Our CSS stylesheet file -->
        <link rel="stylesheet" href="assets/css/styles.css" />
		<link rel="icon" type="image/ico" href="/css/images/delivery_man.ico">
        
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    
    <body>
		<header>
            <h1>Delivery Scripts</h1>
        </header>
        
        <nav id="filter"></nav>

        <section id="container">
			<div class="link-container">
        	<ul id="stage">
            	<li data-tags="Delivery"><a href="scripts/ipgen.php"><img src="assets/img/shots/ipgen.png" alt="IP Generator"/></a></li>
				<li data-tags="Sys. Admin."><a href="scripts/ipCalc.php"><img src="assets/img/shots/ipCalc.png" alt="IP Generator" /></a></li>
				<li data-tags="Delivery"><a href="scripts/rDNS.php"><img src="assets/img/shots/rDNS.png" alt="rDNS Generator" /></a></li>
				<li data-tags="Delivery"><a href="scripts/iproute.php"><img src="assets/img/shots/route.png" alt="IP Generator" /></a></li>
				<li data-tags="Delivery"><a href="scripts/listcount.php"><img src="assets/img/shots/lists.png" alt="rDNS Generator" /></a></li>
				<li data-tags="Misc."><a href="scripts/unique.php"><img src="assets/img/shots/unique.png" alt="" /></a></li>
				<li data-tags="Sys. Admin."><a href="scripts/staticIP.php"><img src="assets/img/shots/iStatic.png" alt="rDNS Generator" /></a></li>
            </ul>
			</div>
        </section>
          
        <footer>
				<p class="tzine">Copyright© 2015 - BEAST Inc. - J²</p>
        </footer>
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
        <script src="assets/js/jquery.quicksand.js"></script>
        <script src="assets/js/script.js"></script>
    
    </body>
</html>
