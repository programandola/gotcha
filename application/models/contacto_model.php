<?php
class Contacto_model Extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		
	}

	public function envia_mensaje_email_anunciante_y_admin($datosUserAnunciante, $datosSolicitante){

		//mandar correo al anunciante de la propiedad y al administrador del sitio
		$fecha_envio=date("d-m-Y");
		$hora_envio=date("H:m:s");
		//para obtener el tipo de propiedad del anunciante
		$tipoPropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($datosUserAnunciante->id_categoria);

		//Primero enviamos email al anunciante para venderle la info del cliente
		$mail = new PHPMailer();
		$mail->From = "staff@interhabita.com";
		$mail->FromName = "Staff Interhabita";
		$mail->Subject = " Inmobiliaria Interhabita - Solicitante Interesado en tu Propiedad";
		$mail->AddAddress($datosUserAnunciante->correo, $datosUserAnunciante->nombre);


		$body='
				<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>
			    <title></title>
			    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			    <style type="text/css">
			@import url(https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic,500italic,700italic); body {margin: 0; padding: 0; min-width: 100%; } table {border-collapse: collapse; border-spacing: 0; } td {padding: 0; vertical-align: top; } .spacer, .border {font-size: 1px; line-height: 1px; } img {
			  border: 0;
			  -ms-interpolation-mode: bicubic;
			}
			.image {font-size: 0; Margin-bottom: 20px; } .image img {display: block; } .logo img {display: block; } strong {font-weight: bold; } h1, h2, h3, p, ol, ul, li {Margin-top: 0; } ol, ul, li {padding-left: 0; } .btn a {mso-hide: all; } blockquote {Margin-top: 0; Margin-right: 0; Margin-bottom: 0; padding-right: 0; } .column-top {font-size: 30px;line-height: 30px;}
			.column-bottom {font-size: 10px; line-height: 10px; } .column {text-align: left; } .contents {width: 100%; } .padded {padding-left: 40px; padding-right: 40px; } .wrapper {background-color: #1e1e1e; width: 100%; min-width: 620px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table.wrapper {table-layout: fixed; } .one-col, .two-col, .three-col {Margin-left: auto; Margin-right: auto; width: 600px; } .one-col p, .one-col ol, .one-col ul {Margin-bottom: 20px; } .two-col p, .two-col ol, .two-col ul {Margin-bottom: 20px; } .two-col .image {Margin-bottom: 20px; } .two-col .column-top {font-size: 40px; line-height: 40px; } .two-col .column-bottom {font-size: 20px; line-height: 20px; } .two-col .column {width: 290px; } .two-col .gutter {width: 20px; font-size: 1px; line-height: 1px; } .three-col p, .three-col ol, .three-col ul {Margin-bottom: 20px; } .three-col .image {Margin-bottom: 20px; } .three-col .column-top {font-size: 20px; line-height: 20px; } .three-col .column-bottom {font-size: 0px; line-height: 0px; } .three-col .column, .two-col .column-narrower {width: 190px; } .three-col .gutter {width: 15px; font-size: 1px; line-height: 1px; } .three-col .padded {padding-left: 20px; padding-right: 20px; } .wider {width: 390px; } .narrower {width: 190px; } 
			 
			 @media only screen and (max-width: 620px) {[class*=wrapper] {min-width: 280px !important; width: 100%!important; } [class*=wrapper] .one-col, [class*=wrapper] .two-col, [class*=wrapper] .three-col {width: 280px !important; } [class*=wrapper] .column {display: block; float: left; width: 280px !important; } [class*=wrapper] .padded {padding-left: 20px !important; padding-right: 20px !important; } [class*=wrapper] .full {display: none; } [class*=wrapper] .block {display: block !important; } [class*=wrapper] .hide {display: none !important; } [class*=wrapper] .image {margin-bottom: 20px !important; } [class*=wrapper] .image img {height: auto !important; width: 100% !important; } } h1, h2, h3 {font-weight: normal; } p, ol, ul {font-weight: 400; } table.wrapper {background-color: #1e1e1e; } .column table, .padded table {width: 100%; } .preheader {width: 100%; background-color: #191919; } .preheader .title, .preheader .webversion {color: #e6e6e6; font-size: 11px; line-height: 16px; } .preheader .title {padding: 9px; text-align: left; } .preheader .webversion {padding: 9px; text-align: right; width: 250px; } .preheader .webversion a {font-weight: bold; color: #e6e6e6; text-decoration: none; } .preheader .preheader-buffer {font-size: 20px; line-height: 20px; background-color: #1e1e1e; } .logo {color: #ffffff; font-size: 36px; line-height: 42px; padding-top: 20px; padding-bottom: 40px; text-align: center; width: 520px; } .logo a {color: #ffffff; text-decoration: none; } ul li {list-style-type: disc; list-style-position: outside; } p, ol, ul {-webkit-font-smoothing: antialiased; } .wrapper {background-color: #1e1e1e; } .wrapper .btn a {transition: background-color 0.2s; } .wrapper h1, .wrapper h2, .wrapper h3, .wrapper p, .wrapper ol, .wrapper ul, .wrapper blockquote p, .wrapper .logo, .wrapper .btn a, .wrapper .footer div, .wrapper .footer td, .wrapper .preheader .title, .wrapper .preheader .webversion {font-family: sans-serif; } @media screen and (min-width: 0) {.wrapper h1, .wrapper h2, .wrapper h3, .wrapper p, .wrapper ol, .wrapper ul, .wrapper blockquote p, .wrapper .logo, .wrapper .btn a, .wrapper .footer div, .wrapper .footer td, .wrapper .preheader .title, .wrapper .preheader .webversion {font-family: Ubuntu, sans-serif !important; } } h1 a, h2 a, h3 a {text-decoration: none; } .one-col, .two-col, .three-col, .preheader, .header, .footer {Margin-left: auto; Margin-right: auto; } .one-col .padded, .two-col .padded, .three-col .padded, .preheader .padded, .header .padded, .footer .padded {text-align: left; } .one-col blockquote, .two-col blockquote, .three-col blockquote, .preheader blockquote, .header blockquote, .footer blockquote {Margin-left: 0; background-repeat: no-repeat; background-position: 0px 4px; } .one-col blockquote p, .two-col blockquote p, .three-col blockquote p, .preheader blockquote p, .header blockquote p, .footer blockquote p {font-style: italic; } .column table td table:nth-last-child(2) td h1:last-child,
			.column-wider table td table:nth-last-child(2) td h1:last-child, .column-narrower table td table:nth-last-child(2) td h1:last-child, .column table td table:nth-last-child(2) td h2:last-child, .column-wider table td table:nth-last-child(2) td h2:last-child, .column-narrower table td table:nth-last-child(2) td h2:last-child, .column table td table:nth-last-child(2) td h3:last-child, .column-wider table td table:nth-last-child(2) td h3:last-child, .column-narrower table td table:nth-last-child(2) td h3:last-child, .column table td table:nth-last-child(2) td p:last-child, .column-wider table td table:nth-last-child(2) td p:last-child, .column-narrower table td table:nth-last-child(2) td p:last-child, .column table td table:nth-last-child(2) td ol:last-child, .column-wider table td table:nth-last-child(2) td ol:last-child, .column-narrower table td table:nth-last-child(2) td ol:last-child, .column table td table:nth-last-child(2) td ul:last-child, .column-wider table td table:nth-last-child(2) td ul:last-child, .column-narrower table td table:nth-last-child(2) td ul:last-child {Margin-bottom: 20px; } .btn {
			  Margin-bottom: 20px;
			}
			.btn a {-webkit-font-smoothing: antialiased; padding-top: 15px; padding-bottom: 15px; font-weight: 500; display: inline-block; font-size: 16px; line-height: 20px; text-align: center; text-decoration: none; border-bottom: 3px solid #1e1e1e; } .one-col .btn a, .one-col-feature .btn a {width: 480px; padding-left: 20px; padding-right: 20px; } .two-col .column .btn a {width: 170px; padding-left: 20px; padding-right: 20px; } .two-col .column-narrower .btn a {width: 130px; padding-left: 10px; padding-right: 10px; } .two-col .column-wider .btn a {width: 270px; padding-left: 20px; padding-right: 20px; } .three-col .btn a {width: 130px; padding-left: 10px; padding-right: 10px; } .divider table {font-size: 0; height: 6px; line-height: 6px; Margin-bottom: 20px; } .one-col .padded ul li {padding-left: 13px; } .one-col h1 {font-size: 30px; line-height: 44px; Margin-bottom: 16px; } .one-col h2 {font-size: 20px; line-height: 28px; Margin-bottom: 14px; } .one-col h3 {font-size: 16px; line-height: 22px; Margin-bottom: 12px; } .one-col p, .one-col ol, .one-col ul {font-size: 14px; line-height: 22px; Margin-bottom: 20px; } .one-col ol, .one-col ul {Margin-left: 48px; } .one-col ol li, .one-col ul li {Margin-bottom: 10px; padding-left: 13px; } .one-col blockquote p {font-size: 18px; line-height: 26px; } .one-col blockquote p, .one-col blockquote h1, .one-col blockquote h2, .one-col blockquote h3, .one-col blockquote ol, .one-col blockquote ul {padding-left: 60px; } .one-col-feature {width: 600px; Margin-left: auto; Margin-right: auto; } .one-col-feature h1, .one-col-feature h2, .one-col-feature h3, .one-col-feature p, .one-col-feature ol, .one-col-feature ul, .one-col-feature a {color: #212a32; } .one-col-feature h1 a, .one-col-feature h2 a, .one-col-feature h3 a, .one-col-feature p a, .one-col-feature li a {text-decoration: none; font-weight: normal; } .one-col-feature h1 {font-size: 30px; line-height: 46px; Margin-bottom: 20px; } .one-col-feature h2 {font-size: 24px; line-height: 40px; Margin-bottom: 16px; } .one-col-feature h3 {font-size: 20px; line-height: 30px; Margin-bottom: 14px; } .one-col-feature p {font-size: 18px; line-height: 30px; Margin-bottom: 20px; } .one-col-feature ol {Margin-left: 36px; } .one-col-feature ol li {padding-left: 15px; } .one-col-feature ul {Margin-left: 30px; } .one-col-feature ul li {padding-left: 20px; list-style-image: url(https://i3.createsend1.com/static/eb/master/09-onyx/images/bullet-large.png); line-height: 40px; } .one-col-feature ol, .one-col-feature ul {font-size: 26px; line-height: 40px; } .one-col-feature li {Margin-bottom: 0; } .one-col-feature h1, .one-col-feature h2, .one-col-feature h3, .one-col-feature p {text-align: center; } .one-col-feature blockquote {Margin: 0; background-repeat: no-repeat; background-position: 100% 100%; } .one-col-feature blockquote p:first-child, .one-col-feature blockquote h1:first-child, .one-col-feature blockquote h2:first-child, .one-col-feature blockquote h3:first-child, .one-col-feature blockquote ol:first-child, .one-col-feature blockquote ul:first-child {padding-top: 27px; } .one-col-feature blockquote p, .one-col-feature blockquote h1, .one-col-feature blockquote h2, .one-col-feature blockquote h3, .one-col-feature blockquote ol, .one-col-feature blockquote ul {background-repeat: no-repeat; background-position: 0% 0%; font-size: 26px; line-height: 40px; padding: 0; font-style: italic; } .one-col-feature blockquote p:last-child, .one-col-feature blockquote h1:last-child, .one-col-feature blockquote h2:last-child, .one-col-feature blockquote h3:last-child, .one-col-feature blockquote ol:last-child, .one-col-feature blockquote ul:last-child {padding-bottom: 30px; Margin-bottom: 20px; } .one-col-feature .divider {Margin-bottom: 20px; } .one-col-feature .divider img {display: block; Margin-left: auto; Margin-right: auto; } .one-col-feature .btn a {background-color: #ffffff; color: #212a32;}
			.two-col h1 {font-size: 30px; line-height: 44px; Margin-bottom: 16px; } .two-col h2 {font-size: 20px; line-height: 28px; Margin-bottom: 14px; } .two-col h3 {font-size: 16px; line-height: 22px; Margin-bottom: 12px; } .two-col p, .two-col ol, .two-col ul {font-size: 14px; line-height: 22px; Margin-bottom: 20px; } .two-col ol, .two-col ul {Margin-left: 18px; } .two-col li {Margin-bottom: 10px; padding-left: 20px; } .two-col .btn a {font-size: 16px; line-height: 20px; } .two-col blockquote p, .two-col blockquote h1, .two-col blockquote h2, .two-col blockquote h3, .two-col blockquote ol, .two-col blockquote ul {padding-left: 38px; } .two-col .column-wider {width: 390px; } .two-col .column-narrower {width: 190px; } .three-col .column .padded, .two-col .column-narrower .padded {padding-left: 20px; padding-right: 20px; } .three-col .column h1, .two-col .column-narrower h1 {font-size: 20px; line-height: 28px; Margin-bottom: 14px; } .three-col .column h2, .two-col .column-narrower h2 {font-size: 16px; line-height: 22px; Margin-bottom: 12px; } .three-col .column h3, .two-col .column-narrower h3 {font-size: 14px; line-height: 20px; Margin-bottom: 8px; } .three-col .column p, .three-col .column ol, .three-col .column ul, .two-col .column-narrower p, .two-col .column-narrower ol, .two-col .column-narrower ul {font-size: 14px; line-height: 22px; Margin-bottom: 20px; } .three-col .column ol, .three-col .column ul, .two-col .column-narrower ol, .two-col .column-narrower ul {Margin-left: 18px; } .three-col .column ol li, .three-col .column ul li, .two-col .column-narrower ol li, .two-col .column-narrower ul li {Margin-bottom: 10px; padding-left: 10px; } .three-col .column .btn a, .two-col .column-narrower .btn a {padding-top: 10px; padding-bottom: 10px; } .three-col .column blockquote p, .three-col .column blockquote h1, .three-col .column blockquote h2, .three-col .column blockquote h3, .three-col .column blockquote ol, .three-col .column blockquote ul, .two-col .column-narrower blockquote p, .two-col .column-narrower blockquote h1, .two-col .column-narrower blockquote h2, .two-col .column-narrower blockquote h3, .two-col .column-narrower blockquote ol, .two-col .column-narrower blockquote ul {padding-left: 28px; } .contents-green {background-color: #27da90; } .contents-green h1 a, .contents-green h2 a, .contents-green h3 a, .contents-green p a, .contents-green li a {border-bottom: 1px solid #212a32; } .contents-green .btn a {border-bottom-color: #1eb074; } .contents-green blockquote {background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark-green.png); } .contents-green blockquote p:first-child, .contents-green blockquote h1:first-child, .contents-green blockquote h2:first-child, .contents-green blockquote h3:first-child, .contents-green blockquote ol:first-child, .contents-green blockquote ul:first-child {background-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark-green.png); } .contents-orange {background-color: #ed5a32; } .contents-orange h1 a, .contents-orange h2 a, .contents-orange h3 a, .contents-orange p a, .contents-orange li a {border-bottom: 1px solid #212a32; } .contents-orange .btn a {border-bottom-color: #d93d13; } .contents-orange blockquote {background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark-orange.png); } .contents-orange blockquote p:first-child, .contents-orange blockquote h1:first-child, .contents-orange blockquote h2:first-child, .contents-orange blockquote h3:first-child, .contents-orange blockquote ol:first-child, .contents-orange blockquote ul:first-child {background-image: url(https://i7.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark-orange.png); } .contents-grey {background-color: #e6e7e8; } .contents-grey h1 a, .contents-grey h2 a, .contents-grey h3 a, .contents-grey p a, .contents-grey li a {border-bottom: 1px solid #212a32; } .contents-grey .btn a {border-bottom-color: #cbced0; } .contents-grey blockquote {background-image: url(https://i9.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark-grey.png); } .contents-grey blockquote p:first-child, .contents-grey blockquote h1:first-child, .contents-grey blockquote h2:first-child, .contents-grey blockquote h3:first-child, .contents-grey blockquote ol:first-child, .contents-grey blockquote ul:first-child {background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark-grey.png); } .contents-green .btn a:hover, .contents-orange .btn a:hover, .contents-grey .btn a:hover {background-image: none!important; background-color: #f1f2f2!important; } .contents {background-color: #212a32; } .contents p, .contents ol, .contents ul {color: #ffffff; } .contents-accent-blue .btn a, .contents-accent-pink .btn a, .contents-accent-orange .btn a, .contents-accent-aqua .btn a {background-repeat: repeat-x; color: #ffffff; } .contents-accent-blue .btn a:hover, .contents-accent-pink .btn a:hover, .contents-accent-orange .btn a:hover, .contents-accent-aqua .btn a:hover {background-image: none!important; } .contents-accent-blue {width: 100%; background-color: #212a32; } .contents-accent-blue p, .contents-accent-blue ol, .contents-accent-blue ul {color: #ffffff; } .contents-accent-blue h1, .contents-accent-blue h2, .contents-accent-blue h3, .contents-accent-blue h1 a, .contents-accent-blue h2 a, .contents-accent-blue h3 a, .contents-accent-blue a {color: #3d88fd; } .contents-accent-blue h1 a, .contents-accent-blue h2 a, .contents-accent-blue h3 a {border-bottom: 1px solid #3d88fd; } .contents-accent-blue ul li {list-style-image: url(https://i10.createsend1.com/static/eb/master/09-onyx/images/bullet-blue.png); } .contents-accent-blue .btn a {background-color: #367ffd; background-image: url(https://i1.createsend1.com/static/eb/master/09-onyx/images/btn-blue.png); } .contents-accent-blue .btn a:hover {background-color: #1d64d2!important; } .contents-accent-blue blockquote {
			  background-image: url(https://i3.createsend1.com/static/eb/master/09-onyx/images/quote-blue.png);
			}
			.contents-accent-aqua {width: 100%; background-color: #212a32; } .contents-accent-aqua p, .contents-accent-aqua ol, .contents-accent-aqua ul {color: #ffffff; } .contents-accent-aqua h1, .contents-accent-aqua h2, .contents-accent-aqua h3, .contents-accent-aqua h1 a, .contents-accent-aqua h2 a, .contents-accent-aqua h3 a, .contents-accent-aqua a {color: #00b5d6; } .contents-accent-aqua h1 a, .contents-accent-aqua h2 a, .contents-accent-aqua h3 a {border-bottom: 1px solid #00b5d6; } .contents-accent-aqua ul li {list-style-image: url(https://i2.createsend1.com/static/eb/master/09-onyx/images/bullet-aqua.png); } .contents-accent-aqua .btn a {background-color: #00add1; background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/btn-aqua.png); } .contents-accent-aqua .btn a:hover {background-color: #0092ad!important; } .contents-accent-aqua blockquote {background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-aqua.png); } .column-narrower .contents-accent-aqua .padded blockquote {background-image: url(https://i7.createsend1.com/static/eb/master/09-onyx/images/quote-aqua-single.png); } .column-narrower .contents-accent-aqua .padded blockquote p, .column-narrower .contents-accent-aqua .padded blockquote h1, .column-narrower .contents-accent-aqua .padded blockquote h2, .column-narrower .contents-accent-aqua .padded blockquote h3 {padding-left: 28px; } .contents-accent-pink {width: 100%; background-color: #212a32; } .contents-accent-pink p, .contents-accent-pink ol, .contents-accent-pink ul {color: #ffffff; } .contents-accent-pink h1, .contents-accent-pink h2, .contents-accent-pink h3, .contents-accent-pink h1 a, .contents-accent-pink h2 a, .contents-accent-pink h3 a, .contents-accent-pink a {color: #f63366; } .contents-accent-pink h1 a, .contents-accent-pink h2 a, .contents-accent-pink h3 a {border-bottom: 1px solid #f63366; } .contents-accent-pink ul li {list-style-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/bullet-pink.png); } .contents-accent-pink .btn a {background-color: #f52d5d; background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/btn-pink.png); } .contents-accent-pink .btn a:hover {background-color: #c93057!important; } .contents-accent-pink blockquote {background-image: url(https://i9.createsend1.com/static/eb/master/09-onyx/images/quote-pink.png); } .contents-accent-orange {width: 100%; background-color: #212a32; } .contents-accent-orange p, .contents-accent-orange ol, .contents-accent-orange ul {color: #ffffff; } .contents-accent-orange h1, .contents-accent-orange h2, .contents-accent-orange h3, .contents-accent-orange h1 a, .contents-accent-orange h2 a, .contents-accent-orange h3 a, .contents-accent-orange a {color: #ff9e05; } .contents-accent-orange h1 a, .contents-accent-orange h2 a, .contents-accent-orange h3 a {border-bottom: 1px solid #ff9e05; } .contents-accent-orange ul li {list-style-image: url(https://i1.createsend1.com/static/eb/master/09-onyx/images/bullet-orange.png); } .contents-accent-orange .btn a {background-color: #ff9306; background-image: url(https://i3.createsend1.com/static/eb/master/09-onyx/images/btn-orange.png); } .contents-accent-orange .btn a:hover {background-color: #ff8a00!important; } .contents-accent-orange blockquote {background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-orange.png); } .footer {width: 100%; background-color: #191919; } .footer .padded {padding-left: 20px; padding-right: 20px; } .footer td {color: #cccccc; font-size: 12px; line-height: 20px; } .footer .contents {background-color: #191919; } .footer .footer-container .column-details {padding: 40px 0 75px 0; } .footer .footer-container .column-details td {text-align: left; } .footer .footer-container .column-social {width: 140px; padding: 42px 0 75px 20px; } .footer .footer-container .column-social td {text-align: left; } .footer .social {width: 170px; } .footer .social a {text-decoration: none; } .footer .social .social-icon {width: 39px; } .footer .social .social-text {width: 131px; text-transform: uppercase; letter-spacing: 0.15em; font-size: 10px; line-height: 12px; vertical-align: middle; color: #cccccc; } .footer .social .social-text a {color: #cccccc; } .footer .social-space {font-size: 10px; line-height: 10px; display: block; width: 100%; } .footer .prefs a {color: #cccccc; } .footer .address, .footer .permission {display: block; } .footer .address a, .footer .permission a {color: #cccccc; text-decoration: underline; } .footer .address {Margin-bottom: 17px; } @media (min-width: 0) {body {background-color: #191919; } } @media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi) {.one-col ul {border-left: 30px solid #212a32; } } @media (-webkit-min-device-pixel-ratio: 1.5) and (min-width: 620px), (min-resolution: 144dpi) and (min-width: 620px) {.contents-accent-blue blockquote {background-size: 40px!important; background-image: url(https://i10.createsend1.com/static/eb/master/09-onyx/images/quote-blue@2x.png) !important; } .contents-accent-aqua blockquote {background-size: 30px!important; background-image: url(https://i2.createsend1.com/static/eb/master/09-onyx/images/quote-aqua@2x.png) !important; } .column-narrower .contents-accent-aqua blockquote {background-position: -15px 6px !important; } .contents-accent-pink blockquote {background-size: 30px!important; background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/quote-pink@2x.png) !important; } .contents-accent-orange blockquote {background-size: 10px!important; background-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/quote-orange@2x.png) !important; } *[class*=contents-accent] ul li {padding-left: 30px!important; } } @media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi), (max-width: 620px) {[class*=wrapper] .one-col-feature blockquote {background-size: 30px!important; background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/quote-bottom-dark@2x.png) !important; background-position: 50% 100%!important; } [class*=wrapper] .one-col-feature blockquote p:first-child, [class*=wrapper] .one-col-feature blockquote h1:first-child, [class*=wrapper] .one-col-feature blockquote h2:first-child, [class*=wrapper] .one-col-feature blockquote h3:first-child, [class*=wrapper] .one-col-feature blockquote ol:first-child, [class*=wrapper] .one-col-feature blockquote ul:first-child {background-size: 30px!important; background-image: url(https://i10.createsend1.com/static/eb/master/09-onyx/images/quote-top-dark@2x.png) !important; background-position: 50% 0%!important; } [class*=wrapper] .contents-accent-blue ul li {background: transparent url(https://i7.createsend1.com/static/eb/master/09-onyx/images/bullet-blue@2x.png) no-repeat top left !important; } [class*=wrapper] .contents-accent-aqua ul li {background: transparent url(https://i9.createsend1.com/static/eb/master/09-onyx/images/bullet-aqua@2x.png) no-repeat top left !important; } [class*=wrapper] .contents-accent-pink ul li {background: transparent url(https://i1.createsend1.com/static/eb/master/09-onyx/images/bullet-pink@2x.png) no-repeat top left !important; } [class*=wrapper] .contents-accent-orange ul li {background: transparent url(https://i3.createsend1.com/static/eb/master/09-onyx/images/bullet-orange@2x.png) no-repeat top left !important; } [class*=wrapper] *[class*=contents-accent] ul {margin-left: 0px!important; } [class*=wrapper] *[class*=contents-accent] ul li {list-style-type: none!important; list-style-image: none!important; background-size: 10px 10px!important; background-position: 0 5px!important; } [class*=wrapper] .one-col-feature ul {margin-left: 0!important; } [class*=wrapper] .one-col-feature ul li {list-style: none!important; background: transparent url(https://i2.createsend1.com/static/eb/master/09-onyx/images/bullet-large@2x.png) no-repeat top left !important; background-size: 20px!important; background-position: 0 9px!important; padding-left: 50px; } } @media (-webkit-min-device-pixel-ratio: 1.5) and (max-width: 620px), (min-resolution: 144dpi) and (max-width: 620px) {[class*=wrapper] .one-col ul {margin-left: 0!important; border: 0!important; } [class*=wrapper] .one-col .divider table, [class*=wrapper] .two-col .column .divider table, [class*=wrapper] .two-col .column-narrower .divider table, [class*=wrapper] .two-col .column-wider .divider table, [class*=wrapper] .three-col .divider table {background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/divider-waves@2x.png) !important; } } @media only screen and (max-width: 620px) {[class*=wrapper] .column table td table:nth-last-child(2) td h1:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td h1:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td h1:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td h2:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td h2:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td h2:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td h3:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td h3:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td h3:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td p:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td p:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td p:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td ol:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td ol:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td ol:last-child, [class*=wrapper] .column table td table:nth-last-child(2) td ul:last-child, [class*=wrapper] .column-wider table td table:nth-last-child(2) td ul:last-child, [class*=wrapper] .column-narrower table td table:nth-last-child(2) td ul:last-child {Margin-bottom: 20px !important; } [class*=wrapper] *[class*=contents-accent] blockquote {background-size: 30px!important; } [class*=wrapper] *[class*=contents-accent] blockquote p, [class*=wrapper] *[class*=contents-accent] blockquote h1, [class*=wrapper] *[class*=contents-accent] blockquote h2, [class*=wrapper] *[class*=contents-accent] blockquote h3, [class*=wrapper] *[class*=contents-accent] blockquote ol, [class*=wrapper] *[class*=contents-accent] blockquote ul {padding-left: 38px!important; } [class*=wrapper] .contents-accent-blue blockquote {background-image: url(https://i6.createsend1.com/static/eb/master/09-onyx/images/quote-mobile-blue@2x.png) !important; } [class*=wrapper] .contents-accent-aqua blockquote {background-image: url(https://i8.createsend1.com/static/eb/master/09-onyx/images/quote-mobile-aqua@2x.png) !important; } [class*=wrapper] .contents-accent-pink blockquote {background-image: url(https://i4.createsend1.com/static/eb/master/09-onyx/images/quote-pink@2x.png) !important; } [class*=wrapper] .contents-accent-orange blockquote {background-image: url(https://i5.createsend1.com/static/eb/master/09-onyx/images/quote-mobile-orange@2x.png) !important; } [class*=wrapper] *[class*=contents-accent] ul li {padding-left: 38px!important; } [class*=wrapper] *[class*=contents-accent] ol li {padding-left: 18px!important; } [class*=wrapper] .spacer {display: none!important; } [class*=wrapper] .header .logo {padding: 40px 0!important; font-size: 24px !important; line-height: 1.3em !important; margin-bottom: 0 !important; } [class*=wrapper] .header .logo img {display: inline-block !important; max-width: 240px !important; height: auto!important; } [class*=wrapper] .header {width: 280px!important; } [class*=wrapper] .preheader-buffer {font-size: 10px !important; line-height: 10px !important; } [class*=wrapper] .preheader .webversion, [class*=wrapper] .header .logo a {text-align: center !important; } [class*=wrapper] *[class*=contents] blockquote p {font-size: 18px!important; line-height: 26px!important; } [class*=wrapper] *[class*=contents] h1 {font-size: 30px!important; line-height: 44px!important; margin-bottom: 16px!important; } [class*=wrapper] *[class*=contents] h2 {font-size: 20px!important; line-height: 28px!important; margin-bottom: 16px!important; } [class*=wrapper] *[class*=contents] h3 {font-size: 16px!important; line-height: 22px!important; margin-bottom: 12px!important; } [class*=wrapper] .column-wider, [class*=wrapper] .column-narrower {display: block; float: left; width: 280px !important; } [class*=wrapper] .one-col-feature {width: 280px !important; } [class*=wrapper] .one-col-feature li {font-size: 18px!important; line-height: 28px!important; } [class*=wrapper] .one-col-feature ol {margin-left: 22px!important; } [class*=wrapper] .one-col-feature ol li {padding-left: 18px!important; } [class*=wrapper] .one-col-feature ul li {background-size: 10px!important; padding-left: 40px!important; } [class*=wrapper] .one-col-feature blockquote p, [class*=wrapper] .one-col-feature blockquote h1, [class*=wrapper] .one-col-feature blockquote h2, [class*=wrapper] .one-col-feature blockquote h3, [class*=wrapper] .one-col-feature blockquote ol, [class*=wrapper] .one-col-feature blockquote ul {font-size: 26px!important; line-height: 40px!important; } [class*=wrapper] .btn a {padding: 15px 10px!important; width: 220px!important; } [class*=wrapper] .gutter {display: block!important; font-size: 10px; line-height: 10px; height: 10px!important; } [class*=wrapper] table.one-col, [class*=wrapper] table.one-col-feature, [class*=wrapper] td.last {margin-bottom: 10px!important; } [class*=wrapper] ol, [class*=wrapper] ul {margin-left: 20px !important; } [class*=wrapper] .footer *[class*="column"], [class*=wrapper] .preheader *[class*="column"] {display: block !important; text-align: center!important; } [class*=wrapper] .footer .title, [class*=wrapper] .preheader .title {display: none!important; } [class*=wrapper] .one-col .divider table, [class*=wrapper] .two-col .column .divider table, [class*=wrapper] .two-col .column-narrower .divider table, [class*=wrapper] .two-col .column-wider .divider table, [class*=wrapper] .three-col .divider table {background: transparent url(https://i7.createsend1.com/static/eb/master/09-onyx/images/divider-waves.png) repeat center center; background-size: auto 6px!important; width: 240px !important; } [class*=wrapper] .one-col .divider table img, [class*=wrapper] .two-col .column .divider table img, [class*=wrapper] .two-col .column-narrower .divider table img, [class*=wrapper] .two-col .column-wider .divider table img, [class*=wrapper] .three-col .divider table img {display: none!important; } [class*=wrapper] .footer .footer-container {width: 280px !important; } [class*=wrapper] .footer .column-social {padding-left: 0!important; padding-right: 0!important; width: 100% !important; } [class*=wrapper] .footer .column-details {width: 100% !important; } [class*=wrapper] .footer .social {width: 280px!important; } [class*=wrapper] .footer .social .social-text {padding: 0!important; text-align: left !important; width: auto !important; } [class*=wrapper] .footer .social-space {display: none !important; } [class*=wrapper] .footer .button {width: auto !important; margin: 0 auto 10px !important; } [class*=wrapper] .footer *[class*=column] {padding-top: 15px!important; padding-bottom: 10px!important; } [class*=wrapper] .footer *[class*=column] td {text-align: center!important; } [class*=wrapper] .footer *[class*=column] .padded {padding: 0!important; } [class*=wrapper] .footer *[class*=column] .social {width: 100%!important; margin-top: 15px!important; } } 
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
			            <p style="Margin-top: 0;font-weight: 400;-webkit-font-smoothing: antialiased;font-family: sans-serif;color: #212a32;font-size: 18px;line-height: 30px;Margin-bottom: 20px;text-align: center">Hola <strong>'.$datosUserAnunciante->nombre.'</strong></p>

			<p style="Margin-top: 0;font-weight: 400;-webkit-font-smoothing: antialiased;font-family: sans-serif;color: #212a32;font-size: 18px;line-height: 30px;Margin-bottom: 20px;text-align: center">¡ Tenemos excelentes noticias para tí !</p>

			<p style="Margin-top: 0;font-weight: 400;-webkit-font-smoothing: antialiased;font-family: sans-serif;color: #212a32;font-size: 18px;line-height: 30px;Margin-bottom: 20px;text-align: center font-weight:bold">'.$datosSolicitante->nombre.' está interesado en tu propiedad ('.$datosUserAnunciante->propiedad.')- '.$tipoPropiedad->nombre.' en '.$datosUserAnunciante->tipo_operacion.'</p>

			<p style="Margin-top: 0;font-weight: 400;-webkit-font-smoothing: antialiased;font-family: sans-serif;color: #212a32;font-size: 18px;line-height: 30px;Margin-bottom: 20px;text-align: center">Si estas interesado en los datos de contacto de este cliente, puedes comprarlos dando <a href="http://interhabita.com/index/mis_colicitantes_sin_pagar/'.$datosUserAnunciante->id_usuario.'" target="_blank" style="font-weight:bold">click aquí</a> o entra a <a href="http://interhabita.com" style="font-weight:bold">interhabita.com</a> e ingresa a tu cuenta y compra en la sección de “Mis solicitantes” donde tienes un registro completo de todos tus prospectos.</p>

			<p style="Margin-top: 0;font-weight: 400;-webkit-font-smoothing: antialiased;font-family: sans-serif;color: #212a32;font-size: 18px;line-height: 30px;Margin-bottom: 20px;text-align: center">¡ Felicidades, y que cierres esta operación !</p>
			</br>
			<p style="Margin-top: 0;font-weight: 400;-webkit-font-smoothing: antialiased;font-family: sans-serif;color: #212a32;font-size: 18px;line-height: 30px;Margin-bottom: 20px;text-align: center"><span style="font-size: 24px; font-weight:bold">Interhabita staff</span></br>
			<a href="mailto:staff@interhabita.com" style="font-weight:bold">staff@interhabita.com</a></br>
			<a href="http://interhabita.com" style="font-weight:bold">interhabita.com</a></p>
			          
			                                    <!-- CONTENIDO HTML FIN--></td>
			                                  </tr>
			                                </tbody></table>
			                              
			                                
			                                <table style="border-collapse: collapse;border-spacing: 0;width: 100%" width="100%">
			                                  <tbody><tr>
			                                    <td class="padded" style="padding-top: 0;padding-bottom: 0;padding-left: 40px;padding-right: 40px;vertical-align: top">
			                                      
			            							<div class="btn" style="Margin-bottom: 20px">
              											<a style="mso-hide: all;-webkit-font-smoothing: antialiased;padding-top: 15px;padding-bottom: 15px;font-weight: 500;display: inline-block;font-size: 16px;line-height: 20px;text-align: center;text-decoration: none;border-bottom-color: #cbced0;border-bottom-style: solid;border-bottom-width: 3px;color: #212a32;transition: background-color 0.2s;font-family: sans-serif;width: 480px;padding-left: 20px;padding-right: 20px;background-color: #ffffff" href="http://www.interhabita.com">Ir a InterHabita</a>
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

	  	$mail->IsHTML(true);
		$mail->Body = $body;
		$mail->Send();

		//Enviamos notificacion al administrador del sitio informandole que un nuevo cliente esta interesado en dicha propiedad
		$mail = new PHPMailer();
		$mail->From = "staff@interhabita.com";
		$mail->FromName = "Staff Interhabita";
		$mail->Subject = " Inmobiliaria Interhabita - Solicitante Interesado en Propiedad del Anunciante";
		$mail->AddAddress('rather_79@hotmail.com', 'Omar Serrano');

		//cuerpo del mensaje
	
		$body='<h2>Inmobiliaria Interhabita</h2>
		     <p>Hola Estimad@ Administrador tienes una nueva notificación de un Solicitante-Anunciante, para ver dicha notificacion ingresa al sitio Interhabita:</p>
		     	
		     	<a target="_blank" href="http://interhabita.com">Sitio Interhabita</a>

		     <br><br>
		  <p>Servicios de la pagína Inmobiliaria Interhabita</p>
		  <br><br>';
		

	  	$mail->IsHTML(true);
		$mail->Body = $body;
		$mail->Send();

		echo "Gracias por tu mensaje pronto recibiras respuesta";
		
	
	}


	public function contactanos(){

		$mail=new PHPMailer();
		$mail->From = "staff@interhabita.com";
		$mail->FromName = "Staff Interhabita";
		$mail->Subject = " Inmobiliaria Interhabita - Comentario";
		$mail->AddAddress($this->input->post('correo'), $this->input->post('nombre'));


		$body='

			<h2>Inmobiliaria Interhabita</h2>
		     <p>Hola Estimad@ Administrador has recibido un nuevo comentario, descripción abajo:</p>
		     <p>Nombre:'.$this->input->post('nombre').'</p>
		     <p>Comentario:'.$this->input->post('comentario').'</p>
		     <br>
		     <a target="_blank" href="http://interhabita.com">Sitio Interhabita</a>
		     <br><br>
			 <p>Servicios de la pagína Inmobiliaria Interhabita</p>
			 <br><br>

		      ';

		$mail->IsHTML(true);
		$mail->Body = $body;
		$mail->Send();

		echo "Gracias! Tu mensaje se envió Satisfactoriamente";

	}

}