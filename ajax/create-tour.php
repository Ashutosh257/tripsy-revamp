



<?php

include '../connect.php';

$data = [];


$name = ucfirst($_POST['location']);
$price = $_POST['price'];
$image = $_FILES['image']['name'];
$desc = $_POST['desc'];


$data['name'] = $name;
$data['price'] = $price;
$data['image'] = $image;
$data['desc'] = $desc;


 $checkQuery = "SELECT * FROM p_info WHERE name='$name';";
 $res = mysqli_query($conn, $checkQuery);
 $rows=mysqli_fetch_array($res);
 $count=mysqli_num_rows($res);


 if($count == 0){
    $query="INSERT INTO p_info(name, base_price, image, description) VALUES ('$name', '$price', '$image', '$desc');";

   if(mysqli_query($conn,$query)){
     $data['reason'] = "new";
     $data['name'] = $name;
   }

 }else{
   $data['reason'] = "duplicate";
   $data['name'] = $name;
 }
 
echo json_encode($data);
  



?>