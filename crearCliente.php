<?php 
//$dom      = new DomDocument("1.0", "ISO-8859-1");
$dom      = new DomDocument("1.0",'UTF-8');
$library  = $dom->createElement('Cliente');
//$attribute1= $dom->createAttributeNS('namespace_aqui','example:attr');
//createElementNS():namespaceURI,qualifiedName,value
$element = $dom->createElementNS('http://www.example.com/XFoo', 'xfoo:test', 'This is the root element!');

 $library->setAttribute('nombre','daniel');
//1st item
$bookElem = $dom->createElement('productos');
// set it's attribute
$producto1= $dom->createElement('producto');
$producto1->setAttribute('precio',55);
$producto1->setAttribute('cantidad',2);
$producto1->setAttribute('importe',110);

$domAttribute = $dom->createAttribute('atributoNodo');
$domAttribute->value="valor";

$producto1->appendChild($domAttribute);
$bookElem->appendChild($producto1);
 
//create infoElement and append a CDATA as its child

 
$dom->appendChild($element);
$library->appendChild( $bookElem );
$dom->appendChild( $library );
 
$xmlData  = $dom->saveXML();
var_dump( $xmlData);
$dom->save('xml.xml');
 ?>
