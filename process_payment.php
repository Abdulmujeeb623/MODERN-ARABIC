// process_payment.php
<?php
class BankTransferPayment {
  private $accountNumber;
  private $amount;

  public function __construct($accountNumber, $amount) {
    $this->accountNumber = $accountNumber;
    $this->amount = $amount;
  }

  public function processPayment() {
    // Perform necessary validation and bank transfer logic here
    // Connect to the bank API, verify account number, perform the transfer, etc.
    // You can also store payment details in a database if needed

    // For demonstration purposes, we'll simply display a success message
    echo "Payment of $this->amount has been successfully transferred to account number $this->accountNumber.";
  }
}

// Create a new instance of BankTransferPayment and process the payment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $accountNumber = $_POST['accountNumber'];
  $amount = $_POST['amount'];

  $payment = new BankTransferPayment($accountNumber, $amount);
  $payment->processPayment();
}
?>
