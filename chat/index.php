<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Skoogle Chatroom</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
	#login_form{
		width:350px;
		height:350px;
		position:relative;
		top:50px;
		margin: auto;
		padding: auto;
	}
	.footer_area {
  background: url("../images/footer.jpg") no-repeat;
  position: relative;
  background-size: cover;
  background-position: center;
  z-index: 1;
  margin-top: 200px;
}
.footer_area:after {
  content: "";
  position: absolute;
  top: 0;
  background-color: rgba(0, 0, 0, 0.8);
  left: 0;
  right: 0;
  bottom: 0;
  display: block;
  z-index: -1;
}
.footer_area .footer_row {
  padding-top: 95px;
  padding-bottom: 50px;

}
.footer_area .footer_row .footer_about {
  padding-bottom: 50px;
}
.footer_area .footer_row .footer_about h2 {
  font: 400 18px "Oswald", sans-serif;
  text-transform: uppercase;
  color: #fff;
  padding-bottom: 25px;
}
.footer_area .footer_row .footer_about img {
  max-width: 100%;
}
.footer_area .footer_row .footer_about p {
  font: 400 14px/26px "Oswald", sans-serif;
  color: #fefefe;
  padding-top: 22px;
}
.footer_area .footer_row .footer_about .socail_icon {
  padding: 0;
  margin: 0;
  padding-top: 25px;
}
.footer_area .footer_row .footer_about .socail_icon li {
  display: inline-block;
  list-style: none;
  padding-left: 8px;
}
.footer_area .footer_row .footer_about .socail_icon li:first-child {
  padding: 0;
}
.footer_area .footer_row .footer_about .socail_icon li a {
  border: 2px solid #f6b60b;
  display: block;
  line-height: 26px;
  width: 30px;
  text-align: center;
  position: relative;
  z-index: 1;
}
.footer_area .footer_row .footer_about .socail_icon li a:after {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  background: #f6b60b;
  z-index: -1;
  transform: scaleY(0);
  transform-origin: 50%;
  transition-property: transform;
  transition-duration: 0.3s;
  transition-timing-function: ease-out;
}
.footer_area .footer_row .footer_about .socail_icon li a i {
  font-size: 14px;
  color: #fff;
  display: inline-block;
  padding-top: 7px;
}
.footer_area .footer_row .footer_about .socail_icon li a:hover:after, .footer_area .footer_row .footer_about .socail_icon li a:focus:after {
  transform: scaleY(1);
}
.footer_area .footer_row .footer_about .quick_link {
  padding: 0;
  margin: 0;
}
.footer_area .footer_row .footer_about .quick_link li {
  list-style: none;
}
.footer_area .footer_row .footer_about .quick_link li a {
  font: 400 14px/28px "Roboto", sans-serif;
  color: #fefefe;
  position: relative;
  padding-left: 30px;
}
.footer_area .footer_row .footer_about .quick_link li a i {
  font-size: 14px;
  color: #f6b60b;
  padding-right: 20px;
  position: absolute;
  left: 0;
  bottom: 0;
  transition: all 300ms linear 0s;
}
.footer_area .footer_row .footer_about .quick_link li a:hover, .footer_area .footer_row .footer_about .quick_link li a:focus {
  color: #f6b60b;
}
.footer_area .footer_row .footer_about .quick_link li a:hover i, .footer_area .footer_row .footer_about .quick_link li a:focus i {
  left: 8px;
}
.footer_area .footer_row .footer_about .twitter {
  font: 400 14px/28px "Roboto", sans-serif;
  color: #fefefe;
  display: block;
  padding-bottom: 15px;
}
.footer_area .footer_row .footer_about .twitter:hover, .footer_area .footer_row .footer_about .twitter:focus {
  color: #f6b60b;
}
.footer_area .footer_row .footer_about address p {
  font: 400 14px/28px "Roboto", sans-serif;
  color: #fff;
  padding: 0;
}
.footer_area .footer_row .footer_about address .my_address {
  padding: 0;
  margin: 0;
  padding-top: 15px;
}
.footer_area .footer_row .footer_about address .my_address li {
  list-style: none;
}
.footer_area .footer_row .footer_about address .my_address li a {
  font: 400 14px/28px "Roboto", sans-serif;
  color: #fff;
}
.footer_area .footer_row .footer_about address .my_address li a i {
  color: #f6b60b;
  padding-right: 20px;
  font-size: 14px;
  display: inline-block;
}
.footer_area .footer_row .footer_about address .my_address li a:hover, .footer_area .footer_row .footer_about address .my_address li a:focus {
  color: #f6b60b;
}
.footer_area .footer_row .footer_about address .my_address li span {
  display: inline-block;
  padding-left: 35px;
  margin-top: -30px;
}
.footer_area .copyright_area {
  background: #090909;
  font: 400 14px/100px "Roboto", sans-serif;
  color: #fefefe;
  text-align: center;
}
.footer_area .copyright_area a {
  font-weight: 700;
  font-size: 14px;
  text-transform: uppercase;
  color: #f6b60b;
}
.footer_area .copyright_area a:hover, .footer_area .copyright_area a:focus {
  color: #fefefe;
}

