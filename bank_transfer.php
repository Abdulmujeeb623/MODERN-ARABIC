<?php include('TheNavbarArab.php');?>
<body>
  <div class="container" style="  max-width: 600px; margin: 0 auto; padding: 20px;">
    <h1>Bank Account Payment</h1>
    <p>Make a payment to the following bank account:</p>
    
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Bank Account Details</h5>
        <p class="card-text">Account Number: 2150289441</p>
        <p class="card-text">Account Name: Abdullahi Ahmad Al-Imam</p>
        <p class="card-text">Bank Name: JAIZ BANK</p>
        <p class="card-text">Branch: SANGO</p>
      </div>
    </div>
    
    <form>
      <div class="mb-3">
        <label for="amount" class="form-label">Payment Amount</label>
        <input type="text" class="form-control" id="amount" placeholder="Enter payment amount">
      </div>
      <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>
  </div>
  
  <!-- Add Bootstrap JS (optional if you want to use Bootstrap JS features) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
