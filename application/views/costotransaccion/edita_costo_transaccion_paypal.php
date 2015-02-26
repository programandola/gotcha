<a href="<? echo base_url()?>costotransaccion"><< Regresar</a>
<br><br>
<h2>Editar Costo por Transacción (Tipo Propiedad) Paypal</h2>	
<div id="divAjaxEditaCostoTransaccion"></div>
<ul>
	<li>Tipo Propiedad -> <b><? echo $datos->nombre ?></b></li>
	<li>Costo Transacción = $ <input type="text" id="costo" name="costo" value="<? echo $datos->costo ?>" style="width:100px"></li>
	<input type="hidden" id="idTipoPropiedad" name="idTipoPropiedad" value="<? echo $datos->id_categoria ?>">
	<li><a href="javascript:void(0);" onclick="actualiza_costo_transaccion('<? echo base_url()?>costotransaccion/actualiza_costo_transaccion')" class="btn btn-primary fileupload-exists">Actualizar</a></li>
</ul>