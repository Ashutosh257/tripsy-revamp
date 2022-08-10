
<?php

include 'header.php';

$pid=$_REQUEST['pid'];

@$uid=$_SESSION['user_id'];
$_SESSION['product_id'] = $pid;
$query="SELECT * FROM p_info WHERE product_id='$pid';";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_array($result);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour</title>
	
	<link rel="stylesheet" href="css/index.css">

	
    <link rel="stylesheet" href="css/daterange.css">
	<script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.umd.min.js"></script>
	

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

	<div class="row mb-5">

		<div class="col-md-4 col-s-12">
			1 Night Stay: <p class="fa fa-inr ms-2"></p> 
				<span class="price"><?php echo $row['base_price']; ?> </span> 
		</div>
		<div class="col-md-3 col-sm-12 ">
			<div class="col-md-3 col-sm-12 d-flex flex-column">
				<input type="text" id="datepicker" />
			</div>
			<div class=" col-sm-12 date-error error" >Please select a Date Range!</div>
		</div>
	</div>
	


	<div class="mb-5">
		Nights to stay: <span class="night ms-2">1</span><span class="night-label ms-2">Night</span>
	</div>
	
	<div class="mb-5">
		Final Price: <span class="m-1 fa fa-inr"></span> <span class=""><?php echo $row['base_price']; ?></span> x <span class="night ms-2 final-night">1</span><span class="night-label ms-2">Night</span> <span class="m-3">=</span>
		<p class="fa fa-inr ms-2"></p>
		<span class="final-price"><?php echo $row['base_price']; ?></span>
	</div>


	<div class="d-grid gap-2 col-6 mx-auto mb-3">
			<button type="submit" class="btn-custom" name="book" id="book">Book Now</button>
	</div>

	

</div>


<script src="./js/date-range.js"></script>

<script type="text/javascript">

	$('.date-error').hide()

	var start_date = null
	var end_date = null

	// console.log(picker);

	picker.on('select', (e) => {
		
		const { end, start } = e.detail;
		start_date = start
		end_date = end 

		// console.log(start_date);
		// console.log(end_date);
	});
	
	
	$(document).ready(function(){
		$('#book').click((event) => {
			
			event.preventDefault();

			// innit
			var user_id = '<?php echo $uid; ?>';
			var product_id = '<?php echo $pid; ?>';
			var name = '<?php echo $row['name']; ?>';
			
			var price = Number($('.final-price').text())
			var night = Number($('.final-night').text())
			var day = night + 1

			var user = true

			function createPopUp(msg, icon, redirect, isToast, position, time) {
				const Toast = Swal.mixin({
					toast: isToast,
					position: position,
					showConfirmButton: false,
					timer: time,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					},
					didClose: () => {
						window.location.href = redirect
					}
				})

				Toast.fire({
					icon: icon,
					titleText: msg
				})
			}

			if(user_id === ""){
				createPopUp(
					"Please Login to book the tour!",
					"info",
					"login.php",
					false,
					"center",
					3000
				)
				user = false
			}

			var flag = false

			if(start_date === null){
				$('.date-error').show()
			}else{
				$('.date-error').hide()
				flag = true
			}

			function toLocal(date){
				var date = date.toLocaleString().slice(0,10).split('/').reverse().join('-')
				var time = date.toLocaleString().slice(12)
				return date +" "+ time
			}

			start_date = toLocal(start_date)
			end_date = toLocal(end_date)
			// start_date: start_date.toISOString().slice(0, 19).replace('T', ' '),

			data = {
				user_id: Number(user_id),
				product_id: Number(product_id),
				start_date: start_date,
				end_date: end_date,
				price: price,
				night: night,
				day: night + 1,
				name: name
			}

			if(flag && user){
				// console.log(data);

				$.ajax({
					url: `ajax/book.php`,
					type: 'POST',
					dataType: 'json',
					encode: true,
					data: data,
					success: function(data) {

						Swal.fire({
							icon: 'success',
							title: `You have successfully booked the ${data.name} package from 
								${data.start} to ${data.end}!`,
							showConfirmButton: true,
							confirmButtonColor: '#4DB5A6',
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = "cart.php"
							}
						})
					},
					error: function (data) {
						// console.log(data);
						window.location.href = "error.php"
					}
				})
			}
			
		})
	})


</script>

</body>
</html>

