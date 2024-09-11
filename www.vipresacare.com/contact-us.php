
<?php
define("DBNAME", "health");
define("DBUSER", "root");
define("DBPASS", "");

try {
    $conn = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSER, DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array();

    // Validation
    if (empty($_POST['first_name'])) {
        $error['first_name'] = "Enter First Name";
    }
    if (empty($_POST['last_name'])) {
        $error['last_name'] = "Enter Last Name";
    }
    if (empty($_POST['email_address'])) {
        $error['email_address'] = "Enter Email Address";
    }
    if (empty($_POST['phone_number'])) {
        $error['phone_number'] = "Enter Phone Number";
    }

    if (empty($_POST['enquiry'])) {
        $error['enquiry'] = "Enter Enquiry";
    }
 

    

    // Check if email already exists
    if (empty($error)) {
        $statement = $conn->prepare("SELECT * FROM enquiries WHERE email_address = :email_address");
        $statement->bindParam(":email_address", $_POST['email_address']);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $error['email_address'] = "Email already exists";
        }
    }

    // Insert data into the database
    if (empty($error)) {
        $cv = file_get_contents($_FILES['cv']['tmp_name']);
        $stmt = $conn->prepare("INSERT INTO enquiries (first_name, last_name, email_address,phone_number, enquiry, time_created, date_created) 
            VALUES (:first_name,  :email_address,:phone_number, :enquiry, NOW(), NOW())");
        $stmt->execute([
            ':first_name' => $_POST['first_name'],
            ':email_address' => $_POST['email_address'],
            ':phone_number' => $_POST['phone_number'],

            ':enquiry' => $_POST['enquiry'],
            
        ]);

        header("Location: home.php");
        exit();
    } else {
        foreach ($error as $err) {
            echo $err . "<br>";
        }
    }
}
?>



  

<!DOCTYPE html>
<html>

 <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="format-detection" content="telephone=no">
<meta name="theme-color" content="#009A93"/>
<title>VIPRESA Care - Contact Us</title>
<meta name="description" content="VIPRESA Care | Health Care">
<meta name="keywords" content="VIPRESA Care, health, healthcare, care worker, hospital, live in care, mental healthcare, learning disabilities, nurses, dementia, physical disabilities,terminal illness, learning diffculties">

<!-- SOCIAL MEDIA META -->
<meta property="og:description" content="VIPRESA Care | Health Care">
<meta property="og:image" content="oyindolapo_favicon.png">
<meta property="og:site_name" content="VIPRESA Care - Contact Us">
<meta property="og:title" content="VIPRESA Care">
<meta property="og:type" content="website">
<meta property="og:url" content="/">

<!-- TWITTER META -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@VIPRESA Care">
<meta name="twitter:creator" content="@VIPRESA Care">
<meta name="twitter:title" content="VIPRESA Care - Contact Us">
<meta name="twitter:description" content="VIPRESA Care | Health Care">
<meta name="twitter:image" content="oyindolapo_favicon.png">
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<link rel="shortcut icon" href="oyindolapo_favicon.png" type="image/x-icon">
<link rel="icon" href="oyindolapo_favicon.png" type="image/x-icon">
<link rel="stylesheet" href="da/assets/fonts/material/css/materialdesignicons.min.css">
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&amp;family=Roboto:wght@300;400;500;700;900&amp;family=Titillium+Web:wght@300;400;600;700&amp;display=swap" rel="stylesheet">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

<div class="page-wrapper">

    <!-- Preloader -->
	<div class="preloader"></div>
	<!-- End Preloader -->

    <!-- Main Header-->
    <header class="main-header header-style-three">

		<!-- Header Top -->
        <div class="header-top style-three">
            <div class="auto-container">
                <div class="clearfix">

					<!-- Top Left -->
                    <div class="top-left pull-left clearfix">

						<!-- Info List -->
                        <!-- <ul class="info-list">
							<li><span>Call Us: </span><a href="tel:+123-456-7890"> +1 (800) 123-4567</a></li>
							<li><span>Support:</span><a href="mailto:info@yourcompany.com"> info@yourcompany.com</a></li>
						</ul> -->

                    </div>

					<!-- Top Right -->
					<div class="top-right pull-right clearfix">
            <ul class="info-list">
  <li style="color: white; text-shadow: 2px 2px 4px #000000;"><span>Call Us: </span><a href="tel:02030894674">02030894674</a></li>
  <li style="color: white; text-shadow: 2px 2px 4px #000000;"><span>Support:</span><a href="mailto:info@oyindolapocare.com"> info@oyindolapocare.com</a></li>
