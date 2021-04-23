<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blank
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">



	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="http://localhost/wordpress/shop/" class="navbar-brand">RESTWELL</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">

            <a href="http://localhost/wordpress/home/" class="nav-item nav-link active">Home</a>
            <a href="http://localhost/wordpress/about/" class="nav-item nav-link">About</a>
            <a href="http://localhost/wordpress/contact/" class="nav-item nav-link">Contact</a>
            <a href="http://localhost/wordpress/shop/" class="nav-item nav-link">Shop</a>

            
            

        </div>
        <form class="form-inline ml-auto">
            <nav class="navbar navbar-expand-md navbar-light bg-info">
            <a href="http://localhost/wordpress/cart/" class="nav-item nav-link">Cart</a>
        </form>
    </div>
</nav>