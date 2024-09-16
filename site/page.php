<?php
echo "<center>
<h1>Label images</h1>
";

$servername = "SERVERNAME";
$username = "USERNAME";
$password = "PASSWORD";
$db = "DATABASE-NAME";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection to database failed: " . $conn->connect_error);
}
echo "<i>Connected to database successfully</i><br><br><i>Write A, B, C, D, E, F or 0 (empty cell) or X (unreadable/not classifiable) for each of the following then slots.</i>
";

function push_value($conn) {
  foreach ($_POST as $key => $value) {
    $sql_insert = "UPDATE IMG SET LABEL = '" . htmlspecialchars($value) . "' WHERE ID = " . str_replace("val", "", htmlspecialchars($key));
    if ($conn->query($sql_insert) === TRUE) {
    } else {
      echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
  }
}

push_value($conn);

$sql = "SELECT `ID`,`NAME`,`VALUE`, LABEL FROM `IMG`";

$results = mysqli_query($conn,$sql);

$labels_array = [];
$count = 0;
$flag = 1;
while($rowitem = mysqli_fetch_array($results)) {
  echo "<form method='post' onsubmit='push_value(" . $rowitem["ID"] . ")'>";

  if ($rowitem['LABEL'] == '1') {
    if ($flag == 1) {
      echo "<br><br>Progress: " . $rowitem['ID'] . " / 11850<br>";
      echo progress_bar($rowitem['ID'], 11850);
    }
    $flag = 0;
    echo '<br><i>' . $rowitem['NAME'] . '</i>';
    echo '<br><img src="data:image/jpeg;base64,'.base64_encode($rowitem['VALUE']).'"/>';
    echo "<br><input name='val" . $rowitem['ID'] ."' type='text' size='10' style='font-size: 20pt; text-align:center' maxlength='1' required/><br>";
    $count++;
    }
    if ($count == 15) {
      break;
    }
}
if ($flag) {
    echo "All done!";
}

echo "<br><br><div style='display:inline-block'>
<input type='submit' value='Submit&#13;&#10;and Continue' style='
  text-align: center;
  backface-visibility: hidden;
  background: #332cf2;
  border: 0;
  border-radius: .375rem;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: Circular,Helvetica,sans-serif;
  font-size: 1.125rem;
  font-weight: 700;
  letter-spacing: -.01em;
  line-height: 1.3;
  padding: 1rem 1.25rem;
  position: relative;
  text-align: left;
  text-decoration: none;
  transform: translateZ(0) scale(1);
  transition: transform .2s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type='submit' value='Submit&#13;&#10;and End' formaction='end.php' style='
  text-align: center;
  backface-visibility: hidden;
  background: #332cf2;
  border: 0;
  border-radius: .375rem;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: Circular,Helvetica,sans-serif;
  font-size: 1.125rem;
  font-weight: 700;
  letter-spacing: -.01em;
  line-height: 1.3;
  padding: 1rem 1.25rem;
  position: relative;
  text-align: left;
  text-decoration: none;
  transform: translateZ(0) scale(1);
  transition: transform .2s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation'>
</div>
</form>
</center>";

/* $sql_insert = "INSERT INTO images (NAME) VALUES ('Doe')";
if ($conn->query($sql_insert) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql_insert . "<br>" . $conn->error;
} */
function add_to_array() {
  array_push($emptyArray, htmlentities($_POST['val']));
}


function progress_bar($done, $total, $info="", $width=100) {
  $perc = round(($done * 100) / $total);
  $bar = round(($width * $perc) / 100);
  return sprintf("%s%%[%s>%s]%s\r<br>", $perc, str_repeat("=", $bar), str_repeat(" ", $width-$bar), $info);
}

/* $results = mysqli_query($conn,$sql);
echo "<table>"; //end table tag
while($rowitem = mysqli_fetch_array($results)) {
    echo "<tr>";
    echo "<td>" . $rowitem['ID'] . "</td>";
    echo "<td>" . $rowitem['NAME'] . "</td>";
    echo "<td>" . $rowitem['VALUE'] . "</td>";
    echo "</tr>";
}
echo "</table>"; //end table tag */

?>