<html>

<script type="text/javascript">
    window.setTimeout(function(){ document.location.reload(true); },5000);
</script>
<body>
<div id="menu" align="middle" >
    <h1><font color="f11a0a"> ShopOnline</font></h1>
    <br>
	<a href="login.html">Home</a> &sdot; <a href="listing.html">Listing</a> &sdot; <a href="bid.php">Bidding</a>&sdot; <a href="maintenance.php">Maintenance</a>

</div>
<br>

<hr>
<br>
<br>
<p><i>Current auction items are listed below. to place a bid for an item, use the place Bid button.</i></p>
<p><i><b>NOTE:</b>Item remaining time and bid prices are updated every 5 seconds.</i></p>
  

<form name="login" method="post" action="" id="login">
            <fieldset id="listingfieldset" style="width: 40%;margin-left: 20%;">

<?php
session_start();


                //if(file_exists('data/auction.xml'))
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
                $category=$node->getElementsByTagName("Category")->item(0)->nodeValue;
                $description=$node->getElementsByTagName("Description")->item(0)->nodeValue;
                $startprice=$node->getElementsByTagName("StartPrice")->item(0)->nodeValue;
                $reserveprice=$node->getElementsByTagName("ReservePrice")->item(0)->nodeValue;
                $buyprice=$node->getElementsByTagName("BuyItNowPrice")->item(0)->nodeValue;
                $status=$node->getElementsByTagName("Status")->item(0)->nodeValue;
                $date=$node->getElementsByTagName("date")->item(0)->nodeValue;
                $time=$node->getElementsByTagName("day")->item(0)->nodeValue;
                $hours=$node->getElementsByTagName("hour")->item(0)->nodeValue;
                $minutes=$node->getElementsByTagName("minutes")->item(0)->nodeValue;
				 

				     $end_date = date("Y/m/d", strtotime($date . " + $time days")); 
                      $datetime1 = new DateTime($end_date );
                      $datetime2 = new DateTime();
                      $interval = $datetime1->diff($datetime2);
                      echo $interval->format('%a days, %h hours, %i minutes, %S seconds');
             
			    
				?>
                <table style="border: 0; border-bottom: 1px solid red; width: 100%"  id="biddinglist">


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
                        <td><label for="Category"> Category:</label></td>
                        <td><?php echo $category;?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label for="Description">Description:</label></td>
                        <td><?php echo substr($description,0,30)."...";?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label for="BuyItNowPrice">Buy It Now Price:</label></td>
                        <td><?php echo "$".$buyprice;?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label for="StartPrice">Bid Price</label></td>
                        <td><?php echo "$". $startprice;?></td>
                    </tr>
                   
                   
                   
                    <tr>
                        <td></td>
                        <td></td>
                        <td><form method="post">
                        &nbsp;    <input type="submit" name="submit" value="Buy It Now"></form></td>
                    </tr>
                </table>
                    <?php 
                    if (isset($_POST['submit'])) 
                    {
                   //$status="sold";

                //load xml file to edit
                $xml = simplexml_load_file('auction.xml');

                $xml->auction->Status = "sold";
                $xml->asXML('auction.xml');
                echo("thank you for purchasing the item");
               }
                ?>
                <?php
                      }

                    }
                else
                {

                 echo "<b> No item has been placed for auction</b>";
                }
                    ?>

               </fieldset>
        </form>
    

</body>
</html>





    
    