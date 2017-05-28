<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Dana Marino Design - Contact</title>
</head>

<body>
<?php
if(isset($_POST['email'])) {
     
    // CHANGE THE TWO LINES BELOW
    $email_to = "danamarinodesign@gmail.com";
     
    $email_subject = "Design Web Submission";
     
     
    function died($error) {
        // your error code can go here
        echo "Sorry! There were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['comments'])) {
        died('Sorry! There were error(s) found with the form you submitted.');       
    }
     
    $first_name = $_POST['first_name']; // required
    $email_from = $_POST['email']; // required
    $comments = $_POST['comments']; // required
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Name: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Message: ".clean_string($comments)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- place your own success html below -->

<html>
	<head>
		<title>Dana Marino Design - Contact</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="Dana Marino Design offers custom design services for weddings, events, businesses, personal stationery, and more." />
		<meta name="keywords" content="design, stationery, wedding, invitations, corporate branding, identity, web design, print design, logo design" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
        <script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		  
			ga('create', 'UA-50360821-1', 'danamarinodesign.com');
			ga('send', 'pageview');
		</script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
			<link rel="stylesheet" href="css/style-noscript.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body class="contact loading">
	
		<!-- Header -->
			<header id="header">
				<h1 id="logo"><a href="index.html"><img src="images/DM_LOGO.svg" height="60" width="60"/></a></h1>
				<nav id="nav">
					<ul>
                    	<li class="current"><a href="index.html">Home</a></li>
                        <li class="current"><a href="weddings.html">Weddings</a></li>
                        <li class="current"><a href="events.html">Events</a></li>
                        <li class="current"><a href="branding.html">Branding</a></li>
						<li><a href="contact.html" class="button special">Contact</a></li>
					</ul>
				</nav>
			</header>
		
		<!-- Main -->
			<article id="main">

				<header class="special container">
					<span class="logo"><img src="images/DM_LOGO.svg" height="90" width="90"/></span>
				  <h2>Email Sent!</h2>
					<p>Thanks for your email. We will send a reply as soon as possible.</p>
                    <br />
                    <li><a href="index.html" class="button small">Back to Home</a></li>
				</header>
				
			</article>

		<!-- Footer -->
			<footer id="footer">
			
				<ul class="icons">
					<li><a href="https://www.facebook.com/danamarinodesign" class="icon circle fa-facebook" target="_blank"><span class="label">Facebook</span></a></li>
					<li><a href="http://www.pinterest.com/danamdesign/" class="icon circle fa-pinterest" target="_blank"><span class="label">Pinterest</span></a></li>
					<li><a href="https://www.etsy.com/shop/DanaMarinoDesign" class="icon circle fa-shopping-cart" target="_blank"><span class="label">Etsy</span></a></li>
				</ul>
				
				<span class="copyright">&copy; Dana Marino Design. All rights reserved. <a href="http://html5up.net" target="_blank">HTML5 UP </a>.</span>
			
			</footer>

	</body>
</html>
 
<?php
}
die();
?>

</body>
</html>