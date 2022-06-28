<?php
    session_start();
    if(!(isset($_SESSION['role_id'])) && !(isset($_SESSION['username']))){
        header("location:../index.php");
    }
    if ($_SESSION['role_id'] != 2) {
        header("location:../index.php");
    }  

    $user = $_SESSION['username'];
    $userid = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="../assets/vendors/simple-datatables/style.css">
    
        <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
        <link rel="stylesheet" href="../assets/css/app.css">
        <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
    <center><img src="../img/logo.png" alt="" srcset=""></center>
        <center><h4>Travel Today</h4></center>
    </div>
      <!-- Sidenav -->
    <?php include "side_navbar.php" ?>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
        </div>
        <div id="main">
           <!-- Headernav -->
    <?php include "header_navbar.php" ?>
            
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Account Settings</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Account Details
            </div>
            <div class="card-body">
  <!-- // Basic multiple Column Form section start -->
  <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Details</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <?php
                         require_once '../Database.php';
                         $connect = new Database();
                         $db = $connect->db();
                         $sql = "SELECT * FROM users WHERE id = $userid";
                         $result = mysqli_query($db, $sql);
                         $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    ?>
                    <?php foreach ($customers as $customer): ?>
                            <form class="form" action="" method="POST">
                                <div class="row">
                                <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Customer ID</label>
                                            <input type="text" id="first-name-column" class="form-control" value="<?php echo $customer['id']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">First Name</label>
                                            <input type="text" name="firstname" id="first-name-column" class="form-control" value="<?php echo $customer['first_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Last Name</label>
                                            <input type="text" name="lastname" id="last-name-column" class="form-control" value="<?php echo $customer['last_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">UserName</label>
                                            <input type="text" name="username" id="city-column" class="form-control" value="<?php echo $customer['username']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">New Password</label>
                                            <input type="password" name="password" id="city-column" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Email</label>
                                            <input type="email" name="email" id="country-floating" class="form-control" value="<?php echo $customer['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Address</label>
                                            <input type="text" name="address" id="company-column" class="form-control" value="<?php echo $customer['address']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Mobile</label>
                                            <input type="number" name="mobile" id="email-id-column" class="form-control" value="<?php echo $customer['mobile']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        
                                    </div>
                                </div>
                            </form>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
            </div>
        </div>

    </section>
</div>

             <!-- footer -->
    <?php include "footer.php" ?>
        </div>
    </div>
     <!-- js scripts -->
     <?php include "scripts.php" ?>

    <?php 
           if(isset($_GET['success']))
           {
               echo'<script>
                       swal("Update Success!", "success!", "success");
                   </script>';
        
           }
           if(isset($_GET['failed']))
           {
               echo'<script>
                       swal("Updated Fail!!", "Something went wrong!", "error");
                   </script>'; 
           }
           if(isset($_GET['username']))
           {
               echo'<script>
                       swal("Username already exists!!", "Something went wrong!", "error");
                   </script>'; 
           }

           if(isset($_GET['email']))
           {
               echo'<script>
                       swal("Email already exists!!", "Something went wrong!", "error");
                   </script>'; 
           }

           if(isset($_POST['submit']))
           {
                $password = $_POST['password'];

                if($password == ""){
                    $user_id = $userid;
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $mobile = $_POST['mobile'];
                    $address = $_POST['address'];
                    include 'Customer.php';
                    //create new instance 
                    $customer = new Customer(); 
                    $customer ->settings($firstname, $lastname, $email, $username, $address,$mobile, $user_id);
                }else{
                    $user_id = $userid;
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $mobile = $_POST['mobile'];
                    $address = $_POST['address'];
                    include 'Customer.php';
                    //create new instance 
                    $customer = new Customer(); 
                    $customer ->settings_with_pass($firstname, $lastname, $email, $username,$password,$address,$mobile, $user_id);
                }
           }
    ?>
</body>
</html>
