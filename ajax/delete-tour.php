

<?php

include '../connect.php';

$data = [];


// $name = ucfirst($_POST['location']);
// $price = $_POST['price'];
// $desc = $_POST['desc'];
$pid = $_POST['id'];




$deleteQuery = "DELETE FROM p_info WHERE product_id='$pid';";


if(mysqli_query($conn, $deleteQuery)){
    $data['result'] = "success";
}else{
    echo "error";
}

echo json_encode($data);

?>