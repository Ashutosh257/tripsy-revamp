<?php 
    include 'header.php';
?>

<h1>admin dashboard</h1>


<script type="text/javascript">
      function capitalizeName(name) {
        return name.charAt(0).toUpperCase() + name.slice(1);
      }

      var name = "<?php echo $_SESSION['admin_name']; ?>"
      var msg = `Welcome ${capitalizeName(name)}!`;
      var icon = 'success';
      // var redirect = "tours.php"
      var position = 'top-end'
      var isToast = true

      const Toast = Swal.mixin({
        toast: isToast,
        position: position,
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        // allowOutsideClick: false,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
        
      Toast.fire({
        icon: icon,
        titleText: msg
      })

</script>

