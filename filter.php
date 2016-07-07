<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","maceachm-db","3hbK7ofktVuGsEIE","maceachm-db");
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
                if(!($stmt = $mysqli->prepare("SELECT characters.fname, characters.lname, planets.name FROM characters INNER JOIN planets ON characters.homeworld = planets.id WHERE planets.id = ?"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!($stmt->bind_param("i",$_POST['Homeworld']))){
                    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($fname, $lname, $homeworld)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $homeworld . "\n</td>\n</tr>";
                }
                $stmt->close();
                ?>
	</table>

	       </table>
        </div>
    </body>
</html>