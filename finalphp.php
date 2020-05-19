$message = '<html><body style="
margin-left: auto;
margin-right: auto;
margin-top: 0;
width: 628px; ">';
$message .= '<h1 style="font-weight: 600; text-align:center; "> Your Bitcoin is waiting  .
 </h1>';

$message .=' <p style="text-align:center; line-height: 1.6;"> Hello <?php echo $name ?> we are delighted that you will like to buy $<?php echo $price_usd;?> worth of Bitcoin, we hope that you continue to use our service through out your investing and trading journey</p>
';
$message .=' <p style="text-align:center; line-height: 1.6;" > To continue with your order, on the bottom of this email you will click <b> Pay </b> you must pay with friends and family. in the notes section of paypal please paste the following information 
</p> ';
$message.=' <p style="text-align:center; line-height: 1.6;"> <b>
My name is   <?php echo $name;?> and I live at
  <?php echo $street;?> I was born on 
  <?php echo $dob;?> My bitcoin address is 
  <?php echo $bitcoinaddress;?> and
  I want <?php echo $price_usd;?> Us Dollars in bitcoin 
  I am agreeing to pay <?php echo $total;?> 
  </b>
</p>';
$message.='  <p style="text-align:center; line-height: 1.6;"> By Paying you are agreeing to our <a href="http://www.budait.com/tos.html"> TOS  </a>
any mistakes made by the user will cause no refund or rejection of payment.</p>';
$message .=' <h1 style="text-align:center; line-height: 1.6;" ><a href=<?php echo $pplink;?> > Pay Now </a></h1>';
$message .= '</body></html>';