</ul>
					</div>

                </div>
            </div>
        </div>

    	<!--Header-Upper-->
        <div class="header-upper">
        	<div class="auto-container">
            	<div class="clearfix">

                	<div class="pull-left logo-box">
                    	<div class="logo pt-4 pb-2"><a href="index.html"><img src="../oyindolapo/uploads/166226262321711filename.jpg" style="wigdth:150px; height:50px;" alt="" title=""></a></div>
                    </div>
                      	<div class="nav-outer clearfix">
						<!-- Mobile Navigation Toggler -->
                        <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
						<!-- Main Menu -->
						<nav class="main-menu navbar-expand-md">
							<div class="navbar-header">
								<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>

							<div class="navbar-collapse show collapse clearfix" id="navbarSupportedContent">
								<ul class="navigation clearfix">
                                    <li style="color: #fff; text-shadow: 0 0 4px #000"><a href="home.html">Home</a></li>
									 
									<li style="color: #fff; text-shadow: 0 0 4px #000"><a href="services.html">Services</a></li>
                                    <li style="color: #fff; text-shadow: 0 0 4px #000"><a href="team.html">Our Team</a></li>
                                    <li style="color: #fff; text-shadow: 0 0 4px #000"><a href="contact-us.html">Contact Us</a></li>
                                   <!-- <li style="color: #fff; text-shadow: 0 0 4px #000"><a href="/book-appointment">Book Appointment</a></li>-->
								    <li style="color: #fff; text-shadow: 0 0 4px #000"><a href="care-worker-application.php">Apply as a Care worker</a></li>
                                    								</ul>
							</div>

						</nav>

					</div>

                </div>
            </div>
        </div>
        <!--End Header Upper-->

		<!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon lnr lnr-cross"></span></div>

            <nav class="menu-box">
               <!-- <div class="nav-logo"><a href="/"><img src="https://oyindolapo/uploads/166226262321711filename.jpg" alt="" title=""></a></div> -->
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            </nav>
        </div><!-- End Mobile Menu -->

    </header>
    <!--End Main Header -->
 	<!-- Page Title -->
     <section class="page-title" style="background-image: url(../oyindolapo/images/background/16.jpg)">
 		<div class="pattern-layer" style="background-image: url(images/main-slider/pattern-2.png)"></div>
         <div class="auto-container">
			<h1>Contact Us</h1>
			<ul class="bread-crumb clearfix">
				<li><a href="index.html">Home</a></li>
				<li>Contact Us</li>
			</ul>
        </div>
    </section>
    <!--End Page Title-->

	<!-- Contact Page Section -->
	<section class="contact-page-section">
		<div class="auto-container">
			<div class="inner-container">

				<!-- Sec Title -->
				<div class="sec-title centered">
					<h2>Get In Touch</h2>
				</div>

				<!-- Contact Form -->
                <div class="pb-3">
    <h5 id="error">
        <?php
        if (!empty($error)) {
            foreach ($error as $err) {
                echo "<div class='error-message'>" . $err . "</div>";
            }
        }
        ?>
    </h5>
