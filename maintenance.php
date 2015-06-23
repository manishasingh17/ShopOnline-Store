<!--
	Maintance page-interface for the Broker.
-->
<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0
sTRICT//EN"
"http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body style="background-color:#E6E6FA">
<h1> Maintenance Page </h1>

<form method="post" action="maintenance.php">

&nbsp;    <input type="submit" value="Process Auctions and Generate Report" name="maintainfield"><br>
<br>
<br>
</form>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
 {
 	if(file_exists('auction.xml'))

                {
                //$doc =DOMDocument::load("data/auction.xml");
                $doc =DOMDocument::load("auction.xml");

                $auctionlist=$doc->getElementsByTagName("auction");
                $auctiondata=array();
                foreach($auctionlist as $node)
                {
                $itemnumber = $node->getElementsByTagName("Itemnumber")->item(0)->nodeValue;
                $itemname=$node->getElementsByTagName("Itemname")->item(0)->nodeValue;
               // $category=$node->getElementsByTagName("Category")->item(0)->nodeValue;
               // $description=$node->getElementsByTagName("Description")->item(0)->nodeValue;
                $startprice=$node->getElementsByTagName("StartPrice")->item(0)->nodeValue;
                //$reserveprice=$node->getElementsByTagName("ReservePrice")->item(0)->nodeValue;
                $buyprice=$node->getElementsByTagName("BuyItNowPrice")->item(0)->nodeValue;
                $status=$node->getElementsByTagName("Status")->item(0)->nodeValue;
                //$customerid=$node->getElementsByTagName("id")->item(0)->nodeValue;
                $date=$node->getElementsByTagName("date")->item(0)->nodeValue;
                $time=$node->getElementsByTagName("day")->item(0)->nodeValue;
                $hours=$node->getElementsByTagName("hour")->item(0)->nodeValue;
                $minutes=$node->getElementsByTagName("minutes")->item(0)->nodeValue;
				 
				//date_default_timezone_set('Australia/Melbourne');

				 $end_date = date("Y/m/d", strtotime($date . " + $time days")); 
                 $datetime1 = new DateTime($end_date );
                 $datetime2 = new DateTime();
                 $interval = $datetime1->diff($datetime2);
                 $interval->format('%a days, %h hours, %i minutes, %S seconds');

                 if($interval=0)
                 {
                 	$status="failed";
                 }
              if($status=="sold")
              {
            	$revenue=(3/100)*$buyprice;
              
              ?>
              <table style="border: 0; border-bottom: 1px solid red; width: 100%"  id="mainlist">


                    <tr>
                        <td></td>
                        <td style="color: red"><label for="Itemnumber">Item No:</label></td>
                        <td><?php echo $itemnumber;?></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><label for="Itemname">Item Name:</label></td>
                        <td><?php echo $itemname;?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label for="Status"> Status:</label></td>
                        <td><?php echo $status;?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label for="Revenue"> Revenue:</label></td>
                        <td><?php echo $revenue;?></td>
                    </tr>
                    </table>
<?php


                }
               
                }
			   }  
				
                }

?>









				</body>
</html>