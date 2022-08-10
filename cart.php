
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

        .btn-custom{
          background-color: #4DB5A6;
          color: #FFFFFF;
          padding: 6px 12px;
          border-radius: 4px;
        }
        
        .btn-custom-danger{
          background-color: #DC3545;
          color: #FFFFFF;
          padding: 6px 12px;
          border-radius: 4px;
        }
    </style>
</head>
<body>


<div class="container">
    <div class="row py-5">
      
    <?php
      $query="SELECT * FROM booking INNER JOIN p_info ON booking.product_id = p_info.product_id WHERE booking.user_id='$uid' AND booking.booked=0;";
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
            <div class="row">
              <div class="col-md-4 col-sm-12 mb-2">
                <!-- <button type="submit" class="btn-custom" id="checkout" name="checkout" onclick="location.href='pay.php?bid=<?php echo $rows["booking_id"].'&pid='.$rows["product_id"]; ?>'">Checkout</button> -->
                <!-- <button type="submit" class="btn-custom" id="checkout" name="checkout" onclick="location.href='pay.php?bid=<?php echo $rows["booking_id"]; ?>'">Checkout</button> -->
                <button class="btn-custom" id="checkout" name="checkout" onclick="location.href='<?php echo 'pay.php?bid='.$rows['booking_id'].'&pid='.$rows["product_id"]; ?>'">Checkout</button>
              </div>
              <div class="col-md-4 col-sm-12">
              </div>
              <div class="col-md-4 col-sm-12">
                <button type="submit" class="btn-custom-danger" id="remove" name="remove" onclick="removeTour(<?php echo $rows['booking_id'];?>)">Remove</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-1"></div>

        <?php } ?>
    </div> 
</div>



<script type="text/javascript">


  function removeTour(id) {

    console.log(id);

    Swal.fire({
      title: `Do you want to remove this tour from your wishlist?`,
      confirmButtonColor: '#DC3545',
      showCancelButton: true,
      confirmButtonText: 'Delete'
    }).then((result) => {
      if(result.isConfirmed) {
        Swal.fire({
          title: `Do you really want to remove this tour?`,
          icon: 'warning',
          showConfirmButton: true,
          confirmButtonColor: '#DC3545',
          // cancelButtonColor: '#4DB5A6',
          showCancelButton: true,
        }).then((result) => {
            
          if (result.isConfirmed) {
            $.ajax({
              url: 'ajax/user-delete-tour.php',
              type: 'POST',
              dataType: 'json',
              encode: true,
              data: { id: id },
              success: function(data) {
                Swal.fire({
                  title: `Tour successfully deleted!`,
                  icon: 'success',
                  timer: 3000,
                  confirmButtonColor: '#4DB5A6'
                }).then((result) => {
                    window.location.href = "cart.php"
                  })
              },
              error: function (data) {
                  // console.log(data);
                  window.location.href = "error.php"
              }
            })
          }else if (result.isDismissed) {
            Swal.fire({
              title:'No changes done',
              icon: 'info',
              confirmButtonColor: '#4DB5A6'
            })
          }
        })

      } else if (result.isDismissed) {
        Swal.fire({
          title:'No changes done',
          icon: 'info',
          confirmButtonColor: '#4DB5A6'
        })
      }
    })

  }


</script>


</body>
</html>

