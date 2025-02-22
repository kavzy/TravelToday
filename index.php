<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Travel Today Agency</title>
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">                <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
    <link rel="stylesheet" href="css/tooplate-style.css">                                   <!-- Templatemo style -->
    
                     <!-- Sweet Alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
</head>

    <body>
    <?php

if(isset($_GET['success']))
        {
            echo'<script>
                    swal("Message Sent Success!", Thank You!", "success");
                </script>';
        
        }
        if(isset($_GET['failed']))
        {
            echo'<script>
                    swal("Message Sent Fail!!", "Something went wrong!", "error");
                </script>'; 
        }

    ?>
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
                                    <a class="nav-link" href="#top">Home <span class="sr-only">(current)</span></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#tm-section-4">Packages</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#tm-section-5">Services</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#tm-section-6">Contact Us</a>
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
            <div class="tm-section tm-bg-img" id="tm-section-1">
                <div class="tm-bg-white ie-container-width-fix-2">
                    <div class="container ie-h-align-center-fix">
                        <div class="row">
                            <div class="col-xs-12 ml-auto mr-auto ie-container-width-fix">
                                <form action="search.php" method="POST" class="tm-search-form tm-section-pad-2">
                                    <div class="form-row tm-search-form-row">
                                        <div class="form-group tm-form-element tm-form-element-100">
                                            <i class="fa fa-map-marker fa-2x tm-form-element-icon"></i>
                                            <input name="location" type="text" class="form-control" id="inputCity" placeholder="Type your destination..." required>
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-50">
                                            <i class="fa fa-calendar fa-2x tm-form-element-icon"></i>
                                            <input name="check-in" type="text" class="form-control" id="inputCheckIn" placeholder="Check In">
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-50">
                                            <i class="fa fa-calendar fa-2x tm-form-element-icon"></i>
                                            <input name="check-out" type="text" class="form-control" id="inputCheckOut" placeholder="Check Out">
                                        </div>
                                    </div>
                                    <div class="form-row tm-search-form-row">
                                        <div class="form-group tm-form-element tm-form-element-2">                                            
                                            <select name="adult" class="form-control tm-select" id="adult">
                                                <option value="">Adult</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                            <i class="fa fa-2x fa-user tm-form-element-icon"></i>
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-2">                                            
                                            <select name="children" class="form-control tm-select" id="children">
                                                <option value="">Children</option>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                            <i class="fa fa-user tm-form-element-icon tm-form-element-icon-small"></i>
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-2">
                                            <select name="room" class="form-control tm-select" id="room" required>
                                                <option value="">Room</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                            <i class="fa fa-2x fa-bed tm-form-element-icon"></i>
                                        </div>
                                        <div class="form-group tm-form-element tm-form-element-2">
                                            <button type="submit" name="search" class="btn btn-primary tm-btn-search">Check Availability</button>
                                        </div>
                                      </div>
                                      <div class="form-row clearfix pl-2 pr-2 tm-fx-col-xs">
                                          <a href="#tm-section-6" class="ie-10-ml-auto ml-auto mt-1 tm-font-semibold tm-color-primary">Need Help?</a>
                                      </div>
                                </form>
                            </div>                        
                        </div>      
                    </div>
                </div>                  
            </div>
            
            <div class="tm-section-2">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <h2 class="tm-section-title">We are here to help you?</h2>
                            <p class="tm-color-white tm-section-subtitle">Subscribe to get our newsletters</p>
                            <a href="#" class="tm-color-white tm-btn-white-bordered">Subscribe Newletters</a>
                        </div>                
                    </div>
                </div>        
            </div>
            
            <div class="tm-section tm-position-relative">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" class="tm-section-down-arrow">
                    <polygon fill="#ee5057" points="0,0  100,0  50,60"></polygon>                   
                </svg> 
                <div class="container tm-pt-5 tm-pb-4">
                    <div class="row text-center">
                        <article class="col-sm-12 col-md-4 col-lg-4 col-xl-4 tm-article">
                            <i class="fa tm-fa-6x fa-book tm-color-primary tm-margin-b-20"></i>                          
                            
                            <h3 class="tm-color-primary tm-article-title-1">Online Tour Booking</h3>
                            <p>Pellentesque at velit ante. Duis scelerisque metus vel felis porttitor gravida. Donec at felis libero. Mauris odio tortor.</p>
                           
                        </article>
                        <article class="col-sm-12 col-md-4 col-lg-4 col-xl-4 tm-article">                            
                            <i class="fa tm-fa-6x fa-plane tm-color-primary tm-margin-b-20"></i>
                            <h3 class="tm-color-primary tm-article-title-1">Flight Tickets</h3>
                            <p>Pellentesque at velit ante. Duis scelerisque metus vel felis porttitor gravida. Donec at felis libero. Mauris odio tortor.</p>
                                                       
                        </article>
                        <article class="col-sm-12 col-md-4 col-lg-4 col-xl-4 tm-article">                           
                            <i class="fa tm-fa-6x fa-car tm-color-primary tm-margin-b-20"></i>
                            <h3 class="tm-color-primary tm-article-title-1">Vehicle Facilities</h3>
                            <p>Pellentesque at velit ante. Duis scelerisque metus vel felis porttitor gravida. Donec at felis libero. Mauris odio tortor.</p>
                                                   
                        </article>
                    </div>        
                </div>
            </div>
            
            <div class="tm-section tm-section-pad tm-bg-gray" id="tm-section-4">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                            <div class="tm-article-carousel">
                            <?php
                                   require_once 'Database.php';
                                   $connect = new Database();
                                   $db = $connect->db();
                                   $sql = "SELECT * FROM packages WHERE is_active = 1 LIMIT 10";
                                   $result = mysqli_query($db, $sql);
                                   $packages = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            ?>
                                <?php foreach ($packages as $package): ?>  
                                <?php
                                    $pkgid = $package['id'];
                                 ?>                         
                                <article class="tm-bg-white mr-2 tm-carousel-item">
                                    <img src="img/packages/<?php echo $package['pic']; ?>" height='262' width='370' alt="Image" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2"><?php echo $package['name']; ?></h3></header>
                                        <p><?php echo $package['categories']; ?></p>
                                        <p>Locations - <?php echo $package['locations']; ?></p>
                                        <strong><i class="fa fa-1x fa-clock-o"></i> <?php echo $package['duration']; ?> Days</strong> <br>
                                        <b>$<?php echo $package['adult_price']; ?></b> per person (Adult) <br>
                                         <b>$<?php echo $package['child_price']; ?></b> per person (Child)<br/>
                                        <strong><i class="fa fa-1x fa-bed"></i> <?php echo $package['room']; ?></strong>
                                        <p></p>
                                        <a href="booking.php?id=<?php echo $package['id']; ?>" class="text-uppercase btn-primary tm-btn-primary">Book Now.</a>
                                    </div>                                
                                </article>
                                <?php endforeach;?>
                             
                            </div>    
                        </div>
                        
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-recommended-container">
                            <div class="tm-bg-white">
                                <div class="tm-bg-primary tm-sidebar-pad">
                                    <h3 class="tm-color-white tm-sidebar-title">Recommended Places</h3>
                                    <p class="tm-color-white tm-margin-b-0 tm-font-light">Travel to best places</p>
                                </div>
                                <div class="tm-sidebar-pad-2">
                                    <a href="recommend.php?search=sigiriya" class="media tm-media tm-recommended-item">
                                        <img src="img/recommend/sigiriya.jpg" height="90" width="85" alt="Image">
                                        <div class="media-body tm-media-body tm-bg-gray">
                                            <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Sigiriya</h4>
                                        </div>                                        
                                    </a>
                                    <a href="recommend.php?search=hikkaduwa" class="media tm-media tm-recommended-item">
                                        <img src="img/recommend/hikkaduwa.jpg" height="90" width="85"  alt="Image">
                                        <div class="media-body tm-media-body tm-bg-gray">
                                            <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Hikkaduwa</h4>
                                        </div>
                                    </a>
                                    <a href="recommend.php?search=ella" class="media tm-media tm-recommended-item">
                                        <img src="img/recommend/ella.jpg" height="90" width="85"  alt="Image">
                                        <div class="media-body tm-media-body tm-bg-gray">
                                            <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Ella</h4>
                                        </div>
                                    </a>
                                    <a href="recommend.php?search=nuwara" class="media tm-media tm-recommended-item">
                                        <img src="img/recommend/nuwara.jpg" height="90" width="85"  alt="Image">
                                        <div class="media-body tm-media-body tm-bg-gray">
                                            <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Nuwara Eliya</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="tm-bg-video">
                <div class="overlay">
                    <i class="fa fa-5x fa-play-circle tm-btn-play"></i>
                    <i class="fa fa-5x fa-pause-circle tm-btn-pause"></i>
                </div>
                <video controls loop class="tmVideo">
                    <source src="videos/video.mp4" type="video/mp4">
                    <source src="videos/video.ogg" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
                <div class="tm-section tm-section-pad tm-bg-img" id="tm-section-5">                                                        
                    <div class="container ie-h-align-center-fix">
                        <div class="row tm-flex-align-center">
                            <div class="col-xs-12 col-md-12 col-lg-3 col-xl-3 tm-media-title-container">
                                <h2 class="text-uppercase tm-section-title-2">Our</h2>
                                <h3 class="tm-color-primary tm-font-semibold tm-section-subtitle-2">Services</h3>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-9 col-xl-9 mt-0 mt-sm-3">
                                <div class="ml-auto tm-bg-white-shadow tm-pad tm-media-container">
                                    <article class="media tm-margin-b-20 tm-media-1">
                                        <img src="img/foods.jpg" height="170" width="280" alt="Image">
                                        <div class="media-body tm-media-body-1 tm-media-body-v-center">
                                            <h3 class="tm-font-semibold tm-color-primary tm-article-title-3">Foods</h3>
                                            <p>Integer libero purus, consectetur vitae posuere quis, maximus id diam. Vivamus eget tellus ornare, sollicitudin quam id, dictum nulla. Phasellus finibus rhoncus justo, tempus eleifend neque dictum ac. Aenean metus leo, consectetur non. 
                                            <br><br>
											Etiam aliquam arcu at mauris consectetur scelerisque. Integer elementum justo in orci facilisis ultricies. Pellentesque at velit ante. Duis scelerisque metus vel felis porttitor gravida.</p>
                                        </div>                                
                                    </article>
                                    <article class="media tm-margin-b-20 tm-media-1">
                                        <img src="img/accommodation.jpg"  height="170" width="280" alt="Image">
                                        <div class="media-body tm-media-body-1 tm-media-body-v-center">
                                            <h3 class="tm-font-semibold tm-article-title-3">Accommodation</h3>
                                            <p>Duis accumsan sagittis tortor in ultrices. Praesent tortor ante, fringilla ac nibh porttitor, fermentum commodo nulla.</p>
                                           
                                        </div>                                
                                    </article>
                                    <article class="media tm-margin-b-20 tm-media-1">
                                        <img src="img/vehicles.jpg"  height="170" width="280" alt="Image">
                                        <div class="media-body tm-media-body-1 tm-media-body-v-center">
                                            <h3 class="tm-font-semibold tm-article-title-3">Vehicles</h3>
                                            <p>Nunc in felis aliquet metus luctus iaculis vel et nisi. Nulla venenatis nisl orci, laoreet ultricies massa tristique id.</p>
                                            
                                        </div>                                
                                    </article>
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>           
            
            <div class="tm-section tm-section-pad tm-bg-img tm-position-relative" id="tm-section-6">
                <div class="container ie-h-align-center-fix">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-7">
                            <div id="google-map"></div>        
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-5 mt-3 mt-md-0">
                            <div class="tm-bg-white tm-p-4">
                                <form action="message.php" method="post" class="contact-form">
                                    <div class="form-group">
                                        <input type="text" id="contact_name" name="name" class="form-control" placeholder="Name"  required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" id="contact_email" name="email" class="form-control" placeholder="Email"  required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="contact_subject" name="subject" class="form-control" placeholder="Subject"  required/>
                                    </div>
                                    <div class="form-group">
                                        <textarea id="contact_message" name="message" class="form-control" rows="9" placeholder="Message" required></textarea>
                                    </div>
                                    <button type="submit" name="send_msg" class="btn btn-primary tm-btn-primary">Send Message Now</button>
                                </form>
                            </div>                            
                        </div>
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

