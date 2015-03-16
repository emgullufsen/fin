#! php-cgi

<?php

ini_set('display_errors',1);
$id = $_POST['id'];
$id = intval($id);

$lh = 'oniddb.cws.oregonstate.edu';
$un = 'gullufse-db';
$p = 'eXVI6J83NBdQ5EiB';
$db = 'gullufse-db';

$mm = new mysqli($lh,$un,$p,$db);
if(mysqli_connect_errno()){
	echo "not gootd";
}

if(!$stmtt = $mm->prepare("SELECT `id`,`name` FROM players WHERE tid=?")){
	echo "no no no prep";
}


if (!$stmtt->bind_param("i", $id)){
	echo "no no no bind";
}

$stmtt->execute();

$stmtt->bind_result($arid, $arname);

$play = array();

$j = 0;

while ($stmtt->fetch()){

	if (!empty($arid) && !empty($arname)){
		$play[$j] = array("id" => $arid, "name" => utf8_encode($arname));
	}
	$j++;

}
echo json_encode(($play));
$mm->close();
?>