/* Top header */
.top_header_area {
  background: #111f29;
  margin-bottom: -50px;
}
.top_header_area .top_nav li a {
  font: 400 12px/50px "Roboto", sans-serif;
  color: #fff;
  padding: 0;
  padding-left: 40px;
  margin-left: -30px;
}
.top_header_area .top_nav li a i {
  color: #f6b60b;
  font-size: 18px;
  padding-right: 10px;
}
.top_header_area .top_nav li a:hover, .top_header_area .top_nav li a:focus {
  background-color: transparent;
  color: #f6b60b;
}
.top_header_area .top_nav li:first-child a {
  padding: 0;
}
.top_header_area .social_nav {
  margin: 0;
  padding-top: 12px;
}
.top_header_area .social_nav li a {
  font-size: 14px;
  color: #fff;
  padding: 0;
  text-align: center;
  height: 24px;
  width: 24px;
  border-radius: 50%;
  margin-left: 10px;
}
.top_header_area .social_nav li a i {
  line-height: 24px;
}
.top_header_area .social_nav li a:hover, .top_header_area .social_nav li a:focus {
  background: #f6b60b;
  color: #111f29;
}

/* End Top header */
/* Top header 2 */
.top_header_area.top_header {
  background-color: transparent;
  position: relative;
  overflow: hidden;
}
.top_header_area.top_header .right_top_header {
  background: #111f29;
  display: block;
  overflow: hidden;
  padding-left: 20px;
}
.top_header_area.top_header .right_top_header:after {
  content: "";
  position: absolute;
  right: 0;
  width: 50%;
  background: #111f29;
  height: 50px;
  z-index: -1;
}
/* Header Aera */
.header_aera {
  background: #fff;
  border-radius: 0;
  border: 0;
  margin: 0;
  width: 100%;
margin: 2px;
  z-index: 9999;
  top: 0;
  box-shadow: 0px 0px 20px 0px rgba(21, 47, 95, 0.2);
}
.header_aera .searchForm {
  height: 0px;

  overflow: hidden;
  transition: all 300ms linear 0s;

}
.header_aera .searchForm .input-group-addon {
  border-radius: 0;
  border: none;
  font-size: 14px;
  padding: 0 45px;
  background: #f6b60b;
  color: #fff;
  cursor: pointer;
}
.header_aera .searchForm .form-control {
  height: 79px;
  padding: 0 15px;
  border-radius: 0;
  border: none;
  color: #fff;
  background: #f6b60b;
  text-align: center;
  font: 400 16px "Roboto", sans-serif;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
}
.header_aera .searchForm .form-control.placeholder {
  font: 400 16px "Roboto", sans-serif;
  color: #fff;
}
.header_aera .searchForm .form-control:-moz-placeholder {
  font: 400 16px "Roboto", sans-serif;
  color: #fff;
}
.header_aera .searchForm .form-control::-webkit-input-placeholder {
  font: 400 16px "Roboto", sans-serif;
  color: #fff;
}
.header_aera .show {
  height: 80px;
  border-bottom: 1px solid transparent;
}
.header_aera .navbar-header .navbar-brand {
  padding-top: 39px;
  margin-top: -60px;

}
.header_aera .navbar-header .navbar-brand img {
  max-width: 100%;
}
.header_aera .navbar-collapse .navbar-nav.navbar-right li a {
  font: 700 14px/100px "Roboto", sans-serif;
  color: #222222;
  text-transform: uppercase;
  padding: 0;
  padding-left: 30px;
}
.header_aera .navbar-collapse .navbar-nav.navbar-right li a:hover, .header_aera .navbar-collapse .navbar-nav.navbar-right li a:focus {
  color: #f6b60b;
}
.header_aera .navbar-collapse .navbar-nav.navbar-right li .nav_searchFrom {
  width: 100px;
  background: #f6b60b;
  color: #fff;
  padding: 0;
  text-align: center;
  margin-left: 15px;
}
.header_aera .navbar-collapse .navbar-nav.navbar-right li .nav_searchFrom:hover, .header_aera .navbar-collapse .navbar-nav.navbar-right li .nav_searchFrom:focus {
  color: #222222;
}
@media (min-width: 768px) {
  .header_aera .navbar-collapse .navbar-nav.navbar-right li.submenu .other_dropdwn {
    margin-right: -122px;
  }
}
.header_aera .navbar-collapse .navbar-nav.navbar-right li.submenu ul {
  border: none;
  box-shadow: none;
  border-radius: 0px;
  min-width: 190px;
  transition: all 500ms ease-in-out;
  background: #f6b60b;
}
@media (min-width: 768px) {
  .header_aera .navbar-collapse .navbar-nav.navbar-right li.submenu ul {
    margin-right: -150px;
    display: block;
    transform: rotateX(-90deg);
    transform-origin: top;
  }
}
.header_aera .navbar-collapse .navbar-nav.navbar-right li.submenu ul li {
  display: block;
}
.header_aera .navbar-collapse .navbar-nav.navbar-right li.submenu ul li a {
  line-height: normal;
  font: 700 14px/normal "Roboto", sans-serif;
  padding: 12px 8px;
  display: block;
}
.header_aera .navbar-collapse .navbar-nav.navbar-right li.submenu ul:before {
  content: "";
  width: 100%;
  height: 5px;
  background: #222222;
  position: absolute;
  top: 0px;
  transform: translateZ(0);
  backface-visibility: hidden;
  transform: scaleX(0);
  transform-origin: 0 50%;
  transition: all 800ms ease-in-out;
}
.header_aera .navbar-collapse .navbar-nav.navbar-right li.submenu ul:after {
  content: "";
  width: 100%;
  height: 5px;
  position: absolute;
  bottom: 0px;
  background: #222222;
  transform: translateZ(0);
  backface-visibility: hidden;
  transform: scaleX(0);
  transform-origin: 100% 50%;
  transition: all 800ms ease-in-out;
}
@media (min-width: 768px) {
  .header_aera .navbar-collapse .navbar-nav.navbar-right li:hover.submenu ul {
    transform: rotateX(0deg);
  }
  .header_aera .navbar-collapse .navbar-nav.navbar-right li:hover.submenu ul:before {
    transform: scaleX(1);
  }
  .header_aera .navbar-collapse .navbar-nav.navbar-right li:hover.submenu ul:after {
    transform: scaleX(1);
  }
}

