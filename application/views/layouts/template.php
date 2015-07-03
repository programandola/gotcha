<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="not-ie8" lang="es-MX" xml:lang="es-MX"><!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $this->layout->getTitle(); ?></title>
	<meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>">
	<meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <link rel="icon" href="<?php echo base_url()?>public/images/favicon.gif" type="image/gif">
    <link rel="stylesheet" id="bootstrap-css" href="<?php echo base_url()?>public/css/bootstrap.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="layout-css" href="<?php echo base_url()?>public/css/layout.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="style-css" href="<?php echo base_url()?>public/css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" id="style-css" href="<?php echo base_url()?>public/css/admin.css" type="text/css" media="screen">
    <link rel="stylesheet" id="style-css" href="<?php echo base_url()?>public/css/popup.css" type="text/css" media="screen">
    <link rel="stylesheet" id="style-css" href="<?php echo base_url()?>public/css/alert-boxes.css" type="text/css" media="screen">
    <link rel="stylesheet" id="style-css" href="<?php echo base_url()?>public/css/flexslider.css" type="text/css" media="screen">
    <script src="<?php echo base_url()?>public/js/jquery1.11.js"></script>
    <script src="<?php echo base_url()?>public/js/modernizr2.8.3.js"></script>
    <script src="<?php echo base_url()?>public/js/jquery.placeholder.js"></script>
    <script src="<?php echo base_url()?>public/js/jquery.flexslider.js"></script>
    <script src="<?php echo base_url()?>public/js/jquery.numeric.js"></script>
    <script src="<?php echo base_url()?>public/js/funciones.js"></script>
  
    <!--*************auxiliares*****************-->

	<?php echo $this->layout->css; ?> 

	<?php echo $this->layout->js; ?> 

	<!--**********fin auxiliares*****************-->
</head>
<body class="home blog boxed layout-three">
	<?php echo $content_for_layout; ?>
</body>
</html>