




<?php

include '../connect.php';

$data = [];
$data['success'] = false;

$email = $_POST['email'];
$pass = $_POST['password'];


$checkEmailQuery = "SELECT * FROM user_info WHERE email='$email' AND password='$pass';";
$res = mysqli_query($conn, $checkEmailQuery);
$rows=mysqli_fetch_array($res);
$count=mysqli_num_rows($res);

// echo $count;

if($count == 1){

    $_SESSION['user_id'] = $rows['user_id'];
    $data['success'] = true;
    $data['reason'] = "exists";
    $data['role'] = "user";
    
    $_SESSION['user_id']=$rows['user_id'];
    $_SESSION['name']=$rows['firstname'];
    $_SESSION['lastname']=$rows['lastname'];
    $_SESSION['email']=$rows['email'];
    $_SESSION['number']=$rows['mobile'];
    
    $data['name'] = $_SESSION['name'];
    $data['email'] = $_SESSION['email'];

}else{
    $data['reason'] = "none";
    $data['email'] = $email;
}

echo json_encode($data);
  


?>