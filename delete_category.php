<?php
	include('conn.php');

	$id = $_GET['category'];

	$sql="DELETE from category where categoryid=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param('s', $id);
    $stmt->execute();


	header('location:category.php');
?>