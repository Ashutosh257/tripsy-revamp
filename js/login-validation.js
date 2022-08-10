

$("body").on('click', '.toggle-password', function() {
    $(this).toggleClass("fa-eye-slash fa-eye");
    var input = $("#password");
    if (input.attr("type") === "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
});

$("body").on('click', '.toggle-confirm-password', function() {
    $(this).toggleClass("fa-eye-slash fa-eye");
    var input = $("#confirmPassword");
    if (input.attr("type") === "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
});



$('#email-error').hide()
$('#password-error').hide()



function checkEmail(email){
  return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( email );
}

function checkPass(pass){
  return /^[a-zA-Z0-9!@#$%^&*.]{3,16}$/.test( pass );
}



$(document).ready(function(){
    $('#login-form').submit((event) => {
  
    var email = $('#email').val()
    var pass = $('#password').val()
    
    var emailFlag = false
    var passFlag = false

    var emailError = $('#email-error')
    var passError = $('#password-error')

    if(email.length == 0){
      emailError.show()
    }else if(!checkEmail(email)){
      emailError.html('Invalid Email!')
      emailError.show()
    }else{
        emailFlag = true
        emailError.hide()
    }
    
    
    if(pass.length == 0){
        passError.show()
    }else if(pass.length < 3){
        passError.html('Password length must be greater than 2')
        passError.show()
    }else if(!checkPass(pass)){
        passError.html('Password can contain alphabets, numbers and special characters like !@#$%^&*.')
        passError.show()
    }else{
        passFlag = true
        passError.hide()
    }

    var loginPage = "user-login.php"
    var url = $('.user-label').text().trim()
    
    // console.log(url);
    
    if(url.toLowerCase().includes("admin")){
      loginPage = "admin-login.php"
    }
    // console.log(loginPage);

    // $('.signup-link').hide()

    if(emailFlag && passFlag){


        $.ajax({
        url: `ajax/${loginPage}`,
        type: 'POST',
        dataType: 'json',
        encode: true,
        data: $('#login-form').serialize(),
        success: function(data) {

          // todo: run only on success login


            console.log(data);

            function capitalizeName(name) {
              return name.charAt(0).toUpperCase() + name.slice(1);
            }

            var msg = `Welcome ${capitalizeName(data.name)}!`;
            var icon = 'success';
            var redirect = "tours.php"
            var position = 'top-end'
            var isToast = true

            if(data.role == "admin"){
              redirect = "admin-dashboard.php"
            }

            if(data.reason == "none"){
                msg = `${data.email} doesn't exists. 
                    Please create an account with this email!`;
                icon = 'warning';
                redirect = "register.php";
                position = "center"
                isToast = false

                const Toast = Swal.mixin({
                  toast: isToast,
                  position: position,
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  // allowOutsideClick: false,
                  didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                  },
                  willClose: () => {
                      window.location.href = redirect
                    }
                  })
                  
                  Toast.fire({
                    icon: icon,
                    titleText: msg
                  })
            }
            
            window.location.href = redirect

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

