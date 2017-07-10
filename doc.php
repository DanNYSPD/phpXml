<?php 
//$dom      = new DomDocument("1.0", "ISO-8859-1");
$dom      = new DomDocument("1.0");
$library  = $dom->createElement('library');
 
//1st item
$bookElem = $dom->createElement('book');
// set it's attribute
$bookElem->setAttribute('isbn', '781');
$bookElem->appendChild( $dom->createElement('name', 'SCJP 1.5') );
 
//create infoElement and append a CDATA as its child
$infoElem = $dom->createElement('info');
$infoElem->appendChild( $dom->createCDATASection('Sun Certified Java Programmer book') );
 
$bookElem->appendChild( $infoElem );
$library->appendChild( $bookElem );
$dom->appendChild( $library );
 
$xmlData  = $dom->saveXML();
echo $xmlData;
$dom->save('xml.xml');
 ?>