<?php
$servername = "localhost";
$username = "stud";
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
if ($action == 'getPlayers') {
    $sql = $conn->query("select * from `zaidejai`");
    $messages = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($messages, $row);
    }
    $result['rezultatai'] = $messages;
    echo json_encode($result);
}
if ($action == 'getPlayer') {
    $playerid = $_GET['id']; 
    $sql = $conn->query("select * from `zaidejai` where id_Zaidejai='$playerid'");
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

    $sql = $conn->query("UPDATE `zaidejai` SET fk_teamid= '$teamid' WHERE id_Zaidejai='$playerid'");
   // $result = $sql->fetch_assoc();
}
if ($action == 'insert2') {
       $teamid = $_GET['teamid'];
       $playerid = $_GET['playerid'];       
       echo $teamid;
       echo $playerid;
       $sql = $conn->query("UPDATE `zaidejai` SET fk_teamid= '$teamid' WHERE id_Zaidejai='$playerid'");
      // $result = $sql->fetch_assoc();
}
$conn->close();
?>