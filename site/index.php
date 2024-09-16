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
echo "<i>Connected to database successfully</i><br><br>";

$sql = "SELECT ID,VALUE, DATE FROM LISTENER";

$results = mysqli_query($conn,$sql);

while($rowitem = mysqli_fetch_array($results)) {
    $dateNow = date("Y-m-d") . " " . date("H:i:s");
    $diff = abs(strtotime($rowitem['DATE']) - strtotime($dateNow));
    
    if ($rowitem['VALUE'] == 0) {
        $sql_insert = "UPDATE LISTENER SET VALUE = 1 WHERE ID = 1";
        if ($conn->query($sql_insert) === TRUE) {
            header('Location: page.php');
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }

    } else if ($rowitem['VALUE'] == 1 && $diff > 300) {
        $sql_insert = "UPDATE LISTENER SET DATE = '" . $dateNow . "' WHERE ID = 1";
        if ($conn->query($sql_insert) === TRUE) {
            header('Location: page.php');
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        echo "An other user is currently labelling images.<br>Due to database restrictions, you should wait until he/she finishes.<br><b>Please try again in a few minutes.</b>";
    }

}
echo "</center>";

?>