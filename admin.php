
<?php 
    include 'header.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link rel="stylesheet" href="css/index.css">
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>

<div class='container mt-5'>
    <div class="row" >
        <div class="col-lg-3"></div>

        <form class="col-lg-6 col-sm-12 border px-2 py-2" id='login-form' method="POST">
            
            <div class="mb-5 user-label">
                Admin Login
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email">
                <div id="email-error" class="form-text error">Email is required!</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class='input-group'>
                    <input type="password" name="password" class="form-control" id="password">
                    <span class="input-group-text fa fa-fw fa-eye-slash field_icon toggle-password" toggle="#password-field"></span>
                </div>
                <label id="password-error" class="error" for="password">Password is required! </label>
            </div>
            
            <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" class="btn-custom">Login</button>
            </div>
        </form> 

        <div class="col-lg-3"></div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="./js/login-validation.js"></script>


<?php


?>

</body>
</html>