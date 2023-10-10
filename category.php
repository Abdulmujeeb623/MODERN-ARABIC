<?php include('headerArab.php'); ?>
<body>
<?php include('TheNavbarArab.php'); ?>
<div class="container">
	<h1 class="page-header text-center">SECTION</h1>
	<div class="row">
		<div class="col-md-12">
			<a href="addcategory.php" data-toggle="modal" class="pull-right btn btn-primary"><span class="glyphicon glyphicon-plus"></span> SECTION</a>
		</div>
	</div>
	<div style="margin-top:10px;">
		<table class="table table-striped table-bordered">
			<thead>
				<th>Category Name</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php
					$sql="SELECT * from category order by categoryid asc";
					$query=$conn->query($sql);
					while($row=$query->fetch_array()){
						?>
						<tr>
							<td><?php echo $row['catname']; ?></td>
							<td>
								<a href="addcategory.php<?php echo $row['categoryid']; ?>" data-toggle="modal" class="btn btn-success btn-sm">
								<span class="glyphicon glyphicon-pencil"></span> Edit</a> || <a href="deletecategory.php
								<?php echo $row['categoryid']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a>
								<?php include('modal.php'); ?>
								<?php include('category_modal.php'); ?>

							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<?php include('RootFooter.php'); ?>
</body>
</html>