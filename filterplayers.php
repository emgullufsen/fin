<?php
$id = $_REQUEST['id'];

$lh = 'oniddb.cws.oregonstate.edu';
$un = 'gullufse-db';
$p = 'eXVI6J83NBdQ5EiB';
$db = 'gullufse-db';

$mm = new mysqli($lh,$un,$p,$db);

$stmtt = $mm->prepare("SELECT `id`,`name` FROM PLAYERS WHERE tid=?");

$stmtt->bind_param("i", $id);

$stmtt->execute();

$stmtt->bind_result($arid, $arname);

$play = array();

while ($stmtt->fetch()){
	$a = array('id' => $arid, 'name' => $arname);
	array_push($play, $a);
}

echo json_encode($play);

?>