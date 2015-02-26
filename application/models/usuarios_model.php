<?php
class Usuarios_model Extends CI_Model{

	public function registro_anunciantes_clientes(){

		$pass_sha1=sha1($this->input->post('pass'));

		$array=array(
				"nombre"=>$this->input->post('nombre'),
				"apellidos"=>$this->input->post('apellidos'),
				"correo"=>$this->input->post('correo'),
				"login"=>"",
				"pass"=>$pass_sha1,
				"direccion"=>"",
				"telefono"=>$this->input->post('telefono'),
				"celular"=>"",
				"avatar"=>"",
				"fecha_registro"=>date("Y-m-d h:i:sa"),
				"status"=>"1",
				"id_usuarios_perfiles"=>1,
				"id_estado"=>$this->input->post('comboEstado'),
				"id_anunciantes_tipo"=>$this->input->post('comboAnunciante')
			);
		//se inserta el registro en la tabla usuarios
		$this->db->insert('usuarios', $array);

		//recupero el id del usuario insertado
		$idUser=$this->db->insert_id();



		//si se checo la opción de suscribir a boletin lo agrego a la tabla boletin anunciantes
		if($_POST["boletin"]=="true"){

			$this->add_remove_boletin_anunciantes($idUser, true);
			
		}

		//inserto el nombre de la empresa del tipo anunciante si contiene algo el campo empresa
		if($_POST["empresa"]!=""){

			$this->add_empresa_anunciante($this->input->post('comboAnunciante'), $this->input->post('empresa'), $idUser);

		}

		//iniciamos sesion del usuario registrado 
		$sesion_data = array('login' => $this->input->post('nombre'),
                              'pass' => $pass_sha1,
                              'idUser' => $idUser,
                              'nivelUser'=>1,
                              'correo'=>$this->input->post('correo')
                             );

        $this->session->set_userdata($sesion_data);

		//mandamos un correo al usuario para que active su cuenta
		$fecha_envio=date("d-m-Y");
		$hora_envio=date("H:m:s");

		$mail = new PHPMailer();
		$mail->From = "staff@interhabita.com";
		$mail->FromName = "Staff Interhabita";
		$mail->Subject = "Bienvenido a Interhabita";
		$mail->AddAddress($this->input->post('correo'), $this->input->post('nombre'));

		$md5Nombre=md5($this->input->post('nombre'));
		// cuerpo del mensaje
		$body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>
          <title></title>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <style type="text/css">
          @import url(https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic,500italic,700italic);
          body {
            margin: 0;
            padding: 0;
            min-width: 100%;
          }
          table {
            border-collapse: collapse;
            border-spacing: 0;
          }
          td {
            padding: 0;
            vertical-align: top;
          }
          .spacer,
          .border {
            font-size: 1px;
            line-height: 1px;
          }
          img {
            border: 0;
            -ms-interpolation-mode: bicubic;
          }
          .image {
            font-size: 0;
            Margin-bottom: 20px;
          }
          .image img {
            display: block;
          }
          .logo img {
            display: block;
          }
          strong {
            font-weight: bold;
          }
          h1,
          h2,
          h3,
          p,
          ol,
          ul,
          li {
            Margin-top: 0;
          }
          ol,
          ul,
          li {
            padding-left: 0;
          }
          .btn a {
            mso-hide: all;
          }
          blockquote {
            Margin-top: 0;
            Margin-right: 0;
            Margin-bottom: 0;
            padding-right: 0;
          }
          .column-top {
            font-size: 30px;
            line-height: 30px;
          }
          .column-bottom {
            font-size: 10px;
            line-height: 10px;
          }
          .column {
            text-align: left;
          }
          .contents {
            width: 100%;
          }
          .padded {
            padding-left: 40px;
            padding-right: 40px;
          }
          .wrapper {
            background-color: #1e1e1e;
            width: 100%;
            min-width: 620px;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
          }
          table.wrapper {
            table-layout: fixed;
          }
          .one-col,
          .two-col,
          .three-col {
            Margin-left: auto;
            Margin-right: auto;
            width: 600px;
          }
          .one-col p,
          .one-col ol,
          .one-col ul {
            Margin-bottom: 20px;
          }
          .two-col p,
          .two-col ol,
          .two-col ul {
            Margin-bottom: 20px;
          }
          .two-col .image {
            Margin-bottom: 20px;
          }
          .two-col .column-top {
            font-size: 40px;
            line-height: 40px;
          }
          .two-col .column-bottom {
            font-size: 20px;
            line-height: 20px;
          }
          .two-col .column {
            width: 290px;
          }
          .two-col .gutter {
            width: 20px;
            font-size: 1px;
            line-height: 1px;
          }
          .three-col p,
          .three-col ol,
          .three-col ul {
            Margin-bottom: 20px;
          }
          .three-col .image {
            Margin-bottom: 20px;
          }
          .three-col .column-top {
            font-size: 20px;
            line-height: 20px;
          }
          .three-col .column-bottom {
            font-size: 0px;
            line-height: 0px;
          }
          .three-col .column,
          .two-col .column-narrower {
            width: 190px;
          }
          .three-col .gutter {
            width: 15px;
            font-size: 1px;
            line-height: 1px;
          }
          .three-col .padded {
            padding-left: 20px;
            padding-right: 20px;
          }
          .wider {
            width: 390px;
          }
          .narrower {
            width: 190px;
          }
          @media only screen and (max-width: 620px) {
            [class*=wrapper] {
              min-width: 280px !important;
              width: 100%!important;
            }
            [class*=wrapper] .one-col,
            [class*=wrapper] .two-col,
            [class*=wrapper] .three-col {
              width: 280px !important;
            }
            [class*=wrapper] .column {
              display: block;
              float: left;
              width: 280px !important;
            }
            [class*=wrapper] .padded {
              padding-left: 20px !important;
              padding-right: 20px !important;
            }
            [class*=wrapper] .full {
              display: none;
            }
            [class*=wrapper] .block {
              display: block !important;
            }
            [class*=wrapper] .hide {
              display: none !important;
            }
            [class*=wrapper] .image {
              margin-bottom: 20px !important;
            }
            [class*=wrapper] .image img {
              height: auto !important;
              width: 100% !important;
            }
          }
          h1,
          h2,
          h3 {
            font-weight: normal;
          }
          p,
          ol,
          ul {
            font-weight: 400;
          }
          table.wrapper {
            background-color: #1e1e1e;
          }
          .column table,
          .padded table {
            width: 100%;
          }
          .preheader {
            width: 100%;
            background-color: #191919;
          }
          .preheader .title,
          .preheader .webversion {
            color: #e6e6e6;
            font-size: 11px;
            line-height: 16px;
          }
          .preheader .title {
            padding: 9px;
            text-align: left;
          }
          .preheader .webversion {
            padding: 9px;
            text-align: right;
            width: 250px;
          }
          .preheader .webversion a {
            font-weight: bold;
            color: #e6e6e6;
            text-decoration: none;
          }
          .preheader .preheader-buffer {
            font-size: 20px;
            line-height: 20px;
            background-color: #1e1e1e;
          }
          .logo {
            color: #ffffff;
            font-size: 36px;
            line-height: 42px;
            padding-top: 20px;
            padding-bottom: 40px;
            text-align: center;
            width: 520px;
          }
          .logo a {
            color: #ffffff;
            text-decoration: none;
          }
          ul li {
            list-style-type: disc;
            list-style-position: outside;
          }
          p,
          ol,
          ul {
            -webkit-font-smoothing: antialiased;
          }
          .wrapper {
            background-color: #1e1e1e;
          }
          .wrapper .btn a {
            transition: background-color 0.2s;
          }
          .wrapper h1,
          .wrapper h2,
          .wrapper h3,
          .wrapper p,
          .wrapper ol,
          .wrapper ul,
          .wrapper blockquote p,
          .wrapper .logo,
          .wrapper .btn a,
          .wrapper .footer div,
          .wrapper .footer td,
          .wrapper .preheader .title,
          .wrapper .preheader .webversion {
            font-family: sans-serif;
          }
          @media screen and (min-width: 0) {
            .wrapper h1,
            .wrapper h2,
            .wrapper h3,
            .wrapper p,
            .wrapper ol,
            .wrapper ul,
            .wrapper blockquote p,
            .wrapper .logo,
            .wrapper .btn a,
            .wrapper .footer div,
            .wrapper .footer td,
            .wrapper .preheader .title,
            .wrapper .preheader .webversion {
              font-family: Ubuntu, sans-serif !important;
            }
          }
          h1 a,
          h2 a,
          h3 a {
            text-decoration: none;
          }
          .one-col,
          .two-col,
          .three-col,
          .preheader,
          .header,
          .footer {
            Margin-left: auto;
            Margin-right: auto;
          }
          .one-col .padded,
          .two-col .padded,
          .three-col .padded,
          .preheader .padded,
          .header .padded,
          .footer .padded {
            text-align: left;
          }
          .one-col blockquote,
          .two-col blockquote,
          .three-col blockquote,
          .preheader blockquote,
          .header blockquote,
          .footer blockquote {
            Margin-left: 0;
            background-repeat: no-repeat;
            background-position: 0px 4px;
          }
          .one-col blockquote p,
          .two-col blockquote p,
          .three-col blockquote p,
          .preheader blockquote p,
          .header blockquote p,
          .footer blockquote p {
            font-style: italic;
          }
          .column table td table:nth-last-child(2) td h1:last-child,
          .column-wider table td table:nth-last-child(2) td h1:last-child,
          .column-narrower table td table:nth-last-child(2) td h1:last-child,
          .column table td table:nth-last-child(2) td h2:last-child,
          .column-wider table td table:nth-last-child(2) td h2:last-child,
          .column-narrower table td table:nth-last-child(2) td h2:last-child,
          .column table td table:nth-last-child(2) td h3:last-child,
          .column-wider table td table:nth-last-child(2) td h3:last-child,
          .column-narrower table td table:nth-last-child(2) td h3:last-child,
          .column table td table:nth-last-child(2) td p:last-child,
          .column-wider table td table:nth-last-child(2) td p:last-child,
          .column-narrower table td table:nth-last-child(2) td p:last-child,
          .column table td table:nth-last-child(2) td ol:last-child,
          .column-wider table td table:nth-last-child(2) td ol:last-child,
          .column-narrower table td table:nth-last-child(2) td ol:last-child,
          .column table td table:nth-last-child(2) td ul:last-child,
          .column-wider table td table:nth-last-child(2) td ul:last-child,
          .column-narrower table td table:nth-last-child(2) td ul:last-child {
            Margin-bottom: 20px;
          }
          .btn {
            Margin-bottom: 20px;
          }
          .btn a {
            -webkit-font-smoothing: antialiased;
            padding-top: 15px;
            padding-bottom: 15px;
            font-weight: 500;
            display: inline-block;
            font-size: 16px;
            line-height: 20px;
            text-align: center;
            text-decoration: none;
            border-bottom: 3px solid #1e1e1e;
          }
          .one-col .btn a,
          .one-col-feature .btn a {
            width: 480px;
            padding-left: 20px;
            padding-right: 20px;
          }
          .two-col .column .btn a {
            width: 170px;
            padding-left: 20px;
            padding-right: 20px;
          }
          .two-col .column-narrower .btn a {
            width: 130px;
            padding-left: 10px;
            padding-right: 10px;
          }
          .two-col .column-wider .btn a {
            width: 270px;
            padding-left: 20px;
            padding-right: 20px;
          }
          .three-col .btn a {
            width: 130px;
            padding-left: 10px;
            padding-right: 10px;
          }
          .divider table {
            font-size: 0;
            height: 6px;
            line-height: 6px;
            Margin-bottom: 20px;
          }
          .one-col .padded ul li {
            padding-left: 13px;
          }
          .one-col h1 {
            font-size: 30px;
            line-height: 44px;
            Margin-bottom: 16px;
          }
          .one-col h2 {
            font-size: 20px;
            line-height: 28px;
            Margin-bottom: 14px;
          }
          .one-col h3 {
            font-size: 16px;
            line-height: 22px;
            Margin-bottom: 12px;
          }
          .one-col p,
          .one-col ol,
          .one-col ul {
            font-size: 14px;
            line-height: 22px;
            Margin-bottom: 20px;
          }
          .one-col ol,
          .one-col ul {
            Margin-left: 48px;
          }
          .one-col ol li,
          .one-col ul li {
            Margin-bottom: 10px;
            padding-left: 13px;
          }
          .one-col blockquote p {
            font-size: 18px;
            line-height: 26px;
          }
          .one-col blockquote p,
          .one-col blockquote h1,
          .one-col blockquote h2,
          .one-col blockquote h3,
          .one-col blockquote ol,
          .one-col blockquote ul {
            padding-left: 60px;
          }
          .one-col-feature {
            width: 600px;
            Margin-left: auto;
            Margin-right: auto;
          }
          .one-col-feature h1,
          .one-col-feature h2,
          .one-col-feature h3,
          .one-col-feature p,
          .one-col-feature ol,
          .one-col-feature ul,
          .one-col-feature a {
            color: #212a32;
          }
          .one-col-feature h1 a,
          .one-col-feature h2 a,
          .one-col-feature h3 a,
          .one-col-feature p a,
          .one-col-feature li a {
            text-decoration: none;
            font-weight: normal;
          }
          .one-col-feature h1 {
            font-size: 30px;
            line-height: 46px;
            Margin-bottom: 20px;
          }
          .one-col-feature h2 {
            font-size: 24px;
            line-height: 40px;
            Margin-bottom: 16px;
          }
          .one-col-feature h3 {
            font-size: 20px;
            line-height: 30px;
            Margin-bottom: 14px;
          }
          .one-col-feature p {
            font-size: 18px;
            line-height: 30px;
            Margin-bottom: 20px;
          }
          .one-col-feature ol {
            Margin-left: 36px;
          }
          .one-col-feature ol li {
            padding-left: 15px;
          }
          .one-col-feature ul {
            Margin-left: 30px;
          }
          .one-col-feature ul li {
            padding-left: 20px;
            list-style-image: url(https://i3.createsend1.com/static/eb/master/09-onyx/images/bullet-large.png);
            line-height: 40px;
          }
          .one-col-feature ol,
          .one-col-feature ul {
            font-size: 26px;
            line-height: 40px;
          }
          .one-col-feature li {
            Margin-bottom: 0;
          }
          .one-col-feature h1,
          .one-col-feature h2,
          .one-col-feature h3,
          .one-col-feature p {
            text-align: center;
          }
          .one-col-feature blockquote {
            Margin: 0;
            background-repeat: no-repeat;
            background-position: 100% 100%;
          }
          .one-col-feature blockquote p:first-child,
          .one-col-feature blockquote h1:first-child,
          .one-col-feature blockquote h2:first-child,
          .one-col-feature blockquote h3:first-child,
          .one-col-feature blockquote ol:first-child,
          .one-col-feature blockquote ul:first-child {
            padding-top: 27px;
          }
          .one-col-feature blockquote p,
          .one-col-feature blockquote h1,
          .one-col-feature blockquote h2,
          .one-col-feature blockquote h3,
          .one-col-feature blockquote ol,
          .one-col-feature blockquote ul {
            background-repeat: no-repeat;
            background-position: 0% 0%;
            font-size: 26px;
            line-height: 40px;
            padding: 0;
            font-style: italic;
          }
          .one-col-feature blockquote p:last-child,
          .one-col-feature blockquote h1:last-child,
          .one-col-feature blockquote h2:last-child,
          .one-col-feature blockquote h3:last-child,
          .one-col-feature blockquote ol:last-child,
          .one-col-feature blockquote ul:last-child {
            padding-bottom: 30px;
            Margin-bottom: 20px;
          }
          .one-col-feature .divider {
            Margin-bottom: 20px;
          }
          .one-col-feature .divider img {
            display: block;
            Margin-left: auto;
            Margin-right: auto;
          }
          .one-col-feature .btn a {
            background-color: #ffffff;
            color: #212a32;
          }
          .two-col h1 {
            font-size: 30px;
            line-height: 44px;
            Margin-bottom: 16px;
          }
          .two-col h2 {
            font-size: 20px;
            line-height: 28px;
            Margin-bottom: 14px;
          }
          .two-col h3 {
            font-size: 16px;
            line-height: 22px;
            Margin-bottom: 12px;
          }
          .two-col p,
          .two-col ol,
          .two-col ul {
            font-size: 14px;
            line-height: 22px;
            Margin-bottom: 20px;
          }
          .two-col ol,
          .two-col ul {
            Margin-left: 18px;
          }
          .two-col li {
            Margin-bottom: 10px;
            padding-left: 20px;
          }
          .two-col .btn a {
            font-size: 16px;
            line-height: 20px;
          }
          .two-col blockquote p,
          .two-col blockquote h1,
          .two-col blockquote h2,
          .two-col blockquote h3,
          .two-col blockquote ol,
          .two-col blockquote ul {
            padding-left: 38px;
          }
          .two-col .column-wider {
            width: 390px;
          }
          .two-col .column-narrower {
            width: 190px;
          }
          .three-col .column .padded,
          .two-col .column-narrower .padded {
            padding-left: 20px;
            padding-right: 20px;
          }
          .three-col .column h1,
          .two-col .column-narrower h1 {
            font-size: 20px;
            line-height: 28px;
            Margin-bottom: 14px;
          }
          .three-col .column h2,
          .two-col .column-narrower h2 {
            font-size: 16px;
            line-height: 22px;
            Margin-bottom: 12px;
          }
          .three-col .column h3,
          .two-col .column-narrower h3 {
            font-size: 14px;
            line-height: 20px;
            Margin-bottom: 8px;
          }
          .three-col .column p,
          .three-col .column ol,
          .three-col .column ul,
          .two-col .column-narrower p,
          .two-col .column-narrower ol,
          .two-col .column-narrower ul {
            font-size: 14px;
            line-height: 22px;
            Margin-bottom: 20px;
          }
          .three-col .column ol,
          .three-col .column ul,
          .two-col .column-narrower ol,
          .two-col .column-narrower ul {
            Margin-left: 18px;
          }
          .three-col .column ol li,
          .three-col .column ul li,
          .two-col .column-narrower ol li,
          .two-col .column-narrower ul li {
            Margin-bottom: 10px;
            padding-left: 10px;
          }
          .three-col .column .btn a,
          .two-col .column-narrower .btn a {
            padding-top: 10px;
            padding-bottom: 10px;
          }
          .three-col .column blockquote p,
          .three-col .column blockquote h1,
          .three-col .column blockquote h2,
          .three-col .column blockquote h3,
          .three-col .column blockquote ol,
          .three-col .column blockquote ul,
          .two-col .column-narrower blockquote p,
          .two-col .column-narrower blockquote h1,
          .two-col .column-narrower blockquote h2,
          .two-col .column-narrower blockquote h3,
          .two-col .column-narrower blockquote ol,
          .two-col .column-narrower blockquote ul {
            padding-left: 28px;
          }
          .contents-green {
            background-color: #27da90;
          }
          .contents-green h1 a,
          .contents-green h2 a,
          .contents-green h3 a,
          .contents-green p a,
          .contents-green li a {
            border-bottom: 1px solid #212a32;
          }
          .contents-green .btn a {
            border-bottom-color: #1eb074;
          }
          .contents-green blockquote {
            background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark-green.png);
          }
          .contents-green blockquote p:first-child,
          .contents-green blockquote h1:first-child,
          .contents-green blockquote h2:first-child,
          .contents-green blockquote h3:first-child,
          .contents-green blockquote ol:first-child,
          .contents-green blockquote ul:first-child {
            background-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark-green.png);
          }
          .contents-orange {
            background-color: #ed5a32;
          }
          .contents-orange h1 a,
          .contents-orange h2 a,
          .contents-orange h3 a,
          .contents-orange p a,
          .contents-orange li a {
            border-bottom: 1px solid #212a32;
          }
          .contents-orange .btn a {
            border-bottom-color: #d93d13;
          }
          .contents-orange blockquote {
            background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark-orange.png);
          }
          .contents-orange blockquote p:first-child,
          .contents-orange blockquote h1:first-child,
          .contents-orange blockquote h2:first-child,
          .contents-orange blockquote h3:first-child,
          .contents-orange blockquote ol:first-child,
          .contents-orange blockquote ul:first-child {
            background-image: url(https://i7.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark-orange.png);
          }
          .contents-grey {
            background-color: #e6e7e8;
          }
          .contents-grey h1 a,
          .contents-grey h2 a,
          .contents-grey h3 a,
          .contents-grey p a,
          .contents-grey li a {
            border-bottom: 1px solid #212a32;
          }
          .contents-grey .btn a {
            border-bottom-color: #cbced0;
          }
          .contents-grey blockquote {
            background-image: url(https://i9.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark-grey.png);
          }
          .contents-grey blockquote p:first-child,
          .contents-grey blockquote h1:first-child,
          .contents-grey blockquote h2:first-child,
          .contents-grey blockquote h3:first-child,
          .contents-grey blockquote ol:first-child,
          .contents-grey blockquote ul:first-child {
            background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark-grey.png);
          }
          .contents-green .btn a:hover,
          .contents-orange .btn a:hover,
          .contents-grey .btn a:hover {
            background-image: none!important;
            background-color: #f1f2f2!important;
          }
          .contents {
            background-color: #212a32;
          }
          .contents p,
          .contents ol,
          .contents ul {
            color: #ffffff;
          }
          .contents-accent-blue .btn a,
          .contents-accent-pink .btn a,
          .contents-accent-orange .btn a,
          .contents-accent-aqua .btn a {
            background-repeat: repeat-x;
            color: #ffffff;
          }
          .contents-accent-blue .btn a:hover,
          .contents-accent-pink .btn a:hover,
          .contents-accent-orange .btn a:hover,
          .contents-accent-aqua .btn a:hover {
            background-image: none!important;
          }
          .contents-accent-blue {
            width: 100%;
            background-color: #212a32;
          }
          .contents-accent-blue p,
          .contents-accent-blue ol,
          .contents-accent-blue ul {
            color: #ffffff;
          }
          .contents-accent-blue h1,
          .contents-accent-blue h2,
          .contents-accent-blue h3,
          .contents-accent-blue h1 a,
          .contents-accent-blue h2 a,
          .contents-accent-blue h3 a,
          .contents-accent-blue a {
            color: #3d88fd;
          }
          .contents-accent-blue h1 a,
          .contents-accent-blue h2 a,
          .contents-accent-blue h3 a {
            border-bottom: 1px solid #3d88fd;
          }
          .contents-accent-blue ul li {
            list-style-image: url(https://i10.createsend1.com/static/eb/master/09-onyx/images/bullet-blue.png);
          }
          .contents-accent-blue .btn a {
            background-color: #367ffd;
            background-image: url(https://i1.createsend1.com/static/eb/master/09-onyx/images/btn-blue.png);
          }
          .contents-accent-blue .btn a:hover {
            background-color: #1d64d2!important;
          }
          .contents-accent-blue blockquote {
            background-image: url(https://i3.createsend1.com/static/eb/master/09-onyx/images/quote-blue.png);
          }
          .contents-accent-aqua {
            width: 100%;
            background-color: #212a32;
          }
          .contents-accent-aqua p,
          .contents-accent-aqua ol,
          .contents-accent-aqua ul {
            color: #ffffff;
          }
          .contents-accent-aqua h1,
          .contents-accent-aqua h2,
          .contents-accent-aqua h3,
          .contents-accent-aqua h1 a,
          .contents-accent-aqua h2 a,
          .contents-accent-aqua h3 a,
          .contents-accent-aqua a {
            color: #00b5d6;
          }
          .contents-accent-aqua h1 a,
          .contents-accent-aqua h2 a,
          .contents-accent-aqua h3 a {
            border-bottom: 1px solid #00b5d6;
          }
          .contents-accent-aqua ul li {
            list-style-image: url(https://i2.createsend1.com/static/eb/master/09-onyx/images/bullet-aqua.png);
          }
          .contents-accent-aqua .btn a {
            background-color: #00add1;
            background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/btn-aqua.png);
          }
          .contents-accent-aqua .btn a:hover {
            background-color: #0092ad!important;
          }
          .contents-accent-aqua blockquote {
            background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-aqua.png);
          }
          .column-narrower .contents-accent-aqua .padded blockquote {
            background-image: url(https://i7.createsend1.com/static/eb/master/09-onyx/images/quote-aqua-single.png);
          }
          .column-narrower .contents-accent-aqua .padded blockquote p,
          .column-narrower .contents-accent-aqua .padded blockquote h1,
          .column-narrower .contents-accent-aqua .padded blockquote h2,
          .column-narrower .contents-accent-aqua .padded blockquote h3 {
            padding-left: 28px;
          }
          .contents-accent-pink {
            width: 100%;
            background-color: #212a32;
          }
          .contents-accent-pink p,
          .contents-accent-pink ol,
          .contents-accent-pink ul {
            color: #ffffff;
          }
          .contents-accent-pink h1,
          .contents-accent-pink h2,
          .contents-accent-pink h3,
          .contents-accent-pink h1 a,
          .contents-accent-pink h2 a,
          .contents-accent-pink h3 a,
          .contents-accent-pink a {
            color: #f63366;
          }
          .contents-accent-pink h1 a,
          .contents-accent-pink h2 a,
          .contents-accent-pink h3 a {
            border-bottom: 1px solid #f63366;
          }
          .contents-accent-pink ul li {
            list-style-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/bullet-pink.png);
          }
          .contents-accent-pink .btn a {
            background-color: #f52d5d;
            background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/btn-pink.png);
          }
          .contents-accent-pink .btn a:hover {
            background-color: #c93057!important;
          }
          .contents-accent-pink blockquote {
            background-image: url(https://i9.createsend1.com/static/eb/master/09-onyx/images/quote-pink.png);
          }
          .contents-accent-orange {
            width: 100%;
            background-color: #212a32;
          }
          .contents-accent-orange p,
          .contents-accent-orange ol,
          .contents-accent-orange ul {
            color: #ffffff;
          }
          .contents-accent-orange h1,
          .contents-accent-orange h2,
          .contents-accent-orange h3,
          .contents-accent-orange h1 a,
          .contents-accent-orange h2 a,
          .contents-accent-orange h3 a,
          .contents-accent-orange a {
            color: #ff9e05;
          }
          .contents-accent-orange h1 a,
          .contents-accent-orange h2 a,
          .contents-accent-orange h3 a {
            border-bottom: 1px solid #ff9e05;
          }
          .contents-accent-orange ul li {
            list-style-image: url(https://i1.createsend1.com/static/eb/master/09-onyx/images/bullet-orange.png);
          }
          .contents-accent-orange .btn a {
            background-color: #ff9306;
            background-image: url(https://i3.createsend1.com/static/eb/master/09-onyx/images/btn-orange.png);
          }
          .contents-accent-orange .btn a:hover {
            background-color: #ff8a00!important;
          }
          .contents-accent-orange blockquote {
            background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-orange.png);
          }
          .footer {
            width: 100%;
            background-color: #191919;
          }
          .footer .padded {
            padding-left: 20px;
            padding-right: 20px;
          }
          .footer td {
            color: #cccccc;
            font-size: 12px;
            line-height: 20px;
          }
          .footer .contents {
            background-color: #191919;
          }
          .footer .footer-container .column-details {
            padding: 40px 0 75px 0;
          }
          .footer .footer-container .column-details td {
            text-align: left;
          }
          .footer .footer-container .column-social {
            width: 140px;
            padding: 42px 0 75px 20px;
          }
          .footer .footer-container .column-social td {
            text-align: left;
          }
          .footer .social {
            width: 170px;
          }
          .footer .social a {
            text-decoration: none;
          }
          .footer .social .social-icon {
            width: 39px;
          }
          .footer .social .social-text {
            width: 131px;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-size: 10px;
            line-height: 12px;
            vertical-align: middle;
            color: #cccccc;
          }
          .footer .social .social-text a {
            color: #cccccc;
          }
          .footer .social-space {
            font-size: 10px;
            line-height: 10px;
            display: block;
            width: 100%;
          }
          .footer .prefs a {
            color: #cccccc;
          }
          .footer .address,
          .footer .permission {
            display: block;
          }
          .footer .address a,
          .footer .permission a {
            color: #cccccc;
            text-decoration: underline;
          }
          .footer .address {
            Margin-bottom: 17px;
          }
          @media (min-width: 0) {
            body {
              background-color: #191919;
            }
          }
          @media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi) {
            .one-col ul {
              border-left: 30px solid #212a32;
            }
          }
          @media (-webkit-min-device-pixel-ratio: 1.5) and (min-width: 620px), (min-resolution: 144dpi) and (min-width: 620px) {
            .contents-accent-blue blockquote {
              background-size: 40px!important;
              background-image: url(https://i10.createsend1.com/static/eb/master/09-onyx/images/quote-blue@2x.png) !important;
            }
            .contents-accent-aqua blockquote {
              background-size: 30px!important;
              background-image: url(https://i2.createsend1.com/static/eb/master/09-onyx/images/quote-aqua@2x.png) !important;
            }
            .column-narrower .contents-accent-aqua blockquote {
              background-position: -15px 6px !important;
            }
            .contents-accent-pink blockquote {
              background-size: 30px!important;
              background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/quote-pink@2x.png) !important;
            }
            .contents-accent-orange blockquote {
              background-size: 10px!important;
              background-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/quote-orange@2x.png) !important;
            }
            *[class*=contents-accent] ul li {
              padding-left: 30px!important;
            }
          }
          @media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi), (max-width: 620px) {
            [class*=wrapper] .one-col-feature blockquote {
              background-size: 30px!important;
              background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark@2x.png) !important;
              background-position: 50% 100%!important;
            }
            [class*=wrapper] .one-col-feature blockquote p:first-child,
            [class*=wrapper] .one-col-feature blockquote h1:first-child,
            [class*=wrapper] .one-col-feature blockquote h2:first-child,
            [class*=wrapper] .one-col-feature blockquote h3:first-child,
            [class*=wrapper] .one-col-feature blockquote ol:first-child,
            [class*=wrapper] .one-col-feature blockquote ul:first-child {
              background-size: 30px!important;
              background-image: url(https://i10.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark@2x.png) !important;
              background-position: 50% 0%!important;
            }
            [class*=wrapper] .contents-accent-blue ul li {
              background: transparent url(https://i7.createsend1.com/static/eb/master/09-onyx/images/bullet-blue@2x.png) no-repeat top left !important;
            }
            [class*=wrapper] .contents-accent-aqua ul li {
              background: transparent url(https://i9.createsend1.com/static/eb/master/09-onyx/images/bullet-aqua@2x.png) no-repeat top left !important;
            }
            [class*=wrapper] .contents-accent-pink ul li {
              background: transparent url(https://i1.createsend1.com/static/eb/master/09-onyx/images/bullet-pink@2x.png) no-repeat top left !important;
            }
            [class*=wrapper] .contents-accent-orange ul li {
              background: transparent url(https://i3.createsend1.com/static/eb/master/09-onyx/images/bullet-orange@2x.png) no-repeat top left !important;
            }
            [class*=wrapper] *[class*=contents-accent] ul {
              margin-left: 0px!important;
            }
            [class*=wrapper] *[class*=contents-accent] ul li {
              list-style-type: none!important;
              list-style-image: none!important;
              background-size: 10px 10px!important;
              background-position: 0 5px!important;
            }
            [class*=wrapper] .one-col-feature ul {
              margin-left: 0!important;
            }
            [class*=wrapper] .one-col-feature ul li {
              list-style: none!important;
              background: transparent url(https://i2.createsend1.com/static/eb/master/09-onyx/images/bullet-large@2x.png) no-repeat top left !important;
              background-size: 20px!important;
              background-position: 0 9px!important;
              padding-left: 50px;
            }
          }
          @media (-webkit-min-device-pixel-ratio: 1.5) and (max-width: 620px), (min-resolution: 144dpi) and (max-width: 620px) {
            [class*=wrapper] .one-col ul {
              margin-left: 0!important;
              border: 0!important;
            }
            [class*=wrapper] .one-col .divider table,
            [class*=wrapper] .two-col .column .divider table,
            [class*=wrapper] .two-col .column-narrower .divider table,
            [class*=wrapper] .two-col .column-wider .divider table,
            [class*=wrapper] .three-col .divider table {
              background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/divider-waves@2x.png) !important;
            }
          }
          @media only screen and (max-width: 620px) {
            [class*=wrapper] .column table td table:nth-last-child(2) td h1:last-child,
            [class*=wrapper] .column-wider table td table:nth-last-child(2) td h1:last-child,
            [class*=wrapper] .column-narrower table td table:nth-last-child(2) td h1:last-child,
            [class*=wrapper] .column table td table:nth-last-child(2) td h2:last-child,
            [class*=wrapper] .column-wider table td table:nth-last-child(2) td h2:last-child,
            [class*=wrapper] .column-narrower table td table:nth-last-child(2) td h2:last-child,
            [class*=wrapper] .column table td table:nth-last-child(2) td h3:last-child,
            [class*=wrapper] .column-wider table td table:nth-last-child(2) td h3:last-child,
            [class*=wrapper] .column-narrower table td table:nth-last-child(2) td h3:last-child,
            [class*=wrapper] .column table td table:nth-last-child(2) td p:last-child,
            [class*=wrapper] .column-wider table td table:nth-last-child(2) td p:last-child,
            [class*=wrapper] .column-narrower table td table:nth-last-child(2) td p:last-child,
            [class*=wrapper] .column table td table:nth-last-child(2) td ol:last-child,
            [class*=wrapper] .column-wider table td table:nth-last-child(2) td ol:last-child,
            [class*=wrapper] .column-narrower table td table:nth-last-child(2) td ol:last-child,
            [class*=wrapper] .column table td table:nth-last-child(2) td ul:last-child,
            [class*=wrapper] .column-wider table td table:nth-last-child(2) td ul:last-child,
            [class*=wrapper] .column-narrower table td table:nth-last-child(2) td ul:last-child {
              Margin-bottom: 20px !important;
            }
            [class*=wrapper] *[class*=contents-accent] blockquote {
              background-size: 30px!important;
            }
            [class*=wrapper] *[class*=contents-accent] blockquote p,
            [class*=wrapper] *[class*=contents-accent] blockquote h1,
            [class*=wrapper] *[class*=contents-accent] blockquote h2,
            [class*=wrapper] *[class*=contents-accent] blockquote h3,
            [class*=wrapper] *[class*=contents-accent] blockquote ol,
            [class*=wrapper] *[class*=contents-accent] blockquote ul {
              padding-left: 38px!important;
            }
            [class*=wrapper] .contents-accent-blue blockquote {
              background-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/quote-mobile-blue@2x.png) !important;
            }
            [class*=wrapper] .contents-accent-aqua blockquote {
              background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/quote-mobile-aqua@2x.png) !important;
            }
            [class*=wrapper] .contents-accent-pink blockquote {
              background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/quote-pink@2x.png) !important;
            }
            [class*=wrapper] .contents-accent-orange blockquote {
              background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-mobile-orange@2x.png) !important;
            }
            [class*=wrapper] *[class*=contents-accent] ul li {
              padding-left: 38px!important;
            }
            [class*=wrapper] *[class*=contents-accent] ol li {
              padding-left: 18px!important;
            }
            [class*=wrapper] .spacer {
              display: none!important;
            }
            [class*=wrapper] .header .logo {
              padding: 40px 0!important;
              font-size: 24px !important;
              line-height: 1.3em !important;
              margin-bottom: 0 !important;
            }
            [class*=wrapper] .header .logo img {
              display: inline-block !important;
              max-width: 240px !important;
              height: auto!important;
            }
            [class*=wrapper] .header {
              width: 280px!important;
            }
            [class*=wrapper] .preheader-buffer {
              font-size: 10px !important;
              line-height: 10px !important;
            }
            [class*=wrapper] .preheader .webversion,
            [class*=wrapper] .header .logo a {
              text-align: center !important;
            }
            [class*=wrapper] *[class*=contents] blockquote p {
              font-size: 18px!important;
              line-height: 26px!important;
            }
            [class*=wrapper] *[class*=contents] h1 {
              font-size: 30px!important;
              line-height: 44px!important;
              margin-bottom: 16px!important;
            }
            [class*=wrapper] *[class*=contents] h2 {
              font-size: 20px!important;
              line-height: 28px!important;
              margin-bottom: 16px!important;
            }
            [class*=wrapper] *[class*=contents] h3 {
              font-size: 16px!important;
              line-height: 22px!important;
              margin-bottom: 12px!important;
            }
            [class*=wrapper] .column-wider,
            [class*=wrapper] .column-narrower {
              display: block;
              float: left;
              width: 280px !important;
            }
            [class*=wrapper] .one-col-feature {
              width: 280px !important;
            }
            [class*=wrapper] .one-col-feature li {
              font-size: 18px!important;
              line-height: 28px!important;
            }
            [class*=wrapper] .one-col-feature ol {
              margin-left: 22px!important;
            }
            [class*=wrapper] .one-col-feature ol li {
              padding-left: 18px!important;
            }
            [class*=wrapper] .one-col-feature ul li {
              background-size: 10px!important;
              padding-left: 40px!important;
            }
            [class*=wrapper] .one-col-feature blockquote p,
            [class*=wrapper] .one-col-feature blockquote h1,
            [class*=wrapper] .one-col-feature blockquote h2,
            [class*=wrapper] .one-col-feature blockquote h3,
            [class*=wrapper] .one-col-feature blockquote ol,
            [class*=wrapper] .one-col-feature blockquote ul {
              font-size: 26px!important;
              line-height: 40px!important;
            }
            [class*=wrapper] .btn a {
              padding: 15px 10px!important;
              width: 220px!important;
            }
            [class*=wrapper] .gutter {
              display: block!important;
              font-size: 10px;
              line-height: 10px;
              height: 10px!important;
            }
            [class*=wrapper] table.one-col,
            [class*=wrapper] table.one-col-feature,
            [class*=wrapper] td.last {
              margin-bottom: 10px!important;
            }
            [class*=wrapper] ol,
            [class*=wrapper] ul {
              margin-left: 20px !important;
            }
            [class*=wrapper] .footer *[class*="column"],
            [class*=wrapper] .preheader *[class*="column"] {
              display: block !important;
              text-align: center!important;
            }
            [class*=wrapper] .footer .title,
            [class*=wrapper] .preheader .title {
              display: none!important;
            }
            [class*=wrapper] .one-col .divider table,
            [class*=wrapper] .two-col .column .divider table,
            [class*=wrapper] .two-col .column-narrower .divider table,
            [class*=wrapper] .two-col .column-wider .divider table,
            [class*=wrapper] .three-col .divider table {
              background: transparent url(https://i7.createsend1.com/static/eb/master/09-onyx/images/divider-waves.png) repeat center center;
              background-size: auto 6px!important;
              width: 240px !important;
            }
            [class*=wrapper] .one-col .divider table img,
            [class*=wrapper] .two-col .column .divider table img,
            [class*=wrapper] .two-col .column-narrower .divider table img,
            [class*=wrapper] .two-col .column-wider .divider table img,
            [class*=wrapper] .three-col .divider table img {
              display: none!important;
            }
            [class*=wrapper] .footer .footer-container {
              width: 280px !important;
            }
            [class*=wrapper] .footer .column-social {
              padding-left: 0!important;
              padding-right: 0!important;
              width: 100% !important;
            }
            [class*=wrapper] .footer .column-details {
              width: 100% !important;
            }
            [class*=wrapper] .footer .social {
              width: 280px!important;
            }
            [class*=wrapper] .footer .social .social-text {
              padding: 0!important;
              text-align: center !important;
              width: auto !important;
            }
            [class*=wrapper] .footer .social-space {
              display: none !important;
            }
            [class*=wrapper] .footer .button {
              width: auto !important;
              margin: 0 auto 10px !important;
            }
            [class*=wrapper] .footer *[class*=column] {
              padding-top: 15px!important;
              padding-bottom: 10px!important;
            }
            [class*=wrapper] .footer *[class*=column] td {
              text-align: center!important;
            }
            [class*=wrapper] .footer *[class*=column] .padded {
              padding: 0!important;
            }
            [class*=wrapper] .footer *[class*=column] .social {
              width: 100%!important;
              margin-top: 15px!important;
            }
          }
          </style>
              <style type="text/css">
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
              <center class="wrapper" style="background-color: #1e1e1e;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%; text-align:center;">
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
                            <td class="logo" style="padding-top: 20px;padding-bottom: 40px;padding-left: 0;padding-right: 0;vertical-align: top;color: #ffffff;font-size: 36px;line-height: 42px;text-align: center;width: 600px;font-family: sans-serif" align="center" bgcolor="#000"><center><div id="emb-email-header"><a style="color: #ffffff;text-decoration: none" href="http://interhabita.com/"><img style="border-left-width: 0;border-top-width: 0;border-bottom-width: 0;border-right-width: 0;-ms-interpolation-mode: bicubic;display: block;max-width: 400px" src="http://interhabita.com/public/images/logo.png" alt="InterHabita" width="298" height="67" /></a></div></center></td>
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
                                <td class="column" style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;text-align: center">
                                  <table class="contents-grey" style="border-collapse: collapse;border-spacing: 0;width: 100%;background-color: #e6e7e8">
                                    <tbody><tr>
                                      <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
                                        <div><div class="column-top" style="font-size: 30px;line-height: 30px">&nbsp;</div></div>
                                          
                                          <table style="border-collapse: collapse;border-spacing: 0;width: 100%" width="100%">
                                            <tbody><tr>
                                              <td class="padded" style="padding-top: 0;padding-bottom: 0;padding-left: 40px;padding-right: 40px;vertical-align: top">
                      <!-- CONTENIDO HTML -->                         
                      
          						<p>Estimado(a): '.$this->input->post("nombre").', tu registro ha sido exitoso.<br>
          						¡Gracias por elegirnos!</p>
          <p>Da click <a href="interhabita.com" style="font-weight:bold;">aquí</a> para agregarnos a tus FAVORITOS,<br>porque estamos seguros que seremos tu página favorita para vender o rentar tus propiedades!</p>
          <p>Tus datos para entrar son:</p><p style="line-height:12px">Email: <strong>'.$this->input->post('correo').'</strong></p>
          <p>Y tu Clave es: <strong>'.$this->input->post('pass').'</strong></p> 
          <p>Y para que <span style="font-weight:bold; color:red">nos pruebes y conozcas</span>, te damos <span style="color:green; font-weight:bold">12 meses</span> de publicación <span style="font-weight:bold; color:red">ILIMITADA</span> de propiedades, totalmente <span style="font-weight:bold; color:red">¡¡GRATIS!!</span></p>
          <p>Solo da de alta tus propiedades antes de que termine la promoción…. ¡Y listo!</p>
          <p>Es muy fácil y rápido. Si quieres publicar en este momento, da click <a href="interhabita.com/anunciar" style="font-weight:bold;">aquí</a></p>
          <p>Te sugerimos hacerlo hoy mismo por que esta promoción vence en <span style="color:red">3</span> días.</p>

                    
                                              <!-- CONTENIDO HTML FIN--></td>
                                            </tr>
                                          </tbody></table>
                                        
                                          
                                          <table style="border-collapse: collapse;border-spacing: 0;width: 100%" width="100%">
                                            <tbody><tr>
                                              <td class="padded" style="padding-top: 0;padding-bottom: 0;padding-left: 40px;padding-right: 40px;vertical-align: top">
                                                
                      <div class="btn" style="Margin-bottom: 20px">
                        <a style="mso-hide: all;-webkit-font-smoothing: antialiased;padding-top: 15px;padding-bottom: 15px;font-weight: 500;display: inline-block;font-size: 16px;line-height: 20px;text-align: center;text-decoration: none;border-bottom-color: #cbced0;border-bottom-style: solid;border-bottom-width: 3px;color: #212a32;transition: background-color 0.2s;font-family: sans-serif;width: 480px;padding-left: 20px;padding-right: 20px;background-color: #ffffff" href="http://preview.createsend1.com/t/t-l-jyjrtjd-l-y/">Ir a InterHabita</a>
                     </div>
                    
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
                                    <td class="column" style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;text-align: center;color: #cccccc;font-size: 12px;line-height: 20px;font-family: sans-serif">
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
            
          </body></html>';

	  $mail->IsHTML(true);
		$mail->Body = $body;
		$mail->Send();

		//mando mensaje para activar el usuario

		echo "Tu registro fue exitoso ya puedes ingresar a Interhabita";

	}

	public function add_remove_boletin_anunciantes($idUser, $status){

		$array=array(
				"id_usuario"=>$idUser,
				"mensaje"=>"",
				"fecha_registro"=>date("Y-m-d h:i:sa"),
				"status"=>$status
			);
		
		$this->db->insert('boletin_anunciantes', $array);

	}

	public function get_user_por_id($idUser=null){

		$where=array("id_usuario"=>$idUser);
		
		$query=$this->db
		->select("id_usuario, nombre, apellidos, telefono, celular, login, pass, correo, avatar, id_usuarios_perfiles, id_estado")
		->from("usuarios")
		->where($where)
		->get();

		return $query->row();


	}

	public function get_user_por_id_propiedad($idPropiedad=null){

		$where=array("p.id_propiedad"=>$idPropiedad);
		
		$query=$this->db
		->select("u.id_usuario, u.nombre, p.id_categoria, u.correo")
		->from("usuarios u")
		->join("propiedades p","u.id_usuario=p.id_usuario","inner")
		->where($where)
		->get();

		return $query->row();


	}

	public function get_user_por_correo($correo=null){

		$where=array("correo"=>$correo);
		
		$query=$this->db
		->select("id_usuario, correo")
		->from("usuarios")
		->where($where)
		->get();

		return $query->row();


	}

	public function update_user(){

		$datos=array( "nombre"=>$_POST["nombre"],
			          "apellidos"=>$_POST["apellidos"],
			          "correo"=>$_POST["correo"],
			          "telefono"=>$_POST["telefono"],
			          "celular"=>$_POST["celular"],
			          "id_estado"=>$_POST["estado"]
			        );

		$this->db->where('id_usuario', $this->session->userdata('idUser'));
		$this->db->update('usuarios', $datos);

		echo "Tus datos se actualizaron correctamente";

	}

	public function update_user_pass(){

		$passSha1=sha1($_POST["passNuevo"]);
	
		$dato=array("pass"=>$passSha1);

		$this->db->where('id_usuario', $this->session->userdata('idUser'));
		$this->db->update('usuarios', $dato);

		echo "La Contrasñea se actualizo correctamente";

	}

	public function valida_pass_actual($passActual=null){

		$where=array("id_usuario"=>$this->session->userdata('idUser'));
		
		$query=$this->db
		->select("pass")
		->from("usuarios")
		->where($where)
		->get();

		$reg=$query->row();


		if($reg->pass == sha1($passActual)){

			return true;

		}
		else{

			return false;
		}
		

	}

	public function activar_usuario($nombreMd5, $nombreMd5Tabla, $idUser){

		//validamos que el login en md5 sea igual con  el de la tabla
		if($nombreMd5 == $nombreMd5Tabla){

			//activamos el usuario cambiando el valor de estatus a 1 en la tabla usuarios
			$datos=array("status"=>"1");
			$this->db->where('id_usuario', $idUser);
			$this->db->update('usuarios', $datos);

			$user=$this->get_user_por_id($idUser);

			//asignar una sesion de usuario y cambiar el menu de registro y login a mi cuenta y cerrar sesion
			$sesion_data = array('login' => $user->nombre,
	                             'idUser' => $user->id_usuario,
	                             'nivelUser'=>$user->id_usuarios_perfiles,
	                             'correo'=>$user->correo
	                            );

			$this->session->set_userdata($sesion_data);

			return "<b>Tu usuario se activo correctamente, ya puedes ingresar</b>";

		}

	}


	//metodo para login
	public function login(){

		$pass_sha1=sha1($_POST["pass"]);

		$where=array("correo"=>$_POST["login"],"pass"=>$pass_sha1);
		$query=$this->db
		->select("id_usuario, nombre, login, pass, correo, status, id_usuarios_perfiles")
		->from("usuarios")
		->where($where)
		->get();

		$row=$query->row();

		//si existe el usuario 
		if($query->num_rows() > 0){
			//si esta activado lo dejo iniciar si no mando mensaje de que no se a activado
			if($row->status == 0){
				echo "<b>Cuenta desactivada por el Administrador del Sitio</b>";
			}else{
				//asignar una sesion de usuario y cambiar el menu de registro y login a mi cuenta y cerrar sesion
				 $sesion_data = array('login' => $row->nombre,
	                                  'pass' => $pass_sha1,
	                                  'idUser' => $row->id_usuario,
	                                  'nivelUser'=>$row->id_usuarios_perfiles,
	                                  'correo'=>$row->correo
	                                 );

	             $this->session->set_userdata($sesion_data);
	                   
				echo "Success";
			}
		}
		else{
			echo "<b>Correo y/ó Password no Validos</b>";
		}
		
	}


	public function login_desde_email_anunciante($idUser){

		$user=$this->get_user_por_id($idUser);

		//asignar una sesion de usuario y cambiar el menu de registro y login a mi cuenta y cerrar sesion
		$sesion_data = array('login' => $user->nombre,
	                          'pass' => $user->pass,
	                          'idUser' => $user->id_usuario,
	                          'nivelUser'=>$user->id_usuarios_perfiles,
	                          'correo'=>$user->correo
	                         );

	    $this->session->set_userdata($sesion_data);



	}


	public function cerrar_sesion(){

		$this->session->sess_destroy();

		unset($_SESSION["carrito"]);

		header("Location:".base_url());
		
	}


	public function cerrar_sesion_carrito(){

		if(isset($_SESSION["carrito"])){

			unset($_SESSION["carrito"]);

		}else{

			echo "No existe la sesion";

		}
		
	}



	public function get_user_por_id_categoria_propiedad($idPropiedad=null){

		$where=array("p.id_propiedad"=>$idPropiedad);
		
		$query=$this->db
		->select("u.id_usuario, u.nombre, u.apellidos, u.telefono, u.login, u.pass, u.correo, p.nombre as propiedad, p.tipo_operacion, p.id_categoria")
		->from("usuarios u")
		->join("propiedades p","u.id_usuario=p.id_usuario","inner")
		->where($where)
		->get();

		return $query->row();
	}

	public function update_avatar_user($avatar=null){

		//primero validamos si el usuario cuenta con imagen
		$userDatos=$this->get_user_por_id($this->session->userdata('idUser'));
		if( $userDatos->avatar !="" ){
			//como si existe imagen de usuario eliminamos la existente de la carpeta de uploads/avatar
			unlink('./uploads/avatar/'.$userDatos->avatar);
		}

		$dato=array("avatar"=>$avatar);
		$this->db->where('id_usuario', $this->session->userdata('idUser'));
		$this->db->update('usuarios', $dato);

	}

	public function get_all_usuarios(){

		$query=$this->db
		->select("id_usuario, login, correo, pass, nombre")
		->from("usuarios")
    ->limit("139")
		->get();

		return $query->result();

	}

	

	public function valida_user_registro($usuario){

		$userDatos=$this->get_all_usuarios();

		foreach ($userDatos as $user) {
			if($user->login==$usuario){
				echo "El usuario ya existe en la base de datos, elige otro para tu Registro";
				exit;
			}
		}
	}

	public function valida_correo_registro($email){

		$userDatos=$this->get_all_usuarios();

		foreach ($userDatos as $user) {
			if($user->correo==$email){
				echo "El Correo ya existe en nuestra base de datos, elige otro para tu Registro";
				exit;
			}
		}
	}

	public function recupera_password_usuario($idUsuario, $correo){

		//mandar un email al usuario para restablecer su password
		$mail = new PHPMailer();
		$mail->From = "staff@interhabita.com";
		$mail->FromName = "Staff Interhabita";
		$mail->Subject = "Recuperación de Contraseña (Inmobiliaria Interhabita)";
		$mail->AddAddress($correo,'');

		$sha1Correo=sha1($correo);
		$sha1IdUsuario=sha1($idUsuario);

		//cuerpo del mensaje

		 $body='
		 <!DOCTYPE HTML><html><head><title>Recuperar Password</title><meta http-equiv="Content-Type" content="text/html"; charset="utf-8"><meta name="viewport" content="width=320, target-densitydpi=device-dpi">
			<style type="text/css">
			@media only screen and (max-width: 660px) { 
			table[class=w0], td[class=w0] { width: 0 !important; }
			table[class=w10], td[class=w10], img[class=w10] { width:10px !important; }
			table[class=w15], td[class=w15], img[class=w15] { width:5px !important; }
			table[class=w30], td[class=w30], img[class=w30] { width:10px !important; }
			table[class=w60], td[class=w60], img[class=w60] { width:10px !important; }
			table[class=w125], td[class=w125], img[class=w125] { width:80px !important; }
			table[class=w130], td[class=w130], img[class=w130] { width:55px !important; }
			table[class=w140], td[class=w140], img[class=w140] { width:90px !important; }
			table[class=w160], td[class=w160], img[class=w160] { width:180px !important; }
			table[class=w170], td[class=w170], img[class=w170] { width:100px !important; }
			table[class=w180], td[class=w180], img[class=w180] { width:80px !important; }
			table[class=w195], td[class=w195], img[class=w195] { width:80px !important; }
			table[class=w220], td[class=w220], img[class=w220] { width:80px !important; }
			table[class=w240], td[class=w240], img[class=w240] { width:180px !important; }
			table[class=w255], td[class=w255], img[class=w255] { width:185px !important; }
			table[class=w275], td[class=w275], img[class=w275] { width:135px !important; }
			table[class=w280], td[class=w280], img[class=w280] { width:135px !important; }
			table[class=w300], td[class=w300], img[class=w300] { width:140px !important; }
			table[class=w325], td[class=w325], img[class=w325] { width:95px !important; }
			table[class=w360], td[class=w360], img[class=w360] { width:140px !important; }
			table[class=w410], td[class=w410], img[class=w410] { width:180px !important; }
			table[class=w470], td[class=w470], img[class=w470] { width:200px !important; }
			table[class=w580], td[class=w580], img[class=w580] { width:280px !important; }
			table[class=w640], td[class=w640], img[class=w640] { width:300px !important; }
			table[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] { display:none !important; }
			table[class=h0], td[class=h0] { height: 0 !important; }
			p[class=footer-content-left] { text-align: center !important; }
			#headline p { font-size: 30px !important; }
			.article-content, #left-sidebar{ -webkit-text-size-adjust: 90% !important; -ms-text-size-adjust: 90% !important; }
			.header-content, .footer-content-left {-webkit-text-size-adjust: 80% !important; -ms-text-size-adjust: 80% !important;}
			img { height: auto; line-height: 100%;}
			 } 
			/* Client-specific Styles */
			#outlook a { padding: 0; }	/* Force Outlook to provide a "view in browser" button. */
			body { width: 100% !important; }
			.ReadMsgBody { width: 100%; }
			.ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */
			body { background-color: #c7c7c7; margin: 0; padding: 0; }
			img { outline: none; text-decoration: none; display: block;}
			br, strong br, b br, em br, i br { line-height:100%; }
			h1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }
			h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }
			h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {	color: red !important; }
			/* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
			h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }
			/* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  
			table td, table tr { border-collapse: collapse; }
			.yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
			color: black; text-decoration: none !important; border-bottom: none !important; background: none !important;
			}	/* Body text color for the New Yahoo.  This example sets the font of Yahoos Shortcuts to black. */
			/* This most probably wont work in all email clients. Dont include code blocks in email. */
			code {
			  white-space: normal;
			  word-break: break-all;
			}
			#background-table { background-color: #c7c7c7; }
			a {color:white;}
			/* Webkit Elements */
			#top-bar { border-radius:100px 0px 0px 0px; -moz-border-radius: 10px 0px 0px 0px; -webkit-border-radius:100px 0px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #000000; color: #888888; height:100px;}
			#footer { border-radius:0px 0px 100px 0px; -moz-border-radius: 0px 0px 100px 0px; -webkit-border-radius:0px 0px 100px 0px; -webkit-font-smoothing: antialiased; height:100px;}
			/* Fonts and Content */
			body, td { font-family: Helvetica, sans-serif; font-size: 14px;}
			.header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }
			/* Prevent Webkit and Windows Mobile platforms from changing default font sizes on header and footer. */
			#footer { background-color: #000000; color: #888888; }
			#footer a { color: #eeeeee; text-decoration: none; font-weight: bold; }
			.content {color:#888888}
			</style>
			<!--[if gte mso 9]>
			<style _tmplitem="241" >
			.article-content ol, .article-content ul {
			   margin: 0 0 0 24px;
			   padding: 0;
			   list-style-position: inside;
			}
			</style>
			<![endif]--></head><body><table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="table-layout:fixed" align="center">
				<tbody><tr>
					<td align="center" bgcolor="#c7c7c7">
			        	<table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">
			            	<tbody><tr><td class="w640" width="640" height="20"></td></tr>
			                
			            	<tr>
			                	<td class="w640" width="640">
			                        <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000">
			    <tbody><tr>
			        <td class="w15" width="15"></td>
			        <td class="w325" width="610" valign="middle" align="center">
						<div id="logo"><a href="http://interhabita.com/" title="">
							<img src="http://interhabita.com/public/images/logo.png" alt=""></a>
						</div>
			        </td>
			        <td class="w15" width="15"></td>
			    </tr>
			</tbody></table>
			                        
			                    </td>
			                </tr>
			                <tr>
			                
			                </tr>
			</tr>
			                <tr>
								<td class="content" width="640" height="15" bgcolor="#000000">
									<table>
										<tr height="25px"></tr><tr>
											<td width="600" align="center" >
												Para poder restablecer tu Password debes ingresar al siguiente enlace y llenar los datos que se te indica:<br>
					     <a href="http://interhabita.com/index/restablecer_password/'.$sha1IdUsuario.'/'.$sha1Correo.'">Restablecer Password</a>
											</td>
										</tr>
										<tr height="25px"></tr></table>
								</td>
							</tr>
			                <tr>
			                <td class="w640" width="640">
			    <table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000">
			        <tbody>
			        <tr>
			            <td class="w30" width="30"></td>
			            <td class="w580" width="580" valign="top" align="center">
							<p>Interhabita staff</br>
							OF. (0155) 96880854</br>
							<a href="mailto:staff@interhabita.com">staff@interhabita.com</a></br>
							<a href="http://www.interhabita.com">www.interhabita.com</a></p>
			            <td class="w30" width="30"></td>
			        </tr>
					<tr>
			            <td class="w30" width="30" height="25"></td>
			            <td class="w580" width="580" valign="top" align="center">
			            <td class="w30" width="30"></td>
			        </tr>
			    </tbody></table>
			</td>
			                </tr>
			                <tr><td class="w640" width="640" height="60"></td></tr>
			            </tbody></table>
			        </td>
				</tr>
			</tbody></table></br></body></html>
		';

	  	$mail->IsHTML(true);
		$mail->Body = $body;
		$mail->Send();

		echo "Ingresa a tu Cuenta de Correo para Restablecer tu Password";

	}

	public function actualiza_password(){


		//validar que los campos no vengan vacios
		if($_POST["passNuevo"]==""){

			echo "<b>Ingresa tu Contraseña Nueva</b>";

			exit;

		}else
			if($_POST["passNuevoConfirm"]==""){

				echo "<b>Ingresa la Confirmación de tu Contraseña Nueva</b>";

				exit;

		}

		//validar que los passwords nuevos coincidan
		if($_POST["passNuevo"] != $_POST["passNuevoConfirm"]){

			echo "<b>Las Contraseñas no Coinciden, tienen que ser iguales revisalas</b>";

			exit;

		}

		//validar que la longitud del password sea minimo 6 caracteres
		if(strlen($_POST["passNuevo"]) < 6){

			echo "<b>La Nueva Contraseña debe tener 6 caracteres mínimo</b>";

			exit;

		}

		//comparar el id que traigo en sha1 con los idś de la base de datos hasta que coincida
		$users=$this->get_all_usuarios();
		foreach ($users as $user) {
			if(sha1($user->id_usuario) == $_POST["sha1IdUsuario"]){
				$id_usuario=$user->id_usuario;
			}
		}

		$passSha1=sha1($_POST["passNuevo"]);

		$dato=array("pass"=>$passSha1);

		$this->db->where('id_usuario', $id_usuario);
		$this->db->update('usuarios', $dato);

		echo "Success";

	}


	public function get_anunciantes_tipo(){
		
		$query=$this->db
		->select("id_anunciantes_tipo, tipo_anunciante")
		->from("anunciantes_tipo")
		->get();

		return $query->result();

	}

	public function get_anunciantes_tipo_por_id($idAnunciantesTipo){
		
		$query=$this->db
		->select("id_anunciantes_tipo, tipo_anunciante")
		->from("anunciantes_tipo")
		->where("id_anunciantes_tipo",$idAnunciantesTipo)
		->get();

		return $query->row();

	}

	public function add_empresa_anunciante($idTipoAnunciante, $empresa, $lastInsertId){

		$array=array(
				"id_anunciantes_tipo"=>$idTipoAnunciante,
				"nombre_empresa"=>$empresa,
				"id_usuario"=>$lastInsertId
			);
		//se inserta el registro en la tabla usuarios
		$this->db->insert('empresa_anunciantes_tipo', $array);

	}

	public function get_empresa_anunciante_por_id_usuario($idUsuario){

		$query=$this->db
		->select("id, id_anunciantes_tipo, nombre_empresa, direccion")
		->from("empresa_anunciantes_tipo")
		->where("id_usuario",$idUsuario)
		->get();

		return $query->row();

	}

	public function update_empresa_anunciante(){

		$dato=array("nombre_empresa"=>$_POST["empresa"],
			        "direccion"=>$_POST["direccionEmpresa"]
			       );
		$this->db->where('id_usuario', $this->session->userdata('idUser'));
		$this->db->update('empresa_anunciantes_tipo', $dato);

	}

	public function eliminar_anunciante($idUser){

		//eliminamos avatar del anunciante si existe
		$avatar=$this->get_user_por_id($idUser);
		if($avatar->avatar!=""){
			//eliminamos su avatar
			unlink("uploads/avatar/".$avatar->avatar);
		}

		$this->db->delete("usuarios", array("id_usuario"=>$idUser));

	}


}//end class

