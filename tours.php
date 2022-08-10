
<?php 
    include 'header.php';
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
            margin: 0 auto;
            width: 200px;
            height: 200px;
        }
    </style>

    
</head>
<body>


<div class="container">
    <div class="row py-5">
      
    <?php
    // echo $_SESSION['name'];
      $query="SELECT * FROM p_info;";
      $result=mysqli_query($conn,$query) or die('failed'.mysql_error($conn));
      $str="";
      while($rows=mysqli_fetch_array($result)) {
    ?>
    
    
        <div class="col-lg-4 col-md-6">
          <div class='card my-card text-center p-3 mb-5'>
            <image class='card-img-top my-card-image' src='<?php echo 'images/places/'.$rows['image']; ?>'>
            <div class='card-body'>
              <h5 class='card-title'>
                <a href='product.php?pid=<?php echo ''.$rows['product_id'];?>'>
                <?php echo "".$rows['name']; ?>
                </a>
              </h5>
              <p>1 Day Stay:
                <i class='fa fa-inr'></i> 
                <?php echo ''.$rows['base_price'];  ?>
              </p>

              
            </div>
          </div>
        </div>

        
        <?php } ?>
    </div> 
</div>



<script type="text/javascript">
      function capitalizeName(name) {
        return name.charAt(0).toUpperCase() + name.slice(1);
      }

      var name = "<?php echo $_SESSION['name']; ?>"
      var msg = `Welcome ${capitalizeName(name)}!`;
      var icon = 'success';
      // var redirect = "tours.php"
      var position = 'top-end'
      var isToast = true

      const Toast = Swal.mixin({
        toast: isToast,
        position: position,
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        // allowOutsideClick: false,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
        
      Toast.fire({
        icon: icon,
        titleText: msg
      })

</script>


</body>
</html>

