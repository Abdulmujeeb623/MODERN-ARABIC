<?php
    include('conn.php');

    if (isset($_GET['product'])) {
        $id = $_GET['product'];

        $sql = "DELETE FROM product WHERE productid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();

        header('location: product.php');
    }
?>
<!-- Delete Product -->
<div class="modal fade" id="deleteproduct<?php echo $row['productid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Product</h4></center>
            </div>
            <div class="modal-body">
                <h3 class="text-center"><?php echo $row['productname']; ?></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                <!-- Use a regular link to directly call the PHP script for deletion -->
                <a href="delete_product.php?product=<?php echo $row['productid']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
