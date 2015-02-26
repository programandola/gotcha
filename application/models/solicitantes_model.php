<?php

class Solicitantes_model Extends CI_Model{

	public function ingresa_clientes(){

		//validar si el cliente ya existe por medio del correo para no insertarlo nuevamente en la tabla de usuarios-sin-registro
		$solicitante=$this->get_cliente_por_correo($this->input->post("correo"));

		if(count($solicitante)>0){

			return $solicitante->id_solicitante;

		}else{

			//insertar en la tabla de solicitantes el nuevo cliente que requiere informacion de la propiedad
			if($this->input->post("mensaje")==""){
				$mensaje=$this->input->post("mensaje_original");
			}else{
				$mensaje=$this->input->post("mensaje");
			}
			$arreglo=array(
							"nombre"=>$this->input->post("nombre"),
							"correo"=>$this->input->post("correo"),
							"telefono"=>$this->input->post("telefono"),
							"celular"=>"",
							"comentario"=>$mensaje
					       );

			$this->db->insert('solicitantes', $arreglo);

			return $this->db->insert_id();
		

		}
		
		
	}


	public function ingresa_solicitantes_propiedades($id_solicitante, $IdPropiedad){

		$where=array("id_solicitante"=>$id_solicitante);
		$where1=array("id_propiedad"=>$IdPropiedad);
		
		$query=$this->db
		->select("id_solicitante")
		->from("solicitantes_propiedades")
		->where($where)
		->where($where1)
		->get();

		$row=$query->row();

		if(count($row)==0){

			if($this->input->post("mensaje")==""){
				$mensaje=$this->input->post("mensaje_original");
			}else{
				$mensaje=$this->input->post("mensaje");
			}

			$date=date("Y-m-d H:i:s");
			$arreglo=array(
							"id_propiedad"=>$IdPropiedad,
							"comentario"=>$mensaje,
							"status"=>"Sin Pagar",
							"id_solicitante"=>$id_solicitante,
							"fecha_registro"=>$date,
							"fecha_pago"=>null,
							"id_metodos_de_pago"=>null

					       );

			$this->db->insert('solicitantes_propiedades', $arreglo);
			//tabla backup de pagos paypal
			$this->db->insert('pagos_paypal_backup', $arreglo);

		}else{

			echo "Ya habías mandado un mensaje con anterioridad a esta propiedad!!!";

			exit;
		}
		
	}

	public function get_cliente_por_correo($correo=null){

		$where=array("correo"=>$correo);
		
		$query=$this->db
		->select("id_solicitante, correo")
		->from("solicitantes")
		->where($where)
		->get();

		return $query->row();

	}

	public function get_solicitante_propiedad_por_id($id=null){

		$where=array("id"=>$id);
		
		$query=$this->db
		->select("s.nombre as cliente, sp.id, p.id_categoria, sp.id_propiedad, p.nombre as propiedad, s.id_solicitante, s.correo, s.telefono, sp.comentario")
		->from("propiedades p")
		->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
		->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
		->where($where)
		->get();

		return $query->row();

	}

	public function get_solicitante_por_id($id=null){

		$where=array("id_solicitante"=>$id);
		
		$query=$this->db
		->select("nombre, correo")
		->from("solicitantes")
		->where($where)
		->get();

		return $query->row();

	}

	public function get_solicitantes_por_id_propiedad($idPropiedad){

		$where=array("id_propiedad"=>$idPropiedad);
		
		$query=$this->db
		->select("id_solicitante")
		->from("solicitantes_propiedades")
		->where($where)
		->get();

		return $query->result();

	}

	public function get_solicitantes_propiedades_por_id_solicitante($idSolicitante){

		$query=$this->db
		->select("id_solicitante")
		->from("solicitantes_propiedades")
		->where("id_solicitante",$idSolicitante)
		->get();

		return $query->row();
		
	}


