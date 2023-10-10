<?php
	include('conn.php');
	function test_input($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$id=$_GET['product'];

	$pname=test_input($_POST['pname']);
	$category=test_input($_POST['category']);
	$price=test_input($_POST['price']);

	$sql=$conn->prepare("SELECT * from product where productid=?");
	$sql->bind_param('s', $id);
	$sql->execute();
	$query = $sql->get_result();
	$row=$query->fetch_array();

	$fileinfo=PATHINFO($_FILES["photo"]["name"]);

	if (empty($fileinfo['filename'])){
		$location = $row['photo'];
	}
	else{
		$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
		move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . $newFilename);
		$location="upload/" . $newFilename;
	}

	$sql=$conn->prepare("UPDATE product set productname=?, categoryid=?, price=?, photo=? where productid=?");

	$sql->bind_param('sssss', $pname, $category, $price, $location, $id);
	$sql->execute();
	

	header('location:product.php');
?>