</div>
<form method="POST" enctype="multipart/form-data">

						<div class="row clearfix">

							<div class="form-group col-lg-6 col-md-6 col-sm-12">
								<input type="text"  id="input_first_name" placeholder="First Name*" required>
							</div>

							<div class="form-group col-lg-6 col-md-6 col-sm-12">
								<input type="text" id="input_last_name" placeholder="Last Name*" required>
							</div>

              <div class="form-group col-lg-6 col-md-6 col-sm-12">
								<input type="email" id="input_email" placeholder="Email Address*" required>
							</div>
              <div id="hide" class="form-group col-lg-6 col-md-6 col-sm-12">
								<input type="text" id="bot_hide">
							</div>

							<div class="form-group col-lg-6 col-md-6 col-sm-12">
								<input type="text" id="input_phone_number" placeholder="Phone Number*" required>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12 form-group">
								<textarea class="" id="text_message" placeholder="Write your enquiry"></textarea>
							</div>


              <div class="col-lg-12 col-md-12 col-sm-12 form-group">
								<input type="checkbox"  id="callback" value="Yes, call back" style="width: 30px; height: 30px">
                <label>Would you like to request a call back?</label>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12 form-group">
								<button class="theme-btn submit-btn btn-style-one" type="submit" id="submit"><span class="txt">Submit Your Enquiry</span></button>
							</div>

						</div>
				</div>

			</div>
		</div>
	</section>
	<!-- End Contact Page Section -->

	<!-- Contact Info Section -->
	<section class="contact-info-section">
		<div class="auto-container">
			<div class="container">

				<!-- Sec Title -->
				<div class="sec-title centered">
					<h2>Contact Information</h2>
					<!-- <div class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit,<br> sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</div> -->
				</div>

				<div class="row clearfix">

					<!-- Info Column -->
					<div class="info-column col-lg-3 col-md-6 col-sm-12">
						<div class="inner-column">
							<div class="icon-box">
								<span class="icon fa fa-phone"></span>
							</div>
							<h6>Phone</h6>
							<ul>
                <li><a href="tel:02030894674">02030894674</a></li>
                <span>Out of work hours:</span>
								<li><a href="tel:+44(730) 756-2773">+44(730) 756-2773</a></li>
							</ul>
						</div>
					</div>

					<!-- Info Column -->
					<div class="info-column col-lg-3 col-md-6 col-sm-12">
						<div class="inner-column">
							<div class="icon-box">
								<span class="icon fa fa-map-marker"></span>
							</div>
							<h6>Address</h6>
							<div class="text">55 John walsh tower,Montague Road, London,E11, 3ES</div>
						</div>
					</div>

					<!-- Info Column -->
					<div class="info-column col-lg-3 col-md-6 col-sm-12">
						<div class="inner-column">
							<div class="icon-box">
								<span class="icon fa fa-envelope"></span>
							</div>
							<h6>Email</h6>
							<ul>
								<li><a href="mailto:info@oyindolapocare.com">info@oyindolapocare.com</a></li>
								<li><a href="mailto:info@oyindolapocare.com">info@oyindolapocare.com</a></li>
							</ul>
						</div>
					</div>

					<!-- Info Column -->
					<div class="info-column col-lg-3 col-md-6 col-sm-12">
						<div class="inner-column">
							<div class="icon-box">
								<span class="icon fa fa-home"></span>
							</div>
							<h6>Office Hours</h6>
							<ul>
						                                <li>Mon-Fri: 9:00am - 5:00pm </li>
                                                         <li>Saturday: 10:00am - 4:00pm </li>
                                                         <li>Sunday: 12:00pm - 3:00pm </li>
                           							</ul>
						</div>
					</div>


				</div>

			</div>
		</div>
	</section>
	<!-- End Contact Info Section -->
	
