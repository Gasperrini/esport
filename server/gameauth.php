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
$result = '';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
if ($action == 'login') {
    $username = $_GET['username'];
    $password = $_GET['password'];
    $sql = $conn->query("select roles.Name from `vartotojai` inner join roles on roles.ID = vartotojai.fk_role where 
    vartotojai.prisijungimas='$username' AND vartotojai.slaptazodis='$password' Limit 1");
    $result = $sql->fetch_assoc();
}
if ($action == 'delete') {
    $id = $_GET['id'];
    $sql = $conn->query("delete from `rungtynes` where id_Rungtynes='$id'");
    if($sql)
    {
        $result = "Successful";
    }
    else
    {
        $result = "Failed";
    }
}
if ($action == 'insert') {
    $title = $_GET['title'];
    $date = $_GET['date'];
    $tournamentid = $_GET['tournamentid'];
    $team1id = $_GET['team1id'];
    $team2id = $_GET['team2id'];
    $sql = $conn->query("INSERT INTO `rungtynes`(`pavadinimas`, `pradzios_laikas`, `fk_Turnyraiid_Turnyrai`, `fk_Komandosid_Komandos`, `fk_Komandosid_Komandos1`) VALUES 
    ('$title', '$date','$tournamentid','$team1id','$team2id')");
    if($sql)
    {
        $result = "Successful";
    }
    else
    {
        $result = "Failed";
    }
}
if ($action == 'update') {
    $title = $_GET['title'];
    $date = $_GET['date'];
    $tournamentid = $_GET['tournamentid'];
    $team1id = $_GET['team1id'];
    $team2id = $_GET['team2id'];
    $matchid = $_GET['matchid'];
    $sql = $conn->query("UPDATE `rungtynes` SET pavadinimas='$title' , pradzios_laikas='$date', fk_Turnyraiid_Turnyrai='$tournamentid', 
     fk_Komandosid_Komandos='$team1id', fk_Komandosid_Komandos1='$team2id' WHERE id_Rungtynes='$matchid'");
    if($sql)
    {
        $result = "Successful";
    }
    else
    {
        $result = "Failed";
    }
}
echo json_encode($result);
$conn->close();
?>