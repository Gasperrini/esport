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
    $sql = $conn->query("delete from `zaidejai` where id_Zaidejai='$id'");
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
    $name = $_GET['name'];
    $lastname = $_GET['lastname'];
    $username = $_GET['username'];
    $city = $_GET['city'];
    $role = $_GET['role'];
    $pic = $_GET['pic'];
    $fk_teamid = $_GET['fk_teamid'];
    $sql = $conn->query("INSERT INTO `zaidejai`(`vardas`, `pavarde`, `slapyvardis`, `miestas`, `role`, `zaidejopic`,`fk_teamid`) VALUES 
    ('$name', '$lastname','$username','$city','$role','$pic','$fk_teamid')");
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
    $name = $_GET['name'];
    $lastname = $_GET['lastname'];
    $username = $_GET['username'];
    $city = $_GET['city'];
    $role = $_GET['role'];
    $pic = $_GET['pic'];
    $fk_teamid = $_GET['fk_teamid'];
    $playerid = $_GET['playerid'];
    $sql = $conn->query("UPDATE `zaidejai` SET vardas='$name' , pavarde='$lastname', slapyvardis='$username',miestas='$city', 
     `role`='$role', zaidejopic='$pic',fk_teamid='$fk_teamid' WHERE id_Zaidejai='$playerid'");
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