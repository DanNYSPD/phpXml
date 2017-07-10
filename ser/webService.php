<?php 
 require_once "lib/nusoap.php";
      
    function registarproducto($nombre,$productos) {
    	$myfile = fopen("estructura.txt", "w") or die("Unable to open file!");
    	$nombreCliente="Nombre del cliente: \n ".$nombre." \n   ";
    	$nombreCliente=$nombreCliente." _______________";
    	//$producto=recorrerProductos($productos);
		$txt = recorrerProductos($productos);
		$txt=$nombreCliente.$txt;
		//file_put_contents($myfile, $txt);
		fwrite($myfile, $nombreCliente);
		fwrite($myfile, $txt);
		fclose($myfile);

    	return $txt;
    
    }
    function recorrerProductos($arrPr)
    {
    	$i=1;
    	$text="";
    	foreach ($arrPr as $value) {

    		$producto="\n Producto ".$i;
    		$producto=$producto.":\n";
    		$producto=$producto." Precio :".$value["precio"];
    		$producto=$producto." Importe :".$value["importe"];
    		$text=$text.$producto;
    		$i++;
    	}
    	return $text;
    }

   
    include_once 'lib/nusoap.php';  
    $server = new soap_server();
    $namespace='http://localhost:8888/sifei/webService.php?wsdl';
    $server->configureWSDL('registarproductos');
  	$server->wsdl->schemaTargetNamespace =$namespace;

    $server->wsdl->addComplexType('Producto',
    'complexType',
    'struct',
    'all',
    '',
    array(
            'precio' => array('name' => 'precio', 'type' => 'xsd:int'),
            'importe' => array('name' => 'importe', 'type' => 'xsd:int'),
            
    ));
      $server->wsdl->addComplexType('Cliente',
    'complexType',
    'struct',
    'all',
    '',
    array(
            'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
           	'productos'=>(array('name'=>'productos','type'=>'tns:Producto'))
    ));


      $server->register(
    	'registarproducto',array('Cliente'=>'tns:Cliente','productos'=>'tns:Producto[]'),
    	 array('return' => 'xsd:string'), 
    	false,
    	false,
    	"rpc",
    	"encoded",
	    "Servicio para registrar productos de un cliente"
    	);

    $HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";
    $server->service($HTTP_RAW_POST_DATA);


function generaXML($clienteNombre,$producto1Precio,$prodcuto1Importe,$producto2Precio,$producto2_importe)
{
	
	$client = new nusoap_client("http://" . $_SERVER['SERVER_NAME'] .":8888". "/sifei/" ."webService.php",'wsdl');
    	$xmlr = new SimpleXMLElement("<Cliente></Cliente>");
		$xmlr->addChild('nombre', $clienteNombre);
		$xmlr->addChild('productos', "");
		
		$params = new stdClass();
		$params->xml = $xmlr->asXML();
		var_dump($params);

		$xml='<cliente nombre="'.$clienteNombre.'">
			<productos>
				<producto cantidad="2" precio="'.$producto1Precio.'" importe="'.$prodcuto1Importe.'"></producto>	
				<producto cantidad="2" precio="'.$producto2Precio.'" importe="'.$producto2_importe.'"></producto>	
			</productos>
		</cliente>';
		return $xml;	
    }
 ?>