/* End Header Aera */

</style>
  <!-- Favicon -->
    <link rel="icon" href="images/favicon.png" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link href="vendors/animate/animate.css" rel="stylesheet">
    <!-- Icon CSS-->
	<link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <!-- Camera Slider -->
    <link rel="stylesheet" href="vendors/camera-slider/camera.css">
    <!-- Owlcarousel CSS-->
	<link rel="stylesheet" type="text/css" href="vendors/owl_carousel/owl.carousel.css" media="all">

    <!--Theme Styles CSS-->
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default header_aera" id="main_navbar">
        <div class="container">
            <!-- searchForm -->
            <div class="searchForm">
                <form action="#" class="row m0">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="search" name="search" class="form-control" placeholder="Type & Hit Enter">
                        <span class="input-group-addon form_hide"><i class="fa fa-times"></i></span>
                    </div>
                </form>
            </div><!-- End searchForm -->
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="col-md-2 p0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#min_navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt=""></a>
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="col-md-10 p0">
                <div class="collapse navbar-collapse" id="min_navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="newsfeed.html">Newsfeed</a></li>
                        <li><a href="articles.html">Articles</a></li>
                        
                        
                        <li class="dropdown submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Skills & Services</a>
                            <ul class="dropdown-menu other_dropdwn">
                                <li><a href="services.html">Internet of Things</a></li>
                                <li><a href="services.html">Artificial Intelligence</a></li>
                                <li><a href="services.html">Cyber Security</a></li>
                                <li><a href="services.html">Crawling & Scraping</a></li>
                                <li><a href="services.html">Programming Languages</a></li>
                                <li><a href="services.html">Others</a></li>
                                
                            </ul>
                        </li>
                        <li><a href="career.html">Career</a></li>
                        <li><a href="forum.html">Forum</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="#" class="nav_searchFrom"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div><!-- /.container -->
    </nav>
