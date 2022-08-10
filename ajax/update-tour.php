



<?php

include '../connect.php';

$data = [];


$name = ucfirst($_POST['location']);
$price = $_POST['price'];
$desc = $_POST['desc'];
$pid = $_POST['pid'];




$updateQuery = "UPDATE p_info SET base_price=$price, description='$desc' WHERE product_id='$pid';";


if(mysqli_query($conn, $updateQuery)){
    $data['name'] = $name;
}else{
    echo "error";
}

echo json_encode($data);

?>