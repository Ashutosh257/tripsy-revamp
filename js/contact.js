

function countChar(val) {
    var len = val.value.length;
    if (len >= 2001) {
      val.value = val.value.substring(0, 2000);
    } else {
      $('#current').text(len);
    }
};


$('#email-error').hide()
$('#msg-error').hide()

function checkEmail(email){
return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( email );
}
  


$(document).ready(function(){
    $('#contact-form').submit((event) => {
  
    var email = $('#email').val()
    var msg = $('#contact-msg').val()
    
    var emailFlag = false
    var msgFlag = false

    var emailError = $('#email-error')
    var msgError = $('#msg-error')

    if(email.length == 0){
      emailError.show()
    }else if(!checkEmail(email)){
      emailError.html('Invalid Email!')
      emailError.show()
    }else{
        emailFlag = true
        emailError.hide()
    }
    
    
    if(msg.length == 0){
        msgError.show()
    }else if(msg.length < 4){
        msgError.html('Message length should be more than 3 characters!')
        msgError.show()
    }else{
        msgFlag = true
        msgError.hide()
    }

    console.log(emailFlag);
    console.log(msgFlag);

    if(emailFlag && msgFlag){
        $.ajax({
        url: `ajax/contact.php`,
        type: 'POST',
        dataType: 'json',
        encode: true,
        data: $('#contact-form').serialize(),
        success: function(data) {

            console.log(data);

            var msg = `Thanks for contacting us!
            Have a great day!`;
            var icon = 'success';
            

            const Toast = Swal.mixin({
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            didClose: () => {
                window.location.href = "contact.php"
            }
            })
            
            Toast.fire({
            icon: icon,
            titleText: msg
            })
            
        },
        error: function (data) {
            // console.log(data);
            window.location.href = "error.php"
        }
        })
    }

    event.preventDefault();
  })
  })

