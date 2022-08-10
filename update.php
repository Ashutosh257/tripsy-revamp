

<?php 
    include 'header.php';

    $pid=$_REQUEST['pid'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tour</title>

    <link rel="stylesheet" href="css/index.css">
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>


<?php 
    $query="SELECT * FROM p_info WHERE product_id='$pid';";
    $result=mysqli_query($conn,$query) or die('failed'.mysql_error($conn));
    $rows=mysqli_fetch_array($result);
?>


<div class='container mt-5'>
    <div class="row" >
        <div class="col-lg-2"></div>

        <form class="col-lg-8 col-sm-12 border px-2 py-2 " id='update-form' method="POST">
            

            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-center">
                    <label for="location" class="form-label p-2">Location Name</label>
                </div>
                <div class="col-7 mt-2" id="location">
                        <?php echo $rows['name']; ?>
                </div>
                <div class="col-4"></div>
            </div>
            
            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-center">
                    <label for="location-desc" class="form-label p-2">Location Description</label>
                </div>
                <div class="col-7">
                    <input type="desc" name="desc" class="form-control" id="desc" value="<?php echo $rows['description']; ?>">
                    
                </div>
                <div class="col-4"></div>
                <div id="desc-error" class="form-text error col-7">Location Description is required!</div>
            </div>
        
            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-center">
                    <label for="price" class="form-label p-2">Base Price</label>
                </div>
                <div class="col-7">
                    <input type="text" name="price" class="form-control" id="price" value="<?php echo $rows['base_price']; ?>">
                </div>
                <div class="col-4"></div>
                <div id="price-error" class="form-text error col-7" for="price">Base Price is required!</div>
            </div>


            <div class="d-grid gap-2 col-6 mx-auto mb-3">
                <button type="submit" class="btn-custom">Update</button>
            </div>
        </form> 

        <div class="col-lg-2"></div>
    </div>



</div>

<script type="text/javascript">

var pid = '<?php echo $pid; ?>';

$('#desc-error').hide()
$('#price-error').hide()



function isNumeric(value) {
  return /^\d+$/.test(value);
}


$(document).ready(function(){
  $('#update-form').submit((event) => {
  
    event.preventDefault();
  
  var descFlag = priceFlag = false
  var location = $('#location').text().trim()
  var desc = $('#desc').val()
  var price = $('#price').val()
  
  // console.log(imagePath);

  var descError = $('#desc-error')
  var priceError = $('#price-error')
  
    
    if(desc.length == 0){
      descError.show()
    }else{
      descFlag = true
      descError.hide()
    }

    if(price.length == 0){
      priceError.show()
    }else if(!isNumeric(price)){
      priceError.html('The Base Price should be in digits')
      priceError.show()
    }else{
      priceFlag = true
      priceError.hide()
    }


    if(descFlag && priceFlag ){

        var data = {
            location: location,
            desc: desc,
            price: price,
            pid: pid
            // pid: Number(pid)
        }
        
        // console.log(data);

        $.ajax({
            url: 'ajax/update-tour.php',
            type: 'POST',
            dataType: 'json',
            encode: true,
            data: data,
            success: function(data) {

            console.log(data);

            var msg = `${data.name} package has successfully updated!`;
            var icon = 'success';
            var redirect = "manage.php";

            
            const Toast = Swal.mixin({
                showConfirmButton: false,
                timer: 3000,
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
                title: msg
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



