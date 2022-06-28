<?php
    session_start();
    if(!(isset($_SESSION['role_id'])) && !(isset($_SESSION['username']))){
        header("location:../index.php");
    }
    if ($_SESSION['role_id'] != 1) {
        header("location:../index.php");
    }  

    $user = $_SESSION['username'];

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
                <h3> Generate Report</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Generate Report</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
               Generate Report
            </div>
            <div class="card-body">
            <a href="reports/customers.php" class="btn btn-primary round">Generate Customers Report</a> |
            <a href="reports/payments.php" class="btn btn-secondary round">Generate Payments Report</a> |
            <a href="reports/bookings.php" class="btn btn-danger round">Generate Bookings Report</a>
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
                       swal("Success!", "success!", "success");
                   </script>';
        
           }
           if(isset($_GET['failed']))
           {
               echo'<script>
                       swal("Fail!!", "Something went wrong!", "error");
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

           if(isset($_GET['active']))
           {
                if(isset($_GET['id']))
                {
                    if(is_numeric($_GET['id']))
                    {
                        $cus_id = $_GET['id'];
                        include 'Admin.php';
                        //create new instance from Admin class
                        $admin = new Admin(); 
                        $admin ->update_customer_status($cus_id, 1);

                    }
                   
            
                }
           }else if(isset($_GET['deactive']))
           {
                if(isset($_GET['id']))
                {
                    if(is_numeric($_GET['id']))
                    {
                        $cus_id = $_GET['id'];
                        include 'Admin.php';
                        //create new instance from Admin class
                        $admin = new Admin(); 
                        $admin ->update_customer_status($cus_id, 0);

                    }
                   
            
                }
           }
    ?>
</body>
</html>
