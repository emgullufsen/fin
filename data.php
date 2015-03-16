<?php
$un = $_REQUEST['username'];
$uid = $_REQUEST['uid'];
echo <<<HTM
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="howto.css">
<link href='http://fonts.googleapis.com/css?family=Old+Standard+TT:700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Gentium+Book+Basic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Gravitas+One' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Abril+Fatface' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="login.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>data</title>
</head>
<body>
<h1>You Are logged in $un <span id="suid"> $uid</span></h1>
<img id="bpl1" class="bpl" src="barclays-premier-leaue-clubs-logo1rs.jpg">

<img id="bpl1" class="bpl" src="barclays-premier-leaue-clubs-logo2rs.jpg">

<img id="bpl1" class="bpl" src="barclays-premier-leaue-clubs-logo4rs.jpg">
<h2>Here are your favorite teams: </h2>
<div id="favplayers">
<table>
HTM;
$lh = 'oniddb.cws.oregonstate.edu';
$un = 'gullufse-db';
$p = 'eXVI6J83NBdQ5EiB';
$db = 'gullufse-db';

$m = new mysqli($lh, $un, $p, $db);
if(mysqli_connect_errno()){
	echo "<tr>heyhey</tr>";
}
$stmt = $m->prepare("SELECT `name` FROM teams t INNER JOIN usersteams ut ON t.`id` = ut.tid WHERE ut.uid = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$stmt->bind_result($llamo);

while($stmt->fetch()){
	echo "<tr><td>" . $llamo . "</td></tr>";
}

echo <<<HTM
</table>
<h2>And here are your favorite players</h2>
<table id="players">
HTM;

$stmt2 = $m->prepare("SELECT `name`, up.id FROM players p INNER JOIN usersplayers up ON p.`id` = up.pid WHERE up.uid = ?");
$stmt2->bind_param("i", $uid);
$stmt2->execute();
$stmt2->bind_result($llamo2, $upid);

while($stmt2->fetch()){
	echo "<tr id=\"$upid\"><td>" . $llamo2 . "</td><td><input type=\"button\" value=\"drop\" onclick=\"drop($upid)\"</td></tr>";
}

echo <<<HTM
</table>
HTM;

echo <<<HTM
<h2>Select More Favorite Players (make a selection from the list to get started!):</h2>
<select id="ddlplayers" onchange="filterplayers()">
HTM;

$stmt3 = $m->prepare("SELECT `id`,`name` FROM teams");
$stmt3->execute();
$stmt3->bind_result($iddd, $namey);

while($stmt3->fetch()){
	echo "<option value=\"$iddd\">$namey</option>";
}
echo "</select><table id=\"filteredplayers\"></table>";

echo <<<HTM
</div>
</body>
</html>
HTM;
?>
