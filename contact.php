
<?php 
    include 'header.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us!</title>

    <link rel="stylesheet" href="css/index.css">

    <style>
        .txt-area{
            height: 300px;
        }

        .error{
            color:red;
        }
    </style>
</head>
<body>

<div class='container  mt-5'>
    <div class="row" >
        <div class="col-lg-3"></div>

        <form class="col-lg-6 col-sm-12 border px-2 py-2" id="contact-form">
            
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email">
                <div id="email-error" class="form-text error">Email is required!</div>
            </div>
            
            <div class="mb-5">
                <label class="form-label">Message</label>
                <textarea class="form-control txt-area" id="contact-msg" name='message' onkeyup="countChar(this)" placeholder="Type your message here..."></textarea>
                <div class="form-text float-end" id='char-count'>
                    <span id="current">0</span>
                    <span id="max"> / 2000</span>
                </div>
                <div id="msg-error" class="form-text error">Message can't be empty!</div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mb-2" >
                <button type="submit" class="btn-custom">Send</button>
            </div>
        </form> 

        <div class="col-lg-3"></div>
    </div>
</div>


<script src="./js/contact.js"></script>
</body>
</html>