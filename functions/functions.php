<?php
	include 'general.php';
	// Needed for generating fake / dummy data
	require __DIR__ . '/../faker/src/autoload.php';
	// -- Function Name : getRoute
	// -- Params : 
	// -- Purpose : 
	function getRoute (){
		
		if(isset($_POST['submit'])){
			
			if($_POST['ipRanges']) {
				$ips = explode("\r\n", trim($_POST['ipRanges']));
				print '<p>';
				echo '<font color="red">Please route to router (conf t) <br>';
				foreach ($ips as $ip) {
					echo "ip route " .str_replace('/24', "", $ip). " 255.255.255.0 gigabitEthernet 0/1" . '<br>' ;
				}

				print '</font></p>';
			}

		}

	}

	// -- Function Name : getIPAdd
	// -- Params : 
	// -- Purpose : 
	function getIPAdd(){
		
		if(isset($_POST['submit'])){
			
			if($_POST['ipRanges']) {
				$ips = explode("\r\n", trim($_POST['ipRanges']));
				
				if (isset($_POST['ipStart'])){
					$ipStart = $_POST['ipStart'];
				} else {
					$ipStart = 1;
				}

				$ipEnd = 254;
				$ethDev = $_POST['ethDev'];
				$lastDigit = range($ipStart, $ipEnd);
				foreach ($ips as $ip) {
					foreach ($lastDigit as $digit){
						echo 'ip address add ' . str_replace('.0/24', ".$digit", $ip . " dev eth0 label eth0:$ethDev") . "\n";
						$ethDev++;
					}

				}

			}

		}

	}

	

	// -- Function Name : makeUniqueCount
	// -- Params : 
	// -- Purpose : 
	function makeUniqueCount() {
		
		if(isset($_POST['submit'])){
			global $beforeCount;
			global $afterCount;
			
			if($_POST['uniqueData']) {
				echo "$afterCount unique values, out of $beforeCount";
			}

		}

	}

	

	// -- Function Name : makeUnique
	// -- Params : 
	// -- Purpose : 
	function makeUnique() {
		
		if(isset($_POST['submit'])){
			
			if($_POST['uniqueData']) {
				global $beforeCount;
				global $afterCount;
				$data = explode("\r\n", trim($_POST['uniqueData']));
				//array_push($data, "\r\n");
				$beforeCount = count($data);
				$uniques = array_unique($data);
				$afterCount = count($uniques);
				$uniques = array_values($uniques);
				for($i = 0; $i < count($uniques); $i++) {
					echo $uniques[$i] . "\n";
				}

			}

		}

	}

	// -- Function Name : getIPDel
	// -- Params : 
	// -- Purpose : 
	function getIPDel(){
		
		if(isset($_POST['submit'])){
			
			if($_POST['ipRanges']) {
				$ips = explode("\r\n", trim($_POST['ipRanges']));
				
				if (isset($_POST['ipStart'])){
					$ipStart = $_POST['ipStart'];
				} else {
					$ipStart = 1;
				}

				$ipEnd = 254;
				$ethDev = $_POST['ethDev'];
				$lastDigit = range($ipStart, $ipEnd);
				foreach ($ips as $ip) {
					foreach ($lastDigit as $digit){
						echo "ifconfig eth0:$ethDev down" . "\n";
						$ethDev++;
					}

				}

			}

		}

	}

	/*
* Functions for IP Calculation and Static IP Configuration
*/	function validateIP($ip = 0) {
		$pattern = '/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])(\/([0-9]|[1-2][0-9]|3[0-2]))$/';
		
		if (preg_match($pattern, $ip)) {
			return "True";
		} else {
			return "False";
		}

	}

	// -- Function Name : validateDomain
	// -- Params : $domain
	// -- Purpose : 
	function validateDomain($domain) {
		$pattern = '/^(?!\-)(?:[a-zA-Z\d\-]{0,62}[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/';
		
		if (preg_match($pattern, $domain)) {
			return "True";
		} else {
			return "False";
		}

	}

	// -- Function Name : tr
	// -- Params : 
	// -- Purpose : 
	function tr(){
		echo "<tr>";
		for($i=0; $i<func_num_args(); $i++) echo "<td align=\"left\">".func_get_arg($i)."</td>";
		echo "</tr>";
	}

	// Convert array of short unsigned integers to binary
	function _packBytes($array) {
		foreach ( $array as $byte ) {
			//$chars .= pack('C',$byte);
		}

		//return $chars;
	}

	// Convert binary to array of short integers
	function _unpackBytes($string) {
		return unpack('C*',$string);
	}

	// Add array of short unsigned integers
	function _addBytes($array1,$array2) {
		$result = array();
		$carry = 0;
		foreach ( array_reverse($array1,true) as $value1 ) {
			$value2 = array_pop($array2);
			
			if ( empty($result) ) {
				$value2++;
			}

			$newValue = $value1 + $value2 + $carry;
			
			if ( $newValue > 255 ) {
				$newValue = $newValue - 256;
				$carry = 1;
			} else {
				$carry = 0;
			}

			array_unshift($result,$newValue);
		}

		return $result;
	}

	// -- Function Name : _cdr2Bin
	// -- Params : $cdrin,$len=4
	// -- Purpose : 
	function _cdr2Bin ($cdrin,$len=4){
		
		if ( $len > 4 || $cdrin > 32 ) {
			// Are we ipv6?
			return str_pad(str_pad("", $cdrin, "1"), 128, "0");
		} else {
			return str_pad(str_pad("", $cdrin, "1"), 32, "0");
		}

	}

	// -- Function Name : _bin2Cdr
	// -- Params : $binin
	// -- Purpose : 
	function _bin2Cdr ($binin){
		return strlen(rtrim($binin,"0"));
	}

	// -- Function Name : _cdr2Char
	// -- Params : $cdrin,$len=4
	// -- Purpose : 
	function _cdr2Char ($cdrin,$len=4){
		$hex = _bin2Hex(_cdr2Bin($cdrin,$len));
		return _hex2Char($hex);
	}

	// -- Function Name : _char2Cdr
	// -- Params : $char
	// -- Purpose : 
	function _char2Cdr ($char){
		$bin = _hex2Bin(_char2Hex($char));
		return _bin2Cdr($bin);
	}

	// -- Function Name : _hex2Char
	// -- Params : $hex
	// -- Purpose : 
	function _hex2Char($hex){
		return pack('H*',$hex);
	}

	// -- Function Name : _char2Hex
	// -- Params : $char
	// -- Purpose : 
	function _char2Hex($char){
		$hex = unpack('H*',$char);
		return array_pop($hex);
	}

	// -- Function Name : _hex2Bin
	// -- Params : $hex
	// -- Purpose : 
	function _hex2Bin($hex){
		$bin='';
		for($i=0;$i<strlen($hex);$i++)    $bin.=str_pad(decbin(hexdec($hex{
			$i}

		)),4,'0',STR_PAD_LEFT);
		return $bin;
	}

	// -- Function Name : _bin2Hex
	// -- Params : $bin
	// -- Purpose : 
	function _bin2Hex($bin){
		$hex='';
		for($i=strlen($bin)-4;$i>=0;$i-=4)    $hex.=dechex(bindec(substr($bin,$i,4)));
		return strrev($hex);
	}

	//Generates rDNS A records
	function rDNS_A($words){
		
		if(isset($_POST['submit'])){
			
			if(!empty($_POST['ip']) && !empty($_POST['domain'])){
				$ip = trim($_POST['ip']);
				$domain = trim($_POST['domain']);
				
				if (!empty($_POST['ipStart'])){
					$ipStart = $_POST['ipStart'];
				} else {
					$ipStart = 1;
				}

				
				if (!empty($_POST['ipEnd'])){
					$ipEnd = $_POST['ipEnd'];
				} else {
					$ipEnd = 254;
				}

				$lastDigit = range($ipStart, $ipEnd);
				$i =0;
				foreach ($lastDigit as $digit){
					$word = $words[$i];
					echo "$word.$domain."."\t"."IN"."\t"."A"."\t". str_replace('.0/24', ".$digit", $ip). "\n";
					$i++;
				}

			}

		}

	}

	//Generates rDNS PTR records to match A records
	function rDNS_PTR($words){
		
		if(isset($_POST['submit'])){
			
			if(!empty($_POST['ip']) && !empty($_POST['domain'])){
				$ip = trim($_POST['ip']);
				$domain = trim($_POST['domain']);
				
				if (!empty($_POST['ipStart'])){
					$ipStart = $_POST['ipStart'];
				} else {
					$ipStart = 1;
				}

				
				if (!empty($_POST['ipEnd'])){
					$ipEnd = $_POST['ipEnd'];
				} else {
					$ipEnd = 254;
				}

				$lastDigit = range($ipStart, $ipEnd);
				$i =0;
				foreach ($lastDigit as $digit){
					$word = $words[$i];
					echo str_replace('.0/24', ".$digit", $ip). "\t" .'IN'. "\t". 'PTR'. "\t" . "$word.$domain.". "\n";
					$i++;
				}

			}

		}

	}

	// -- Function Name : getLeftoverIPs
	// -- Params : $ipRange, $startIP
	// -- Purpose : 
	function getLeftoverIPs($ipRange, $startIP){
		
		if(isset($_POST['submit'])){
			
			if($_POST[$ipRange]) {
				$ips = explode("\n", trim($_POST[$ipRange]));
				$endCounter = 3;
				foreach ($ips as $ip) {
					$ipStart = $_POST[$startIP];
					for($i=0; $i<$endCounter; $i++){
						echo str_replace('.0/24', ".$ipStart", $ip) . "\n";
						$ipStart++;
						echo str_replace('.0/24', ".$ipStart", $ip) . "\n";
						$ipStart += 7;
					}

				}

			}

		}

	}

	// -- Function Name : printIPs
	// -- Params : $data
	// -- Purpose : 
	function printIPs($data){
		
		if(isset($_POST['submit'])){
			
			if($_POST[$data]) {
				$ips = explode("\n", trim($_POST[$data]));
				foreach ($ips as $ip){
					echo $ip . "\n";
				}

			}

		}

	}

	// -- Function Name : getIPs
	// -- Params : $ipRange, $startIP
	// -- Purpose : 
	function getIPs($ipRange, $startIP){
		
		if(isset($_POST['submit'])){
			
			if($_POST[$ipRange]) {
				$ips = explode("\n", trim($_POST[$ipRange]));
				$ipStart = $_POST[$startIP];
				$ipEnd = $ipStart + 5;
				$lastDigit = range($ipStart, $ipEnd);
				foreach ($ips as $ip) {
					foreach ($lastDigit as $digit){
						echo str_replace('.0/24', ".$digit", $ip) . "\n";
					}

				}

			}

		}

	}

	// -- Function Name : osAvail
	// -- Params : 
	// -- Purpose : 
	function osAvail(){
		$OS = array('CentOS 5','CentOS 6','CentOS 7','Ubuntu 12.04 Desktop','Ubuntu 12.04 Server','Ubuntu 14.04 Desktop','Ubuntu 14.04 Server','Debian 6','Debian 7','Windows Server 2008','Windows Server 2013');
		foreach($OS as $os) {
			echo '<option value="' . $os .'">' . $os . '</option>';
		}

	}

	?>
