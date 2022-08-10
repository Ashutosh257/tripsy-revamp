

$('#desc-error').hide()
$('#price-error').hide()



function isNumeric(value) {
  return /^\d+$/.test(value);
}


$(document).ready(function(){
  $('#update-form').submit((event) => {
  
    event.preventDefault();
  
  var descFlag = priceFlag = false
  var desc = $('#desc').val()
  var price = $('#price').val()
  
  // console.log(imagePath);

  var descError = $('#desc-error')
  var priceError = $('#price-error')
  
    
    if(desc.length == 0){
      descError.show()
    }else{
      descFlag = true
      descError.hide()
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


    if(descFlag && priceFlag ){

        var data = {
            desc: desc,
            price: price,
            pid: 4,
        }
        
        console.log(data);

      $.ajax({
        url: 'ajax/update-tour.php',
        type: 'POST',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        encode: true,
        data: data,
        success: function(data) {

          console.log(data);

          var msg = `${data.name} package has successfully updated!`;
          var icon = 'success';
          var redirect = "manage.php";

          
          const Toast = Swal.mixin({
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            didClose: () => {
            //   window.location.href = redirect
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

