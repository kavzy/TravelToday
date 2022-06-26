<?php
    session_start();
?>
<?php 
if (isset($_POST['pkgID'])){ 
    if(is_numeric($_POST['pkgID'])){
        $pkg_id = $_POST['pkgID'];
        $total_adult = $_POST['adult'];
        $total_child = $_POST['children'];
        $checkin = $_POST['check-in'];
        $checkout = $_POST['check-out'];
    }else{
        ?>
        <script>
            location.replace('index.php');
        </script> 
        <?php
    }
 }else{
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Trave Today Agency</title>
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">                <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
    <link rel="stylesheet" href="css/tooplate-style.css">                                   <!-- Templatemo style -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
</head>

    <body>
        <div class="tm-main-content" id="top">
            <div class="tm-top-bar-bg"></div>
            <div class="tm-top-bar" id="tm-top-bar">
                <!-- Top Navbar -->
                <div class="container">
                    <div class="row">
                        
                        <nav class="navbar navbar-expand-lg narbar-light">
                            <a class="navbar-brand mr-auto" href="#">
                                <img src="img/logo.png" alt="Site logo">
                                Travel Today Agency
                            </a>
                            <button type="button" id="nav-toggle" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div id="mainNav" class="collapse navbar-collapse tm-bg-white">
                                <ul class="navbar-nav ml-auto">
                                  <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="index.php#tm-section-4">Packages</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="index.php#tm-section-5">Services</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="index.php#tm-section-6">Contact Us</a>
                                  </li>
                                  <?php
                                  if((isset($_SESSION['role_id'])) && (isset($_SESSION['username']))){
                                        if ($_SESSION['role_id'] == 1) { ?>
                                             <li class="nav-item">
                                            <a class="nav-link" onclick="panelAdmin()" href="#">My Panel</a>
                                             </li> <?php
                                        }else if($_SESSION['role_id'] == 2){ ?>
                                             <li class="nav-item">
                                            <a class="nav-link" onclick="panelCustomer()" href="#">My Panel</a>
                                             </li> <?php
                                        }  
                                    }else{ ?>
                                  <li class="nav-item">
                                    <a class="nav-link" id="login" href="#">Login</a>
                                  </li>
                                    <?php }
                                  ?>
                                </ul>
                            </div>                            
                        </nav>            
                    </div>
                </div>
            </div>
          
        
            
            <div class="tm-section tm-position-relative">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" class="tm-section-down-arrow">
                    <polygon fill="#ee5057" points="0,0  100,0  50,60"></polygon>                   
                </svg> 
                <div class="container tm-pt-5 tm-pb-4">    
                    <div class="row text-center">
                   <?php if((isset($_SESSION['role_id'])) && (isset($_SESSION['username']))){ 
                        if($_SESSION['role_id'] == 2) {
                            if(isset($pkg_id)){ ?>
                                <?php
                                    require_once 'Database.php';
                                    $connect = new Database();
                                    $db = $connect->db();
                                    $sql = "SELECT * FROM packages WHERE id = $pkg_id";
                                    $result = mysqli_query($db, $sql);
                                    $packages = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                ?>
                                <?php foreach ($packages as $package): ?>  
                                    <?php
                                        $pkgid = $package['id'];
                                    ?>  
                                <article class="col-sm-6 col-md-6 col-lg-6 col-xl-6 tm-article">                           
                                <i class="fa tm-fa-6x fa-life-saver tm-color-primary tm-margin-b-20"></i>
                                <h3 class="tm-color-primary tm-article-title-1">Selected Package Details</h3>
                                <p>Package name : <b><?php echo $package['name']; ?></b></p>
                                <p>Locations : <b><?php echo $package['locations']; ?></b></p>
                                <p><strong><i class="fa fa-1x fa-clock-o"></i> <?php echo $package['duration']; ?> Days</strong></p>
                                <p>Price (Adult) : <b>$<?php echo $package['adult_price']; ?></b> per person</p>
                                <p>Price (Child) : <b>$<?php echo $package['child_price']; ?></b> per person</p>
                                <p>Rooms : <strong><i class="fa fa-1x fa-bed"></i> <?php echo $package['room']; ?></strong></p><br> 
                                                        
                                </article>
                                <article class="col-sm-6 col-md-6 col-lg-6 col-xl-6 tm-article">                           
                                <i class="fa tm-fa-6x fa-life-saver tm-color-primary tm-margin-b-20"></i>
                                <h3 class="tm-color-primary tm-article-title-1">Bill Details</h3>
                                <form action="Customer/checkout.php" method="post">
                                    <div class="form-group tm-form-element tm-form-element-100">
                                         <label><b>Total Adult</b></label><input type="text" class="form-control" name="total_adult" value="<?php echo $total_adult; ?>" readonly>
                                    </div>
                                    <div class="form-group tm-form-element tm-form-element-100">
                                         <label><b>Total Children</b></label><input type="text" class="form-control" name="total_children" value="<?php echo $total_child; ?>" readonly>
                                    </div>
                                    <br>
                                    <?php
                                    $totalAdultPrice = $total_adult*$package['adult_price'];
                                    $totalChildPrice = $total_child*$package['child_price'];
                                    $totalPrice = $totalAdultPrice + $totalChildPrice;
                                    
                                    ?>
                                    <p><font color ="red">Check In :</font>  <?php echo $checkin; ?></p>
                                    <p><font color ="red">Check Out :</font>  <?php echo $checkout; ?></p>
                                    <p><font color ="red">Adult Price</font> : <?php echo $total_adult.' * '.$package['adult_price'].' = $'.$total_adult*$package['adult_price'] ; ?> </p>
                                    <p><font color ="red">Children Price</font> : <?php echo $total_child.' * '.$package['child_price'].' = $'.$total_child*$package['child_price'] ; ?> </p>
                                    <input type="hidden" name="total" value="<?php echo $totalPrice; ?>">
                                    <input type="hidden" name="total_adult_price" value="<?php echo $totalAdultPrice; ?>">
                                    <input type="hidden" name="total_child_price" value="<?php echo $totalChildPrice; ?>">
                                    <input type="hidden" name="pkg_id" value="<?php echo $pkgid; ?>">
                                    <input type="hidden" name="check-in" value="<?php echo $checkin; ?>">
                                    <input type="hidden" name="check-out" value="<?php echo $checkout; ?>">
                                    
                                    <p><strong>Total</strong> : <font size="3"> $</font> <font size="5"> <?php echo $totalPrice; ?> </font> </p>
                                    <button type="submit" class="btn btn-primary tm-btn-search">Checkout Now</button>
                                </form>
                                                        
                                </article>
                                <?php endforeach;?>
                      <?php }
                     } else{?>
                            <article class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-article">                           
                            <i class="fa tm-fa-6x fa-life-saver tm-color-primary tm-margin-b-20"></i>
                            <h3 class="tm-color-primary tm-article-title-1">You are in Admin Mode</h3>
                            <p>You cannot checkout packages with admin !! please login with customer mode</p>
                            <a href="logout.php" class="text-uppercase tm-color-primary tm-font-semibold">logout</a>                           
                            </article>
                     <?php }
                   }else{ ?>
                            <article class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-article">                           
                            <i class="fa tm-fa-6x fa-life-saver tm-color-primary tm-margin-b-20"></i>
                            <h3 class="tm-color-primary tm-article-title-1">Checkout</h3>
                            <p>To checkout your package please login or create account!</p>
                            <a href="create_account.php" class="text-uppercase tm-color-primary tm-font-semibold">Create Account</a> |    
                            <a href="login.php" class="text-uppercase tm-color-primary tm-font-semibold">Login</a>                         
                            </article>
                 <?php  } ?>
                       
                    </div>       
                </div>
            </div>
            
           
            
            <footer class="tm-bg-dark-blue">
                <div class="container">
                    <div class="row">
                        <p class="col-sm-12 text-center tm-font-light tm-color-white p-4 tm-margin-b-0">
                        Copyright &copy; <span class="tm-current-year">2022</span> Travel Today</p>        
                    </div>
                </div>                
            </footer>
        </div>
        
        <!-- load JS files -->
        <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
        <script src="js/popper.min.js"></script>                    <!-- https://popper.js.org/ -->       
        <script src="js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
        <script src="js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
        <script src="js/jquery.singlePageNav.min.js"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
        <script src="slick/slick.min.js"></script>                  <!-- http://kenwheeler.github.io/slick/ -->
        <script>

            /* Google map
            ------------------------------------------------*/
            var map = '';
            var center;

            function initialize() {
                var mapOptions = {
                    zoom: 16,
                    center: new google.maps.LatLng(13.7567928,100.5653741),
                    scrollwheel: false
                };

                map = new google.maps.Map(document.getElementById('google-map'),  mapOptions);

                google.maps.event.addDomListener(map, 'idle', function() {
                  calculateCenter();
              });

                google.maps.event.addDomListener(window, 'resize', function() {
                  map.setCenter(center);
              });
            }

            function calculateCenter() {
                center = map.getCenter();
            }

            function loadGoogleMap(){
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDVWt4rJfibfsEDvcuaChUaZRS5NXey1Cs&v=3.exp&sensor=false&' + 'callback=initialize';
                document.body.appendChild(script);
            } 

            function setCarousel() {
                
                if ($('.tm-article-carousel').hasClass('slick-initialized')) {
                    $('.tm-article-carousel').slick('destroy');
                } 

                if($(window).width() < 438){
                    // Slick carousel
                    $('.tm-article-carousel').slick({
                        infinite: false,
                        dots: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    });
                }
                else {
                 $('.tm-article-carousel').slick({
                        infinite: false,
                        dots: true,
                        slidesToShow: 2,
                        slidesToScroll: 1
                    });   
                }
            }

            function setPageNav(){
                if($(window).width() > 991) {
                    $('#tm-top-bar').singlePageNav({
                        currentClass:'active',
                        offset: 79
                    });   
                }
                else {
                    $('#tm-top-bar').singlePageNav({
                        currentClass:'active',
                        offset: 65
                    });   
                }
            }

            function togglePlayPause() {
                vid = $('.tmVideo').get(0);

                if(vid.paused) {
                    vid.play();
                    $('.tm-btn-play').hide();
                    $('.tm-btn-pause').show();
                }
                else {
                    vid.pause();
                    $('.tm-btn-play').show();
                    $('.tm-btn-pause').hide();   
                }  
            }
       
            $(document).ready(function(){

                $(window).on("scroll", function() {
                    if($(window).scrollTop() > 100) {
                        $(".tm-top-bar").addClass("active");
                    } else {
                        //remove the background property so it comes transparent again (defined in your css)
                       $(".tm-top-bar").removeClass("active");
                    }
                });      

                // Google Map
                loadGoogleMap();  

                // Date Picker
                const pickerCheckIn = datepicker('#inputCheckIn');
                const pickerCheckOut = datepicker('#inputCheckOut');
                
                // Slick carousel
                setCarousel();
                setPageNav();

                $(window).resize(function() {
                  setCarousel();
                  setPageNav();
                });

                // Close navbar after clicked
                $('.nav-link').click(function(){
                    $('#mainNav').removeClass('show');
                });

                // Control video
                $('.tm-btn-play').click(function() {
                    togglePlayPause();                                      
                });

                $('.tm-btn-pause').click(function() {
                    togglePlayPause();                                      
                });

                // Update the current year in copyright
                $('.tm-current-year').text(new Date().getFullYear());                           
            });

            //check login click
            document.getElementById("login").addEventListener("click", login);

            function login() {
                location.replace('login.php');
            }

            //check panel-admin click----------------------------------------------

            function panelAdmin() {
                location.replace('Admin/dashboard.php');
            }
            //check panel-admin click end------------------------------------------

            //check panel-customer click----------------------------------------------

            function panelCustomer() {
                location.replace('Customer/dashboard.php');
            }
            //check panel-admin click end------------------------------------------

        </script>             

</body>
</html>

