<?php
$_name=$_GET['Firstname'];
$_surname=$_GET['Surname'];
$_email=$_GET['Email'];
if ($_SERVER['REQUEST_METHOD'] == 'GET')
 {
            $errors=0;
    if(empty($_GET['Firstname']))
      {
            ++$errors;
            echo "<p>please enter first name</p>";
      }
    else
      {
            $_name=$_GET['Firstname'];
      }
      if(empty($_GET['Surname']))
      {
            ++$errors;
            echo "<p>please enter last name</p>";
      }
    else
      {
            $_surname=$_GET['Surname'];
      }
      //Email ckeck
    if (empty($_GET['Email'])) 
      {
             ++$errors;
             echo "<p>You need to enter an e-mail address.</p>\n";
      }
     else
      {
              
           $email_pattern='/[a-zA-Z0-9!#$&\'*+\-\/=?^_`{|}~.]+@[a-zA-Z0-9-.]+/';
	         preg_match($email_pattern, $_email, $match);
	         if($match[0]!=$_email)
	    {
		             ++$errors;

		echo "Please enter a valid email address";

	}
}
$repeat=false;
if(file_exists('cust.xml'))

{
  $xml=simplexml_load_file('cust.xml');
  foreach($xml->customer as $customer)
  {
    if($customer->Email==$_email)
    {
      $repeat=true;
      break;
    }
    
  }
}
if($repeat)
{
  echo 'Email address already exists';
} 
if($errors==0)
    {

  $xml = simplexml_load_file('cust.xml');
$id = $xml->xpath("//customer/id"); // select all ids
$newid = max(array_map("intval", $id)) + 1;// change objects to `int`, get `max()`, + 1
$length=6;
$password='';    
$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$count = strlen($chars);
for ($i = 0; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $password .= substr($chars, $index, 1);
    }
       
	$customer=$xml->addChild("customer");
	$customer->addChild("id", $newid);
	$customer->addChild("Firstname", $_name);
	$customer->addChild("Surname", $_surname);
	$customer->addChild("Email", $_email);
    $customer->addChild("Password", $password);
    $dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());
$dom->save("cust.xml"); 

$To =$_email;
            $Subject="welcome to ShopOnline!";
            $Message="Dear".$_name.", Welcome to shoponline! Your customer id is".$newid."and the password is".$password;
            $Header= "From: Registration@shoponline.com.au";
            $deliver=mail($To,$Subject,$Message,$Header,"-r 4956958@student.swin.edu.au");
    if($deliver)
    {
        $sent="Your message was successfully sent.";
    }
   else
    {
        $sent="There was an error in sending your message.";
    }
    echo "successfully registered, go back to login";
    echo "Dear ".$_name.", Welcome to shoponline! Your customer id is ".$newid."and the password is ".$password;
    }

}
?>