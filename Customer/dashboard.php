<?php
    session_start();
    if(!(isset($_SESSION['role_id'])) && !(isset($_SESSION['username']))){
        header("location:../index.php");
    }
    if ($_SESSION['role_id'] != 2) {
        header("location:../index.php");
    }  

    $user = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    
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
                <h3>My Bookings</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Bookings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Simple Datatable
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Package ID</th>
                            <th>Total Adult</th>
                            <th>Total Children</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                         require_once '../Database.php';
                         $connect = new Database();
                         $userid = $_SESSION['id'];
                         $db = $connect->db();
                         $sql = "SELECT * FROM bookings WHERE customer_id = $userid";
                         $result = mysqli_query($db, $sql);
                         $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    ?>
                    <?php foreach ($books as $book): ?>
                        <?php
                            if($book['status'] == 0){
                                $status = '<span class="badge bg-danger">waiting for approval</span>';
                            }else if($book['status'] == 1){
                                $status = '<span class="badge bg-warning">waiting for payment</span>';
                            }else if($book['status'] == 2){
                                $status = '<span class="badge bg-success">success</span>';
                            }else{
                                $status = 'not found';
                            }
                        ?>
                        <tr>
                            <td><?php echo $book['id']; ?></td>
                            <td><?php echo $book['package_id']; ?></td>
                            <td><?php echo $book['total_adult']; ?></td>
                            <td><?php echo $book['total_child']; ?></td>
                            <td><?php echo $book['checkin']; ?></td>
                            <td><?php echo $book['checkout']; ?></td>
                            <td>$ <?php echo $book['total']; ?></td>
                            <td>
                            <?php echo $status; ?>
                            </td>
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
                       swal("Tour Booked Success!", "Thank You! Our staff member will contact you soon!", "success");
                   </script>';
        
           }
           if(isset($_GET['failed']))
           {
               echo'<script>
                       swal("Tour Booked fail!", "Something went wrong!", "error");
                   </script>'; 
           }
    ?>
</body>
</html>
