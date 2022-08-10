
<?php 
    include 'header.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage</title>

    <link rel="stylesheet" href="css/index.css">


    <style>
        .my-card-image{
            margin: 0 auto;
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
      $query="SELECT * FROM p_info;";
      $result=mysqli_query($conn,$query) or die('failed'.mysql_error($conn));
      while($rows=mysqli_fetch_array($result)) {
    ?>
    

    <div class="col-md-1"></div>

    <div class="card mb-3" style="max-width: 80%;">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="<?php echo 'images/places/'.$rows['image']; ?>" class="img-fluid my-card-image p-2" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title mb-4"><?php echo $rows['name']; ?></h5>
           
            <p class="card-text mb-5">
              <i class="fa fa-inr"></i> 
              <span class="ms-1"><?php echo $rows['base_price']; ?></span>
            </p>
            <div class="row">
              <div class="col-md-4 col-sm-12 mb-2">
                <button type="submit" class="btn-custom" id="update" name="update" onclick="location.href = 'update.php?pid=<?php echo $rows["product_id"]; ?>'">Update</button>
              </div>
              <div class="col-md-4 col-sm-12">
              </div>
              <div class="col-md-4 col-sm-12">
                <?php 
                  $pid = $rows['product_id'];
                  $name = $rows['name'];
                  $x = $pid . ','. strval($name);
                ?>
                <button type="submit" class="btn-custom-danger" id="delete" name="delete" onclick="removeTour(<?php echo $pid;?>)">Delete</button>
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
      title: `Do you want to delete this tour?`,
      confirmButtonColor: '#DC3545',
      showCancelButton: true,
      confirmButtonText: 'Delete'
    }).then((result) => {
      if(result.isConfirmed) {
        Swal.fire({
          title: `Do you really want to delete this tour?`,
          icon: 'warning',
          showConfirmButton: true,
          confirmButtonColor: '#DC3545',
          // cancelButtonColor: '#4DB5A6',
          showCancelButton: true,
        }).then((result) => {
            
          if (result.isConfirmed) {
            $.ajax({
              url: 'ajax/delete-tour.php',
              type: 'POST',
              dataType: 'json',
              encode: true,
              data: { id: id },
              success: function(data) {
                Swal.fire({
                  title: `Tour successfully deleted!`,
                  icon: 'success',
                  timer: 3000,
                }).then((result) => {
                    window.location.href = "manage.php"
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
