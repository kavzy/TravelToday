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
                <h3> Manage Admins</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Admins</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
            <font color="red"> Admins </font> | <a href="add_admin.php" class="btn btn-secondary round">Add New Admin</a>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Admin ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Address</th>
                            <th>Mobile</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                         require_once '../Database.php';
                         $connect = new Database();
                         $userid = $_SESSION['id'];
                         $db = $connect->db();
                         $sql = "SELECT * FROM role_users WHERE role_id = 1";
                         $result = mysqli_query($db, $sql);
                         $role_users = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    ?>
                    <?php foreach ($role_users as $role_user): ?>
                    <?php 
                        $user_id = $role_user['user_id'];
                        $sql2 = "SELECT * FROM users WHERE id = $user_id";
                        $result2 = mysqli_query($db, $sql2);
                        $users = mysqli_fetch_all($result2, MYSQLI_ASSOC); ?>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['first_name']; ?></td>
                            <td><?php echo $user['last_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['address']; ?></td>
                            <td><?php echo $user['mobile']; ?></td>
                        </tr>
                        <?php endforeach;?>
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
