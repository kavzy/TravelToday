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
            <a href="manage_packages.php" class="btn rounded btn-secondary">Packages</a> | <font color="blue">Add New Package</font>
            </div>
            <div class="card-body">
            <form class="form" action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                        <label for="file">Select Image for Package</label>
                                            <input type="file" name="image" id="file" class="file" required>
                                        </div>
                                     </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Package Name</label>
                                            <input type="text" name="pkg_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Duration (Days)</label>
                                            <input type="number" name="duration" class="form-control" min="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Total Rooms</label>
                                            <input type="number" name="rooms" class="form-control" min="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Price Per Person - Adult ($)</label>
                                            <input type="number" name="adult" class="form-control" step=".01" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Price Per Person - Children ($)</label>
                                            <input type="number" name="child" class="form-control" step=".01" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Locations</label>
                                            <textarea class="form-control" name="locations" rows="3" placeholder="Sigiriya, Nuwara Eliya etc.." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Categories</label>
                                            <textarea class="form-control" name="categories" rows="3"  placeholder="Adventure, Wild etc.."  required></textarea>
                                        </div>
                                    </div>
                                   
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
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
                       swal("Package Added Success!", "success!", "success");
                   </script>';
        
           }
           if(isset($_GET['failed']))
           {
               echo'<script>
                       swal("Package Added Fail!!", "Something went wrong!", "error");
                   </script>'; 
           }

           if(isset($_POST['submit']))
           {
                $name = $_POST['pkg_name'];
                $duration = $_POST['duration'];
                $rooms = $_POST['rooms'];
                $adult = $_POST['adult'];
                $child = $_POST['child'];
                $locations = $_POST['locations'];
                $categories = $_POST['categories'];
               // if save button on the form is clicked-
                // name of the uploaded file
                $filename = $_FILES['image']['name'];

                // destination of the file on the server
              //  $destination = '../img/packages/' . $filename;

                // get the file extension
                $extension = pathinfo($filename, PATHINFO_EXTENSION);

                //----------------------
                
                $t=time();
                $hashcode = hash('md5', $t);
                $filename_rename = $hashcode.'_'.$filename;
                // destination of the file on the server
                $destination = '../img/packages/' .$filename_rename;

                //--------------

                // the physical file on a temporary uploads directory on the server
                $file = $_FILES['image']['tmp_name'];
                $size = $_FILES['image']['size'];

                if (!in_array($extension, ['jpg', 'jpeg', 'png', 'JPEG', 'JPG'])) {
                    echo'<script>
                        swal("Failed!", "Your file extension must be  jpg , jpeg or png", "error");
                        </script>';
                } elseif ($_FILES['image']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
                    echo'<script>
                        swal("Failed!", "File size limit 10mb", "error");
                        </script>';
                } else {
                    // move the uploaded (temporary) file to the specified destination
                    if (move_uploaded_file($file, $destination)) {
                        include 'Admin.php';
                        //create new instance from Admin class
                        $admin = new Admin(); 
                        $admin ->add_package($name, $duration, $rooms, $adult, $child, $locations, $categories,  $filename_rename);
                    } else {
                        echo'<script>
                        swal("Failed!", "upload fail", "error");
                       </script>';
                    }
                }
                            
                 

                           
           }
    ?>
</body>
</html>
