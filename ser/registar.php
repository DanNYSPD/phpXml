<?php 

	const key_cl_nombre="nombre";

	const key_producto1_precio="producto1_precio";
	const key_producto1_importe="producto1_importe";

	const key_producto2_precio="producto2_precio";
	const key_producto2_importe="producto2_importe";

	if(!empty($_POST[key_cl_nombre])&&
		!empty($_POST[key_producto1_precio])&&
		!empty($_POST[key_producto1_importe])&&
		!empty($_POST[key_producto2_precio])&&
		!empty($_POST[key_producto2_importe])){

		$clienteNombre=$_POST[key_cl_nombre];

		$producto1Precio=$_POST[key_producto1_precio];
		$prodcuto1Importe=$_POST[key_producto1_importe];

		$producto2Precio=$_POST[key_producto2_precio];
		$producto2Importe=$_POST[key_producto2_importe];
		//echo "ok";
		generaXML2($clienteNombre,$producto1Precio,$prodcuto1Importe,$producto2Precio,$producto2Importe);
	}else{
		http_response_code(401); //error
	}

function generaXML2($clienteNombre,$producto1Precio,$prodcuto1Importe,$producto2Precio,$producto2_importe)
{
	require_once "lib/nusoap.php";
	
	$cliente = new nusoap_client("http://" . $_SERVER['SERVER_NAME'] .":8888". "/sifei/" ."webService.php",false);
    //$cliente = new nusoap_client("http://127.0.0.1:8888/sife/webService.php",'wsdl');
      
     $error = $cliente->getError();
    if ($error) {
        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    }
  
   
   //$array=array("nombre"=>$clienteNombre,"productos"=>array("precio"=>20,"importe"=>50)); 
   $array=array("nombre"=>$clienteNombre,"productos"=>array(array("precio"=>20,"importe"=>50),array("precio"=>20,"importe"=>50))); 
  	
    $result = $cliente->call("registarproducto",$array);
      
    if ($cliente->fault) {
        echo "<h2>Fallo</h2><pre>";
        print_r($result);
        echo "</pre>";
    }
    else {
        $error = $cliente->getError();
        if ($error) {
            echo "<h2>Error</h2><pre>" . $error . "</pre>";
        }
        else {
            echo "<h2>Se ha registrado los productos</h2><pre>";
            echo $result;
            echo "</pre>";
        }
    }

}
function generaXML($clienteNombre,$producto1Precio,$prodcuto1Importe,$producto2Precio,$producto2_importe)
{
	require_once "lib/nusoap.php";
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