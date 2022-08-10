

<?php

include '../connect.php';

$data = [];


// $name = ucfirst($_POST['location']);
// $price = $_POST['price'];
// $desc = $_POST['desc'];
$id = $_POST['id'];




$deleteQuery = "DELETE FROM booking WHERE booking_id='$id';";


if(mysqli_query($conn, $deleteQuery)){
    $data['result'] = "success";
}else{
    echo "error";
}

echo json_encode($data);

?>