<!-----------------------------NAVVVVVVVVVVVVVVV SKKKKKKKKOOOOOOOOOOOOOOOOOOOOOGLEEEE------------------------->
    <div class="container">
	<div id="login_form" class="well">
		<h2><center><span class="glyphicon glyphicon-lock"></span> Please Login</center></h2>
		<hr>
		<form method="POST" action="login.php">
		Username: <input type="text" name="username" class="form-control" required>
		<div style="height: 10px;"></div>		
		Password: <input type="password" name="password" class="form-control" required> 
		<div style="height: 10px;"></div>
		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Login</button> No account? <a href="signup.php"> Sign up</a>
		</form>
		<div style="height: 15px;"></div>
		<div style="color: red; font-size: 15px;">
			<center>
			<?php
				session_start();
				if(isset($_SESSION['msg'])){
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
			?>
			</center>
		</div>
	</div>
</div>
  <footer class="footer_area">
        <div class="container">
            <div class="footer_row row">
                <div class="col-md-3 col-sm-6 footer_about">
                    <h2>ABOUT OUR COMPANY</h2>
                    <img src="images/footer-logo.png" alt="">
                    <p>Skoogle is working with many organizations to seek the hidden skills of emplyees to utilize them for benefitting the whole company.</p>
                    <ul class="socail_icon">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 footer_about quick">
                    <h2>Quick links</h2>
                    <ul class="quick_link">
                        <li><a href="#"><i class="fa fa-chevron-right"></i>Internet of Things</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i>Artificial Intelligence</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i>Cyber Security</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i>Crawling & Scraping</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i>Programming Languages</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i>Others</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 footer_about">
                    <h2>Twitter Feed</h2>
                    <a href="#" class="twitter">@skoogle: if your world seems dark to you, you haven't sought the light properly.</a>
                    <a href="#" class="twitter">@skoogle: believe in the start that is hiding behind the cloud and will eventually appear.</a>
                </div>
                <div class="col-md-3 col-sm-6 footer_about">
                    <h2>CONTACT US</h2>
                    <address>
                        <p>Have questions, comments or just want to say hello:</p>
                        <ul class="my_address">
                            <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>info@skoogle.com</a></li>
                            <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i>(+92) 334 9096226</a></li>
                            <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><span>H-9 Khayaban Iqbal, Islamabad </span></a></li>
                        </ul>
                    </address>
                </div>
            </div>
        </div>
        <div class="copyright_area">
            Copyright 2019 All rights reserved. Designed by <a href="https://colorlib.com">Abbas Kizilbash.</a>
        </div>
    </footer>
    <!-- End Footer Area -->

    <!-- jQuery JS -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Animate JS -->
    <script src="vendors/animate/wow.min.js"></script>
    <!-- Camera Slider -->
    <script src="vendors/camera-slider/jquery.easing.1.3.js"></script>
    <script src="vendors/camera-slider/camera.min.js"></script>
    <!-- Isotope JS -->
    <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope.pkgd.min.js"></script>
    <!-- Progress JS -->
    <script src="vendors/Counter-Up/jquery.counterup.min.js"></script>
    <script src="vendors/Counter-Up/waypoints.min.js"></script>
    <!-- Owlcarousel JS -->
    <script src="vendors/owl_carousel/owl.carousel.min.js"></script>
    <!-- Stellar JS -->
    <script src="vendors/stellar/jquery.stellar.js"></script>
    <!-- Theme JS -->
    <script src="js/theme.js"></script>

</body>
</html>