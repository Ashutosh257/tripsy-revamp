



<?php

include '../connect.php';

$data = [];

$product_id = $_POST['product_id'];
$user_id = $_POST['user_id'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$price = $_POST['price'];
$day = $_POST['day'];
$night = $_POST['night'];
$name = $_POST['name'];


$query = "INSERT INTO booking(product_id, user_id, start_date, end_date, price, day, night, booked) VALUES ('$product_id', '$user_id', '$start_date', '$end_date', '$price', '$day','$night', 0);";

// $query = "SELECT * FROM booking;";

if(mysqli_query($conn, $query)){
    $data['success'] = true;
    $data['name'] = $name;
    $data['start'] = $start_date;
    $data['end'] = $end_date;
}

echo json_encode($data);
  


?>