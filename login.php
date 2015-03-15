#! php-cgi

<?php 
header('Content-type: application/json');

$lh = 'oniddb.cws.oregonstate.edu';
$un = 'gullufse-db';
$p = 'eXVI6J83NBdQ5EiB';
$db = 'gullufse-db';

//$userr = $_REQUEST['username'];
$mli = new mysqli($lh,$un,$p,$db);
if(mysqli_connect_errno()){
	echo "no";
}

$stmt = $mli->prepare("SELECT * FROM users Where username=?");

$stringy = 'ericgullie';

$stmt->bind_param("s", $stringy);

$stmt->execute();

$stmt->store_result();

if ($stmt->num_rows>0){
	
	$resp = json_encode(array('success' => 1));
	echo $resp;
	
}
else {
	$resp = json_encode(array('success' => 0));
	echo $resp;
}
$mli->close();
?>
