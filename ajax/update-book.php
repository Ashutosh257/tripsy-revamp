






<?php

include '../connect.php';

$data = [];

$user_id = $_POST['user_id'];
$product_id = $_POST['product_id'];
$booking_id = $_POST['booking_id'];
$price = $_POST['price'];
$payment_id = $_POST['razorpay_payment_id'];
$order_id = $_POST['razorpay_order_id'];
$sign = $_POST['razorpay_signature'];



$query = "INSERT INTO payment(payment_id, order_id, signature, price, user_id, product_id) VALUES ('$payment_id', '$order_id', '$sign', '$price', '$user_id', '$product_id');";
// echo $query;

if(mysqli_query($conn, $query)){
    $updateQuery = "UPDATE booking SET booked=1 WHERE booking_id='$booking_id';";
    mysqli_query($conn, $updateQuery);

    $selectQuery = "SELECT * FROM booking INNER JOIN p_info ON booking.product_id = p_info.product_id WHERE booking.user_id='$user_id' AND booking.booking_id='$booking_id';";
    $res = mysqli_query($conn, $selectQuery);
    $rows=mysqli_fetch_array($res);

    $data['success'] = true;
    $data['name'] = $rows['name'];
    $data['start'] = $rows['start_date'];
    $data['end'] = $rows['end_date'];
}

echo json_encode($data);

?>