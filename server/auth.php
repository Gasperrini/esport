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
if ($action == 'login') {
    $username = $_GET['username'];
    $password = $_GET['password'];
    $sql = $conn->query("select roles.Name from `vartotojai` inner join roles on roles.ID = vartotojai.fk_role where 
    vartotojai.prisijungimas='$username' AND vartotojai.slaptazodis='$password' Limit 1");
    $result = $sql->fetch_assoc();
}
echo json_encode($result);
$conn->close();
?>