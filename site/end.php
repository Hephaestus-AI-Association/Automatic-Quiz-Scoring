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
echo "<i>Connected to database 1 successfully</i><br>
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


$servername = "SERVERNAME2";
$username = "USERNAME2";
$password = "PASSWORD2";
$db = "DATABASE-NAME2";


// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection to database failed: " . $conn->connect_error);
}
echo "<i>Connected to database 2 successfully</i><br><br><h2>Thank You!</h2><br>";

$sql_insert = "UPDATE LISTENER SET VALUE = 0 WHERE ID = 1";


if ($conn->query($sql_insert) === TRUE) {
} else {
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

echo "<form method='post' onsubmit='index.php'>";

echo "<input type='submit' value='Start Again' formaction='index.php' style='
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
  touch-action: manipulation'>";

echo '</form>';

echo "</center>";

?>