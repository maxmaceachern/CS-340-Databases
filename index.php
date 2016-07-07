<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","maceachm-db","3hbK7ofktVuGsEIE","maceachm-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
echo "THIS WORKS";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<div>
	<table>
		<tr>
			<td>Star Trek People</td>
		</tr>
		<tr>
			<td>First Name</td>
			<td>Last Name</td>
			<td>Homeworld</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT fname, lname, homeworld FROM characters INNER JOIN planets ON characters.homeworld = planets.id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name, $age, $homeworld)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $age . "\n</td>\n<td>\n" . $homeworld . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="filter.php"> 

		<fieldset>
			<legend>Filter by Homeworld</legend>
			<select name="Homeworld" />
            <?php
                if(!($stmt = $mysqli->prepare("SELECT id, name FROM planets"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $pname)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
                }
                $stmt->close();
            ?>
        </fieldset>
		<p><input type="submit" value ="Run Filter"/></p>
	</form>
</div>

<div>
	<form method="post" action="addCharacter.php"> 

		<fieldset>
			<legend>Add Character</legend>
			<p>First Name: <input type="text" name="FirstName" /></p>
			<p>Last Name: <input type="text" name="LastName" /></p>
			<p>Homeworld: <select name="Homeworld">
            <?php
                if(!($stmt = $mysqli->prepare("SELECT id, name FROM planets"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $pname)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
                }
                $stmt->close();
            ?>
            </select></p>
        </fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<div>
	<form method="post" action="addPlanet.php"> 

		<fieldset>
			<legend>Add Planet</legend>
			<p>Name: <input type="text" name="pName" /></p>
        </fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<div>
	<form method="post" action="addShip.php"> 

		<fieldset>
			<legend>Add Ship</legend>
			<p>Name: <input type="text" name="sName" /></p>
        </fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<div>
	<form method="post" action="addSkill.php"> 

		<fieldset>
			<legend>Add Skill</legend>
			<p>Name: <input type="text" name="skName" /></p>
        </fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<div>
	<form method="post" action="addStationed.php"> 

		<fieldset>
			<legend>Add Stationed</legend>
			<p>Character: <select name="charName">
            <?php
                if(!($stmt = $mysqli->prepare("SELECT id, concat (fname, lname) as cName FROM characters"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $pname)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
                }
                $stmt->close();
            ?>
            </select></p>
			<p>Ship: <select name="shipName">
            <?php
                if(!($stmt = $mysqli->prepare("SELECT id, name FROM ships"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $pname)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
                }
                $stmt->close();
                ?>
            </select></p>
        </fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<div>
	<form method="post" action="addReport.php"> 

		<fieldset>
			<legend>Add Report To</legend>
			<p>Subordinate: <select name="subName">
            <?php
                if(!($stmt = $mysqli->prepare("SELECT id, concat (fname, lname) as cName FROM characters"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $pname)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
                }
                $stmt->close();
            ?>
            </select></p>
			<p>Officer: <select name="offName">
            <?php
                if(!($stmt = $mysqli->prepare("SELECT id, concat (fname, lname) as cName FROM characters"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $pname)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
                }
                $stmt->close();
            ?>
            </select></p>
        </fieldset>
		<p><input type="submit" /></p>
	</form>
</div>
    
<div>
	<form method="post" action="addCharSkill.php"> 

		<fieldset>
			<legend>Add Character Skill</legend>
			<p>Character: <select name="charName01">
            <?php
                if(!($stmt = $mysqli->prepare("SELECT id, concat (fname, lname) as cName FROM characters"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $pname)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
                }
                $stmt->close();
            ?>
            </select></p>
			<p>Skill: <select name="skillName">
            <?php
                if(!($stmt = $mysqli->prepare("SELECT id, name FROM skills"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $pname)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
                }
                $stmt->close();
                ?>
            </select></p>
        </fieldset>
		<p><input type="submit" /></p>
	</form>
</div>
    
<div>
	<form method="post" action="deleteCharacter.php"> 

		<fieldset>
			<legend>Delete Character</legend>
			<p>First Name: <input type="text" name="FirstName" /></p>
			<p>Last Name: <input type="text" name="LastName" /></p>
			<!--<p>Homeworld: <select name="Homeworld">
            <?php
                if(!($stmt = $mysqli->prepare("SELECT id, name FROM planets"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $pname)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
                }
                $stmt->close();
            ?>
            </select></p>
			<p>Skill: <select name="Skill">
            <?php
                if(!($stmt = $mysqli->prepare("SELECT id, name FROM skills"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $pname)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
                }
                $stmt->close();
                ?>
            </select></p>-->
        </fieldset>
		<p><input type="submit" /></p>
	</form>
</div>



</body>
</html>