	public function envia_mail_anunciante_con_datos_solicitante($idSolicitante){

		$solicitante=$this->get_solicitante_propiedad_por_id($idSolicitante);
		$anunciante=$this->usuarios_model->get_user_por_id_propiedad($solicitante->id_propiedad);
		$costoTransaccion=$this->propiedades_model->get_costo_transaccion_paypal_por_id_categoria($anunciante->id_categoria);	

		$mail = new PHPMailer();
		$mail->From = "staff@interhabita.com";
		$mail->FromName = "Staff Interhabita";
		$mail->Subject = " Nuevo Pago desde Depósito";
		$mail->AddAddress('no-reply@interhabita.com', 'Omar Serrano');

		$body='
		        <h1>Pago Correcto desde Depósito:</h2>
				<h2>Un anunciante realizo un nuevo pago por el medio de Pago Depósito en la pagina web Interhabita, detalles del pago:</h2>
				<p>Propiedad: <b>'.$solicitante->propiedad.'</b></p>
				<p>Anunciante: <b>'.$anunciante->nombre.'</b></p>
				<p>Monto Pago: <b>$'.$costoTransaccion->costo.'</b></p>
			   ';

		$mail->IsHTML(true);
		$mail->Body = $body;
		$mail->Send();

		//mandamos correo al anunciante con todos los datos de el solicitante comprado
		$mail1 = new PHPMailer();
		$mail1->From = "staff@interhabita.com";
		$mail1->FromName = "Staff Interhabita";
		$mail1->Subject = "Inmobiliaria Interhabita - Datos de Solicitante, Interesado en ".$solicitante->propiedad;
		$mail1->AddAddress($anunciante->correo, $anunciante->nombre);

		$body1='
				<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>
			    <title></title>
			    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			    <style type="text/css">
			@import url(https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic,500italic,700italic); body {margin: 0; padding: 0; min-width: 100%; } table {border-collapse: collapse; border-spacing: 0; } td {padding: 0; vertical-align: top; } .spacer, .border {font-size: 1px; line-height: 1px; } img {border: 0; -ms-interpolation-mode: bicubic; } .image {font-size: 0; Margin-bottom: 20px; } .image img {display: block; } .logo img {display: block; } strong {font-weight: bold; } h1, h2, h3, p, ol, ul, li {Margin-top: 0; } ol, ul, li {padding-left: 0; } .btn a {mso-hide: all; } blockquote {Margin-top: 0; Margin-right: 0; Margin-bottom: 0; padding-right: 0; } .column-top {font-size: 30px; line-height: 30px; } .column-bottom {font-size: 10px; line-height: 10px; } .column {text-align: left; } .contents {width: 100%; } .padded {padding-left: 40px; padding-right: 40px; } .wrapper {background-color: #1e1e1e; width: 100%; min-width: 620px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table.wrapper {table-layout: fixed; } .one-col, .two-col, .three-col {Margin-left: auto; Margin-right: auto; width: 600px; } .one-col p, .one-col ol, .one-col ul {Margin-bottom: 20px; } .two-col p, .two-col ol, .two-col ul {Margin-bottom: 20px; } .two-col .image {Margin-bottom: 20px; } .two-col .column-top {font-size: 40px; line-height: 40px; } .two-col .column-bottom {font-size: 20px; line-height: 20px; } .two-col .column {width: 290px; } .two-col .gutter {width: 20px; font-size: 1px; line-height: 1px; } .three-col p, .three-col ol, .three-col ul {Margin-bottom: 20px; } .three-col .image {Margin-bottom: 20px; } .three-col .column-top {font-size: 20px; line-height: 20px; } .three-col .column-bottom {font-size: 0px; line-height: 0px; } .three-col .column, .two-col .column-narrower {width: 190px; } .three-col .gutter {width: 15px; font-size: 1px; line-height: 1px; } .three-col .padded {padding-left: 20px; padding-right: 20px; } .wider {width: 390px; } .narrower {width: 190px; } @media only screen and (max-width: 620px) {[class*=wrapper] {min-width: 280px !important; width: 100%!important; } [class*=wrapper] .one-col, [class*=wrapper] .two-col, [class*=wrapper] .three-col {width: 280px !important; } [class*=wrapper] .column {display: block; float: left; width: 280px !important; } [class*=wrapper] .padded {padding-left: 20px !important; padding-right: 20px !important; } [class*=wrapper] .full {display: none; } [class*=wrapper] .block {display: block !important; } [class*=wrapper] .hide {display: none !important; } [class*=wrapper] .image {margin-bottom: 20px !important; } [class*=wrapper] .image img {height: auto !important; width: 100% !important; } } h1, h2, h3 {font-weight: normal; } p, ol, ul {font-weight: 400; } table.wrapper {background-color: #1e1e1e; } .column table, .padded table {width: 100%; } .preheader {width: 100%; background-color: #191919; } .preheader .title, .preheader .webversion {color: #e6e6e6; font-size: 11px; line-height: 16px; } .preheader .title {padding: 9px; text-align: left; } .preheader .webversion {padding: 9px; text-align: right; width: 250px; } .preheader .webversion a {font-weight: bold; color: #e6e6e6; text-decoration: none; } .preheader .preheader-buffer {font-size: 20px; line-height: 20px; background-color: #1e1e1e; } .logo {color: #ffffff; font-size: 36px; line-height: 42px; padding-top: 20px; padding-bottom: 40px; text-align: center; width: 520px; } .logo a {color: #ffffff; text-decoration: none; } ul li {list-style-type: disc; list-style-position: outside; } p, ol, ul {-webkit-font-smoothing: antialiased; } .wrapper {background-color: #1e1e1e; } .wrapper .btn a {transition: background-color 0.2s; } .wrapper h1, .wrapper h2, .wrapper h3, .wrapper p, .wrapper ol, .wrapper ul, .wrapper blockquote p, .wrapper .logo, .wrapper .btn a, .wrapper .footer div, .wrapper .footer td, .wrapper .preheader .title, .wrapper .preheader .webversion {font-family: sans-serif; } @media screen and (min-width: 0) {.wrapper h1, .wrapper h2, .wrapper h3, .wrapper p, .wrapper ol, .wrapper ul, .wrapper blockquote p, .wrapper .logo, .wrapper .btn a, .wrapper .footer div, .wrapper .footer td, .wrapper .preheader .title, .wrapper .preheader .webversion {font-family: Ubuntu, sans-serif !important; } } h1 a, h2 a, h3 a {text-decoration: none; } .one-col, .two-col, .three-col, .preheader, .header, .footer {Margin-left: auto; Margin-right: auto; } .one-col .padded, .two-col .padded, .three-col .padded, .preheader .padded, .header .padded, .footer .padded {text-align: left; } .one-col blockquote, .two-col blockquote, .three-col blockquote, .preheader blockquote, .header blockquote, .footer blockquote {Margin-left: 0; background-repeat: no-repeat; background-position: 0px 4px; } .one-col blockquote p, .two-col blockquote p, .three-col blockquote p, .preheader blockquote p, .header blockquote p, .footer blockquote p {font-style: italic; } .column table td table:nth-last-child(2) td h1:last-child, .column-wider table td table:nth-last-child(2) td h1:last-child, .column-narrower table td table:nth-last-child(2) td h1:last-child, .column table td table:nth-last-child(2) td h2:last-child, .column-wider table td table:nth-last-child(2) td h2:last-child, .column-narrower table td table:nth-last-child(2) td h2:last-child, .column table td table:nth-last-child(2) td h3:last-child, .column-wider table td table:nth-last-child(2) td h3:last-child, .column-narrower table td table:nth-last-child(2) td h3:last-child, .column table td table:nth-last-child(2) td p:last-child, .column-wider table td table:nth-last-child(2) td p:last-child, .column-narrower table td table:nth-last-child(2) td p:last-child, .column table td table:nth-last-child(2) td ol:last-child, .column-wider table td table:nth-last-child(2) td ol:last-child, .column-narrower table td table:nth-last-child(2) td ol:last-child, .column table td table:nth-last-child(2) td ul:last-child, .column-wider table td table:nth-last-child(2) td ul:last-child, .column-narrower table td table:nth-last-child(2) td ul:last-child {Margin-bottom: 20px; } .btn {Margin-bottom: 20px; } .btn a {-webkit-font-smoothing: antialiased; padding-top: 15px; padding-bottom: 15px; font-weight: 500; display: inline-block; font-size: 16px; line-height: 20px; text-align: center; text-decoration: none; border-bottom: 3px solid #1e1e1e; } .one-col .btn a, .one-col-feature .btn a {width: 480px; padding-left: 20px; padding-right: 20px; } .two-col .column .btn a {width: 170px; padding-left: 20px; padding-right: 20px; } .two-col .column-narrower .btn a {width: 130px; padding-left: 10px; padding-right: 10px; } .two-col .column-wider .btn a {width: 270px; padding-left: 20px; padding-right: 20px; } .three-col .btn a {width: 130px; padding-left: 10px; padding-right: 10px; } .divider table {font-size: 0; height: 6px; line-height: 6px; Margin-bottom: 20px; } .one-col .padded ul li {padding-left: 13px; } .one-col h1 {font-size: 30px; line-height: 44px; Margin-bottom: 16px; } .one-col h2 {font-size: 20px; line-height: 28px; Margin-bottom: 14px; } .one-col h3 {font-size: 16px; line-height: 22px; Margin-bottom: 12px; } .one-col p, .one-col ol, .one-col ul {font-size: 14px; line-height: 22px; Margin-bottom: 20px; } .one-col ol, .one-col ul {Margin-left: 48px; } .one-col ol li, .one-col ul li {Margin-bottom: 10px; padding-left: 13px; } .one-col blockquote p {font-size: 18px; line-height: 26px; } .one-col blockquote p, .one-col blockquote h1, .one-col blockquote h2, .one-col blockquote h3, .one-col blockquote ol, .one-col blockquote ul {padding-left: 60px; } .one-col-feature {width: 600px; Margin-left: auto; Margin-right: auto; } .one-col-feature h1, .one-col-feature h2, .one-col-feature h3, .one-col-feature p, .one-col-feature ol, .one-col-feature ul, .one-col-feature a {color: #212a32; } .one-col-feature h1 a, .one-col-feature h2 a, .one-col-feature h3 a, .one-col-feature p a, .one-col-feature li a {text-decoration: none; font-weight: normal; } .one-col-feature h1 {font-size: 30px; line-height: 46px; Margin-bottom: 20px; } .one-col-feature h2 {font-size: 24px; line-height: 40px; Margin-bottom: 16px; } .one-col-feature h3 {font-size: 20px; line-height: 30px; Margin-bottom: 14px; } .one-col-feature p {font-size: 18px; line-height: 30px; Margin-bottom: 20px; } .one-col-feature ol {Margin-left: 36px; } .one-col-feature ol li {padding-left: 15px; } .one-col-feature ul {Margin-left: 30px; } .one-col-feature ul li {padding-left: 20px; list-style-image: url(https://i3.createsend1.com/static/eb/master/09-onyx/images/bullet-large.png); line-height: 40px; } .one-col-feature ol, .one-col-feature ul {font-size: 26px; line-height: 40px; } .one-col-feature li {Margin-bottom: 0; } .one-col-feature h1, .one-col-feature h2, .one-col-feature h3, .one-col-feature p {text-align: center; } .one-col-feature blockquote {Margin: 0; background-repeat: no-repeat; background-position: 100% 100%; } 

			.one-col-feature blockquote p:first-child, .one-col-feature blockquote h1:first-child, .one-col-feature blockquote h2:first-child, .one-col-feature blockquote h3:first-child, .one-col-feature blockquote ol:first-child, .one-col-feature blockquote ul:first-child {padding-top: 27px; } .one-col-feature blockquote p, .one-col-feature blockquote h1, .one-col-feature blockquote h2, .one-col-feature blockquote h3, .one-col-feature blockquote ol, .one-col-feature blockquote ul {background-repeat: no-repeat; background-position: 0% 0%; font-size: 26px; line-height: 40px; padding: 0; font-style: italic; } .one-col-feature blockquote p:last-child, .one-col-feature blockquote h1:last-child, .one-col-feature blockquote h2:last-child, .one-col-feature blockquote h3:last-child, .one-col-feature blockquote ol:last-child, .one-col-feature blockquote ul:last-child {padding-bottom: 30px; Margin-bottom: 20px; } .one-col-feature .divider {Margin-bottom: 20px; } .one-col-feature .divider img {display: block; Margin-left: auto; Margin-right: auto; } .one-col-feature .btn a {background-color: #ffffff; color: #212a32; } .two-col h1 {font-size: 30px; line-height: 44px; Margin-bottom: 16px; } .two-col h2 {font-size: 20px; line-height: 28px; Margin-bottom: 14px; } .two-col h3 {font-size: 16px; line-height: 22px; Margin-bottom: 12px; } .two-col p, .two-col ol, .two-col ul {font-size: 14px; line-height: 22px; Margin-bottom: 20px; } .two-col ol, .two-col ul {Margin-left: 18px; } .two-col li {Margin-bottom: 10px; padding-left: 20px; } .two-col .btn a {font-size: 16px; line-height: 20px; } .two-col blockquote p, .two-col blockquote h1, .two-col blockquote h2, .two-col blockquote h3, .two-col blockquote ol, .two-col blockquote ul {padding-left: 38px; } .two-col .column-wider {width: 390px; } .two-col .column-narrower {width: 190px; } .three-col .column .padded, .two-col .column-narrower .padded {padding-left: 20px; padding-right: 20px; } .three-col .column h1, .two-col .column-narrower h1 {font-size: 20px; line-height: 28px; Margin-bottom: 14px; } .three-col .column h2, .two-col .column-narrower h2 {font-size: 16px; line-height: 22px; Margin-bottom: 12px; } .three-col .column h3, .two-col .column-narrower h3 {font-size: 14px; line-height: 20px; Margin-bottom: 8px; } .three-col .column p, .three-col .column ol, .three-col .column ul, .two-col .column-narrower p, .two-col .column-narrower ol, .two-col .column-narrower ul {font-size: 14px; line-height: 22px; Margin-bottom: 20px; } .three-col .column ol, .three-col .column ul, .two-col .column-narrower ol, .two-col .column-narrower ul {Margin-left: 18px; } .three-col .column ol li, .three-col .column ul li, .two-col .column-narrower ol li, .two-col .column-narrower ul li {Margin-bottom: 10px; padding-left: 10px; } .three-col .column .btn a, .two-col .column-narrower .btn a {padding-top: 10px; padding-bottom: 10px; } .three-col .column blockquote p, .three-col .column blockquote h1, .three-col .column blockquote h2, .three-col .column blockquote h3, .three-col .column blockquote ol, .three-col .column blockquote ul, .two-col .column-narrower blockquote p, .two-col .column-narrower blockquote h1, .two-col .column-narrower blockquote h2, .two-col .column-narrower blockquote h3, .two-col .column-narrower blockquote ol, .two-col .column-narrower blockquote ul {padding-left: 28px; } .contents-green {background-color: #27da90; } .contents-green h1 a, .contents-green h2 a, .contents-green h3 a, .contents-green p a, .contents-green li a {border-bottom: 1px solid #212a32; } .contents-green .btn a {border-bottom-color: #1eb074; } .contents-green blockquote {background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark-green.png); } .contents-green blockquote p:first-child, .contents-green blockquote h1:first-child, .contents-green blockquote h2:first-child, .contents-green blockquote h3:first-child, .contents-green blockquote ol:first-child, .contents-green blockquote ul:first-child {background-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark-green.png); } .contents-orange {background-color: #ed5a32; } .contents-orange h1 a, .contents-orange h2 a, .contents-orange h3 a, .contents-orange p a, .contents-orange li a {border-bottom: 1px solid #212a32; } .contents-orange .btn a {border-bottom-color: #d93d13; } .contents-orange blockquote {background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark-orange.png); } .contents-orange blockquote p:first-child, .contents-orange blockquote h1:first-child, .contents-orange blockquote h2:first-child, .contents-orange blockquote h3:first-child, .contents-orange blockquote ol:first-child, .contents-orange blockquote ul:first-child {background-image: url(https://i7.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark-orange.png); } .contents-grey {background-color: #e6e7e8; } .contents-grey h1 a, .contents-grey h2 a, .contents-grey h3 a, .contents-grey p a, .contents-grey li a {border-bottom: 1px solid #212a32; } .contents-grey .btn a {border-bottom-color: #cbced0; } .contents-grey blockquote {background-image: url(https://i9.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark-grey.png); } .contents-grey blockquote p:first-child, .contents-grey blockquote h1:first-child, .contents-grey blockquote h2:first-child, .contents-grey blockquote h3:first-child, .contents-grey blockquote ol:first-child, .contents-grey blockquote ul:first-child {background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark-grey.png); } .contents-green .btn a:hover, .contents-orange .btn a:hover, .contents-grey .btn a:hover {background-image: none!important; background-color: #f1f2f2!important; } .contents {background-color: #212a32; } .contents p, .contents ol, .contents ul {color: #ffffff; } .contents-accent-blue .btn a, .contents-accent-pink .btn a, .contents-accent-orange .btn a, .contents-accent-aqua .btn a {background-repeat: repeat-x; color: #ffffff; } .contents-accent-blue .btn a:hover, .contents-accent-pink .btn a:hover, .contents-accent-orange .btn a:hover, .contents-accent-aqua .btn a:hover {background-image: none!important; } .contents-accent-blue {width: 100%; background-color: #212a32; } .contents-accent-blue p, .contents-accent-blue ol, .contents-accent-blue ul {color: #ffffff; } .contents-accent-blue h1, .contents-accent-blue h2, .contents-accent-blue h3, .contents-accent-blue h1 a, .contents-accent-blue h2 a, .contents-accent-blue h3 a, .contents-accent-blue a {color: #3d88fd; } .contents-accent-blue h1 a, .contents-accent-blue h2 a, .contents-accent-blue h3 a {border-bottom: 1px solid #3d88fd; } .contents-accent-blue ul li {list-style-image: url(https://i10.createsend1.com/static/eb/master/09-onyx/images/bullet-blue.png); } .contents-accent-blue .btn a {background-color: #367ffd; background-image: url(https://i1.createsend1.com/static/eb/master/09-onyx/images/btn-blue.png); } .contents-accent-blue .btn a:hover {background-color: #1d64d2!important; } .contents-accent-blue blockquote {background-image: url(https://i3.createsend1.com/static/eb/master/09-onyx/images/quote-blue.png); } .contents-accent-aqua {width: 100%; background-color: #212a32; } .contents-accent-aqua p, .contents-accent-aqua ol, .contents-accent-aqua ul {color: #ffffff; } .contents-accent-aqua h1, .contents-accent-aqua h2, .contents-accent-aqua h3, .contents-accent-aqua h1 a, .contents-accent-aqua h2 a, .contents-accent-aqua h3 a, .contents-accent-aqua a {color: #00b5d6; } .contents-accent-aqua h1 a, .contents-accent-aqua h2 a, .contents-accent-aqua h3 a {border-bottom: 1px solid #00b5d6; } .contents-accent-aqua ul li {list-style-image: url(https://i2.createsend1.com/static/eb/master/09-onyx/images/bullet-aqua.png); } .contents-accent-aqua .btn a {background-color: #00add1; background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/btn-aqua.png); } .contents-accent-aqua .btn a:hover {background-color: #0092ad!important; } .contents-accent-aqua blockquote {background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-aqua.png); } .column-narrower .contents-accent-aqua .padded blockquote {background-image: url(https://i7.createsend1.com/static/eb/master/09-onyx/images/quote-aqua-single.png); } .column-narrower .contents-accent-aqua .padded blockquote p, .column-narrower .contents-accent-aqua .padded blockquote h1, .column-narrower .contents-accent-aqua .padded blockquote h2, .column-narrower .contents-accent-aqua .padded blockquote h3 {padding-left: 28px; } .contents-accent-pink {width: 100%; background-color: #212a32; } .contents-accent-pink p, .contents-accent-pink ol, .contents-accent-pink ul {color: #ffffff; } .contents-accent-pink h1, .contents-accent-pink h2, .contents-accent-pink h3, .contents-accent-pink h1 a, .contents-accent-pink h2 a, .contents-accent-pink h3 a, .contents-accent-pink a {color: #f63366; } .contents-accent-pink h1 a, .contents-accent-pink h2 a, .contents-accent-pink h3 a {border-bottom: 1px solid #f63366; } .contents-accent-pink ul li {list-style-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/bullet-pink.png); } .contents-accent-pink .btn a {background-color: #f52d5d; background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/btn-pink.png); } .contents-accent-pink .btn a:hover {background-color: #c93057!important; } .contents-accent-pink blockquote {background-image: url(https://i9.createsend1.com/static/eb/master/09-onyx/images/quote-pink.png); } .contents-accent-orange {width: 100%; background-color: #212a32; } .contents-accent-orange p, .contents-accent-orange ol, .contents-accent-orange ul {color: #ffffff; } .contents-accent-orange h1, .contents-accent-orange h2, .contents-accent-orange h3, .contents-accent-orange h1 a, .contents-accent-orange h2 a, .contents-accent-orange h3 a, .contents-accent-orange a {color: #ff9e05; } .contents-accent-orange h1 a, .contents-accent-orange h2 a, .contents-accent-orange h3 a {border-bottom: 1px solid #ff9e05; } .contents-accent-orange ul li {list-style-image: url(https://i1.createsend1.com/static/eb/master/09-onyx/images/bullet-orange.png); } .contents-accent-orange .btn a {background-color: #ff9306; background-image: url(https://i3.createsend1.com/static/eb/master/09-onyx/images/btn-orange.png); } .contents-accent-orange .btn a:hover {background-color: #ff8a00!important; } .contents-accent-orange blockquote {background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-orange.png); } .footer {width: 100%; background-color: #191919; } .footer .padded {padding-left: 20px; padding-right: 20px; } .footer td {color: #cccccc; font-size: 12px; line-height: 20px; } .footer .contents {background-color: #191919; } .footer .footer-container .column-details {padding: 40px 0 75px 0; } .footer .footer-container .column-details td {text-align: left; } .footer .footer-container .column-social {width: 140px; padding: 42px 0 75px 20px; } .footer .footer-container .column-social td {text-align: left; } .footer .social {width: 170px; } .footer .social a {text-decoration: none; } .footer .social .social-icon {width: 39px; } 

			.footer .social .social-text {width: 131px; text-transform: uppercase; letter-spacing: 0.15em; font-size: 10px; line-height: 12px; vertical-align: middle; color: #cccccc; } .footer .social .social-text a {color: #cccccc; } .footer .social-space {font-size: 10px; line-height: 10px; display: block; width: 100%; } .footer .prefs a {color: #cccccc; } .footer .address, .footer .permission {display: block; } .footer .address a, .footer .permission a {color: #cccccc; text-decoration: underline; } .footer .address {Margin-bottom: 17px; } @media (min-width: 0) {body {background-color: #191919; } } @media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi) {.one-col ul {border-left: 30px solid #212a32; } } @media (-webkit-min-device-pixel-ratio: 1.5) and (min-width: 620px), (min-resolution: 144dpi) and (min-width: 620px) {.contents-accent-blue blockquote {background-size: 40px!important; background-image: url(https://i10.createsend1.com/static/eb/master/09-onyx/images/quote-blue@2x.png) !important; } .contents-accent-aqua blockquote {background-size: 30px!important; background-image: url(https://i2.createsend1.com/static/eb/master/09-onyx/images/quote-aqua@2x.png) !important; } .column-narrower .contents-accent-aqua blockquote {background-position: -15px 6px !important; } .contents-accent-pink blockquote {background-size: 30px!important; background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/quote-pink@2x.png) !important; } .contents-accent-orange blockquote {background-size: 10px!important; background-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/quote-orange@2x.png) !important; } *[class*=contents-accent] ul li {padding-left: 30px!important; } } @media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi), (max-width: 620px) {[class*=wrapper] .one-col-feature blockquote {background-size: 30px!important; background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark@2x.png) !important; background-position: 50% 100%!important; } [class*=wrapper] .one-col-feature blockquote p:first-child, [class*=wrapper] .one-col-feature blockquote h1:first-child, [class*=wrapper] .one-col-feature blockquote h2:first-child, [class*=wrapper] .one-col-feature blockquote h3:first-child, [class*=wrapper] .one-col-feature blockquote ol:first-child, [class*=wrapper] .one-col-feature blockquote ul:first-child {background-size: 30px!important; background-image: url(https://i10.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark@2x.png) !important; background-position: 50% 0%!important; } [class*=wrapper] .contents-accent-blue ul li {background: transparent url(https://i7.createsend1.com/static/eb/master/09-onyx/images/bullet-blue@2x.png) no-repeat top left !important; } [class*=wrapper] .contents-accent-aqua ul li {background: transparent url(https://i9.createsend1.com/static/eb/master/09-onyx/images/bullet-aqua@2x.png) no-repeat top left !important; } [class*=wrapper] .contents-accent-pink ul li {background: transparent url(https://i1.createsend1.com/static/eb/master/09-onyx/images/bullet-pink@2x.png) no-repeat top left !important; } [class*=wrapper] .contents-accent-orange ul li {background: transparent url(https://i3.createsend1.com/static/eb/master/09-onyx/images/bullet-orange@2x.png) no-repeat top left !important; } [class*=wrapper] *[class*=contents-accent] ul {margin-left: 0px!important; } [class*=wrapper] *[class*=contents-accent] ul li {list-style-type: none!important; list-style-image: none!important; background-size: 10px 10px!important; background-position: 0 5px!important; } [class*=wrapper] .one-col-feature ul {margin-left: 0!important; } [class*=wrapper] .one-col-feature ul li {list-style: none!important; background: transparent url(https://i2.createsend1.com/static/eb/master/09-onyx/images/bullet-large@2x.png) no-repeat top left !important; background-size: 20px!important; background-position: 0 9px!important; padding-left: 50px; } } @media (-webkit-min-device-pixel-ratio: 1.5) and (max-width: 620px), (min-resolution: 144dpi) and (max-width: 620px) {[class*=wrapper] .one-col ul {margin-left: 0!important; border: 0!important; } [class*=wrapper] .one-col .divider table, [class*=wrapper] .two-col .column .divider table, [class*=wrapper] .two-col .column-narrower .divider table, [class*=wrapper] .two-col .column-wider .divider table, [class*=wrapper] .three-col .divider table {background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/divider-waves@2x.png) !important; } } @media only screen and (max-width: 620px) {[class*=wrapper] .column table td table:nth-last-child(2) td h1:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td h1:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td h1:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td h2:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td h2:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td h2:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td h3:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td h3:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td h3:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td p:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td p:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td p:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td ol:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td ol:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td ol:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td ul:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td ul:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td ul:last-child {Margin-bottom: 20px !important; } [class*=wrapper] *[class*=contents-accent] blockquote {background-size: 30px!important; } [class*=wrapper] *[class*=contents-accent] blockquote p, [class*=wrapper] *[class*=contents-accent] blockquote h1, [class*=wrapper] *[class*=contents-accent] blockquote h2, [class*=wrapper] *[class*=contents-accent] blockquote h3, [class*=wrapper] *[class*=contents-accent] blockquote ol, [class*=wrapper] *[class*=contents-accent] blockquote ul {padding-left: 38px!important; } [class*=wrapper] .contents-accent-blue blockquote {background-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/quote-mobile-blue@2x.png) !important; } [class*=wrapper] .contents-accent-aqua blockquote {background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/quote-mobile-aqua@2x.png) !important; } [class*=wrapper] .contents-accent-pink blockquote {background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/quote-pink@2x.png) !important; } [class*=wrapper] .contents-accent-orange blockquote {background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-mobile-orange@2x.png) !important; } [class*=wrapper] *[class*=contents-accent] ul li {padding-left: 38px!important; } [class*=wrapper] *[class*=contents-accent] ol li {padding-left: 18px!important; } [class*=wrapper] .spacer {display: none!important; } [class*=wrapper] .header .logo {padding: 40px 0!important; font-size: 24px !important; line-height: 1.3em !important; margin-bottom: 0 !important; } [class*=wrapper] .header .logo img {display: inline-block !important; max-width: 240px !important; height: auto!important; } [class*=wrapper] .header {width: 280px!important; } [class*=wrapper] .preheader-buffer {font-size: 10px !important; line-height: 10px !important; } [class*=wrapper] .preheader .webversion, [class*=wrapper] .header .logo a {text-align: center !important; } [class*=wrapper] *[class*=contents] blockquote p {font-size: 18px!important; line-height: 26px!important; } [class*=wrapper] *[class*=contents] h1 {font-size: 30px!important; line-height: 44px!important; margin-bottom: 16px!important; } [class*=wrapper] *[class*=contents] h2 {font-size: 20px!important; line-height: 28px!important; margin-bottom: 16px!important; } [class*=wrapper] *[class*=contents] h3 {font-size: 16px!important; line-height: 22px!important; margin-bottom: 12px!important; } [class*=wrapper] .column-wider, [class*=wrapper] .column-narrower {display: block; float: left; width: 280px !important; } [class*=wrapper] .one-col-feature {width: 280px !important; } [class*=wrapper] .one-col-feature li {font-size: 18px!important; line-height: 28px!important; } [class*=wrapper] .one-col-feature ol {margin-left: 22px!important; } [class*=wrapper] .one-col-feature ol li {padding-left: 18px!important; } [class*=wrapper] .one-col-feature ul li {background-size: 10px!important; padding-left: 40px!important; } [class*=wrapper] .one-col-feature blockquote p, [class*=wrapper] .one-col-feature blockquote h1, [class*=wrapper] .one-col-feature blockquote h2, [class*=wrapper] .one-col-feature blockquote h3, [class*=wrapper] .one-col-feature blockquote ol, [class*=wrapper] .one-col-feature blockquote ul {font-size: 26px!important; line-height: 40px!important; } [class*=wrapper] .btn a {padding: 15px 10px!important; width: 220px!important; } [class*=wrapper] .gutter {display: block!important; font-size: 10px; line-height: 10px; height: 10px!important; } [class*=wrapper] table.one-col, [class*=wrapper] table.one-col-feature, [class*=wrapper] td.last {margin-bottom: 10px!important; } [class*=wrapper] ol, [class*=wrapper] ul {margin-left: 20px !important; } [class*=wrapper] .footer *[class*="column"], [class*=wrapper] .preheader *[class*="column"] {display: block !important; text-align: center!important; } [class*=wrapper] .footer .title, [class*=wrapper] .preheader .title {display: none!important; } [class*=wrapper] .one-col .divider table, [class*=wrapper] .two-col .column .divider table, [class*=wrapper] .two-col .column-narrower .divider table, [class*=wrapper] .two-col .column-wider .divider table, [class*=wrapper] .three-col .divider table {background: transparent url(https://i7.createsend1.com/static/eb/master/09-onyx/images/divider-waves.png) repeat center center; background-size: auto 6px!important; width: 240px !important; } [class*=wrapper] .one-col .divider table img, [class*=wrapper] .two-col .column .divider table img, [class*=wrapper] .two-col .column-narrower .divider table img, [class*=wrapper] .two-col .column-wider .divider table img, [class*=wrapper] .three-col .divider table img {display: none!important; } [class*=wrapper] .footer .footer-container {width: 280px !important; } [class*=wrapper] .footer .column-social {padding-left: 0!important; padding-right: 0!important; width: 100% !important; } [class*=wrapper] .footer .column-details {width: 100% !important; } [class*=wrapper] .footer .social {width: 280px!important; } [class*=wrapper] .footer .social .social-text {padding: 0!important; text-align: left !important; width: auto !important; } [class*=wrapper] .footer .social-space {display: none !important; } [class*=wrapper] .footer .button {width: auto !important; margin: 0 auto 10px !important; } [class*=wrapper] .footer *[class*=column] {padding-top: 15px!important; padding-bottom: 10px!important; } [class*=wrapper] .footer *[class*=column] td {text-align: center!important; } [class*=wrapper] .footer *[class*=column] .padded {padding: 0!important; } [class*=wrapper] .footer *[class*=column] .social {width: 100%!important; margin-top: 15px!important; } } 
			</style>
			    <!--[if (gte mso 9)|(IE)]>
			    <style>
			      li {
			        padding-left: 5px !important;
			        margin-left: 10px !important;
			      }
			      ul li {
			        list-style-image: none !important;
			        list-style-type: disc !important;
			      }
			      ol, ul {
			        margin-left: 20px !important;
			      }
			      .image-bottom, .spacer, .border, .column-top, .column-bottom {
			        mso-line-height-rule: exactly !important;
			      }
			    </style>
			    <![endif]-->
			    <!--[if gte mso 9]>
			    <style>
			      blockquote p {
			        padding-left: 0px !important;
			        margin-left: 0px !important;
			      }
			    </style>
			    <![endif]-->
			  <meta name="robots" content="noindex,nofollow" />
			<meta property="og:title" content="My First Campaign" />
			</head>
			  <body class="emb-font-stack-default" bgcolor="#ffffff">
			    <center class="wrapper" style="background-color: #1e1e1e;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%">
			      <table class="wrapper" style="border-collapse: collapse;border-spacing: 0;background-color: #1e1e1e;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed">
			        <tbody><tr>
			          <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
			            <center>
			              <table class="preheader" style="border-collapse: collapse;border-spacing: 0;width: 100%;background-color: #191919;Margin-left: auto;Margin-right: auto">
			                <tbody><tr>
			                  
			                  
			                </tr>
			                <tr><td class="preheader-buffer" style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;font-size: 20px;line-height: 20px;background-color: #1e1e1e" colspan="2">&nbsp;</td></tr>
			              </tbody></table>
			              <table class="header" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto">
			                <tbody><tr>
			                  <td class="logo" style="padding-top: 20px;padding-bottom: 40px;padding-left: 0;padding-right: 0;vertical-align: top;color: #ffffff;font-size: 36px;line-height: 42px;text-align: center;width: 600px;font-family: sans-serif" align="center" bgcolor="#000"><center><div id="emb-email-header"><a style="color: #ffffff;text-decoration: none" href="http://preview.createsend1.com/t/t-l-jyjrtjd-l-r/"><img style="border-left-width: 0;border-top-width: 0;border-bottom-width: 0;border-right-width: 0;-ms-interpolation-mode: bicubic;display: block;max-width: 400px" src="http://interhabita.com/public/images/logo.png" alt="InterHabita" width="298" height="67" /></a></div></center></td>
			                </tr>
			              </tbody></table>
			            </center>
			          </td>
			        </tr>
			      </tbody></table>
			      
			          <table class="wrapper" style="border-collapse: collapse;border-spacing: 0;background-color: #1e1e1e;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed">
			            <tbody><tr>
			              <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
			                <center>
			                  <table class="one-col-feature" style="border-collapse: collapse;border-spacing: 0;width: 600px;Margin-left: auto;Margin-right: auto">
			                    <tbody><tr>
			                      <td class="column" style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;text-align: left">
			                        <table class="contents-grey" style="border-collapse: collapse;border-spacing: 0;width: 100%;background-color: #e6e7e8">
			                          <tbody><tr>
			                            <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
			                              <div><div class="column-top" style="font-size: 30px;line-height: 30px">&nbsp;</div></div>
			                                
			                                <table style="border-collapse: collapse;border-spacing: 0;width: 100%" width="100%">
			                                  <tbody><tr>
			                                    <td class="padded" style="padding-top: 0;padding-bottom: 0;padding-left: 40px;padding-right: 40px;vertical-align: top">
			            <!-- CONTENIDO HTML -->                         
			            <table><tbody><tr height="25px"></tr><tr><td width="600" align="center">
									<p>Estimado(a): '.$anunciante->nombre.', te enviamos todos los datos de contacto que</p>
			<p>'.$solicitante->cliente.' ingresó  para que lo contactes a la brevedad.</p>
			<p>
				</p><table width="500px" style="font-size: 16px;line-height: 24px;font-family: Ubuntu, sans-serif">
					<tbody><tr><td bgcolor="#ccc" width="150"><strong>ID de Propiedad:</strong></td><td  width="410">'.$solicitante->id_propiedad.'</td></tr>
					<tr><td bgcolor="#ccc"><strong>Nombre:</strong></td><td >'.$solicitante->cliente.'</td></tr>
					<tr><td bgcolor="#ccc"><strong>Teléfono:</strong></td><td >'.$solicitante->telefono.'</td></tr>
					<tr><td bgcolor="#ccc"><strong>Email:</strong></td><td ><a href="mailto:[Email]" style="color:black">'.$solicitante->correo.'</a></td></tr>
					<tr><td bgcolor="#ccc"><strong>Mensaje:</strong></td><td >'.$solicitante->comentario.'</td></tr>
				</tbody></table>
			<p></p> 
			<p>Suerte y esperamos que cierres esta venta!</p>
			</td></tr><tr height="25px"></tr></tbody></table>
			          
			                                    <!-- CONTENIDO HTML FIN--></td>
			                                  </tr>
			                                </tbody></table>
			                              
			                                
			                                <table style="border-collapse: collapse;border-spacing: 0;width: 100%" width="100%">
			                                  <tbody><tr>
			                                    <td class="padded" style="padding-top: 0;padding-bottom: 0;padding-left: 40px;padding-right: 40px;vertical-align: top">
			                                      
			           <div class="btn" style="Margin-bottom: 20px">
              <a style="mso-hide: all;-webkit-font-smoothing: antialiased;padding-top: 15px;padding-bottom: 15px;font-weight: 500;display: inline-block;font-size: 16px;line-height: 20px;text-align: center;text-decoration: none;border-bottom-color: #cbced0;border-bottom-style: solid;border-bottom-width: 3px;color: #212a32;transition: background-color 0.2s;font-family: sans-serif;width: 480px;padding-left: 20px;padding-right: 20px;background-color: #ffffff" href="http://www.interhabita.com">Ir a InterHabita</a></div>
			          
			                                    </td>
			                                  </tr>
			                                </tbody></table>
			                              
			                              <div class="column-bottom" style="font-size: 10px;line-height: 10px">&nbsp;</div>
			                            </td>
			                          </tr>
			                        </tbody></table>
			                      </td>
			                    </tr>
			                  </tbody></table>
			                </center>
			              </td>
			            </tr>
			          </tbody></table>
			        
			          <div class="spacer" style="font-size: 1px;line-height: 20px">&nbsp;</div>
			        
			      <table class="wrapper" style="border-collapse: collapse;border-spacing: 0;background-color: #1e1e1e;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed">
			        <tbody><tr>
			          <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
			            <center>
			              <table class="footer" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 100%;background-color: #191919">
			                <tbody><tr>
			                  <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;color: #cccccc;font-size: 12px;line-height: 20px;font-family: sans-serif">
			                    <center>
			                      <table class="one-col" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 600px">
			                        <tbody><tr>
			                          <td class="column" style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;text-align: left;color: #cccccc;font-size: 12px;line-height: 20px;font-family: sans-serif">
			                            <table class="contents" style="border-collapse: collapse;border-spacing: 0;width: 100%;background-color: #191919">
			                              <tbody><tr>
			                                <td class="padded" style="padding-top: 0;padding-bottom: 0;padding-left: 20px;padding-right: 20px;vertical-align: top;color: #cccccc;font-size: 12px;line-height: 20px;text-align: left;font-family: sans-serif">
			                                  <table class="footer-container" style="border-collapse: collapse;border-spacing: 0;width: 100%">
			                                    <tbody><tr>
			                                      <td class="column-details" style="padding-top: 40px;padding-bottom: 75px;padding-left: 0;padding-right: 0;vertical-align: top;color: #cccccc;font-size: 12px;line-height: 20px;font-family: sans-serif">
			                                       
			                                      </td>
			                                      
			                                    </tr>
			                                  </tbody></table>
			                                </td>
			                              </tr>
			                            </tbody></table>
			                          </td>
			                        </tr>
			                      </tbody></table>
			                    </center>
			                  </td>
			                </tr>
			              </tbody></table>
			            </center>
			          </td>
			        </tr>
			      </tbody></table>
			    </center>
			</body></html>
		';


		$mail1->IsHTML(true);
		$mail1->Body = $body1;
		$mail1->Send();



	}

	public function get_all_solicitantes_propiedades(){

		
		$query=$this->db
		->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
		->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
		->from("propiedades p")
		->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
		->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
		->get();

		return $query->result();

	
	}

	public function get_solicitantes_propiedades($statusPago, $deposito){

		if(!empty($deposito)){
			$query=$this->db
			->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
			->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
			->from("propiedades p")
			->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
			->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
			->where("sp.status",$statusPago)
			->get();
		}else{

			$where=array("p.id_usuario"=>$this->session->userdata("idUser"),
						"sp.status"=>$statusPago);
			
			$query=$this->db
			->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
			->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
			->from("propiedades p")
			->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
			->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
			->where($where)
			->get();
		}
		
	

		return $query->result();

	
	}

	public function get_solicitantes_propiedades_limite($statusPago, $limiteInicio, $deposito){

		if(empty($statusPago)){
			if($limiteInicio==0){
				$query=$this->db
				->select("s.nombre as cliente, sp.id, sp.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria, p.id_usuario")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->limit($this->paginador->configPaginador["reg_x_pagina"])
				->order_by('sp.fecha_registro','desc')
				->get();
			}else{
				$query=$this->db
				->select("s.nombre as cliente, sp.id, sp.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria, p.id_usuario")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
				->order_by('sp.fecha_registro','desc')
				->get();
			}
		}else{
			if(!empty($deposito)){

				if($limiteInicio==0){
					$query=$this->db
					->select("s.nombre as cliente, sp.id, sp.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria, p.id_usuario")
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
					->from("propiedades p")
					->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
					->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
					->where("sp.status",$statusPago)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->order_by('sp.fecha_registro','desc')
					->get();
				}else{
					$query=$this->db
					->select("s.nombre as cliente, sp.id, sp.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria, p.id_usuario")
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->from("propiedades p")
					->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
					->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
					->where("sp.status",$statusPago)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->order_by('sp.fecha_registro','desc')
					->get();
				}
			}else{
				$where=array("p.id_usuario"=>$this->session->userdata("idUser"),
					 		 "sp.status"=>$statusPago
			         		);
				if($limiteInicio==0){
				$query=$this->db
				->select("s.nombre as cliente, sp.id, sp.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria, p.id_usuario")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->where($where)
				->limit($this->paginador->configPaginador["reg_x_pagina"])
				->order_by('sp.fecha_registro','desc')
				->get();
				}else{
					$query=$this->db
					->select("s.nombre as cliente, sp.id, sp.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria, p.id_usuario")
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->from("propiedades p")
					->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
					->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
					->where($where)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->order_by('sp.fecha_registro','desc')
					->get();
				}
			}

		}

		return $query->result();

	
	}


	
	//filtros 

	public function get_all_clientes_interesados_fecha_asc(){

		$query=$this->db
		->select("usr.nombre as cliente, uip.id, uip.id_usuario, uip.id_propiedad, usr.correo, usr.telefono, usr.celular, uip.comentario, uip.status, p.nombre as propiedad, p.precio, p.id_categoria")
		->select("DATE_FORMAT(uip.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
		->from("propiedades p")
		->join("usuarios_interesados_propiedades uip","p.id_propiedad=uip.id_propiedad","inner")
		->join("usuarios_sin_registro usr","uip.id_usuario=usr.id_usuarios_sin_registro","inner")
		->order_by("uip.fecha_registro", "asc")
		->get();

		return $query->result();
		
	}

	public function get_all_clientes_interesados_usuarios_registro_fecha_asc(){

		$query=$this->db
		->select("u.nombre as cliente, uip.id, uip.id_usuario, uip.id_propiedad, u.correo, u.telefono, u.celular, uip.comentario, uip.status, p.nombre as propiedad, p.precio, p.id_categoria")
		->select("DATE_FORMAT(uip.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
		->from("propiedades p")
		->join("usuarios_interesados_propiedades uip","p.id_propiedad=uip.id_propiedad","inner")
		->join("usuarios u","uip.id_usuario=u.id_usuario","inner")
		->order_by("uip.fecha_registro", "asc")
		->get();

		return $query->result();

		
	}

	//busquedas interesados para ficha de deposito
	public function get_all_clientes_interesados_ficha_deposito_parametro($opcion, $campo, $statusPago){
	
		$like=array();
		$whereIdPropiedad=array();
		$wherePropiedad=array();
		$likeAnunciante=array();


		if($opcion=="nombre"){
			$like['s.nombre']=$campo;
		}else
			if($opcion=="id_propiedad"){
				$whereIdPropiedad['sp.id_propiedad']=$campo;
				$whereIdPropiedad['sp.status']=$statusPago;
		}else
			if($opcion=="propiedad"){
				$wherePropiedad['sp.status']=$statusPago;
		}else
			if($opcion=="fecha"){
				$fechaA=$_POST["fechaA"];
				if($fechaA==""){
					$fechaA=date('Y-m-d');
				}
				$where['sp.fecha_registro >=']=$_POST["fechaDe"]." 00:00:00";
				$where['sp.fecha_registro <=']=$_POST["fechaA"]." 23:59:59";
				$where['sp.status']=$statusPago;
		}else
			if($opcion=="anunciante"){
				$likeAnunciante["u.nombre"]=$campo;
		}

		if(!empty($whereIdPropiedad)){
			$query=$this->db
			->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
			->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
			->from("propiedades p")
			->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
			->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
			->where($whereIdPropiedad)
			->get();
		}else
			if(!empty($wherePropiedad)){
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->where($wherePropiedad)
				->like('p.nombre',$campo)
				->get();
		}else
			if(!empty($where)){
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->where($where)
				->get();
		}else
			if(!empty($likeAnunciante)){
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria, u.id_usuario")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("solicitantes s")
				->join("solicitantes_propiedades sp","s.id_solicitante=sp.id_solicitante","inner")
				->join("propiedades p","sp.id_propiedad=p.id_propiedad","inner")
				->join("usuarios u","p.id_usuario=u.id_usuario","inner")
				->like($likeAnunciante)
				->where('sp.status',$statusPago)
				->get();
		}else{
			$query=$this->db
			->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
			->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
			->from("propiedades p")
			->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
			->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
			->like($like)
			->where('sp.status',$statusPago)
			->get();
		}

		return $query->result();
	}

	public function get_all_clientes_interesados_ficha_deposito_parametro_limite($opcion, $campo, $statusPago, $limiteInicio){
		
		$like=array();
		$wherePropiedad=array();
		$whereIdPropiedad=array();
		$likeAnunciante=array();
	
		if($opcion=="nombre"){
			$like['s.nombre']=$campo;
		}else
			if($opcion=="id_propiedad"){
				$whereIdPropiedad['sp.id_propiedad']=$campo;
				$whereIdPropiedad['sp.status']=$statusPago;
		}else
			if($opcion=="propiedad"){
				$wherePropiedad['sp.status']=$statusPago;
		}else
			if($opcion=="fecha"){
				$fechaA=$_POST["fechaA"];
				if($fechaA==""){
					$fechaA=date('Y-m-d');
				}
				$where['sp.fecha_registro >=']=$_POST["fechaDe"]." 00:00:00";
				$where['sp.fecha_registro <=']=$fechaA." 23:59:59";
				$where['sp.status']=$statusPago;
		}else
			if($opcion=="anunciante"){
				$likeAnunciante['u.nombre']=$campo;
		}



		if(!empty($whereIdPropiedad)){

			if($limiteInicio==0){
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->where($whereIdPropiedad)
				->limit($this->paginador->configPaginador["reg_x_pagina"])
				->order_by('sp.fecha_registro','desc')
				->get();
			}else{
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->where($whereIdPropiedad)
				->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
				->order_by('sp.fecha_registro','desc')
				->get();
			}
		}if(!empty($wherePropiedad)){
			if($limiteInicio==0){
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->where($wherePropiedad)
				->like('p.nombre',$campo)
				->limit($this->paginador->configPaginador["reg_x_pagina"])
				->order_by('sp.fecha_registro','desc')
				->get();
			}else{
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->where($wherePropiedad)
				->like('p.nombre',$campo)
				->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
				->order_by('sp.fecha_registro','desc')
				->get();
			}
		}else
			if(!empty($where)){
				if($limiteInicio==0){
					$query=$this->db
					->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->from("propiedades p")
					->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
					->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
					->where($where)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->where('sp.status',$statusPago)
					->order_by('sp.fecha_registro','desc')
					->get();
				}else{
					$query=$this->db
					->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->from("propiedades p")
					->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
					->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
					->where($where)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->order_by('sp.fecha_registro','desc')
					->get();
				}
		}else
			if(!empty($like)){
				if($limiteInicio==0){
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->like($like)
				->where('sp.status',$statusPago)
				->limit($this->paginador->configPaginador["reg_x_pagina"])
				->order_by('sp.fecha_registro','desc')
				->get();
			}else{
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->like($like)
				->where('sp.status',$statusPago)
				->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
				->order_by('sp.fecha_registro','desc')
				->get();
			}
		}else
			if(!empty($likeAnunciante)){
				if($limiteInicio==0){
					$query=$this->db
					->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria, u.id_usuario")
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->from("solicitantes s")
					->join("solicitantes_propiedades sp","s.id_solicitante=sp.id_solicitante","inner")
					->join("propiedades p","sp.id_propiedad=p.id_propiedad","inner")
					->join("usuarios u","p.id_usuario=u.id_usuario","inner")
					->like($likeAnunciante)
					->where('sp.status',$statusPago)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->order_by('sp.fecha_registro','desc')
					->get();

				}else{
					$query=$this->db
					->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria, u.id_usuario")
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->from("solicitantes s")
					->join("solicitantes_propiedades sp","s.id_solicitante=sp.id_solicitante","inner")
					->join("propiedades p","sp.id_propiedad=p.id_propiedad","inner")
					->join("usuarios u","p.id_usuario=u.id_usuario","inner")
					->like($likeAnunciante)
					->where('sp.status',$statusPago)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->order_by('sp.fecha_registro','desc')
					->get();
				}
		}

		return $query->result();
	
	}



	//busquedas interesados
	public function get_all_clientes_interesados_por_parametro($opcion, $campo=null){

		$like=array();
		$or_like=array();

		if($opcion=="nombre"){
			$like['s.nombre']=$campo;
		}else
			if($opcion=="propiedad"){
				$like['p.nombre']=$campo;
				$or_like['sp.id_propiedad']=$campo;
		}else
			if($opcion=="fecha"){
				$fechaA=$_POST["fechaA"];
				if($fechaA==""){
					$fechaA=date('Y-m-d');
				}
				$where['sp.fecha_registro >=']=$_POST["fechaDe"]." 00:00:00";
				$where['sp.fecha_registro <=']=$fechaA." 23:59:59";
		}

		if(!empty($or_like)){
			$query=$this->db
			->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
			->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
			->from("propiedades p")
			->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
			->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
			->like($like)
			->or_like($or_like)
			->get();
		}else
			if(!empty($where)){
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->where($where)
				->get();
		}else{
			$query=$this->db
			->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
			->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
			->from("propiedades p")
			->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
			->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
			->like($like)
			->get();
		}

		return $query->result();
	}

	public function get_all_clientes_interesados_por_parametro_limite($opcion, $campo=null, $limiteInicio){

		

		$like=array();
		$or_like=array();

		if($opcion=="nombre"){
			$like['s.nombre']=$campo;
		}else
			if($opcion=="propiedad"){
				$like['p.nombre']=$campo;
				$or_like['sp.id_propiedad']=$campo;
		}else
			if($opcion=="fecha"){
				$fechaA=$_POST["fechaA"];
				if($fechaA==""){
					$fechaA=date('Y-m-d');
				}
				$where['sp.fecha_registro >=']=$_POST["fechaDe"]." 00:00:00";
				$where['sp.fecha_registro <=']=$fechaA." 23:59:59";
		}

		if(!empty($or_like)){
			if($limiteInicio==0){
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->like($like)
				->or_like($or_like)
				->limit($this->paginador->configPaginador["reg_x_pagina"])
				->order_by('sp.fecha_registro','desc')
				->get();
			}else{
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->like($like)
				->or_like($or_like)
				->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
				->order_by('sp.fecha_registro','desc')
				->get();
			}
		}else
			if(!empty($where)){
				if($limiteInicio==0){
					$query=$this->db
					->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->from("propiedades p")
					->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
					->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
					->where($where)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->order_by('sp.fecha_registro','desc')
					->get();
				}else{
					$query=$this->db
					->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->from("propiedades p")
					->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
					->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
					->where($where)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->order_by('sp.fecha_registro','desc')
					->get();
				}
		}else{
			if($limiteInicio==0){
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->like($like)
				->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
				->order_by('sp.fecha_registro','desc')
				->get();
			}else{
				$query=$this->db
				->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria")
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->from("propiedades p")
				->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
				->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
				->like($like)
				->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
				->order_by('sp.fecha_registro','desc')
				->get();
			}
		}

		return $query->result();
	}




	
	//paypal
	public function cliente_realizo_pago($id){

		$dato=array("status"=>"Pagado",
			        "fecha_pago"=>date("Y-m-d H:i:s"),
			        "id_metodos_de_pago"=>1);

		$this->db->where('id', $id);
		$this->db->update('solicitantes_propiedades', $dato);

		 //para sacar los datos del cliente
	    $cliente=$this->get_solicitante_propiedad_por_id($id);
	    $anunciante=$this->usuarios_model->get_user_por_id_propiedad($cliente->id_propiedad);
	    $costoTransaccion=$this->propiedades_model->get_costo_transaccion_paypal_por_id_categoria($cliente->id_categoria);


		//mandamos correo al administrador del sitio
		$mail = new PHPMailer();
		$mail->From = "staff@interhabita.com";
		$mail->FromName = "Staff Interhabita";
		$mail->Subject = "Nuevo Pago desde Paypal";
		$mail->AddAddress('rather_79@hotmail.com', 'Omar Serrano');

		$body='
		        <h1>Pago Correcto de Paypal:</h2>
				<h2>Un anunciante realizo un nuevo pago desde paypal en la pagina web Interhabita, detalles del pago:</h2>";
				<p>Propiedad: <b>'.$cliente->propiedad.'</b></p>
				<p>Anunciante: <b>'.$anunciante->nombre.'</b></p>
				<p>Monto Pago: <b>$'.$costoTransaccion->costo.'</b></p>
			   ';

		$mail->IsHTML(true);
		$mail->Body = $body;
		$mail->Send();


		//despues mando el correo al anunciante con los datos del cliente
		$mail1 = new PHPMailer();
		$mail1->From = "staff@interhabita.com";
		$mail1->FromName = "Staff Interhabita";
		$mail1->Subject = "Inmobiliaria Interhabita - Datos de cliente interesado en ".$cliente->propiedad;
		$mail1->AddAddress($anunciante->correo, $anunciante->nombre);

		$body1='
				<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>
			    <title></title>
			    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			    <style type="text/css">
			@import url(https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic,500italic,700italic); body {margin: 0; padding: 0; min-width: 100%; } table {border-collapse: collapse; border-spacing: 0; } td {padding: 0; vertical-align: top; } .spacer, .border {font-size: 1px; line-height: 1px; } img {border: 0; -ms-interpolation-mode: bicubic; } .image {font-size: 0; Margin-bottom: 20px; } .image img {display: block; } .logo img {display: block; } strong {font-weight: bold; } h1, h2, h3, p, ol, ul, li {Margin-top: 0; } ol, ul, li {padding-left: 0; } .btn a {mso-hide: all; } blockquote {Margin-top: 0; Margin-right: 0; Margin-bottom: 0; padding-right: 0; } .column-top {font-size: 30px; line-height: 30px; } .column-bottom {font-size: 10px; line-height: 10px; } .column {text-align: left; } .contents {width: 100%; } .padded {padding-left: 40px; padding-right: 40px; } .wrapper {background-color: #1e1e1e; width: 100%; min-width: 620px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table.wrapper {table-layout: fixed; } .one-col, .two-col, .three-col {Margin-left: auto; Margin-right: auto; width: 600px; } .one-col p, .one-col ol, .one-col ul {Margin-bottom: 20px; } .two-col p, .two-col ol, .two-col ul {Margin-bottom: 20px; } .two-col .image {Margin-bottom: 20px; } .two-col .column-top {font-size: 40px; line-height: 40px; } .two-col .column-bottom {font-size: 20px; line-height: 20px; } .two-col .column {width: 290px; } .two-col .gutter {width: 20px; font-size: 1px; line-height: 1px; } .three-col p, .three-col ol, .three-col ul {Margin-bottom: 20px; } .three-col .image {Margin-bottom: 20px; } .three-col .column-top {font-size: 20px; line-height: 20px; } .three-col .column-bottom {font-size: 0px; line-height: 0px; } .three-col .column, .two-col .column-narrower {width: 190px; } .three-col .gutter {width: 15px; font-size: 1px; line-height: 1px; } .three-col .padded {padding-left: 20px; padding-right: 20px; } .wider {width: 390px; } .narrower {width: 190px; } @media only screen and (max-width: 620px) {[class*=wrapper] {min-width: 280px !important; width: 100%!important; } [class*=wrapper] .one-col, [class*=wrapper] .two-col, [class*=wrapper] .three-col {width: 280px !important; } [class*=wrapper] .column {display: block; float: left; width: 280px !important; } [class*=wrapper] .padded {padding-left: 20px !important; padding-right: 20px !important; } [class*=wrapper] .full {display: none; } [class*=wrapper] .block {display: block !important; } [class*=wrapper] .hide {display: none !important; } [class*=wrapper] .image {margin-bottom: 20px !important; } [class*=wrapper] .image img {height: auto !important; width: 100% !important; } } h1, h2, h3 {font-weight: normal; } p, ol, ul {font-weight: 400; } table.wrapper {background-color: #1e1e1e; } .column table, .padded table {width: 100%; } .preheader {width: 100%; background-color: #191919; } .preheader .title, .preheader .webversion {color: #e6e6e6; font-size: 11px; line-height: 16px; } .preheader .title {padding: 9px; text-align: left; } .preheader .webversion {padding: 9px; text-align: right; width: 250px; } .preheader .webversion a {font-weight: bold; color: #e6e6e6; text-decoration: none; } .preheader .preheader-buffer {font-size: 20px; line-height: 20px; background-color: #1e1e1e; } .logo {color: #ffffff; font-size: 36px; line-height: 42px; padding-top: 20px; padding-bottom: 40px; text-align: center; width: 520px; } .logo a {color: #ffffff; text-decoration: none; } ul li {list-style-type: disc; list-style-position: outside; } p, ol, ul {-webkit-font-smoothing: antialiased; } .wrapper {background-color: #1e1e1e; } .wrapper .btn a {transition: background-color 0.2s; } .wrapper h1, .wrapper h2, .wrapper h3, .wrapper p, .wrapper ol, .wrapper ul, .wrapper blockquote p, .wrapper .logo, .wrapper .btn a, .wrapper .footer div, .wrapper .footer td, .wrapper .preheader .title, .wrapper .preheader .webversion {font-family: sans-serif; } @media screen and (min-width: 0) {.wrapper h1, .wrapper h2, .wrapper h3, .wrapper p, .wrapper ol, .wrapper ul, .wrapper blockquote p, .wrapper .logo, .wrapper .btn a, .wrapper .footer div, .wrapper .footer td, .wrapper .preheader .title, .wrapper .preheader .webversion {font-family: Ubuntu, sans-serif !important; } } h1 a, h2 a, h3 a {text-decoration: none; } .one-col, .two-col, .three-col, .preheader, .header, .footer {Margin-left: auto; Margin-right: auto; } .one-col .padded, .two-col .padded, .three-col .padded, .preheader .padded, .header .padded, .footer .padded {text-align: left; } .one-col blockquote, .two-col blockquote, .three-col blockquote, .preheader blockquote, .header blockquote, .footer blockquote {Margin-left: 0; background-repeat: no-repeat; background-position: 0px 4px; } .one-col blockquote p, .two-col blockquote p, .three-col blockquote p, .preheader blockquote p, .header blockquote p, .footer blockquote p {font-style: italic; } .column table td table:nth-last-child(2) td h1:last-child, .column-wider table td table:nth-last-child(2) td h1:last-child, .column-narrower table td table:nth-last-child(2) td h1:last-child, .column table td table:nth-last-child(2) td h2:last-child, .column-wider table td table:nth-last-child(2) td h2:last-child, .column-narrower table td table:nth-last-child(2) td h2:last-child, .column table td table:nth-last-child(2) td h3:last-child, .column-wider table td table:nth-last-child(2) td h3:last-child, .column-narrower table td table:nth-last-child(2) td h3:last-child, .column table td table:nth-last-child(2) td p:last-child, .column-wider table td table:nth-last-child(2) td p:last-child, .column-narrower table td table:nth-last-child(2) td p:last-child, .column table td table:nth-last-child(2) td ol:last-child, .column-wider table td table:nth-last-child(2) td ol:last-child, .column-narrower table td table:nth-last-child(2) td ol:last-child, .column table td table:nth-last-child(2) td ul:last-child, .column-wider table td table:nth-last-child(2) td ul:last-child, .column-narrower table td table:nth-last-child(2) td ul:last-child {Margin-bottom: 20px; } .btn {Margin-bottom: 20px; } .btn a {-webkit-font-smoothing: antialiased; padding-top: 15px; padding-bottom: 15px; font-weight: 500; display: inline-block; font-size: 16px; line-height: 20px; text-align: center; text-decoration: none; border-bottom: 3px solid #1e1e1e; } .one-col .btn a, .one-col-feature .btn a {width: 480px; padding-left: 20px; padding-right: 20px; } .two-col .column .btn a {width: 170px; padding-left: 20px; padding-right: 20px; } .two-col .column-narrower .btn a {width: 130px; padding-left: 10px; padding-right: 10px; } .two-col .column-wider .btn a {width: 270px; padding-left: 20px; padding-right: 20px; } .three-col .btn a {width: 130px; padding-left: 10px; padding-right: 10px; } .divider table {font-size: 0; height: 6px; line-height: 6px; Margin-bottom: 20px; } .one-col .padded ul li {padding-left: 13px; } .one-col h1 {font-size: 30px; line-height: 44px; Margin-bottom: 16px; } .one-col h2 {font-size: 20px; line-height: 28px; Margin-bottom: 14px; } .one-col h3 {font-size: 16px; line-height: 22px; Margin-bottom: 12px; } .one-col p, .one-col ol, .one-col ul {font-size: 14px; line-height: 22px; Margin-bottom: 20px; } .one-col ol, .one-col ul {Margin-left: 48px; } .one-col ol li, .one-col ul li {Margin-bottom: 10px; padding-left: 13px; } .one-col blockquote p {font-size: 18px; line-height: 26px; } .one-col blockquote p, .one-col blockquote h1, .one-col blockquote h2, .one-col blockquote h3, .one-col blockquote ol, .one-col blockquote ul {padding-left: 60px; } .one-col-feature {width: 600px; Margin-left: auto; Margin-right: auto; } .one-col-feature h1, .one-col-feature h2, .one-col-feature h3, .one-col-feature p, .one-col-feature ol, .one-col-feature ul, .one-col-feature a {color: #212a32; } .one-col-feature h1 a, .one-col-feature h2 a, .one-col-feature h3 a, .one-col-feature p a, .one-col-feature li a {text-decoration: none; font-weight: normal; } .one-col-feature h1 {font-size: 30px; line-height: 46px; Margin-bottom: 20px; } .one-col-feature h2 {font-size: 24px; line-height: 40px; Margin-bottom: 16px; } .one-col-feature h3 {font-size: 20px; line-height: 30px; Margin-bottom: 14px; } .one-col-feature p {font-size: 18px; line-height: 30px; Margin-bottom: 20px; } .one-col-feature ol {Margin-left: 36px; } .one-col-feature ol li {padding-left: 15px; } .one-col-feature ul {Margin-left: 30px; } .one-col-feature ul li {padding-left: 20px; list-style-image: url(https://i3.createsend1.com/static/eb/master/09-onyx/images/bullet-large.png); line-height: 40px; } .one-col-feature ol, .one-col-feature ul {font-size: 26px; line-height: 40px; } .one-col-feature li {Margin-bottom: 0; } .one-col-feature h1, .one-col-feature h2, .one-col-feature h3, .one-col-feature p {text-align: center; } .one-col-feature blockquote {Margin: 0; background-repeat: no-repeat; background-position: 100% 100%; } 

			.one-col-feature blockquote p:first-child, .one-col-feature blockquote h1:first-child, .one-col-feature blockquote h2:first-child, .one-col-feature blockquote h3:first-child, .one-col-feature blockquote ol:first-child, .one-col-feature blockquote ul:first-child {padding-top: 27px; } .one-col-feature blockquote p, .one-col-feature blockquote h1, .one-col-feature blockquote h2, .one-col-feature blockquote h3, .one-col-feature blockquote ol, .one-col-feature blockquote ul {background-repeat: no-repeat; background-position: 0% 0%; font-size: 26px; line-height: 40px; padding: 0; font-style: italic; } .one-col-feature blockquote p:last-child, .one-col-feature blockquote h1:last-child, .one-col-feature blockquote h2:last-child, .one-col-feature blockquote h3:last-child, .one-col-feature blockquote ol:last-child, .one-col-feature blockquote ul:last-child {padding-bottom: 30px; Margin-bottom: 20px; } .one-col-feature .divider {Margin-bottom: 20px; } .one-col-feature .divider img {display: block; Margin-left: auto; Margin-right: auto; } .one-col-feature .btn a {background-color: #ffffff; color: #212a32; } .two-col h1 {font-size: 30px; line-height: 44px; Margin-bottom: 16px; } .two-col h2 {font-size: 20px; line-height: 28px; Margin-bottom: 14px; } .two-col h3 {font-size: 16px; line-height: 22px; Margin-bottom: 12px; } .two-col p, .two-col ol, .two-col ul {font-size: 14px; line-height: 22px; Margin-bottom: 20px; } .two-col ol, .two-col ul {Margin-left: 18px; } .two-col li {Margin-bottom: 10px; padding-left: 20px; } .two-col .btn a {font-size: 16px; line-height: 20px; } .two-col blockquote p, .two-col blockquote h1, .two-col blockquote h2, .two-col blockquote h3, .two-col blockquote ol, .two-col blockquote ul {padding-left: 38px; } .two-col .column-wider {width: 390px; } .two-col .column-narrower {width: 190px; } .three-col .column .padded, .two-col .column-narrower .padded {padding-left: 20px; padding-right: 20px; } .three-col .column h1, .two-col .column-narrower h1 {font-size: 20px; line-height: 28px; Margin-bottom: 14px; } .three-col .column h2, .two-col .column-narrower h2 {font-size: 16px; line-height: 22px; Margin-bottom: 12px; } .three-col .column h3, .two-col .column-narrower h3 {font-size: 14px; line-height: 20px; Margin-bottom: 8px; } .three-col .column p, .three-col .column ol, .three-col .column ul, .two-col .column-narrower p, .two-col .column-narrower ol, .two-col .column-narrower ul {font-size: 14px; line-height: 22px; Margin-bottom: 20px; } .three-col .column ol, .three-col .column ul, .two-col .column-narrower ol, .two-col .column-narrower ul {Margin-left: 18px; } .three-col .column ol li, .three-col .column ul li, .two-col .column-narrower ol li, .two-col .column-narrower ul li {Margin-bottom: 10px; padding-left: 10px; } .three-col .column .btn a, .two-col .column-narrower .btn a {padding-top: 10px; padding-bottom: 10px; } .three-col .column blockquote p, .three-col .column blockquote h1, .three-col .column blockquote h2, .three-col .column blockquote h3, .three-col .column blockquote ol, .three-col .column blockquote ul, .two-col .column-narrower blockquote p, .two-col .column-narrower blockquote h1, .two-col .column-narrower blockquote h2, .two-col .column-narrower blockquote h3, .two-col .column-narrower blockquote ol, .two-col .column-narrower blockquote ul {padding-left: 28px; } .contents-green {background-color: #27da90; } .contents-green h1 a, .contents-green h2 a, .contents-green h3 a, .contents-green p a, .contents-green li a {border-bottom: 1px solid #212a32; } .contents-green .btn a {border-bottom-color: #1eb074; } .contents-green blockquote {background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark-green.png); } .contents-green blockquote p:first-child, .contents-green blockquote h1:first-child, .contents-green blockquote h2:first-child, .contents-green blockquote h3:first-child, .contents-green blockquote ol:first-child, .contents-green blockquote ul:first-child {background-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark-green.png); } .contents-orange {background-color: #ed5a32; } .contents-orange h1 a, .contents-orange h2 a, .contents-orange h3 a, .contents-orange p a, .contents-orange li a {border-bottom: 1px solid #212a32; } .contents-orange .btn a {border-bottom-color: #d93d13; } .contents-orange blockquote {background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark-orange.png); } .contents-orange blockquote p:first-child, .contents-orange blockquote h1:first-child, .contents-orange blockquote h2:first-child, .contents-orange blockquote h3:first-child, .contents-orange blockquote ol:first-child, .contents-orange blockquote ul:first-child {background-image: url(https://i7.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark-orange.png); } .contents-grey {background-color: #e6e7e8; } .contents-grey h1 a, .contents-grey h2 a, .contents-grey h3 a, .contents-grey p a, .contents-grey li a {border-bottom: 1px solid #212a32; } .contents-grey .btn a {border-bottom-color: #cbced0; } .contents-grey blockquote {background-image: url(https://i9.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark-grey.png); } .contents-grey blockquote p:first-child, .contents-grey blockquote h1:first-child, .contents-grey blockquote h2:first-child, .contents-grey blockquote h3:first-child, .contents-grey blockquote ol:first-child, .contents-grey blockquote ul:first-child {background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark-grey.png); } .contents-green .btn a:hover, .contents-orange .btn a:hover, .contents-grey .btn a:hover {background-image: none!important; background-color: #f1f2f2!important; } .contents {background-color: #212a32; } .contents p, .contents ol, .contents ul {color: #ffffff; } .contents-accent-blue .btn a, .contents-accent-pink .btn a, .contents-accent-orange .btn a, .contents-accent-aqua .btn a {background-repeat: repeat-x; color: #ffffff; } .contents-accent-blue .btn a:hover, .contents-accent-pink .btn a:hover, .contents-accent-orange .btn a:hover, .contents-accent-aqua .btn a:hover {background-image: none!important; } .contents-accent-blue {width: 100%; background-color: #212a32; } .contents-accent-blue p, .contents-accent-blue ol, .contents-accent-blue ul {color: #ffffff; } .contents-accent-blue h1, .contents-accent-blue h2, .contents-accent-blue h3, .contents-accent-blue h1 a, .contents-accent-blue h2 a, .contents-accent-blue h3 a, .contents-accent-blue a {color: #3d88fd; } .contents-accent-blue h1 a, .contents-accent-blue h2 a, .contents-accent-blue h3 a {border-bottom: 1px solid #3d88fd; } .contents-accent-blue ul li {list-style-image: url(https://i10.createsend1.com/static/eb/master/09-onyx/images/bullet-blue.png); } .contents-accent-blue .btn a {background-color: #367ffd; background-image: url(https://i1.createsend1.com/static/eb/master/09-onyx/images/btn-blue.png); } .contents-accent-blue .btn a:hover {background-color: #1d64d2!important; } .contents-accent-blue blockquote {background-image: url(https://i3.createsend1.com/static/eb/master/09-onyx/images/quote-blue.png); } .contents-accent-aqua {width: 100%; background-color: #212a32; } .contents-accent-aqua p, .contents-accent-aqua ol, .contents-accent-aqua ul {color: #ffffff; } .contents-accent-aqua h1, .contents-accent-aqua h2, .contents-accent-aqua h3, .contents-accent-aqua h1 a, .contents-accent-aqua h2 a, .contents-accent-aqua h3 a, .contents-accent-aqua a {color: #00b5d6; } .contents-accent-aqua h1 a, .contents-accent-aqua h2 a, .contents-accent-aqua h3 a {border-bottom: 1px solid #00b5d6; } .contents-accent-aqua ul li {list-style-image: url(https://i2.createsend1.com/static/eb/master/09-onyx/images/bullet-aqua.png); } .contents-accent-aqua .btn a {background-color: #00add1; background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/btn-aqua.png); } .contents-accent-aqua .btn a:hover {background-color: #0092ad!important; } .contents-accent-aqua blockquote {background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-aqua.png); } .column-narrower .contents-accent-aqua .padded blockquote {background-image: url(https://i7.createsend1.com/static/eb/master/09-onyx/images/quote-aqua-single.png); } .column-narrower .contents-accent-aqua .padded blockquote p, .column-narrower .contents-accent-aqua .padded blockquote h1, .column-narrower .contents-accent-aqua .padded blockquote h2, .column-narrower .contents-accent-aqua .padded blockquote h3 {padding-left: 28px; } .contents-accent-pink {width: 100%; background-color: #212a32; } .contents-accent-pink p, .contents-accent-pink ol, .contents-accent-pink ul {color: #ffffff; } .contents-accent-pink h1, .contents-accent-pink h2, .contents-accent-pink h3, .contents-accent-pink h1 a, .contents-accent-pink h2 a, .contents-accent-pink h3 a, .contents-accent-pink a {color: #f63366; } .contents-accent-pink h1 a, .contents-accent-pink h2 a, .contents-accent-pink h3 a {border-bottom: 1px solid #f63366; } .contents-accent-pink ul li {list-style-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/bullet-pink.png); } .contents-accent-pink .btn a {background-color: #f52d5d; background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/btn-pink.png); } .contents-accent-pink .btn a:hover {background-color: #c93057!important; } .contents-accent-pink blockquote {background-image: url(https://i9.createsend1.com/static/eb/master/09-onyx/images/quote-pink.png); } .contents-accent-orange {width: 100%; background-color: #212a32; } .contents-accent-orange p, .contents-accent-orange ol, .contents-accent-orange ul {color: #ffffff; } .contents-accent-orange h1, .contents-accent-orange h2, .contents-accent-orange h3, .contents-accent-orange h1 a, .contents-accent-orange h2 a, .contents-accent-orange h3 a, .contents-accent-orange a {color: #ff9e05; } .contents-accent-orange h1 a, .contents-accent-orange h2 a, .contents-accent-orange h3 a {border-bottom: 1px solid #ff9e05; } .contents-accent-orange ul li {list-style-image: url(https://i1.createsend1.com/static/eb/master/09-onyx/images/bullet-orange.png); } .contents-accent-orange .btn a {background-color: #ff9306; background-image: url(https://i3.createsend1.com/static/eb/master/09-onyx/images/btn-orange.png); } .contents-accent-orange .btn a:hover {background-color: #ff8a00!important; } .contents-accent-orange blockquote {background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-orange.png); } .footer {width: 100%; background-color: #191919; } .footer .padded {padding-left: 20px; padding-right: 20px; } .footer td {color: #cccccc; font-size: 12px; line-height: 20px; } .footer .contents {background-color: #191919; } .footer .footer-container .column-details {padding: 40px 0 75px 0; } .footer .footer-container .column-details td {text-align: left; } .footer .footer-container .column-social {width: 140px; padding: 42px 0 75px 20px; } .footer .footer-container .column-social td {text-align: left; } .footer .social {width: 170px; } .footer .social a {text-decoration: none; } .footer .social .social-icon {width: 39px; } 

			.footer .social .social-text {width: 131px; text-transform: uppercase; letter-spacing: 0.15em; font-size: 10px; line-height: 12px; vertical-align: middle; color: #cccccc; } .footer .social .social-text a {color: #cccccc; } .footer .social-space {font-size: 10px; line-height: 10px; display: block; width: 100%; } .footer .prefs a {color: #cccccc; } .footer .address, .footer .permission {display: block; } .footer .address a, .footer .permission a {color: #cccccc; text-decoration: underline; } .footer .address {Margin-bottom: 17px; } @media (min-width: 0) {body {background-color: #191919; } } @media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi) {.one-col ul {border-left: 30px solid #212a32; } } @media (-webkit-min-device-pixel-ratio: 1.5) and (min-width: 620px), (min-resolution: 144dpi) and (min-width: 620px) {.contents-accent-blue blockquote {background-size: 40px!important; background-image: url(https://i10.createsend1.com/static/eb/master/09-onyx/images/quote-blue@2x.png) !important; } .contents-accent-aqua blockquote {background-size: 30px!important; background-image: url(https://i2.createsend1.com/static/eb/master/09-onyx/images/quote-aqua@2x.png) !important; } .column-narrower .contents-accent-aqua blockquote {background-position: -15px 6px !important; } .contents-accent-pink blockquote {background-size: 30px!important; background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/quote-pink@2x.png) !important; } .contents-accent-orange blockquote {background-size: 10px!important; background-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/quote-orange@2x.png) !important; } *[class*=contents-accent] ul li {padding-left: 30px!important; } } @media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi), (max-width: 620px) {[class*=wrapper] .one-col-feature blockquote {background-size: 30px!important; background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark@2x.png) !important; background-position: 50% 100%!important; } [class*=wrapper] .one-col-feature blockquote p:first-child, [class*=wrapper] .one-col-feature blockquote h1:first-child, [class*=wrapper] .one-col-feature blockquote h2:first-child, [class*=wrapper] .one-col-feature blockquote h3:first-child, [class*=wrapper] .one-col-feature blockquote ol:first-child, [class*=wrapper] .one-col-feature blockquote ul:first-child {background-size: 30px!important; background-image: url(https://i10.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark@2x.png) !important; background-position: 50% 0%!important; } [class*=wrapper] .contents-accent-blue ul li {background: transparent url(https://i7.createsend1.com/static/eb/master/09-onyx/images/bullet-blue@2x.png) no-repeat top left !important; } [class*=wrapper] .contents-accent-aqua ul li {background: transparent url(https://i9.createsend1.com/static/eb/master/09-onyx/images/bullet-aqua@2x.png) no-repeat top left !important; } [class*=wrapper] .contents-accent-pink ul li {background: transparent url(https://i1.createsend1.com/static/eb/master/09-onyx/images/bullet-pink@2x.png) no-repeat top left !important; } [class*=wrapper] .contents-accent-orange ul li {background: transparent url(https://i3.createsend1.com/static/eb/master/09-onyx/images/bullet-orange@2x.png) no-repeat top left !important; } [class*=wrapper] *[class*=contents-accent] ul {margin-left: 0px!important; } [class*=wrapper] *[class*=contents-accent] ul li {list-style-type: none!important; list-style-image: none!important; background-size: 10px 10px!important; background-position: 0 5px!important; } [class*=wrapper] .one-col-feature ul {margin-left: 0!important; } [class*=wrapper] .one-col-feature ul li {list-style: none!important; background: transparent url(https://i2.createsend1.com/static/eb/master/09-onyx/images/bullet-large@2x.png) no-repeat top left !important; background-size: 20px!important; background-position: 0 9px!important; padding-left: 50px; } } @media (-webkit-min-device-pixel-ratio: 1.5) and (max-width: 620px), (min-resolution: 144dpi) and (max-width: 620px) {[class*=wrapper] .one-col ul {margin-left: 0!important; border: 0!important; } [class*=wrapper] .one-col .divider table, [class*=wrapper] .two-col .column .divider table, [class*=wrapper] .two-col .column-narrower .divider table, [class*=wrapper] .two-col .column-wider .divider table, [class*=wrapper] .three-col .divider table {background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/divider-waves@2x.png) !important; } } @media only screen and (max-width: 620px) {[class*=wrapper] .column table td table:nth-last-child(2) td h1:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td h1:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td h1:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td h2:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td h2:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td h2:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td h3:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td h3:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td h3:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td p:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td p:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td p:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td ol:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td ol:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td ol:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td ul:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td ul:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td ul:last-child {Margin-bottom: 20px !important; } [class*=wrapper] *[class*=contents-accent] blockquote {background-size: 30px!important; } [class*=wrapper] *[class*=contents-accent] blockquote p, [class*=wrapper] *[class*=contents-accent] blockquote h1, [class*=wrapper] *[class*=contents-accent] blockquote h2, [class*=wrapper] *[class*=contents-accent] blockquote h3, [class*=wrapper] *[class*=contents-accent] blockquote ol, [class*=wrapper] *[class*=contents-accent] blockquote ul {padding-left: 38px!important; } [class*=wrapper] .contents-accent-blue blockquote {background-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/quote-mobile-blue@2x.png) !important; } [class*=wrapper] .contents-accent-aqua blockquote {background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/quote-mobile-aqua@2x.png) !important; } [class*=wrapper] .contents-accent-pink blockquote {background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/quote-pink@2x.png) !important; } [class*=wrapper] .contents-accent-orange blockquote {background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-mobile-orange@2x.png) !important; } [class*=wrapper] *[class*=contents-accent] ul li {padding-left: 38px!important; } [class*=wrapper] *[class*=contents-accent] ol li {padding-left: 18px!important; } [class*=wrapper] .spacer {display: none!important; } [class*=wrapper] .header .logo {padding: 40px 0!important; font-size: 24px !important; line-height: 1.3em !important; margin-bottom: 0 !important; } [class*=wrapper] .header .logo img {display: inline-block !important; max-width: 240px !important; height: auto!important; } [class*=wrapper] .header {width: 280px!important; } [class*=wrapper] .preheader-buffer {font-size: 10px !important; line-height: 10px !important; } [class*=wrapper] .preheader .webversion, [class*=wrapper] .header .logo a {text-align: center !important; } [class*=wrapper] *[class*=contents] blockquote p {font-size: 18px!important; line-height: 26px!important; } [class*=wrapper] *[class*=contents] h1 {font-size: 30px!important; line-height: 44px!important; margin-bottom: 16px!important; } [class*=wrapper] *[class*=contents] h2 {font-size: 20px!important; line-height: 28px!important; margin-bottom: 16px!important; } [class*=wrapper] *[class*=contents] h3 {font-size: 16px!important; line-height: 22px!important; margin-bottom: 12px!important; } [class*=wrapper] .column-wider, [class*=wrapper] .column-narrower {display: block; float: left; width: 280px !important; } [class*=wrapper] .one-col-feature {width: 280px !important; } [class*=wrapper] .one-col-feature li {font-size: 18px!important; line-height: 28px!important; } [class*=wrapper] .one-col-feature ol {margin-left: 22px!important; } [class*=wrapper] .one-col-feature ol li {padding-left: 18px!important; } [class*=wrapper] .one-col-feature ul li {background-size: 10px!important; padding-left: 40px!important; } [class*=wrapper] .one-col-feature blockquote p, [class*=wrapper] .one-col-feature blockquote h1, [class*=wrapper] .one-col-feature blockquote h2, [class*=wrapper] .one-col-feature blockquote h3, [class*=wrapper] .one-col-feature blockquote ol, [class*=wrapper] .one-col-feature blockquote ul {font-size: 26px!important; line-height: 40px!important; } [class*=wrapper] .btn a {padding: 15px 10px!important; width: 220px!important; } [class*=wrapper] .gutter {display: block!important; font-size: 10px; line-height: 10px; height: 10px!important; } [class*=wrapper] table.one-col, [class*=wrapper] table.one-col-feature, [class*=wrapper] td.last {margin-bottom: 10px!important; } [class*=wrapper] ol, [class*=wrapper] ul {margin-left: 20px !important; } [class*=wrapper] .footer *[class*="column"], [class*=wrapper] .preheader *[class*="column"] {display: block !important; text-align: center!important; } [class*=wrapper] .footer .title, [class*=wrapper] .preheader .title {display: none!important; } [class*=wrapper] .one-col .divider table, [class*=wrapper] .two-col .column .divider table, [class*=wrapper] .two-col .column-narrower .divider table, [class*=wrapper] .two-col .column-wider .divider table, [class*=wrapper] .three-col .divider table {background: transparent url(https://i7.createsend1.com/static/eb/master/09-onyx/images/divider-waves.png) repeat center center; background-size: auto 6px!important; width: 240px !important; } [class*=wrapper] .one-col .divider table img, [class*=wrapper] .two-col .column .divider table img, [class*=wrapper] .two-col .column-narrower .divider table img, [class*=wrapper] .two-col .column-wider .divider table img, [class*=wrapper] .three-col .divider table img {display: none!important; } [class*=wrapper] .footer .footer-container {width: 280px !important; } [class*=wrapper] .footer .column-social {padding-left: 0!important; padding-right: 0!important; width: 100% !important; } [class*=wrapper] .footer .column-details {width: 100% !important; } [class*=wrapper] .footer .social {width: 280px!important; } [class*=wrapper] .footer .social .social-text {padding: 0!important; text-align: left !important; width: auto !important; } [class*=wrapper] .footer .social-space {display: none !important; } [class*=wrapper] .footer .button {width: auto !important; margin: 0 auto 10px !important; } [class*=wrapper] .footer *[class*=column] {padding-top: 15px!important; padding-bottom: 10px!important; } [class*=wrapper] .footer *[class*=column] td {text-align: center!important; } [class*=wrapper] .footer *[class*=column] .padded {padding: 0!important; } [class*=wrapper] .footer *[class*=column] .social {width: 100%!important; margin-top: 15px!important; } } 
			</style>
			    <!--[if (gte mso 9)|(IE)]>
			    <style>
			      li {
			        padding-left: 5px !important;
			        margin-left: 10px !important;
			      }
			      ul li {
			        list-style-image: none !important;
			        list-style-type: disc !important;
			      }
			      ol, ul {
			        margin-left: 20px !important;
			      }
			      .image-bottom, .spacer, .border, .column-top, .column-bottom {
			        mso-line-height-rule: exactly !important;
			      }
			    </style>
			    <![endif]-->
			    <!--[if gte mso 9]>
			    <style>
			      blockquote p {
			        padding-left: 0px !important;
			        margin-left: 0px !important;
			      }
			    </style>
			    <![endif]-->
			  <meta name="robots" content="noindex,nofollow" />
			<meta property="og:title" content="My First Campaign" />
			</head>
			  <body class="emb-font-stack-default" bgcolor="#ffffff">
			    <center class="wrapper" style="background-color: #1e1e1e;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%">
			      <table class="wrapper" style="border-collapse: collapse;border-spacing: 0;background-color: #1e1e1e;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed">
			        <tbody><tr>
			          <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
			            <center>
			              <table class="preheader" style="border-collapse: collapse;border-spacing: 0;width: 100%;background-color: #191919;Margin-left: auto;Margin-right: auto">
			                <tbody><tr>
			                  
			                  
			                </tr>
			                <tr><td class="preheader-buffer" style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;font-size: 20px;line-height: 20px;background-color: #1e1e1e" colspan="2">&nbsp;</td></tr>
			              </tbody></table>
			              <table class="header" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto">
			                <tbody><tr>
			                  <td class="logo" style="padding-top: 20px;padding-bottom: 40px;padding-left: 0;padding-right: 0;vertical-align: top;color: #ffffff;font-size: 36px;line-height: 42px;text-align: center;width: 600px;font-family: sans-serif" align="center" bgcolor="#000"><center><div id="emb-email-header"><a style="color: #ffffff;text-decoration: none" href="http://preview.createsend1.com/t/t-l-jyjrtjd-l-r/"><img style="border-left-width: 0;border-top-width: 0;border-bottom-width: 0;border-right-width: 0;-ms-interpolation-mode: bicubic;display: block;max-width: 400px" src="http://interhabita.com/public/images/logo.png" alt="InterHabita" width="298" height="67" /></a></div></center></td>
			                </tr>
			              </tbody></table>
			            </center>
			          </td>
			        </tr>
			      </tbody></table>
			      
			          <table class="wrapper" style="border-collapse: collapse;border-spacing: 0;background-color: #1e1e1e;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed">
			            <tbody><tr>
			              <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
			                <center>
			                  <table class="one-col-feature" style="border-collapse: collapse;border-spacing: 0;width: 600px;Margin-left: auto;Margin-right: auto">
			                    <tbody><tr>
			                      <td class="column" style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;text-align: left">
			                        <table class="contents-grey" style="border-collapse: collapse;border-spacing: 0;width: 100%;background-color: #e6e7e8">
			                          <tbody><tr>
			                            <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
			                              <div><div class="column-top" style="font-size: 30px;line-height: 30px">&nbsp;</div></div>
			                                
			                                <table style="border-collapse: collapse;border-spacing: 0;width: 100%" width="100%">
			                                  <tbody><tr>
			                                    <td class="padded" style="padding-top: 0;padding-bottom: 0;padding-left: 40px;padding-right: 40px;vertical-align: top">
			            <!-- CONTENIDO HTML -->                         
			            <table><tbody><tr height="25px"></tr><tr><td width="600" align="center">
									<p>Estimado(a): '.$anunciante->nombre.', te enviamos todos los datos de contacto que</p>
			<p>'.$cliente->cliente.' ingresó  para que lo contactes a la brevedad.</p>
			<p>
				</p><table width="500px" style="font-size: 16px;line-height: 24px;font-family: Ubuntu, sans-serif">
					<tbody><tr><td bgcolor="#ccc" width="150"><strong>ID de Propiedad:</strong></td><td  width="410">'.$cliente->id_propiedad.'</td></tr>
					<tr><td bgcolor="#ccc"><strong>Nombre:</strong></td><td >'.$cliente->cliente.'</td></tr>
					<tr><td bgcolor="#ccc"><strong>Teléfono:</strong></td><td >'.$cliente->telefono.'</td></tr>
					<tr><td bgcolor="#ccc"><strong>Email:</strong></td><td ><a href="mailto:[Email]" style="color:black">'.$cliente->correo.'</a></td></tr>
					<tr><td bgcolor="#ccc"><strong>Mensaje:</strong></td><td >'.$cliente->comentario.'</td></tr>
				</tbody></table>
			<p></p> 
			<p>Suerte y esperamos que cierres esta venta!</p>
			</td></tr><tr height="25px"></tr></tbody></table>
			          
			                                    <!-- CONTENIDO HTML FIN--></td>
			                                  </tr>
			                                </tbody></table>
			                              
			                                
			                                <table style="border-collapse: collapse;border-spacing: 0;width: 100%" width="100%">
			                                  <tbody><tr>
			                                    <td class="padded" style="padding-top: 0;padding-bottom: 0;padding-left: 40px;padding-right: 40px;vertical-align: top">
			                                      
			           <div class="btn" style="Margin-bottom: 20px">
              <a style="mso-hide: all;-webkit-font-smoothing: antialiased;padding-top: 15px;padding-bottom: 15px;font-weight: 500;display: inline-block;font-size: 16px;line-height: 20px;text-align: center;text-decoration: none;border-bottom-color: #cbced0;border-bottom-style: solid;border-bottom-width: 3px;color: #212a32;transition: background-color 0.2s;font-family: sans-serif;width: 480px;padding-left: 20px;padding-right: 20px;background-color: #ffffff" href="http://www.interhabita.com">Ir a InterHabita</a></div>
			          
			                                    </td>
			                                  </tr>
			                                </tbody></table>
			                              
			                              <div class="column-bottom" style="font-size: 10px;line-height: 10px">&nbsp;</div>
			                            </td>
			                          </tr>
			                        </tbody></table>
			                      </td>
			                    </tr>
			                  </tbody></table>
			                </center>
			              </td>
			            </tr>
			          </tbody></table>
			        
			          <div class="spacer" style="font-size: 1px;line-height: 20px">&nbsp;</div>
			        
			      <table class="wrapper" style="border-collapse: collapse;border-spacing: 0;background-color: #1e1e1e;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed">
			        <tbody><tr>
			          <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
			            <center>
			              <table class="footer" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 100%;background-color: #191919">
			                <tbody><tr>
			                  <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;color: #cccccc;font-size: 12px;line-height: 20px;font-family: sans-serif">
			                    <center>
			                      <table class="one-col" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 600px">
			                        <tbody><tr>
			                          <td class="column" style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;text-align: left;color: #cccccc;font-size: 12px;line-height: 20px;font-family: sans-serif">
			                            <table class="contents" style="border-collapse: collapse;border-spacing: 0;width: 100%;background-color: #191919">
			                              <tbody><tr>
			                                <td class="padded" style="padding-top: 0;padding-bottom: 0;padding-left: 20px;padding-right: 20px;vertical-align: top;color: #cccccc;font-size: 12px;line-height: 20px;text-align: left;font-family: sans-serif">
			                                  <table class="footer-container" style="border-collapse: collapse;border-spacing: 0;width: 100%">
			                                    <tbody><tr>
			                                      <td class="column-details" style="padding-top: 40px;padding-bottom: 75px;padding-left: 0;padding-right: 0;vertical-align: top;color: #cccccc;font-size: 12px;line-height: 20px;font-family: sans-serif">
			                                       
			                                      </td>
			                                      
			                                    </tr>
			                                  </tbody></table>
			                                </td>
			                              </tr>
			                            </tbody></table>
			                          </td>
			                        </tr>
			                      </tbody></table>
			                    </center>
			                  </td>
			                </tr>
			              </tbody></table>
			            </center>
			          </td>
			        </tr>
			      </tbody></table>
			    </center>
			</body></html>
		';

		$mail1->IsHTML(true);
		$mail1->Body = $body1;
		$mail1->Send();

		$mail="";
		$mail1="";
	

	}

	public function items_carrito($item){
		$arreglo=array(
							"item"=>$item,
							"item_number"=>""
					       );

			$this->db->insert('items_carrito', $arreglo);
	}


	public function add_pago_deposito($id, $id_metodos_de_pago){


		$dato=array("status"=>"Pagado",
			        "fecha_pago"=>date("Y-m-d H:i:s"),
			        "id_metodos_de_pago"=>$id_metodos_de_pago);

		$this->db->where('id', $id);
		$this->db->update('solicitantes_propiedades', $dato);

	}


	public function get_paypal_anunciantes_parametro($opcion, $campoValor=null, $statusPago=null){

		$where=array();

		if($opcion=="nombre"){
			$where["u.nombre"]=$campoValor;
			if($statusPago!="undefined"){
				$where["sp.status"]=$statusPago;
			}
			$query=$this->db
			->select('sp.id_propiedad, sp.status, u.nombre, p.id_categoria, sp.id_solicitante')
			->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
			->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
			->from('solicitantes_propiedades sp')
			->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')
			->join('usuarios u','p.id_usuario = u.id_usuario','inner')	
			->where($where)
			->get();
		}else
			if($opcion=="fecha"){
				$fechaA=$_POST["fechaA"];
				if($fechaA==""){
					$fechaA=date('Y-m-d');
				}
				if($_POST["fechaComparar"]=="fecha_registro"){
					$where["sp.fecha_registro >="]=$_POST["fechaDe"]." 00:00:00";
					$where["sp.fecha_registro <="]=$fechaA." 23:59:59";
				}else{
					$where["sp.fecha_pago >="]=$_POST["fechaDe"]." 00:00:00";
					$where["sp.fecha_pago <="]=$fechaA." 23:59:59";
				}

				if($_POST["statusPago"]!="undefined"){
					$where["sp.status"]=$_POST["statusPago"];
				}

				$query=$this->db
				->select('sp.id_propiedad, sp.status, u.nombre, p.id_categoria, sp.id_solicitante')
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
				->from('solicitantes_propiedades sp')
				->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')
				->join("usuarios u","p.id_usuario=u.id_usuario","inner")
				->where($where)
				->order_by("sp.fecha_registro","asc")
				->get();
		}else
			if($opcion=="propiedad"){
				$query=$this->db
				->select('sp.id_propiedad, sp.status, u.nombre, p.id_categoria, sp.id_solicitante')
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
				->from('solicitantes_propiedades sp')
				->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')
				->join('usuarios u','p.id_usuario = u.id_usuario','inner')	
				->where('sp.id_propiedad',$campoValor)
				->get();
		}else
			if($opcion=="solicitante"){
				$where['s.nombre']=$campoValor;
				if($statusPago!="undefined"){
					$where["sp.status"]=$statusPago;
				}
				$query=$this->db
				->select('sp.id_propiedad, sp.status, u.nombre, p.id_categoria, sp.id_solicitante, s.nombre as solicitante')
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
				->from('solicitantes s')
				->join('solicitantes_propiedades sp','s.id_solicitante = sp.id_solicitante','inner')
				->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')	
				->join('usuarios u','p.id_usuario = u.id_usuario','inner')	
				->where($where)
				->get();
		}

		return $query->result();

	}


	public function get_all_pagos_paypal_parametro_limite($opcion, $campoValor=null, $limiteInicio, $statusPago){

		$like=array();
		$where=array();
		$whereStatusPago=array();
		$likeSolicitante=array();

		if($opcion=="nombre"){
			$like['u.nombre']=$campoValor;
		}else
			if($opcion=="propiedad"){
				$like['p.nombre']=$campo;
				$or_like=array();
				$or_like['sp.id_propiedad']=$campo;
		}else
			if($opcion=="fecha"){
				$fechaA=$_POST["fechaA"];
				if($fechaA==""){
					$fechaA=date('Y-m-d');
				}
				if($_POST["fechaComparar"]=="fecha_registro"){
					$where["sp.fecha_registro >="]=$_POST["fechaDe"]." 00:00:00";
					$where["sp.fecha_registro <="]=$fechaA." 23:59:59";
				}else{
					$where["sp.fecha_pago >="]=$_POST["fechaDe"]." 00:00:00";
					$where["sp.fecha_pago <="]=$fechaA." 23:59:59";
				}
				if($statusPago!="undefined"){
					$where["sp.status"]=$statusPago;
				}
		}else
			if($opcion=="idPropiedadPaypal"){
				$where['sp.id_propiedad']=$campoValor;
				if($statusPago!="undefined"){
					$where["sp.status"]=$statusPago;
				}
		}else
			if($opcion=="solicitante"){
				$likeSolicitante['s.nombre']=$campoValor;
		}

		if(!empty($or_like)){
			if($limiteInicio==0){
				$query=$this->db
				->select('sp.id_propiedad, sp.status, sp.id_metodos_de_pago, u.nombre, u.apellidos, p.id_categoria, sp.id_solicitante')
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
				->from('solicitantes_propiedades sp')
				->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')
				->join('usuarios u','p.id_usuario = u.id_usuario','inner')
				->like($like)
				->or_like($or_like)
				->limit($this->paginador->configPaginador["reg_x_pagina"])
				->order_by('sp.fecha_registro','desc')
				->get();
			}else{
				$query=$this->db
				->select('sp.id_propiedad, sp.status, sp.id_metodos_de_pago, u.nombre, u.apellidos, p.id_categoria, sp.id_solicitante')
				->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
				->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
				->from('solicitantes_propiedades sp')
				->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')
				->join('usuarios u','p.id_usuario = u.id_usuario','inner')
				->like($like)
				->or_like($or_like)
				->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
				->order_by('sp.fecha_registro','desc')
				->get();
			}
		}else
			if(!empty($where)){
				if($limiteInicio==0){
					$query=$this->db
					->select('sp.id_propiedad, sp.status, sp.id_metodos_de_pago, u.nombre, u.apellidos, p.id_categoria, sp.id_solicitante')
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
					->from('solicitantes_propiedades sp')
					->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')
					->join('usuarios u','p.id_usuario = u.id_usuario','inner')
					->where($where)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->order_by('sp.fecha_registro','desc')
					->get();
				}else{
					$query=$this->db
					->select('sp.id_propiedad, sp.status, sp.id_metodos_de_pago, u.nombre, u.apellidos, p.id_categoria, sp.id_solicitante')
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
					->from('solicitantes_propiedades sp')
					->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')
					->join('usuarios u','p.id_usuario = u.id_usuario','inner')
					->where($where)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->order_by('sp.fecha_registro','desc')
					->get();
				}
		}else
			if(!empty($likeSolicitante)){
				if($limiteInicio==0){
					if($statusPago!="undefined"){
						$query=$this->db
						->select('sp.id_propiedad, sp.status, u.nombre, u.apellidos,  p.id_categoria, sp.id_solicitante, s.nombre as solicitante')
						->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
						->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
						->from('solicitantes s')
						->join('solicitantes_propiedades sp','s.id_solicitante = sp.id_solicitante','inner')
						->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')	
						->join('usuarios u','p.id_usuario = u.id_usuario','inner')	
						->where("sp.status",$statusPago)
						->like($likeSolicitante)
						->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
						->order_by('sp.fecha_registro','desc')
						->get();
					}else{
						$query=$this->db
						->select('sp.id_propiedad, sp.status, u.nombre,u.apellidos, p.id_categoria, sp.id_solicitante, s.nombre as solicitante')
						->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
						->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
						->from('solicitantes s')
						->join('solicitantes_propiedades sp','s.id_solicitante = sp.id_solicitante','inner')
						->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')	
						->join('usuarios u','p.id_usuario = u.id_usuario','inner')	
						->like($likeSolicitante)
						->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
						->order_by('sp.fecha_registro','desc')
						->get();
					}
				}else{//si el limite es mayor a 0
					if($statusPago!="undefined"){
						$query=$this->db
						->select('sp.id_propiedad, sp.status, u.nombre, u.apellidos, p.id_categoria, sp.id_solicitante, s.nombre as solicitante')
						->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
						->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
						->from('solicitantes s')
						->join('solicitantes_propiedades sp','s.id_solicitante = sp.id_solicitante','inner')
						->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')	
						->join('usuarios u','p.id_usuario = u.id_usuario','inner')	
						->where("sp.status",$statusPago)
						->like($likeSolicitante)
						->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
						->order_by('sp.fecha_registro','desc')
						->get();

					}else{
						$query=$this->db
						->select('sp.id_propiedad, sp.status, u.nombre, u.apellidos, p.id_categoria, sp.id_solicitante, s.nombre as solicitante')
						->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
						->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
						->from('solicitantes s')
						->join('solicitantes_propiedades sp','s.id_solicitante = sp.id_solicitante','inner')
						->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')	
						->join('usuarios u','p.id_usuario = u.id_usuario','inner')	
						->like($likeSolicitante)
						->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
						->order_by('sp.fecha_registro','desc')
						->get();
					}
				}
		}else{//si se eligio la opcion de busqueda por anunciante
			if($limiteInicio==0){
					if($statusPago!="undefined"){
						$query=$this->db
						->select('sp.id_propiedad, sp.status, sp.id_metodos_de_pago, u.nombre, u.apellidos, p.id_categoria, sp.id_solicitante')
						->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
						->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
						->from('solicitantes_propiedades sp')
						->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')
						->join('usuarios u','p.id_usuario = u.id_usuario','inner')
						->where("sp.status",$statusPago)
						->like($like)
						->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
						->order_by('sp.fecha_registro','desc')
						->get();
					}else{
						$query=$this->db
						->select('sp.id_propiedad, sp.status, sp.id_metodos_de_pago, u.nombre, u.apellidos, p.id_categoria, sp.id_solicitante')
						->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
						->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
						->from('solicitantes_propiedades sp')
						->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')
						->join('usuarios u','p.id_usuario = u.id_usuario','inner')
						->like($like)
						->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
						->order_by('sp.fecha_registro','desc')
						->get();
					}
				
			}else{
				if($statusPago!="undefined"){
					$query=$this->db
					->select('sp.id_propiedad, sp.status, sp.id_metodos_de_pago, u.nombre, u.apellidos, p.id_categoria, sp.id_solicitante')
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
					->from('solicitantes_propiedades sp')
					->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')
					->join('usuarios u','p.id_usuario = u.id_usuario','inner')
					->where("sp.status",$statusPago)
					->like($like)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->order_by('sp.fecha_registro','desc')
					->get();

				}else{
					$query=$this->db
					->select('sp.id_propiedad, sp.status, sp.id_metodos_de_pago, u.nombre, u.apellidos, p.id_categoria, sp.id_solicitante')
					->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
					->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
					->from('solicitantes_propiedades sp')
					->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')
					->join('usuarios u','p.id_usuario = u.id_usuario','inner')
					->like($like)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->order_by('sp.fecha_registro','desc')
					->get();
				}
			}
		}

		return $query->result();

	}


	public function get_all_pagos_paypal(){

		$query=$this->db
		->select('sp.id_propiedad, sp.status, sp.id_metodos_de_pago, u.nombre, p.id_categoria, sp.id_solicitante')
		->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
		->select("DATE_FORMAT(sp.fecha_pago, '%d-%m-%Y %h:%i %p') as fecha_pago", FALSE)
		->from('solicitantes_propiedades sp')
		->join('propiedades p','sp.id_propiedad = p.id_propiedad','inner')
		->join('usuarios u','p.id_usuario = u.id_usuario','inner')
		->get();


		return $query->result();

	}

	public function get_all_metodos_de_pago(){

		$query=$this->db
		->select('id_metodos_de_pago, tipo_pago')
		->from('metodos_de_pago')
		->get();

		return $query->result();

	}


	public function get_metodo_pago_por_id($idMetodoPago){

		$query=$this->db
		->select('tipo_pago')
		->from('metodos_de_pago')
		->where('id_metodos_de_pago',$idMetodoPago)
		->get();

		return $query->row();

	}


	public function add_orden_compra($idMetodoPago){

		$arreglo=array(
						"status"=>false,
						"fecha_registro"=>date("Y-m-d H:i:s"),
						"id_metodos_de_pago"=>$idMetodoPago,
						"id_usuario"=>$this->session->userdata('idUser')
				      );

		$this->db->insert('orden_de_compra', $arreglo);

		return $this->db->insert_id();

	}


	public function add_detalles_orden_compra($idSolicitantesPropiedades, $idOrdenCompra){

		$arreglo=array(
						"id_orden_de_compra"=>$idOrdenCompra,
						"id_solicitantes_propiedades"=>$idSolicitantesPropiedades
				      );

		$this->db->insert('detalles_orden_de_compra', $arreglo);


	}


	public function get_all_orden_de_compra($opcion=null, $campoValor=null){

		$where=array();
		if($opcion=="idOrdenCompra"){
			$query=$this->db
			->select('id_orden_de_compra, status, fecha_registro, id_metodos_de_pago, id_usuario')
			->from('orden_de_compra')
			->where('id_orden_de_compra',$campoValor)
			->get();
		}else
			if($opcion=="anunciante"){
				$query=$this->db
				->select('oc.id_orden_de_compra, oc.status, oc.fecha_registro, oc.id_metodos_de_pago, oc.id_usuario')
				->from('orden_de_compra oc')
				->join('usuarios u','oc.id_usuario=u.id_usuario','inner')
				->where('u.nombre',$campoValor)
				->get();
		}else
			if($opcion=="fecha"){
				$where["fecha_registro >="]=$_POST["fechaDe"]." 00:00:00";
				$where["fecha_registro <="]=$_POST["fechaA"]." 23:59:59";
				$query=$this->db
				->select('id_orden_de_compra, status, fecha_registro, id_metodos_de_pago, id_usuario')
				->from('orden_de_compra')
				->where($where)
				->get();
		}else
			if($opcion==null){
				$query=$this->db
				->select('id_orden_de_compra, status, fecha_registro, id_metodos_de_pago, id_usuario')
				->from('orden_de_compra')
				->get();
		}
		
		return $query->result();

	}


	public function get_all_orden_de_compra_limite($opcion=null, $campoValor=null, $limiteInicio){

		$where=array();
		if($opcion=="idOrdenCompra"){
			if($limiteInicio==0){
				$query=$this->db
				->select('id_orden_de_compra, status, fecha_registro, id_metodos_de_pago, id_usuario')
				->from('orden_de_compra')
				->where('status', 0)
				->where('id_orden_de_compra',$campoValor)
				->limit($this->paginador->configPaginador["reg_x_pagina"])
				->get();
			}else{
				$query=$this->db
				->select('id_orden_de_compra, status, fecha_registro, id_metodos_de_pago, id_usuario')
				->from('orden_de_compra')
				->where('status', 0)
				->where('id_orden_de_compra',$campoValor)
				->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
				->get();
			}
		}else
			if($opcion=="fecha"){
				$where["fecha_registro >="]=$_POST["fechaDe"]." 00:00:00";
				$where["fecha_registro <="]=$_POST["fechaA"]." 23:59:59";
				$where["status"]=0;
				if($limiteInicio==0){
					$query=$this->db
					->select('id_orden_de_compra, status, fecha_registro, id_metodos_de_pago, id_usuario')
					->from('orden_de_compra')
					->where($where)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->get();
				}else{
					$query=$this->db
					->select('id_orden_de_compra, status, fecha_registro, id_metodos_de_pago, id_usuario')
					->from('orden_de_compra')
					->where($where)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->get();
				}
		}else
			if($opcion=="anunciante"){
				if($limiteInicio==0){
					$query=$this->db
					->select('oc.id_orden_de_compra, oc.status, oc.fecha_registro, oc.id_metodos_de_pago, oc.id_usuario')
					->from('orden_de_compra oc')
					->join('usuarios u','oc.id_usuario=u.id_usuario','inner')
					->where('oc.status', 0)
					->where('u.nombre',$campoValor)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->get();
				}else{
					$query=$this->db
					->select('oc.id_orden_de_compra, oc.status, oc.fecha_registro, oc.id_metodos_de_pago, oc.id_usuario')
					->from('orden_de_compra oc')
					->join('usuarios u','oc.id_usuario=u.id_usuario','inner')
					->where('oc.status', 0)
					->where('u.nombre',$campoValor)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->get();
				}
		}else
			if($opcion==null){
				if($limiteInicio==0){
					$query=$this->db
					->select('id_orden_de_compra, status, fecha_registro, id_metodos_de_pago, id_usuario')
					->from('orden_de_compra')
					->where('status', 0)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->get();
				}else{
					$query=$this->db
					->select('id_orden_de_compra, status, fecha_registro, id_metodos_de_pago, id_usuario')
					->from('orden_de_compra')
					->where('status', 0)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->get();
				}
		}

		return $query->result();

	}

	public function get_detalles_orden_de_compra($idOrdenCompra){

		$query=$this->db
		->select('id_orden_de_compra, id_solicitantes_propiedades')
		->from('detalles_orden_de_compra')
		->where('id_orden_de_compra', $idOrdenCompra)
		->get();
	
		return $query->result();

	}


	public function get_solicitante_detalles_orden_de_compra($idOrdenCompra){

		$query=$this->db
		->select("s.nombre as cliente, sp.id, s.id_solicitante, sp.id_propiedad, s.correo, s.telefono, s.celular, sp.comentario, sp.status, p.nombre as propiedad, p.precio, p.id_categoria, p.id_usuario")
		->select("DATE_FORMAT(sp.fecha_registro, '%d-%m-%Y %h:%i %p') as fecha_registro", FALSE)
		->from("propiedades p")
		->join("solicitantes_propiedades sp","p.id_propiedad=sp.id_propiedad","inner")
		->join("solicitantes s","sp.id_solicitante=s.id_solicitante","inner")
		->where("sp.id",$idOrdenCompra)
		->get();

		return $query->row();
	
	}


	public function status_orden_compra($status, $idOrdenCompra){

		$dato=array("status"=>$status);

		$this->db->where('id_orden_de_compra', $idOrdenCompra);
		$this->db->update('orden_de_compra', $dato);

	}


	//delete's
	public function eliminar_solicitantes_propiedades_por_id_propiedad($idPropiedad){

		$this->db->delete('solicitantes_propiedades', array('id_propiedad'=>$idPropiedad));

	}

	public function eliminar_solicitante($idSolicitante){

		$this->db->delete('solicitantes', array('id_solicitante'=>$idSolicitante));

	}

	public function eliminar_empresa_anunciante($idUser){

		$this->db->delete('empresa_anunciantes_tipo', array('id_usuario'=>$idUser));

	}

	public function eliminar_propiedades_anunciante($idUser){

		$propiedades=$this->propiedades_model->get_propiedades_por_id_usuario_para_root($idUser);
		if(count($propiedades)>0){
			$this->db->delete('propiedades', array('id_usuario'=>$idUser));
		}	

	}

	public function eliminar_propiedad($idPropiedad){

		$this->db->delete('propiedades', array('id_propiedad'=>$idPropiedad));
		
	}


}
