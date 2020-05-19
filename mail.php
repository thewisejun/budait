<!DOCTYPE html>
<html lang="en" >
<head>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<?php
session_start();


?>
  <meta charset="UTF-8">
 
  <link rel="stylesheet" href="css/email.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>

<?php

date_default_timezone_set('UTC');
$price_usd=  $_SESSION["amount"];
if ($price_usd < 20) {
    $fee = .1;
} elseif ($price_usd > 20) {
    $fee=.09;
} elseif ($price_usd >= 50) {
    $fee=.08;
} elseif ($price_usd >=100){
    $fee=.075;
}

$email = $_SESSION['email'];
$fee_display= $price_usd * $fee;
$total = $price_usd + $fee_display;
$bitcoinaddress=  $_SESSION["bitcoin_address"];
$date = date("m.d.y"); 
$url= 'http://chart.googleapis.com/chart?cht=qr&chl=bitcoin%'.$bitcoinaddress .'&choe=UTF-8&chs=300x300';
$pplink = 'https://www.paypal.me/BTCtoPAYPAL/'.$total;
$name = $_SESSION["name"];
$street =  $_SESSION["houseaddress"];
$dob= $_SESSION["dob"];
?>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<div class="recieptMain">
	<h1>Sweet! Your order has been recieved!</h1>
	<p>Bitcoin Address:</p>
	<p><?php echo  $bitcoinaddress; ?></p>
	<p>Date:</p>
	<p><?php echo $date; ?></p>
	<hr class="divide1"></hr>
	<h4 class="itemdetails">ITEM DETAILS</h4>
	<img src=<?php echo $url ?>></img>
	<p>Product</p>
	<p>Bitcoin Purchase</p>
	<p>Price</p>
	<p>$<?php echo $price_usd; ?></p>
	<p>Fee</p>
	<p>$<?php echo $fee_display; ?></p>
	<p>TOTAL</p>
	<p>$<?php echo $total; ?></p>
	<hr class="divide2"></hr>
	<h4 class="shipmentinfo">BUYER  INFORMATION</h4>
	<ul class="customerinfo">
		<li id="name"><?php echo $name;?></li>
		<li id="street"><?php echo $street; ?></li>
		<li id="street"><?php echo $dob; ?></li>
		<li id="street"><?php echo $bitcoinaddress; ?></li>
	</ul>
	<p>Estimated Arrival</p>
	<p>30 to 1 hour of time of purchase</p>
	<a href=<?php echo $pplink;?> target=_BLANK><button>PURCHASE </button></a>
</div>
<!-- MAIL SECTION-->
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '';                     // SMTP username
    $mail->Password   = '';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('order@budait.com', 'F2BTC');
    $mail->addAddress($email);     // Add a recipient
                // Name is optional
   
   

				$message = '<html><body style="
				margin-left: auto;
				margin-right: auto;
				margin-top: 0;
				width: 628px; ">';
				$message .= '<h1 style="font-weight: 600; text-align:center; "> Your Bitcoin is waiting  '.$name.'
				 </h1>';
				
				$message .=' <p style="text-align:center; line-height: 1.6;"> Hello '. $name .' we are delighted that you will like to buy '. $price_usd .' US Dollars worth of Bitcoin, we hope that you continue to use our service through out your investing and trading journey</p>
				';
				$message .=' <p style="text-align:center; line-height: 1.6;" > To continue with your order, on the bottom of this email you will click <b> Pay </b> you must pay with friends and family. in the notes section of paypal please paste the following information 
				</p> ';
				$message.=' <p style="text-align:center; line-height: 1.6;"> <b>
				My name is   '.$name.' and I live at
				  <?php '.$street.' I was born on 
				  '. $dob.'> My bitcoin address is 
				  '. $bitcoinaddress.' and
				  I want '. $price_usd. 'Us Dollars in bitcoin 
				  I am agreeing to pay '. $total .'> 
				  </b>
				</p>';
				$message.='  <p style="text-align:center; line-height: 1.6;"> By Paying you are agreeing to our <a href="http://www.budait.com/tos.html"> TOS  </a>
				any mistakes made by the user will cause no refund or rejection of payment.</p>';
				$message .=' <h1 style="text-align:center; line-height: 1.6;" ><a href='.$pplink.' > Pay Now </a></h1>';
				$message .= '</body></html>';
				
    // Attachments
    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Confirmation for F2BTC Order';
	$mail->Body    =$message;
	
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Error please try again";
}
    


?>