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
                <h3>Manage Packages</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Packages</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Packages | <a href="add_package.php" class="btn rounded btn-info">Add New Package</a>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Package ID</th>
                            <th>Package Name</th>
                            <th>Locations</th>
                            <th>Categories</th>
                            <th>Duration</th>
                            <th>Rooms</th>
                            <th>Adult</th>
                            <th>Child</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                         require_once '../Database.php';
                         $connect = new Database();
                         $userid = $_SESSION['id'];
                         $db = $connect->db();
                         $sql = "SELECT * FROM packages";
                         $result = mysqli_query($db, $sql);
                         $packages = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    ?>
                    <?php foreach ($packages as $package): ?>
                        <?php
                            if($package['is_active'] == 0){
                                $status = '<span class="badge bg-danger">Not Available</span>';
                                $btn = '<a href="manage_packages.php?active=1&id='.$package['id'].'" class="btn btn-success">Activate</a>';
                            }else{
                                $status = '<span class="badge bg-success">Available</span>';
                                $btn = '<a href="manage_packages.php?deactive=1&id='.$package['id'].'" class="btn btn-danger">Deactivate</a>';
                            }
                        ?>
                        <tr>
                            <td><?php echo $package['id']; ?></td>
                            <td><?php echo $package['name']; ?></td>
                            <td><?php echo $package['locations']; ?></td>
                            <td><?php echo $package['categories']; ?></td>
                            <td><?php echo $package['duration']; ?> Days</td>
                            <td><?php echo $package['room']; ?></td>
                            <td>$ <?php echo $package['adult_price']; ?></td>
                            <td>$ <?php echo $package['child_price']; ?></td>
                            <td>
                            <?php echo $status; ?>
                            </td>
                            <td>
                            <?php echo $btn; ?>
                            </td>
                            <td>
                            <a href="edit_package.php?id=<?php echo $package['id']; ?>" class="btn btn-primary">Edit</a>
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
                       swal("Package Status Updated Success!", "success!", "success");
                   </script>';
        
           }
           if(isset($_GET['failed']))
           {
               echo'<script>
                       swal("Package Status Updated Fail!!", "Something went wrong!", "error");
                   </script>'; 
           }

           if(isset($_GET['active']))
           {
                if(isset($_GET['id']))
                {
                    if(is_numeric($_GET['id']))
                    {
                        $pkg_id = $_GET['id'];
                        include 'Admin.php';
                        //create new instance from Admin class
                        $admin = new Admin(); 
                        $admin ->update_pkg_status($pkg_id, 1);

                    }
                   
            
                }
           }else if(isset($_GET['deactive']))
           {
                if(isset($_GET['id']))
                {
                    if(is_numeric($_GET['id']))
                    {
                        $pkg_id = $_GET['id'];
                        include 'Admin.php';
                        //create new instance from Admin class
                        $admin = new Admin(); 
                        $admin ->update_pkg_status($pkg_id, 0);

                    }
                   
            
                }
           }
    ?>
</body>
</html>
