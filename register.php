<?php 
    include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>

    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
<div class='container  mt-5'>
    <div class="row" >
        <div class="col-3"></div>

        <form class="col-5 border px-2 py-2" id='user-form'>
            
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" name="firstname" class="form-control" id="firstname">
                <!-- <input type="text" name="firstname" class="form-control" id="firstname" value="ash"> -->
                <div id="first-name-error" class=" error">First Name is required!</div>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" name="lastname" class="form-control" id="lastname">
                <!-- <input type="text" name="lastname" class="form-control" id="lastname" value='b'> -->
                <div id="last-name-error" class=" error">Last Name is required!</div>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="tel" name="mobile" class="form-control" id="mobile" maxlength=10 >
                <!-- <input type="tel" name="mobile" class="form-control" id="mobile" maxlength=10 value="8779613274"> -->
                <div id="mobile-error" class=" error">Mobile Number is required!</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email">
                <!-- <input type="email" name="email" class="form-control" id="email" value="ab@gmail.com"> -->
                <div id="email-error" class=" error">Email is required!</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class='input-group'>
                    <input type="password" name="password" class="form-control" id="password" >
                    <!-- <input type="password" name="password" class="form-control" id="password" value="ash"> -->
                    <span class="input-group-text fa fa-fw fa-eye-slash field_icon toggle-password" toggle="#password-field"></span>
                </div>
                <label id="password-error" class="error" for="password">Password is required! </label>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <div class='input-group'>
                    <input type="password" name="confirmPassword" class="form-control" id="confirmPassword">
                    <!-- <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" value="ash"> -->
                    <span class="input-group-text fa fa-fw fa-eye-slash field_icon toggle-confirm-password" toggle="#password-field"></span>
                </div>
                <label id="cnf-password-error" class="error" for="confirmPassword">Password is required! </label>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mb-3">
                <button type="submit" name='submit' id='submit' class="btn-custom">Register</button>
            </div>
        </form> 

        <div class="col-3"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="./js/validation.js"></script>



</body>
</html>