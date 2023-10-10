<?php
include('TheNavbarArab2.php');

?>

<body>

  <div class="container">
    <h1 class="text-center my-5">Choose a Payment Method</h1>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Bank Transfer</h5>
            <p class="card-text">Transfer the payment to the provided bank account.</p>
            <button class="btn btn-primary" onclick="makePayment('bank')">Proceed to Bank Transfer</button>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Cash Payment</h5>
            <p class="card-text">Pay in cash when receiving the order.</p>
            <button class="btn btn-primary" onclick="makePayment('cash')">Proceed to Cash Payment</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br><br><hr><hr>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Bank Account Details</h5>
            <p class="card-text">Transfer the payment to the provided bank account.</p>
            
            <p class="card-text">Account Number: 1003629931</p>
            <p class="card-text">Account Name: Professor Abdur-rahman Ahmad Al-Imam</p>
            <p class="card-text">Bank Name: UBA BANK</p>
            <p class="card-text">Branch: SANGO</p>
      
            
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Cash Payment</h5>
            <p class="card-text">Pay in cash when receiving the order.</p>
            <form>
      <div class="form-group">
        <label for="amount">Payment Amount:</label>
        <input type="text" class="form-control" id="amount" placeholder="Enter payment amount">
      </div>
      <div class="form-group">
        <label for="name">Customer Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter customer name">
      </div>
      <div class="form-group">
        <label for="email">Email Address:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email address">
      </div>
      <button type="submit" class="btn btn-primary">Make Payment</button>
    </form>
    
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('RootFooter.php')?>
  


  


</body>