<?php
$id = $_REQUEST['id'];

$lh = 'oniddb.cws.oregonstate.edu';
$un = 'gullufse-db';
$p = 'eXVI6J83NBdQ5EiB';
$db = 'gullufse-db';

$mm = new mysqli($lh,$un,$p,$db);

$stmtt = $mm->prepare("DELETE FROM usersplayers WHERE id=?");

$stmtt->bind_param("i", $id);

$stmtt->execute();

if (mysqli_affected_rows($mm)>0){
	echo json_encode(array('dropped' => 1));
}

?>
