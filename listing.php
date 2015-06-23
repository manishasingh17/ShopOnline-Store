
<?php
session_start();
$itemname=$_POST['Itemname'];
$category=$_POST['Category'];
$description=$_POST['Description'];
$sprice=$_POST['StartPrice'];
$rprice=$_POST['ReservePrice'];
$bprice=$_POST['BuyItNowPrice'];
$day=$_POST['day'];
$hours=$_POST['hour'];
$minutes=$_POST['minutes'];


if ($_SERVER['REQUEST_METHOD'] == 'POST')
 {
            $errors=0;
    if(empty($_POST['Itemname']))
      {
            ++$errors;
            echo "<p>please enter item name</p>";
      }
    else
      {
            $itemname=$_POST['Itemname'];
      }
    if(empty($_POST['Category']))
      {
            ++$errors;
            echo "<p>please select the Category</p>";
      }
    else
      {
            $category=$_POST['Category'];
      }
             $description=$_POST['Description'];
      
    if($_POST['StartPrice']<$_POST['ReservePrice'])

      {
             $sprice=$_POST['StartPrice'];
      }
      else
      {
            ++$errors;
             echo "start price should be less than reserve price";
      }
     
     if($_POST['ReservePrice']<$_POST['BuyItNowPrice'])
      {
             $rprice=$_POST['ReservePrice'];
      }
      else
      {
             ++$errors;
             echo "Reserve price should be less than buy it now price";
      }

     if(empty($_POST['BuyItNowPrice']))
      {
            ++$errors;
            echo "<p>please enter the buy it now price</p>";
      }
     else
      {
            $bprice=$_POST['BuyItNowPrice'];
      }
      if(empty($_POST['day']))
      {
            ++$errors;
            echo "<p>please select the day</p>";
      }
      else
      {
           $day=$_POST['day'];
     }
     if(empty($_POST['hour']))
      {
            ++$errors;
            echo "<p>please select the hours</p>";
      }
      else
      {
          $hours=$_POST['hour'];
     }
     if(empty($_POST['minutes']))
      {
            ++$errors;
            echo "<p>please select minutes</p>";
      }
      else
      {
           $minutes=$_POST['minutes'];
      }
     
 $status="in_progress";
 $date = date('Y/m/d');
 $time=date('H:i:s');
    
if($errors==0)
  {
    $xml = simplexml_load_file("auction.xml");
    $item = $xml->xpath("//auction/Itemnumber"); // select all ids
    $newitem = max(array_map("intval", $item)) + 1;
    $auction=$xml->addChild("auction");
    $auction->addChild("Itemnumber", $newitem);
	  $auction->addChild("Itemname", $itemname);
	  $auction->addChild("Category", $category);
	  $auction->addChild("Description", $description);
    $auction->addChild("StartPrice", $sprice);
    $auction->addChild("ReservePrice", $rprice);
    $auction->addChild("BuyItNowPrice", $bprice);
    $auction->addChild("Status", $status);
    $auction->addChild("date",$date);
    $auction->addChild("time",$time);
    $auction->addChild("day",$day);
    $auction->addChild("hour",$hours);
    $auction->addChild("minutes",$minutes);
    $dom = new DOMDocument("1.0");
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());
    $dom->save("auction.xml"); 
   }
 if($errors==0)
  {
    echo "Thank you! Your item has been listed in ShopOnline.";
    echo "The item number is".$newitem.", and the bidding starts on: ".$date."at".$time;
?>
<html>
<body>
     <a href="bid.php?content=bidding">click here to go to <b><u>Bidding page</u></b></a>
</body>
</html>
<?php

  }
 else
  {
    echo "Please fill all the required fields";
  }
}
?>
























