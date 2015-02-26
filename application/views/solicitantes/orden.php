<?
//destruimos la session carrito
$this->usuarios_model->cerrar_sesion_carrito();
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Orden No #</title>
<link rel="stylesheet" type="text/css" href="<? echo base_url()?>public/css/invoicestyle.css">
</head>
<body bgcolor="#efefef">
<table align="center" height="50px" width="600px">
<tbody><tr>
<td width="92%" valign="top" height="40px;" align="right">
<a href="<? echo base_url()?>solicitantes/index/spago" title="Volver al área de clientes" class="btn_continuar" style="width:170px; height:35px; font-size:16px; line-height:35px; -moz-border-radius:5px; border-radius:5px;">Volver al área de Solicitantes</a>
</td>
<td width="8%" align="right">
<a href="javascript:print()"><img src="<? echo base_url()?>public/images/btn_imprimir.png" alt="Imprimir" title="Imprimir" border="0"></a>
</td>
</tr>
</tbody></table>
<table cellspacing="0" cellpadding="0" align="center">
<tbody><tr><td>
<img src="<? echo base_url()?>public/images/back_invoice_01.png" border="0">
</td></tr>
</tbody></table>
<table id="wrapper" cellspacing="1" cellpadding="20" background="<? echo base_url()?>public/images/back_invoice_02.png" align="center">
<tbody><tr><td>
<table width="100%">
<tbody><tr>
<td bgcolor="#FFFFFF" class="header" valign="top">
<p><img src="<? echo base_url()?>public/images/logo.png" alt="InterHabita.com" title="InterHabita.com" border="0"></p>
</td>
<!--NUMERO DE COMPRA-->
<td class="comun" align="right">
<strong style="color:#990000;">Orden No. <? echo $lastInsertId ?></strong><br>
Generada: <? echo date("d/m/Y") ?><br>
<br>

<font style="font-size:20px; color:#c20304;" class="header">No Pagada</font><br>
</td>
<!--NUMERO DE COMPRA-->
</tr>
</tbody></table>

<br>

<table width="100%" id="invoicetoptables" cellspacing="0">
<tbody><tr>
<td width="50%" id="invoicecontent">
<!--DATOS DEL CLIENTE-->
<table width="100%" height="220" cellspacing="0" cellpadding="10" id="invoicetoptables">
<tbody><tr bgcolor="#FFFFFF">
<td id="invoicecontent" valign="top" style="border:1px #CCCCCC dotted; background-color:#f1efef; -moz-border-radius:10px; border-radius:10px; margin-left:10px; font-size:14px;" class="comun_fac">
<strong>Pagar a:</strong><br>
SCOTIA BANK</br>
TITULAR: JUAN MANUEL CHAIREZ</br>
CUENTA: 00101820067</br>
CLABE: 044180001018200670</br>
</td></tr></tbody></table>
<!--DATOS DEL CLIENTE-->
</td>
<!--FORMA DE PAGO-->
<td width="50%" id="invoicecontent" style="font-size:16px;" class="comun_fac" valign="top" align="right">


</div>
</td>
<!--FORMA DE PAGO-->
</tr></tbody></table>
<p><br></p>

<!--DESCRIPCION-->
<table cellspacing="0" id="invoiceitemstable" align="center">
	<tbody>
		<tr bgcolor="#FFFFFF">
			<td colspan="2" class="tipo_factura1" id="invoiceitemsheading" align="center" width="70%">Descripción</td>
			<td class="tipo_factura1" id="invoiceitemsheading" align="center" width="30%">Importe</td>
		</tr>
		<?
		$total=0;
		foreach ($carrito as $item) {
			foreach ($item as $key => $value) {
				if($key=="idCliente"){
					$idSolicitud=$value;
				}
				if($key=="cliente"){
					$cliente=$value;
				}
				if($key=="propiedad"){
					$propiedad=$value;
				}
				if($key=="costo"){
					$costo=$value;
					$total+=$costo;
				}
			}
			?>
		<tr bgcolor="#ffffff">
			<td colspan="2" class="tipo_factura2" id="invoiceitemsrow">Id Sol. <? echo $idSolicitud ?> | Sol. <? echo $cliente ?>  | Prop. <? echo $propiedad ?></td>
			<td class="tipo_factura2" id="invoiceitemsrow"><div align="right" style="margin-right:15px;">$<? echo $costo ?>.00</div></td>
		</tr>
		<?
		}
		?>
		
	</tbody>
</table>
<p></p>
<table cellspacing="0" id="invoiceitemstable" align="center">
<tbody><tr bgcolor="#ffffff">
<td rowspan="5" width="38%">
</td><td id="invoiceitemsheading" class="tipo_factura2"><div align="right">Sub Total:&nbsp;</div></td>
<td id="invoiceitemsheading" align="center" class="tipo_factura2"><div align="right" style="margin-right:15px;"><strong>$<? echo $total ?>.00</strong></div></td>
</tr>
<tr bgcolor="#ffffff">
<td id="invoiceitemsheading" class="tipo_factura2"><div align="right">Crédito:&nbsp;</div></td>
<td id="invoiceitemsheading" align="center" class="tipo_factura2"><div align="right" style="margin-right:15px;"><strong>$0.00</strong></div></td>
</tr>
<tr bgcolor="#ffffff">
<td id="invoiceitemsheading" class="tipo_factura2"><div align="right">Total a pagar:&nbsp;</div></td>
<td id="invoiceitemsheading" align="center" class="tipo_factura2"><div align="right" style="margin-right:15px;"><strong>$<? echo $total?>.00</strong></div></td>
</tr>
</tbody></table>

<br>
<br>
</td></tr>
</tbody></table>
<table cellspacing="0" cellpadding="0" align="center">
<tbody><tr><td>
<img src="<? echo base_url()?>public/images/back_invoice_04.png" border="0">
</td></tr>
</tbody></table>
<div class="ligas_fac">
<p class="comun" align="center" style="font-size:15px;">Este documento no es una factura electrónica y no tiene validez fiscal.<br> <comentar>Su factura electrónica seré emitida una vez que nuestro sistema detecte tu pago y le será enviada por correo electrónico.</comentar></p>
</div>
<p></p>
</body></html>