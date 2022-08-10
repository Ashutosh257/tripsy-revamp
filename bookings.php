
<?php 
    include 'header.php';


    $uid = $_SESSION['user_id'];


    function getHumanReadableDate($var){
      return date("jS F Y", strtotime($var));
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


<div class="container">
    <div class="row py-5">
      
    <?php
      $query="SELECT * FROM booking INNER JOIN p_info ON booking.product_id = p_info.product_id WHERE booking.user_id='$uid' AND booking.booked=1;";
      $result=mysqli_query($conn,$query) or die('failed'.mysql_error($conn));
      while($rows=mysqli_fetch_array($result)) {
        // echo print_r($rows);
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
                From: <?php echo getHumanReadableDate($rows['start_date']) ?>
              </span> 
                <span class="col-md-6 col-sm-12">
                  To: <?php echo getHumanReadableDate($rows['end_date']) ?>
                </span> 
            </p>
            <p class="card-text">
            <?php echo $rows['day']; ?> Days, <?php echo $rows['night']; ?> Nights
            </p>
            <p class="card-text mb-5">
              <i class="fa fa-inr"></i> 
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

