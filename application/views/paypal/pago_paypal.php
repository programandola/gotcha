<?php
$payaltest = false; //cambialo a false para realizar transacciones reales, de lo contrario utiliza sandbox.
 
$req = 'cmd=_notify-validate';
$fullipnA = array();
 
foreach ($_POST as $key => $value)
{
	$fullipnA[$key] = $value;
 
	$encodedvalue = urlencode(stripslashes($value));
	$req .= "&$key=$encodedvalue";
}
 
$fullipn = Array2Str(" : ", "\n", $fullipnA);
 
if (!$payaltest) 
{
	$url ='https://www.paypal.com/cgi-bin/webscr';	
 
}else{	
 
	$url ='https://www.sandbox.paypal.com/cgi-bin/webscr'; 
 
}
 
$curl_result=$curl_err='';
$fp = curl_init();
curl_setopt($fp, CURLOPT_URL,$url);
curl_setopt($fp, CURLOPT_RETURNTRANSFER,1);
curl_setopt($fp, CURLOPT_POST, 1);
curl_setopt($fp, CURLOPT_POSTFIELDS, $req);
curl_setopt($fp, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Content-Length: " . strlen($req)));
curl_setopt($fp, CURLOPT_HEADER , 0); 
curl_setopt($fp, CURLOPT_VERBOSE, 1);
curl_setopt($fp, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($fp, CURLOPT_TIMEOUT, 30);
 
$response = curl_exec($fp);
$curl_err = curl_error($fp);
curl_close($fp);
 
 
// Variables enviadas por Paypal
//$item_name = $_POST['item_name'];
//$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$payer_email = $_POST['payer_email'];
$txn_type = $_POST['txn_type'];
$pending_reason = $_POST['pending_reason'];
$payment_type = $_POST['payment_type'];
//$variables = $_POST['custom'];
//$monto=$_POST["amount"];

 
 
if (strcmp ($response, "VERIFIED") == 0){
	// Verifico el estado de la orden
	if ($payment_status != "Completed"){
		TransLog("El pago no fue aceptado por paypal - Estado del Pago: $payment_status");
		StopProcess();
	}
 
	//todo bien hasta ahora, la transacción ha sido confirmada por lo tanto puedo realizar mis tareas, 
	//actualizar DB, stock, acreditar cómputos, activar cuentas etc etc

	//primero separamos el contenido del cuadro de texto por , usando explode aqui viene id de la venta, id_usuario y nombre del usuario que compra	

	$contador = 1; 
	while(true){
	     if (!isset($_POST['item_number'.$contador])) {
	          break; //en cuanto no exista la variable salimos del loop...
	     }
	     //actualizo en la base de datos el registro a pagado y mando los emails a anunciante y administrador
		 $this->solicitantes_model->cliente_realizo_pago($_POST['item_number'.$contador]);

	     $contador++;
	}

	//destruyo la session del carrito de compras
	$this->usuarios_model->cerrar_sesion_carrito();
 
	//TransLog("Pago Correcto - $fullipn"); //notifico al webmaster

 
 }else{ //la transacción es invalida NO se puedo cobrarle al cliente.
 
	 TransLog("Pago Inválido - $fullipn");

}
 
//función básica para las notificaciones
function notify_webmaster($message)
{

	$subject="Pago Invalido desde Paypal";
	$remite="staff@interhabita.com";
	$remitente="Staff Interhabita";
 
	$header .="MIME-Version: 1.0\n"; 
	$header .= "Content-type: text/html; charset=iso-8859-1\n"; 
	$header .="From: ".$remitente."<".$remite.">\n";
	$header .="Return-path: ". $remite."\n";
	$header .="X-Mailer: PHP/". phpversion()."\n";
 
	mail("rather_79@hotmail.com", $subject, $message, $header);
 
}


 
//esta funcion puede utilizarse como almacenar en una variable global todas las acciones del script, de esta manera podremos rastrear errors facilmente.
function TransLog($message)
{	

	notify_webmaster($message);	
 
}
 
//examina todo el IPN y lo convierte en una cadena de texto
function Array2Str($kvsep, $entrysep, $a)
{
	$str = "";
	foreach ($a as $k=>$v)
	{
		$str .= "{$k}{$kvsep}{$v}{$entrysep}";
	}
	return $str;
}
 
//para toda la ejecución del programa
function StopProcess()
{
	exit;
}
?>