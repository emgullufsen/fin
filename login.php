#! php-cgi

<?php

$resp1 = array('success' => 1);
$resp0 = array('success' => 0);

header('Content-type: application/json');

$lh = 'oniddb.cws.oregonstate.edu';
$un = 'gullufse-db';
$p = 'eXVI6J83NBdQ5EiB';
$db = 'gullufse-db';

if (!is_null($_REQUEST['username'])){
	$userr = $_REQUEST['username'];
}
else {
	$resp0['message'] = "Username Is Required, Please Fill In"; // should have been checked by js anyhow, I'm realizing now.
}

$passs = $_REQUEST['password'];

$mli = new mysqli($lh,$un,$p,$db);
if(mysqli_connect_errno()){
	echo "no";
}

$stmt = $mli->prepare("SELECT id FROM users Where username=? AND password=?");

$stmt->bind_param("ss", $userr, $passs);
$stmt->execute();
$stmt->bind_result($idd);
$stmt->fetch();

if (!is_null($idd)){
	$resp1['uid'] = $idd;
	$resp1['username'] = $userr;
	echo json_encode($resp1);
}
else {
	
	echo json_encode($resp0);
}
$mli->close();
?>
