<?php
	include('conn.php');
	function test_input($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


	$id=$_GET['category'];
	

	$cname=test_input($_POST['cname']);

	$sql="UPDATE category set catname=? where categoryid=? ";
	$stmt=$conn->prepare($sql);
    $stmt->bind_param('ss', $id, $cname);
    $stmt->execute();
 

	header('location:category.php');
?>