<?php 
//php.net/manual/en/class.domdocument.php
//https://www.sitepoint.com/php-dom-working-with-xml/
//http://www.lacorona.com.mx/fortiz/sat/soriana.php
//http://www.lacorona.com.mx/fortiz/sat/xml.php
//$dom      = new DomDocument("1.0", "ISO-8859-1");
$dom      = new DomDocument("1.0",'UTF-8');
$library  = $dom->createElement('Comprobante');
//$attribute1= $dom->createAttributeNS('namespace_aqui','example:attr');
//createElementNS():namespaceURI,qualifiedName,value
$library -> setAttribute('xmlns','http://www.sat.gob.mx/cfd/2');
$library -> setAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
$library -> setAttribute('xsi:schemaLocation','http://www.w3.org/2001/XMLSchema-instance');


$domAttribute = $dom->createAttribute('atributoNodo');
$domAttribute->value="valor";

$domElement = $dom->createElement('Emisor');
	$domElement->setAttribute('rfc','sasa');
	$domElement->setAttribute('nombre','jan');
	$domElement->appendChild(generarDomicilio($dom));
$library->appendChild($domElement);
 
//create infoElement and append a CDATA as its child

 


$dom->appendChild( $library );
 
$xmlData  = $dom->saveXML();
var_dump( $xmlData);
$dom->save('Comprobante.xml');
function GenerarEmisor($rfc='dsadsada',$nombre="Jan")
{
	$dom      = new DomDocument("1.0",'UTF-8');
	$domElement = $dom->createElement('Emisor');
	$domElement->setAttribute('rfc','sasa');
	$domElement->setAttribute('nombre','jan');

	return $domElement;

}
//debe ser rferencia, ya que marca error si se usa una instancia diferente, 
function generarDomicilio($dom)
{
	$domicilio=$dom->createElement('DomicilioFiscal');
	$domicilio->setAttribute('calle','alguna');
	return $domicilio;
}
 ?>
