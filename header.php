
<?php
    include 'connect.php';
    include 'btn-top.php';
?>

<!-- CDN Links -->
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">


<link rel="stylesheet" href="css/index.css">
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
    <img src="./images/logo/new-logo.png" width="150px" height="90px" class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
          <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            
            
            <?php
            if(isset($_SESSION['admin_id'])){
                echo '
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Tours
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="create.php">Create</a></li>
                    <li><a class="dropdown-item" href="manage.php">Edit</a></li>
                </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin-payments.php">Payments</a>
                </li>';
            }else if(isset($_SESSION['user_id'])){
                echo '
                <li class="nav-item">
                    <a class="nav-link" href="tours.php">Tours</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="bookingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        My Bookings
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="bookingDropdown">
                        <li><a class="dropdown-item" href="cart.php">My WishList</a></li>
                        <li><a class="dropdown-item" href="bookings.php">Booked Tours</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>';
            }else{
                echo '
                <li class="nav-item">
                    <a class="nav-link" href="tours.php">Tours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>';
            }

            ?>
            <!-- <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
            </li> -->
        </ul>    
        <ul class="navbar-nav">
        <?php
        if(isset($_SESSION['user_id'])){
            $str= $_SESSION['name'];
            echo '<li class="nav-item"><a class="nav-link">Welcome '.ucfirst($str).'</a>';
            echo "<li class='nav-item'><a class='nav-link' href='logout.php'><span class='glyphicon glyphicon-user'></span> Logout</a></li>";
        }else if(isset($_SESSION['admin_id'])){
            $str= $_SESSION['admin_name'];
            echo '<li class="nav-item"><a class="nav-link">Welcome '.ucfirst($str).'</a>';
            echo "<li class='nav-item'><a class='nav-link' href='logout.php'><span class='glyphicon glyphicon-user'></span> Logout</a></li>";
        }else
            echo '<li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin.php">Admin</a>
            </li>';
          ?>
            
        </ul>
    </div>
</div>
</nav>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- tailwindcss -->
<script src="https://cdn.tailwindcss.com"></script>
