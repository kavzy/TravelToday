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
        <link rel="shortcut icon" href="../assets/images/favicon.svg" type="image/x-icon">
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <img src="../assets/images/logo.svg" alt="" srcset="">
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
                <h3>Manage Payments</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Payments</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Manage Payments
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>Booking ID</th>
                            <th>Customer ID</th>
                            <th>Total</th>
                            <th>Date and Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                         require_once '../Database.php';
                         $connect = new Database();
                         $userid = $_SESSION['id'];
                         $db = $connect->db();
                         $sql = "SELECT * FROM payments";
                         $result = mysqli_query($db, $sql);
                         $payments = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    ?>
                    <?php foreach ($payments  as $payment): ?>
                      
                        <tr>
                            <td><?php echo $payment['id']; ?></td>
                            <td><?php echo $payment['booking_id']; ?></td>
                            <td><?php echo $payment['customer_id']; ?></td>
                            <td>$ <?php echo $payment['total']; ?></td>
                            <td><?php echo $payment['date']; ?></td>
                            
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
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
