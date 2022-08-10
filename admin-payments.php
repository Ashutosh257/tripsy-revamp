
<?php 
    include 'header.php';


    $uid = $_SESSION['admin_id'];


    function getHumanReadableDate($var){
      return date("jS F Y", strtotime($var));
    }

    $balance = 0;

    $query = "SELECT * FROM payment;";
    $result=mysqli_query($conn,$query) or die('failed'.mysql_error($conn));
    while($rows=mysqli_fetch_array($result)) {
        $balance = $balance + $rows['price'];
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tours</title>

    <style>
        .my-card-image{
            /* margin: 0 auto; */
            border-radius: 20px;
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <p class="card-text mb-2">Account Balance: 
              <i class="fa fa-inr ms-2"></i> 
              <span class="ms-1 balance"><?php 
                echo $balance;
               ?></span>
            </p>
    </div>

    


<div class="container">
    <div class="row py-5">

      
    <?php
      $query="SELECT * FROM payment INNER JOIN p_info ON payment.product_id = p_info.product_id INNER JOIN user_info ON payment.user_id = user_info.user_id;";
      $result=mysqli_query($conn,$query) or die('failed'.mysql_error($conn));
      while($rows=mysqli_fetch_array($result)) {
        // echo print_r($rows);

        $balance = $balance + $rows['price'];
    ?>
    

    <div class="col-md-1"></div>

    <div class="card mb-3" style="max-width: 80%;">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="<?php echo 'images/places/'.$rows['image']; ?>" class="img-fluid my-card-image p-2" alt="images/places/noimg.png">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title mb-4"><?php echo $rows['name']; ?></h5>
           
            <p class=" row card-text">
              <span class="col-md-6 col-sm-12">
                Payment ID: <?php echo $rows['payment_id'] ?>
              </span> 
                <span class="col-md-6 col-sm-12">
                Order ID: <?php echo $rows['order_id'] ?>
                </span> 
            </p>
            <p class="card-text">
            Name: <?php echo ucfirst($rows['firstname']); ?>  <?php echo ucfirst($rows['lastname']); ?> 
            </p>
            <p class="card-text mb-5">Paid:
              <i class="fa fa-inr ms-2"></i> 
              <span class="ms-1"><?php echo $rows['price']; ?></span>
            </p>

          </div>
        </div>
      </div>
    </div>

    <div class="col-md-1"></div>

        <?php } ?>
    </div> 
</div>



</body>
</html>


