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
                <h3>Messages</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Messages</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Messages
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                         require_once '../Database.php';
                         $connect = new Database();
                         $db = $connect->db();
                         $sql = "SELECT * FROM messages";
                         $result = mysqli_query($db, $sql);
                         $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    ?>
                    <?php foreach ($messages  as $message): ?>
                      
                        <tr>
                            <td><?php echo $message['id']; ?></td>
                            <td><?php echo $message['email']; ?></td>
                            <td><?php echo $message['name']; ?></td>
                            <td><?php echo $message['subject']; ?></td>
                            <td><?php echo $message['message']; ?></td>
                            <td><?php echo $message['datetime']; ?></td>
                            
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


</body>
</html>
