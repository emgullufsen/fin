<?php
include 'info.php';
$un = $_REQUEST['username'];
echo <<<HTM
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script type="text/javascript" src="login.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>data</title>
</head>
<body>
<h1>You Are logged in $un </h1>
<div id="favplayers">
<table>
HTM;

$uid = $_REQUEST['uid'];
$m = new mysqli($lh, $un, $pass, $db);
$stmt = $m->prepare("SELECT `name` FROM teams t INNER JOIN usersteams ut ON t.`id` = ut.tid WHERE ut.uid = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$stmt->bind_result($llamo);
while($stmt->fetch()){
	echo "<tr><td>" . $llamo . "</td></tr>";
}
echo <<<HTM
</table>
</div>
</body>
</html>
HTM;
?>