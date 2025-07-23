<?php
$servername="localhost";
$username="root";
$password="";
$dbname="informacion";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Conexion Fallida".$conn->connect_error);

}
?>