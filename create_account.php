<?php
    session_start();
?>
<?php if((isset($_SESSION['role_id'])) && (isset($_SESSION['username']))){ 
?>
        
    <script>
        location.replace('index.php');
    </script>

<?php
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">
        
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="assets/images/favicon.svg" height="48" class='mb-4'>
                        <h3>Sign Up</h3>
                        <p>Please sign up to continue to Travel Today.</p>
                        <a href="index.php"><i data-feather="arrow-left" width="20"></i> Back to home</a>
                    </div>
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">First Name</label>
                                    <input type="text" id="first-name-column" class="form-control"  name="fname" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Last Name</label>
                                    <input type="text" id="last-name-column" class="form-control"  name="lname" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username-column">Username</label>
                                    <input type="text" id="username-column" class="form-control" name="username" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Passowrd</label>
                                    <input type="password" id="country-floating" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email-id-column">Email</label>
                                    <input type="email" id="email-id-column" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="company-column">Address</label>
                                    <input type="text" id="company-column" class="form-control" name="address" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="company-column">Mobile</label>
                                    <input type="number" id="company-column" class="form-control" name="mobile" required>
                                </div>
                            </div>
                          
                        </diV>

                                <a href="login.php">Have an account? Login</a>
                        <div class="clearfix">
                            <button type="submit" name="submit" class="btn btn-primary float-end">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/js/main.js"></script>
     <!-- Sweet Alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



    <?php 
    if(isset($_POST['submit']))
    {
         
         $firstname = $_POST['fname'];
         $lastname = $_POST['lname'];
         $username = $_POST['username'];
         $password = $_POST['password'];
         $email = $_POST['email'];
         $mobile = $_POST['mobile'];
         $address = $_POST['address'];
         include 'Authenticate.php';
         //create new instance from Customer class
         $customer = new Authenticate(); 
         $customer->customerCreateAccount($firstname, $lastname, $email, $username, $address,$mobile, $password);
    }


    ?>

<?php 
           if(isset($_GET['email']))
           {
               echo'<script>
                        swal("Email already exists!!", "Use new email!", "error");
                   </script>';
        
           }
           if(isset($_GET['username']))
           {
               echo'<script>
                       swal("UserName already exists!!", "Use New username!", "error");
                   </script>'; 
           }
           if(isset($_GET['success']))
           {
               echo'<script>
                       swal("Account Created Success!", "Now You can login!", "success");
                   </script>';
        
           }
           if(isset($_GET['failed']))
           {
               echo'<script>
                       swal("Account Created Fail!!", "Something went wrong!", "error");
                   </script>'; 
           }

           ?>
</body>

</html>
