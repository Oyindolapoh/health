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
    if (empty($_POST['applicant_name'])) {
        $error['applicant_name'] = "Enter Applicant Name";
    }
    if (empty($_POST['phone_number'])) {
        $error['phone_number'] = "Enter Phone Number";
    }
    if (empty($_POST['email_address'])) {
        $error['email_address'] = "Enter Email Address";
    }
    if (empty($_POST['home_address'])) {
        $error['home_address'] = "Enter Home Address";
    }
    if (empty($_POST['years_of_experience'])) {
        $error['years_of_experience'] = "Enter Years of Experience";
    }
    if (empty($_POST['other_information'])) {
        $error['other_information'] = "Enter Information";
    }
    if (empty($_FILES['cv']['tmp_name'])) {
        $error['cv'] = "Upload CV";
    } else {
        // File type validation
        $allowed_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $file_type = mime_content_type($_FILES['cv']['tmp_name']);
        if (!in_array($file_type, $allowed_types)) {
            $error['cv'] = "CV must be a PDF or DOC file";
        }
    }

    // Check if email already exists
    if (empty($error)) {
        $statement = $conn->prepare("SELECT * FROM applications WHERE email_address = :email_address");
        $statement->bindParam(":email_address", $_POST['email_address']);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $error['email_address'] = "Email already exists";
        }
    }

    // Insert data into the database
    if (empty($error)) {
        $cv = file_get_contents($_FILES['cv']['tmp_name']);
        $stmt = $conn->prepare("INSERT INTO applications (applicant_name, phone_number, email_address, home_address, years_of_experience, cv, other_information, time_created, date_created) 
            VALUES (:applicant_name, :phone_number, :email_address, :home_address, :years_of_experience, :cv, :other_information, NOW(), NOW())");
        $stmt->execute([
            ':applicant_name' => $_POST['applicant_name'],
            ':phone_number' => $_POST['phone_number'],
            ':email_address' => $_POST['email_address'],
            ':home_address' => $_POST['home_address'],
            ':years_of_experience' => $_POST['years_of_experience'],
            ':cv' => $cv,
            ':other_information' => $_POST['other_information']
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

 <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="format-detection" content="telephone=no">
<meta name="theme-color" content="#009A93"/>
<title>firstorder Care - Care Worker Application</title>
<meta name="description" content="oyindolapo Care | Health Care">
<meta name="keywords" content="oyindolapo Care, health, healthcare, care worker, hospital, live in care, mental healthcare, learning disabilities, nurses, dementia, physical disabilities,terminal illness, learning diffculties">


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
  <li style="color: white; text-shadow: 2px 2px 4px #000000;"><span>Call Us: </span><a href="tel:08101216920">08101216920</a></li>
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
                                    <li style="color: #fff; text-shadow: 0 0 4px #000"><a href="contact-us.php">Contact Us</a></li>
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
     <section class="page-title" style="background-image: url(../oyindolapo/uploads/165757858573776filename.jpg)">
		<div class="pattern-layer" style="background-image: url(images/main-slider/pattern-2.png)"></div>
        <div class="auto-container">
			<h1>Apply as a care worker</h1>
			<ul class="bread-crumb clearfix">
				<li><a href="index.html">Home</a></li>
				<li>Fill the form below.</li>
			</ul>
        </div>
    </section>
    <!--End Page Title-->

	<!-- Appointment Section -->
	<section class="appointment-section">
		<div class="auto-container">
			<div class="inner-container">
				<div class="appointment-box">
					<!-- Sec Title -->
					<div class="sec-title centered">
						<h2>Make An Application</h2>
					</div>

					<!-- Appointment Form -->
					<div class="appointment-form">

						<!-- Appointment Form -->
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
        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
            <input type="text" name="applicant_name" id="applicant_name" value="" placeholder="* Applicant Name" required>
        </div>

        <div id="hide" class="col-lg-6 col-md-6 col-sm-12 form-group">
            <input type="text" name="bot_hide">
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
            <input type="text" name="phone_number" id="phone_number" value="" placeholder="* Phone Number" required>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
            <input type="email" id="email_address" value="" name="email_address" placeholder="* Email Address" required>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
            <input type="text" id="home_address" value="" name="home_address" placeholder="* Home Address" required>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
            <input type="text" id="years_experience" value="" name="years_of_experience" placeholder="* Years of Experience" required>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
            <label for="cv">Upload your C.V</label>
            <input type="file" id="cv" name="cv" required>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
            <textarea class="" id="other_information" name="other_information" placeholder="Other Information"></textarea>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
            <input class="theme-btn btn-style-one" id="submit" type="submit" name="submit-application" value="Submit">
        </div>
    </div>
</form>

								</div>


							</div>

					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- End Appointment Section -->


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
                <div class="text">oyindolapo Care is a leading care provider with over 10 years of experience. We provide...</div>
                <div class="social-box">
                  <a href="https://www.facebook.com/profile.php?id=61563392707450&mibextid=LQQJ4d" class="fab fa-facebook-square"></a>
                  <a href="http://twitter.com/" class="fab fa-twitter-square"></a>
                  <a href="https://www.linkedin.com/company/comfort-cove-nursing-home-care/" class="fab fa-linkedin"></a>
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
                  <li><a href="contact-us.php">Contact</a></li>
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
const name = document.querySelector("#name");
const number = document.querySelector("#number");
const email = document.querySelector("#email");
const address = document.querySelector("#address");
const experience = document.querySelector("#experience");
const resume = document.querySelector("#resume");
const information = document.querySelector("#information");

hideElement.style.display = "none";

submit.addEventListener('click', function() {
  cleanName = name.value.trim();
  cleanNumber = number.value.trim();
  cleanEmail = email.value.trim();
  cleanAddress = address.value.trim();
  cleanExperience = experience.value.trim();
  cleanResume = resume.value.trim();
  cleanInformation = information.value.trim();

  if (cleanName == "" || cleanNumber == "" || cleanEmail == "" || cleanAddress == "" ||
  cleanExperience == "" || cleanResume == "" || cleanInformation == "") {
    const errorBoard = document.querySelector("#error");
    errorBoard.innerHTML = "All Fields Are Required"
    errorBoard.style.color = "red";
  } else {

    var method = "POST";
    var url = "/application-backend";
    var param = 'input_name='+cleanName;
    param += "&input_phone_number="+cleanNumber;
    param += "&input_email="+cleanEmail;
    param += "&input_home_address="+cleanAddress;
    param += "&input_experience="+cleanExperience;
    param += "&input_resume="+cleanResume;
    param += "&text_information="+cleanInformation;

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var res = JSON.parse(xhr.responseText);
        console.log(res)
        if (res.success) {
          swal.fire("Success!", "Application Sent!", "success");
          setTimeout(function(){window.location.reload();
          }, 5000);

        }
        if (res.input_email) {
          swal.fire("Notice!", "Application Already Sent By Current Email!", "error");
          setTimeout(function(){window.location.reload();
          }, 5000);
        }
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
    xhr.send(param);
  }


},false)


</script>
