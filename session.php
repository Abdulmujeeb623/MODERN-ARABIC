<?php
include("includes/.php");
session_start();
if (!isset($_SESSION['email'])){
header('location:index.php');
}

$id = $_SESSION['id'];

$query=mysql_query ("SELECT * FROM  WHERE id ='$id'") or die(mysql_error());
$row=mysql_fetch_array($query);
$cover_picture=$row['coverpic'];
$profile_picture=$row['profilepic'];
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$username=$row['username'];
?>