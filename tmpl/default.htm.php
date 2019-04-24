<?php 

/**
 * configs:
 * 
 * title
 * template
 */
use php\util\TemplateUtil;

?>

<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="Dominik Suter, Noel Oliveira">
<title><?php echo $title?></title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="<?php echo $webroot?>bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $webroot?>css/offcanvas.css">
<link rel="stylesheet" href="<?php echo $webroot?>css/glyphicon.css">

<!-- Custom styles for this template -->
<?php TemplateUtil::stylesheets( $stylesheets )?>
</head>
<body class="bg-light">

	<?php $nav ? include( Config::PATH_TEMPLATE . 'navigation.htm.php' ) : null; ?>
    
    <main role="main" class="container mt-5">
    	<?php TemplateUtil::exists( $template ) ? include( $template ) : null; ?>
    </main>
	
    <script src="<?php echo $webroot?>js/plugin/jquery.slim.min.js"></script>
	<script src="<?php echo $webroot?>js/plugin/popper.min.js"></script>
	<script src="<?php echo $webroot?>bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo $webroot?>js/offcanvas.js"></script>
	<script src="<?php echo $webroot?>js/print.js"></script>
		
    <!-- Custom scripts for this template -->
    <?php TemplateUtil::scripts( $scripts )?>
</body>
</html>
