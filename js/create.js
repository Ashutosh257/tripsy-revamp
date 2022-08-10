
$('#location-error').hide()
$('#desc-error').hide()
$('#price-error').hide()
$('#image-error').hide()


function checkExtension(path) {
  var exe = path.substring(path.lastIndexOf('.') + 1).toLowerCase();

  if(exe == "png" || exe == "jpeg" || exe == "jpg"){
    return true
  }

  return false
}

function isNumeric(value) {
  return /^\d+$/.test(value);
}


var image = document.getElementById('imageUpload')

$("#imageUpload").change(function (){

  var read = new FileReader()
  read.onload = function(e) {
    if(e.target.result){
      $('#blah').attr('src', e.target.result);
    }else{
      $('#blah').attr('src', "images/noimg.jpg");
    }
  }

  read.readAsDataURL(image.files[0]);

});


$(document).ready(function(){
  $('#create-form').submit((event) => {
  
    event.preventDefault();
  
  var locFlag = descFlag = priceFlag = imgFlag = false
  var location = $('#location').val()
  var desc = $('#desc').val()
  var price = $('#price').val()
  var image = document.getElementById('imageUpload')
  var imagePath = $('#imageUpload').val()
  
  // console.log(imagePath);

  var locationError = $('#location-error')
  var descError = $('#desc-error')
  var priceError = $('#price-error')
  var imageError = $('#image-error')
  
    
    if(location.length == 0){
      locationError.show()
    }else{
      locFlag = true
      locationError.hide()
    }
    
    if(desc.length == 0){
      descError.show()
    }else{
      descFlag = true
      locationError.hide()
    }

    if(price.length == 0){
      priceError.show()
    }else if(!isNumeric(price)){
      priceError.html('The Base Price should be in digits')
      priceError.show()
    }else{
      priceFlag = true
      priceError.hide()
    }
    
    
    if(imagePath == ""){
      imageError.show()
    }else if(!checkExtension(imagePath)){
      imageError.html('Invalid image extension! Valid extensions are .png/.jpeg/.jpg')
      imageError.show()
    }else{
      imgFlag = true
      imageError.hide()


      if (image.files && image.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(image.files[0]);
      }

    }


    if(locFlag && descFlag && priceFlag && imgFlag){

      var x = new FormData(document.getElementById('create-form'))
      // console.log(x);
      
      $.ajax({
        url: 'ajax/create-tour.php',
        type: 'POST',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        encode: true,
        data: x,
        success: function(data) {

          console.log(data);

          var msg = `${data.name} package has successfully registered!`;
          var icon = 'success';
          var redirect = "manage.php";
          
          if(data['reason'] == "duplicate"){
            msg = `${data.name} package already exists. Please create another package tour!`;
            icon = 'warning';
            redirect = "create.php";
          }
          
          const Toast = Swal.mixin({
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            didClose: () => {
              window.location.href = redirect
            }
          })
          
          Toast.fire({
            icon: icon,
            title: msg
          })
          
        },
        error: function (data) {
          window.location.href = "error.php"
        }
      })
    }

    
  })
  })

