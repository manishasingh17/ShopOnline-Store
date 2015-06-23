<?php
$xml=new DOMDocument("1.0");

$sauction=$xml->createElement("xml");
$sauction=$xml->appendChild($sauction);

$auction=$xml->createElement("auction");
$auction=$sauction->appendChild($auction);

$itemnumber=$xml->createElement("Itemnumber");
$itemnumber=$auction->appendChild($itemnumber);
$itemvalue=$xml->createTextNode("1");
$itemvalue=$itemnumber->appendChild($itemvalue);

$itemname=$xml->createElement("Itemname");
$itemname=$auction->appendChild($itemname);
$item=$xml->createTextNode("mobile");
$item=$itemname->appendChild($item);

$category=$xml->createElement("Category");
$category=$auction->appendChild($category);
$cvalue=$xml->createTextNode("electronic");
$cvalue=$category->appendChild($cvalue);

$description=$xml->createElement("Description");
$description=$auction->appendChild($description);
$dvalue=$xml->createTextNode("1 year old");
$dvalue=$description->appendChild($dvalue);

$sprice=$xml->createElement("StartPrice");
$sprice=$auction->appendChild($sprice);
$svalue=$xml->createTextNode("100");
$svalue=$sprice->appendChild($svalue);

$rprice=$xml->createElement("ReservePrice");
$rprice=$auction->appendChild($rprice);
$rvalue=$xml->createTextNode("$100");
$rvalue=$rprice->appendChild($rvalue);

$bprice=$xml->createElement("BuyItNowPrice");
$bprice=$auction->appendChild($bprice);
$bvalue=$xml->createTextNode("$80");
$bvalue=$bprice->appendChild($bvalue);
$status=$xml->createElement("Status");
$status=$auction->appendChild($status);
$svalue=$xml->createTextNode("in_progress");
$svalue=$status->appendChild($svalue);

$date=$xml->createElement("date");
$date=$auction->appendChild($date);
$vdate=$xml->createTextNode("2014/05/05 10:18:10");
$vdate=$date->appendChild($vdate);



$day=$xml->createElement("day");
$day=$auction->appendChild($day);
$vday=$xml->createTextNode("02");
$vday=$day->appendChild($vday);


$hours=$xml->createElement("hour");
$hours=$auction->appendChild($hours);
$vhour=$xml->createTextNode("05");
$vhour=$hours->appendChild($vhour);


$min=$xml->createElement("minutes");
$min=$auction->appendChild($min);
$vmin=$xml->createTextNode("15");
$vmin=$min->appendChild($vmin);

$xml->formatOutput=true;
$string_value=$xml->saveXML();
$xml->save("auction.xml");
?>