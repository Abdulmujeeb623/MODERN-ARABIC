<?php
// Start the session (put this at the beginning of your script)
session_start();

include('TheNavbarArab2.php');

// Function to sanitize and validate input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input name
    $customer_name = test_input($_POST['customer']);

    // Create a prepared statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE customer_Name = ?");
    $stmt->bind_param("s", $customer_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Customer exists, fetch customer information and purchase details
        $row = $result->fetch_assoc();
        $customer_id = $row['id'];
        $address = $row['customer_Address'];
        $phone_number = $row['customer_Number'];
        $description = $row['customer_Description'];

        // Set the customer name in the session variable
        $_SESSION['customer_name'] = $customer_name;
        $customer=$_SESSION['customer_name'];

        // Query the database to retrieve purchase and purchase_detail information
        $sql = "SELECT * FROM purchase 
        LEFT JOIN purchase_detail ON purchase.purchaseid = purchase_detail.purchaseid
        LEFT JOIN product ON purchase_detail.productid = product.productid
        WHERE purchase.customer = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $customer);
        $stmt->execute();
        $result = $stmt->get_result();

    

        
    } else {
        // Customer does not exist, display an error message or take appropriate action
        echo "<h1 class='text-center'>Customer not found</h1>";
    }
    $stmt->close();
}
?>

            


</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <title>Sales</title>
	<style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        /* Header styles */
        h1 {
            text-align: center;
            margin-top: 20px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Total row style */
        tfoot td {
            font-weight: bold;
        }

        /* Responsive styles for laptop and mobile views */
        @media (max-width: 768px) {
            /* Center the table on mobile devices */
            table {
                margin: 0 auto;
            }

            /* Make table headers stack on top of each other */
            th {
                display: block;
            }

            /* Hide the table header */
            thead {
                display: none;
            }

            /* Show the table footer row */
            tfoot {
                display: table-row-group;
            }

            /* Show the total label above the total amount on mobile devices */
            tfoot td:first-child {
                text-align: right;
            }
        }
    </style>
</head>
<body>
    <h3>Welcome back <?php echo $customer;?></h3>
    <h1>Customer Information</h1>
    <table>
        <tr>
            <td>Customer Name:</td>
            <td><?php echo $customer_id; ?></td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><?php echo $address; ?></td>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td><?php echo $phone_number; ?></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><?php echo $description; ?></td>
        </tr>
    </table>

    <h2>Purchase Details</h2>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            while ($row = $result->fetch_assoc()) {
                $subtotal = $row['price'] * $row['quantity'];
                $total += $subtotal;
                ?>
                <tr>
                    <td><?php echo $row['productname']; ?></td>
                    <td><?php echo number_format($row['price'], 2); ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo number_format($subtotal, 2); ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total</td>
                <td><?php echo number_format($total, 2); ?></td>
            </tr>
        </tfoot>
    </table>
    <div style="background-color: black;">
    <a href="payment.php">Click here to make payment</a>
        </div>
    
	<?php include('footerr.php');?>
</body>
</html>

