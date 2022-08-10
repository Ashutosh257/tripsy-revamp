

<?php 
    include 'header.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tour</title>

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
        <div class="col-lg-2"></div>

        <form class="col-lg-8 col-sm-12 border px-2 py-2 " id='create-form' method="POST">
            

            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-center">
                    <label for="location" class="form-label p-2">Location Name</label>
                </div>
                <div class="col-7">
                    <input type="location" name="location" class="form-control" id="location">
                </div>
                <div class="col-4"></div>
                <div id="location-error" class="form-text error col-7">Location is required!</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-center">
                    <label for="location-desc" class="form-label p-2">Location Description</label>
                </div>
                <div class="col-7">
                    <input type="desc" name="desc" class="form-control" id="desc">
                </div>
                <div class="col-4"></div>
                <div id="desc-error" class="form-text error col-7">Location Description is required!</div>
            </div>
        
            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-center">
                    <label for="price" class="form-label p-2">Base Price</label>
                </div>
                <div class="col-7">
                    <input type="text" name="price" class="form-control" id="price">
                </div>
                <div class="col-4"></div>
                <div id="price-error" class="form-text error col-7" for="price">Base Price is required!</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-center">
                    <label for="imageUpload" class="form-label p-2">Location Image</label>
                </div>
                <div class="col-7">
                    <input class="form-control" type="file" id="imageUpload" name="image">
                </div>
                <div class="col-4"></div>
                <div id="image-error" class="form-text error col-7">Image is required!</div>
            </div>

            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-center">
                    <label for="imagePreview" class="form-label p-2">Location Image Preview</label>
                </div>
                <div class="col-7">
                    <img src="images/places/noimg.png" id="blah">
                    <!-- <span id="blah">Nothing selected</span> -->
                </div>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto mb-3">
                <button type="submit" class="btn-custom">Create</button>
            </div>
        </form> 

        <div class="col-lg-2"></div>
    </div>



</div>
    

<script src="./js/create.js"></script>
    
</body>
</html>



