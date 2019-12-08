<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esport";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$action = '';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
if ($action == 'getGames') {
    $sql = $conn->query("select * from `rungtynes`");
    $messages = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($messages, $row);
    }
    $result['rezultatai'] = $messages;
    echo json_encode($result);
}
if ($action == 'getGame') {
    $matchid = $_GET['id']; 
    $sql = $conn->query("select * from `rungtynes` where id_Rungtynes='$matchid'");
    $messages =$sql->fetch_assoc();
    $result = $messages;
    echo json_encode($result);
}
if ($action == 'insert') {
    $vardas = $_GET['vardas'];
    $pavarde = $_GET['pavarde'];       
    $slapyvardis = $_GET['slapyvardis'];
    $miestas = $_GET['miestas'];   
    $role = $_GET['role'];
    $zaidejopic = $_GET['zaidejopic'];  
    $fk_teamid = $_GET['fk_teamid'];

    $sql = $conn->query("UPDATE `zaidejai` SET fk_teamid= '$teamid' WHERE id_Zaidejai='$matchid'");
   // $result = $sql->fetch_assoc();
}
if ($action == 'insert2') {
       $teamid = $_GET['teamid'];
       $matchid = $_GET['matchid'];       
       echo $teamid;
       echo $matchid;
       $sql = $conn->query("UPDATE `zaidejai` SET fk_teamid= '$teamid' WHERE id_Zaidejai='$matchid'");
      // $result = $sql->fetch_assoc();
}
$conn->close();
?>