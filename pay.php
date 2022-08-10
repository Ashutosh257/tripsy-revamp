



<?php

include 'header.php';

require('config.php');
require('razorpay-php/Razorpay.php');

// Create the Razorpay Order

use Razorpay\Api\Api;
$api = new Api($keyId, $keySecret);



$bid=$_REQUEST['bid'];
$pid=$_REQUEST['pid'];
$_SESSION['product_id'] = $pid;
$_SESSION['booking_id'] = $bid;



$username = ucfirst($_SESSION['name'])." ".ucfirst($_SESSION['lastname']);
// echo $username;

$number = $_SESSION['number'];
$emailAddr = $_SESSION['email'];


$uid=$_SESSION['user_id'];
// echo $uid;

$joinQuery = "SELECT * FROM booking INNER JOIN p_info USING(product_id) WHERE booking_id='$bid';";
// echo $joinQuery;
$result=mysqli_query($conn,$joinQuery);
$row=mysqli_fetch_array($result);


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
    <title>Checkout</title>
	
	<link rel="stylesheet" href="css/index.css">


	<style>
		.error{
			color: red
		}

	</style>
</head>
<body>
    
<div class="container py-5">
	<div class="row">


		<div class="col-md-6 col-s-12">
			<div class="col-md-6 col-s-12 d-flex flex-column mb-2">
				<?php
                    $img = $row['image'];
					$str='<img class="prod-image" src="images/places/'.$img.'">';
                    echo $str;
				?>
			</div>
			<h2 class="mb-3">
				<?php echo $row['name']; ?>
			</h2>
		</div>

		<div class="col-md-6 col-sm-12">
			<h4>
				Description:
			</h4>	
			
			<p>
				<!-- <?php echo $row['description']; ?> -->
				Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Porttitor rhoncus dolor purus non enim praesent. Suscipit tellus mauris a diam maecenas sed enim ut. Elit pellentesque habitant morbi tristique senectus. Nunc pulvinar sapien et ligula ullamcorper. Mus mauris vitae ultricies leo. Ac orci phasellus egestas tellus rutrum. Leo a diam sollicitudin tempor id eu. Adipiscing at in tellus integer feugiat scelerisque varius morbi enim. Ut sem viverra aliquet eget sit.
			</p>
		</div>
			
    </div>
	<hr>

	<div class="row mb-3">

		<div class="col-md-4 col-s-12">
			1 Night Stay: <p class="fa fa-inr ms-2"></p> 
				<span class="price"><?php echo $row['base_price']; ?> </span> 
		</div>
	</div>
	
    <div class="row mb-4">
        <div class="col-md-6 col-sm-12">
        <?php echo getHumanReadableDate($row['start_date'])?> - <?php echo getHumanReadableDate($row['end_date']) ?>
        </div> 
    </div>


	<div class="mb-4">
		Nights to stay: <span class="night ms-2"><?php echo $row['night']; ?></span><span class="night-label ms-2">Night/s</span>
	</div>
	
	<div class="mb-5">
		Final Price: <span class="m-1 fa fa-inr"></span> <span class=""><?php echo $row['base_price']; ?></span> x <span class="night ms-2 final-night"><?php echo $row['night']; ?></span><span class="night-label ms-2">Night/s</span> <span class="m-3">=</span>
		<p class="fa fa-inr ms-2"></p>
		<span class="final-price"><?php echo $row['price']; ?></span>
	</div>


	<div class="d-grid gap-2 col-6 mx-auto mb-3">
            <button type="submit" class="btn-custom" id="pay" name="pay">Pay Now</button>
	</div>

	

</div>


<?php 


$orderData = [];

$orderData['amount'] = $row['price'] * 100;
$orderData['currency'] = "INR";

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];
$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$amount = $orderData['amount'];

$checkout = 'automatic';



?>


<script src="https://checkout.razorpay.com/v1/checkout.js">

</script>

<script type="text/javascript">

	console.log("hello");

	var key = "<?php echo $keyId; ?>"
	var amount = "<?php echo $amount; ?>"
	var username = "<?php echo $username; ?>"
	var email = "<?php echo $emailAddr; ?>"
	var number = "<?php echo $number; ?>"
	var order_id = "<?php echo $razorpayOrderId; ?>"
	var user_id = "<?php echo $uid; ?>"
	var product_id = "<?php echo $pid; ?>"
	var booking_id = "<?php echo $bid; ?>"

	var data = {
		"key": key,
		"amount": amount,
		"name": "Tripsy",
		"description": "TRAVEL AGENCY",
		"prefill": {
			"name": username,
			"email": email,
			"contact": number
		},
		"order_id": order_id,
		"handler": function (response){

			response['price'] = amount/100
			response['user_id'] = user_id
			response['product_id'] = product_id
			response['booking_id'] = booking_id

			console.log(response);

			$.ajax({
			    url: `ajax/update-book.php`,
			    type: 'POST',
			    dataType: 'json',
			    encode: true,
			    data: response,
			    success: function(data) {
			        console.log(data);

					function toLocal(date){
						var date = date.toLocaleString().slice(0,10).split('/').reverse().join('-')
						var time = date.toLocaleString().slice(12)
						return date +" "+ time
					}
					var start = toLocal(data.start)
					var end = toLocal(data.end)

					Swal.fire({
						icon: 'success',
						title: `You have successfully booked the ${data.name} package from 
							${start} to ${end}!`,
						showConfirmButton: true,
						confirmButtonColor: '#4DB5A6',
					}).then((result) => {
						if(result.isConfirmed){
							window.location.href = "bookings.php"
						}
					})
			    },
			    error: function (data) {
			        console.log(data);
			        // window.location.href = "error.php"
			    }
            })

		}
	}

	console.log(data);


	$(document).ready(function(){
		$('#pay').click((event) => {
			
			event.preventDefault();

			var rzp1 = new Razorpay(data);
            rzp1.open();

			rzp1.on('payment.failed', function (response){

				Swal.fire({
						icon: 'info',
						title: `Payment Declined!`,
						showConfirmButton: true,
						confirmButtonColor: '#4DB5A6',
					}).then((result) => {
						if(result.isConfirmed){
							window.location.href = "cart.php"
						}
					})
			});
		})
	})

</script>


</body>
</html>

