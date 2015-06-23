<?php
$_name=$_POST['Firstname'];
$_sname=$_POST['Surname'];
$_email=$_POST['Email'];

$xml=new DOMDocument("1.0");
$customer=$xml->createElement("customer");
$xml->appendChild($customer);

$firstname=$xml->createElement("Firstname");
$customer->appendChild($firstname);
$firstvalue=$xml->createTextNode("$_name");
$firstname->appendChild($firstvalue);

$sname=$xml->createElement("Surname");
$customer->appendChild($sname);
$svalue=$xml->createTextNode("$_sname");
$sname->appendChild($svalue);




$email=$xml->createElement("Email");
$customer->appendChild($email);

$emailvalue=$xml->createTextNode("$_email");
$email->appendChild($emailvalue);

$xml->save("cust.xml");
?>