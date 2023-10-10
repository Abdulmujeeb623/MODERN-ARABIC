<?php
include('conn.php');

function isValidName($name) {
    return !empty($name) && preg_match('/^[a-zA-Z\s]+$/', $name);
}

function isValidCustomerNumber($number) {
    return ctype_digit($number);
}

function isValidQuantity($quantity) {
    return ctype_digit($quantity) && intval($quantity) > 0;
}

// Check if the form is submitted
if (isset($_POST['productid'])) {
    // Validate inputs
    $customer = $_POST['customer'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];
    $description = $_POST['description'];

    $isValidForm = true;
    $errorMsg = '';

    if (!isValidName($customer)) {
        $isValidForm = false;
        $errorMsg .= 'Invalid customer name. ';
    }

    if (!isValidCustomerNumber($phonenumber)) {
        $isValidForm = false;
        $errorMsg .= 'Invalid customer number. ';
    }

    // Validate email if it exists in the form
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $isValidForm = false;
            $errorMsg .= 'Invalid email address. ';
        }
    }

    // Validate quantity
    foreach ($_POST['productid'] as $product) {
        $proinfo = explode("||", $product);
        $iterate = $proinfo[1];
        if (isset($_POST['quantity_'.$iterate])) {
            $quantity = $_POST['quantity_'.$iterate];
            if (!isValidQuantity($quantity)) {
                $isValidForm = false;
                $errorMsg .= 'Invalid quantity for product '.$iterate.'. ';
            }
        } else {
            $isValidForm = false;
            $errorMsg .= 'Quantity is missing for product '.$iterate.'. ';
        }
    }

    // If the form is not valid, show an error message and go back to the order.php page
    if (!$isValidForm) {
        ?>
        <script>
            window.alert('Error: <?php echo $errorMsg; ?>');
            window.location.href = 'order.php';
        </script>
        <?php
        exit(); // Stop the PHP script execution
    }

    // If the form is valid, proceed with saving the data
    // ... (rest of the code remains unchanged)

    // Save customer information into the user table
    $sql = "INSERT INTO users (customer_Name, customer_Address, customer_Number, customer_Description) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $customer, $address, $phonenumber, $description);
    $stmt->execute();

    // Save customer information into sessions
    session_start();
    $_SESSION['customer'] = $customer;
    $_SESSION['address'] = $address;
    $_SESSION['phonenumber'] = $phonenumber;
    $_SESSION['description'] = $description;

    // Continue with the rest of the code to save product details
    $sql = "INSERT INTO purchase (customer, date_purchase) VALUES (?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $customer);
    $stmt->execute();
    $pid = $conn->insert_id;

    $total = 0;

    foreach ($_POST['productid'] as $product) {
        $proinfo = explode("||", $product);
        $productid = $proinfo[0];
        $iterate = $proinfo[1];
        $sql = "SELECT * FROM product WHERE productid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $productid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array();

        if (isset($_POST['quantity_'.$iterate])) {
            $subt = $row['price'] * $_POST['quantity_'.$iterate];
            $total += $subt;
            $quant = $_POST['quantity_'.$iterate];

            $sql = $conn->prepare("INSERT INTO purchase_detail (purchaseid, productid, quantity) VALUES (?, ?, ?)");
            $sql->bind_param('sis', $pid, $productid, $quant);
            $sql->execute();
        }
    }

    $sql = "UPDATE purchase SET total=? WHERE purchaseid=?";
    $stml = $conn->prepare($sql);
    $stml->bind_param('si', $total, $pid);
    $stml->execute();
    header('location:cart.php');

} else {
    ?>
    <script>
        window.alert('Please select a product');
        window.location.href = 'order.php';
    </script>
    <?php
}
?>
