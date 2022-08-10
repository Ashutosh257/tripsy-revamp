



<?php

include '../connect.php';

$data = [];
$data['success'] = false;

if(isset($_POST['firstname'])) {
  
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $pass = $_POST['password'];



 $checkEmailQuery = "SELECT * FROM user_info WHERE email='$email';";
 $res = mysqli_query($conn, $checkEmailQuery);
 $rows=mysqli_fetch_array($res);
 $count=mysqli_num_rows($res);

 // echo $count;

 if($count == 0){
    $query="INSERT INTO user_info(firstname, lastname, mobile, email, password) VALUES ('$firstname', '$lastname', '$mobile' ,'$email','$pass');";
  
   // $query = "SELECT * FROM user_info;";

   if(mysqli_query($conn,$query)){
     $data['success'] = true;
     $data['reason'] = "new";
     $data['email'] = $email; 
     //  header("Location: login.php");
   }

 }else{
   $data['success'] = true;
   $data['reason'] = "duplicate";
   $data['email'] = $email;
 }
 echo json_encode($data);
  
}


?>