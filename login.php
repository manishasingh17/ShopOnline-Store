
<?php
/*
Student info here

Function: Server side code for login
*/

session_start();

$_email=$_POST['Email'];
$_password=$_POST['Password'];
$errors=0;

if(!isset($_email) || empty($_email))
{
	echo"Email field is empty";
	$errors++;

}
elseif(!isset($_password) || empty($_password))
{
	echo"Password field is empty";
		$errors++;

}
elseif(file_exists('cust.xml'))
{
	$xml=simplexml_load_file('cust.xml');

	$count=count($xml->customer);
	for($i=0; $i<$count; $i++)
	{
		$customer=$xml->customer[$i];
		if($customer->Email==$_email && $customer->Password==$_password)
		{
			$fullname=$customer->Firstname.' '.$customer->Surname;
			$_SESSION['id']=(string) $customer->id;
			
			break;
		}
	}
	if($i>=$count)
	{ 
		echo"Email and password combination invalid,go BACK and try again";
		$errors++;
    }
}

if($errors==0)
{
?>
<html>
<body>
<a href="listing.html?content=listing">click here to go to <b><u>listing page</u></b></a>
 </body>
 </html>
 <?php
}
?>
            



