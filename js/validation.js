

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

  
  
// jQuery.validator.addMethod("checkMobile", function(value, element) {
//     return /^[6-9]\d{9}$/.test( value );
// });

// jQuery.validator.addMethod("checkEmail", function(value, element) {
//     return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( value );
// });
    
// jQuery.validator.addMethod("checkPassword", function(value, element) {
//     return /^[a-zA-Z0-9!@#$%^&*.]{3,16}$/.test( value );
// });
    
// jQuery.validator.addMethod("matchPassword", function(value, element) {
//     password = $('#password').val()
//     cnfpassword = $('#confirmPassword').val()
//     return password === cnfpassword
// });


// $('#user-form').validate({
//     rules: {
//         firstname: {
//             required: true
//         },
//         lastname: {
//             required: true
//         },
//         mobile: {
//             required: true,
//             // digits: true,
//             // maxlength: 10,
//             // checkMobile: true,
//         },
//         email: {
//             required: true,
//             checkEmail: true,
//         },
//         password: {
//             required: true,
//             minlength: 3,
//             checkPassword: true
//         },
//         confirmPassword: {
//             required: true,
//             minlength: 3,
//             matchPassword: true
//         }
//     },
//     messages: {
//         mobile: {
//             // required: 'This field is required',
//             // checkMobile: "The phone number entered is invalid",
//         },
//         email:{
//             required: "Email can't be empty",
//             checkEmail: 'Please enter a valid email address.'
//         },
//         password:{
//             required: "This field is required",
//             minlength: 'Password length must be greater than 6',
//             checkPassword: "Password can contain alphabets, numbers and special characters like !@#$%^&*. "
//         },
//         confirmPassword: {
//             required: "This field is required",
//             minlength: 'Password length must be greater than 6',
//             matchPassword: "Password don't match"
//         }
//     }
// });


$('#first-name-error').hide()
$('#last-name-error').hide()
$('#mobile-error').hide()
$('#email-error').hide()
$('#password-error').hide()
$('#cnf-password-error').hide()



function checkEmail(email){
  return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( email );
}

function checkPass(pass){
  return /^[a-zA-Z0-9!@#$%^&*.]{6,16}$/.test( pass );
}

function isNumeric(value) {
  return /^\d+$/.test(value);
}


// $('#user-form').submit((event) => {
  $(document).ready(function(){
    // $("#submit").click(function(){
    $('#user-form').submit((event) => {
  
      var firstFlag = lastFlag = mobileFlag = emailFlag = passFlag = cnfPassFlag = false
  
      var firstname = $('#firstname').val()
      var lastname = $('#lastname').val()
      var mobile = $('#mobile').val()
      var email = $('#email').val()
      var pass = $('#password').val()
      var cnfpass = $('#confirmPassword').val()
      

      var fNameError = $('#first-name-error')
      var lNameError = $('#last-name-error')
      var mobileError = $('#mobile-error')
      var emailError = $('#email-error')
      var passError = $('#password-error')
      var cnfPassError = $('#cnf-password-error')

      if(firstname.length == 0){
        // $('#first-name-error').css({
          //     'display': 'block'
          // })
          fNameError.show()
          // $('#first-name-error').addClass('error')
          // $('#first-name-error').val('first name cant be null')
          // fNameError.html('This field is required')
          
      }else{
        firstFlag = true
        fNameError.hide()
      }
    
      if(lastname.length == 0){
        lNameError.show()
        // lNameError.html('This field is required')
      }else{
        lastFlag = true
        lNameError.hide()
      }

      if(mobile.length == 0){
        mobileError.show()
      }else if(mobile.length !== 10 ){
        mobileError.html('Mobile Number should be of 10 digits')
        mobileError.show()
      }else if(!isNumeric(mobile)){
        mobileError.html('Mobile Number should be digits')
        mobileError.show()
      }else{
        mobileFlag = true
        mobileError.hide()
      }
      
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
      }else if(pass.length < 5){
        passError.html('Password length must be greater than 5')
        passError.show()
      }else if(!checkPass(pass)){
        passError.html('Password can contain alphabets, numbers and special characters like !@#$%^&*.')
        passError.show()
      }else{
        passFlag = true
        passError.hide()
      }

      if(cnfpass.length == 0){
        cnfPassError.show()
      }else if(pass !== cnfpass){
        cnfPassError.html("Password doesn't match")
        cnfPassError.show()
      }else{
        cnfPassFlag = true
        cnfPassError.hide()
      }

      if (firstFlag && lastFlag && mobileFlag && emailFlag && passFlag && cnfPassFlag) {
        $.ajax({
          url: 'ajax/insert-user.php',
          type: 'POST',
          dataType: 'json',
          encode: true,
          data: $('#user-form').serialize(),
          success: function(data) {

            // var newData = data.trim();
            // console.log(newData);
            console.log(data);
            

            var msg = `${data.email} has successfully registered!`;
            var icon = 'success';
            var redirect = "login.php";
            
            if(data['reason'] == "duplicate"){
              msg = `${data.email} already exists. Please create an account with another email!`;
              // msg = `${data.email}`;
              icon = 'warning';
              redirect = "register.php";
            }
            
            const Toast = Swal.mixin({
              // toast: true,
              // position: 'top-end',
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
            console.log(data);
            // window.location.href = "error.php"
          }
        })
      }

    
      event.preventDefault();
  })
  })

