





<?php

include '../connect.php';

$data = [];

$email = $_POST['email'];
$msg = $_POST['message'];

$query = "INSERT INTO contact(email, message) VALUES ('$email','$msg');";


if(mysqli_query($conn, $query)){
    $data['success'] = true;
}

echo json_encode($data);
  


?>