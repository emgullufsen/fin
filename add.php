<?php
ini_set('display_errors',1);
$id = $_POST['id'];
$id = intval($id);
$uid = intval($_POST['suid']);

$lh = 'oniddb.cws.oregonstate.edu';
$un = 'gullufse-db';
$p = 'eXVI6J83NBdQ5EiB';
$db = 'gullufse-db';

$m = new mysqli($lh,$un,$p,$db);

$s = $m->prepare("INSERT INTO usersplayers (uid, pid) VALUES (?,?)");

$s->bind_param("ii", $uid, $id);

$s->execute();

$s->store_result();

if ($s->affected_rows){
	echo json_encode(array('added' => 1));
}

?>
