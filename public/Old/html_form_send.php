<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
if(isset($_POST['email'])) {
     
    // CHANGE THE TWO LINES BELOW
    $email_to = "danamarinodesign@gmail.com";
     
    $email_subject = "Design Web Submission";
     
     
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- place your own success html below -->
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Description" content="Graphic Design" />
	<meta name="Keywords" content="design, stationery, wedding, invitations, corporate branding, identity, web design, print design, logo design" />
    
<title>Dana Marino Design • About</title>

<!--STYLES AND JAVA-->
		<!--PAGE STYLES-->
		<link rel="stylesheet" type="text/css" href="style.css" />
      
		<!--MAIN SLIDER GALLERY-->
		<link href="js-image-slider.css" rel="stylesheet" type="text/css" />
    	<script src="js-image-slider.js" type="text/javascript"></script>
		
        <!--LIGHTBOX-->
        <link href="lightbox/css/lightbox.css" rel="stylesheet" />
		<script src="lightbox/js/jquery-1.10.2.min.js"></script>
		<script src="lightbox/js/lightbox-2.6.min.js"></script>
</head>

<body>
        <div class="wrapper">
       
        <div class="logo">
        <a href="index.html"><img src="images/logo.gif" /></a>
        </div>
        
        <!--TOP NAVIGATION-->        
        <div class="topnav">
                <ul>                    
                    <li><a href="weddings.html">WEDDINGS</a>
                  <ul>
                        <li><a href="custom_design.html">CUSTOM DESIGN</a></li>
                        <li><a href="readytolove.html">READY TO LOVE</a></li>
                    </ul>
                    </li>
                    
                  
                    <li><a href="events.html">EVENTS</a>
                    </li>
                  
                    <li><a href="portfolio.html">PORTFOLIO</a>
                    </li>
                    
                    <li><a href="about.html">ABOUT</a></li>

                    <li><a href="contact.html">CONTACT</a></li>
                </ul>
        </div>
        
        <!--HEADING-->
        <p>Thank you for contacting us! We will send a response back as soon as possible.</p>

       
        
		<!--KEEP EMPTY-->
        <div class="push"></div>
        <!--KEEP EMPTY-->
        
        </div>
        
        <div class="footer">
            <p>© DANA MARINO DESIGN 2013</p>
        </div>
        
</body>
</html>
 
<?php
}
die();
?>

</body>
</html>