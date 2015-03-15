<?php 
header('Content-type: application/json');

$lh = 'oniddb.cws.oregonstate.edu';
$un = 'gullufse-db';
$p = 'eXVI6J83NBdQ5EiB';
$db = 'gullufse-db';

$userr = $_REQUEST['username'];

$mli = new mysqli($lh,$un,$p,$db);

if(mysqli_connect_errno()){
	echo "no";
}

$stmt = $mli->prepare("SELECT * FROM users WHERE username=?");

$stringy = 'ericgullie';

$stmt->bind_param("s", $stringy);

$stmt->execute();

if (num_rows($stmt)){
	
	$resp = json_encode(array('success' => 1));
	echo $resp;
	
}
else {
	$resp = json_encode(array('success' => 0));
	echo $resp;
}

?>