<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","maceachm-db","3hbK7ofktVuGsEIE","maceachm-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}


if(!($stmt = $mysqli->prepare("INSERT INTO reports (sub_id, o_id) VALUES (?, ?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("ii",$_POST['subName'], $_POST['offName']))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
    echo "Added " . $stmt->affected_rows . " rows to reports.";
}
?>