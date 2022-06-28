<?php
    session_start();
    if(!(isset($_SESSION['role_id'])) && !(isset($_SESSION['username']))){
        header("location:../index.php");
    }
    if ($_SESSION['role_id'] != 1) {
        header("location:../index.php");
    }  

    $user = $_SESSION['username'];

    if(isset($_GET['id']))
    {
             if(is_numeric($_GET['id']))
             {
                 $customer_id = $_GET['id'];

             }else{
                header("location: dashboard.php");
            }
 
    }else{
        header("location: dashboard.php");
    }

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
                <h3>Manage Bookings</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Bookings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Customer Details
            </div>
            <div class="card-body">
  <!-- // Basic multiple Column Form section start -->
  <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer Details</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <?php
                         require_once '../Database.php';
                         $connect = new Database();
                         $db = $connect->db();
                         $sql = "SELECT * FROM users WHERE id = $customer_id";
                         $result = mysqli_query($db, $sql);
                         $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    ?>
                    <?php foreach ($customers as $customer): ?>
                            <form class="form">
                                <div class="row">
                                <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Customer ID</label>
                                            <input type="text" id="first-name-column" class="form-control" value="<?php echo $customer['id']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">First Name</label>
                                            <input type="text" id="first-name-column" class="form-control" value="<?php echo $customer['first_name']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Last Name</label>
                                            <input type="text" id="last-name-column" class="form-control" value="<?php echo $customer['last_name']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">UserName</label>
                                            <input type="text" id="city-column" class="form-control" value="<?php echo $customer['username']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Email</label>
                                            <input type="email" id="country-floating" class="form-control" value="<?php echo $customer['email']; ?>" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Address</label>
                                            <input type="text" id="company-column" class="form-control" value="<?php echo $customer['address']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Mobile</label>
                                            <input type="email" id="email-id-column" class="form-control" value="<?php echo $customer['mobile']; ?>" readonly>
                                        </div>
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
                       swal("Approved Success!", "success!", "success");
                   </script>';
        
           }
           if(isset($_GET['failed']))
           {
               echo'<script>
                       swal("Approved Fail!!", "Something went wrong!", "error");
                   </script>'; 
           }

           if(isset($_GET['approve']))
           {
                if(isset($_GET['id']))
                {
                    if(is_numeric($_GET['id']))
                    {
                        $book_id = $_GET['id'];
                        include 'Admin.php';
                        //create new instance from Admin class
                        $admin = new Admin(); 
                        $admin ->approve($book_id);

                    }
                   
            
                }
        
           }
    ?>
</body>
</html>