<!-- Main Footer -->
  <footer class="main-footer style-three" style="background-color:#003331">
  <div class="pattern-layer" style="background-image: url(images/background/pattern-7.png)"></div>
  <div class="curve-layer" style="background-image: url(images/background/pattern-8.png)"></div>
  <div class="auto-container">

    <!-- Upper Box -->
    <div class="upper-boxed">
      <div class="inner-container">
        <div class="clearfix">
          <div class="pull-left">
            <div class="appointment"><span class="icon flaticon-telephone"></span>Call For An Appointment</div>
          </div>
          <div class="pull-right">
            <a class="phone" href="tel:02030894674">02030894674</a>
          </div>
        </div>
      </div>
    </div>
    <!-- End Upper Box -->

        <!-- Widgets Section -->
          <div class="widgets-section">
            <div class="row clearfix">

                  <!-- Big Column -->
                  <div class="big-column col-lg-6 col-md-12 col-sm-12">
                      <div class="row clearfix">

            <!--Footer Column-->
                          <div class="footer-column col-lg-7 col-md-6 col-sm-12">
                              <div class="footer-widget logo-widget">
                <div class="logo">
                  <a href="index.html"><img src="../oyindolapo/uploads/166226262321711filename.jpg" style="wigdth:150px; height:50px;" alt="" title=""></a>
                </div>
                <div class="text"> ...Compassionate Care with a Decade of Excellence... We provide...</div>
                <div class="social-box">
                  <a href="http://facebook.com/" class="fab fa-facebook-square"></a>
                  <a href="http://twitter.com/" class="fab fa-twitter-square"></a>
                  <a href="http://linkedin.com/in/" class="fab fa-linkedin"></a>
                </div>
              </div>
            </div>

            <!--Footer Column-->
                          <div class="footer-column col-lg-5 col-md-6 col-sm-12">
                              <div class="footer-widget links-widget">
                <h4>About Us</h4>
                <ul class="links-widget">
                  <li><a href="about-us.html">About us</a></li>
                  <li><a href="team.html">Our Team</a></li>
                  <li><a href="contact-us.html">Contact</a></li>
                  <li><a href="privacy-and-policy.html">Privacy & Policy</a></li>
                  <!-- <li><a href="#">Reviews</a></li>
                  <li><a href="#">Blogs</a></li>
                  <li><a href="#">Newsletter</a></li> -->
                </ul>
              </div>
            </div>

          </div>
        </div>

        <!-- Big Column -->
                  <div class="big-column col-lg-6 col-md-12 col-sm-12">
                      <div class="row clearfix">



            <!--Footer Column-->
            <div class="footer-column col-lg-6 col-md-6 col-sm-12">
              <div class="footer-widget links-widget">
                <h4>Quick Links</h4>
                <ul class="links-widget">
                  <li><a href="index.html">home</a></li>
                  <li><a href="services.html">Services</a></li>
                  <!-- <li><a href="/book-appointment">Book Appointment</a></li> -->
                </ul>
              </div>
            </div>
            <div class="footer-column col-lg-6 col-md-6 col-sm-12">
              <div class="footer-widget links-widget">
                <h4>Apply</h4>
                <ul class="links-widget">
                  <li><a href="care-worker-application.php">Apply as Care Worker</a></li>
                  <li><a href="login.html">Sign In</a></li>
                  <!-- <li><a href="/about-us">About us</a></li> -->
                  <!-- <li><a href="/book-appointment">Book Appointment</a></li> -->
                </ul>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <div class="auto-container">
      <div class="copyright">Copyright &copy; 2024 Developed by <a href="https://wa.me/2348101216920">Oyindolapo Tech.</a> </div>
    </div>
  </div>

</footer>

</div>
<!--End pagewrapper-->

<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-circle-up"></span></div>

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/typeit.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/parallax.min.js"></script>
<script src="js/tilt.jquery.min.js"></script>
<script src="js/jquery.paroller.min.js"></script>
<script src="js/mixitup.js"></script>
<script src="js/validate.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/script.js"></script>
<script src="js/sweetalert2.all.min.js"></script>

</script>

</body>

 </html>


  <script type="text/javascript">
  const submit = document.querySelector("#submit");
  const hideElement = document.querySelector("#hide");
  const firstName = document.querySelector("#input_first_name");
  const lastName = document.querySelector("#input_last_name");
  const email = document.querySelector("#input_email");
  const phoneNumber = document.querySelector("#input_phone_number");
  const textMessage = document.querySelector("#text_message");
  const callBack = document.querySelector("#callback");

  hideElement.style.display = "none";

  submit.addEventListener('click', function() {
    cleanFirstName = firstName.value.trim();
    cleanLastName = lastName.value.trim();
    cleanEmail = email.value.trim();
    cleanNumber = phoneNumber.value.trim();
    cleanTextMessage = textMessage.value.trim();
    cleanCallBack = callBack.value.trim();

    if (cleanFirstName == "" || cleanNumber == "" || cleanLastName == "" || cleanEmail == "" || cleanNumber == "" ||
    cleanTextMessage == "") {
      const errorBoard = document.querySelector("#error");
      errorBoard.innerHTML = "All Fields Are Required"
      errorBoard.style.color = "red";
    } else {

      var method = "POST";
      var url = "/contact-backend";
      var param = 'input_first_name='+cleanFirstName;
      param += "&input_last_name="+cleanLastName;
      param += "&input_phone_number="+cleanNumber;
      param += "&input_email="+cleanEmail;
      param += "&text_message="+cleanTextMessage;

      var xhr = new XMLHttpRequest();

      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var res = JSON.parse(xhr.responseText);
          console.log(res)
          if (res.success) {
            swal.fire("Success!", "Message Sent. Thanks for contacting us. We'll reach out to you as soon as possible.", "success");
            setTimeout(function(){window.location.reload();
            }, 5000);

          }
          if (res.failed) {
            swal.fire("Notice!", "Message not sent. Please try again after some time!", "error");
          }
        }
      }
      xhr.open(method, url, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
      xhr.send(param);
    }


  },false)


  </script>
