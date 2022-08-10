





<?php

include '../connect.php';

$data = [];
$data['success'] = false;

$email = $_POST['email'];
$pass = $_POST['password'];

$checkAdminQuery = "SELECT * FROM admin_info WHERE email='$email' AND password='$pass';";
$res = mysqli_query($conn, $checkAdminQuery);
$rows=mysqli_fetch_array($res);
$count=mysqli_num_rows($res);

// echo $count;

if($count == 1){

    $_SESSION['admin_id'] = $rows['admin_id'];
    $data['success'] = true;
    $data['reason'] = "exists";
    $data['role'] = "admin";
    
    $_SESSION['admin_name']=$rows['name'];
    $_SESSION['email']=$rows['email'];
    
    $data['name'] = $_SESSION['admin_name'];
    $data['email'] = $_SESSION['email'];

}else{
    $data['reason'] = "none";
    $data['email'] = $email;
}

echo json_encode($data);
  


?>