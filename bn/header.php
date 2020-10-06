<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_4
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139151713-3"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-139151713-3');
	</script>

</head>

<body <?php body_class( array('drawer','drawer--right')); ?>>
	<div class="mimic">&nbsp;</div>
	<nav class="drawer-nav" role="navigation">
		<?php wp_nav_menu( array( 'menu' => 'main', 'menu_class' => 'side-menu' ) ); ?>
	</nav>

	<div id="page" class="site" role="main">
		<header class="header">
	    <div class="header__wrap wrap">
	      <div class="header__bg"></div>
	      <div class="header__mobile">
	        <div class="hamburger"><span></span><span></span><span></span><span></span><span></span><span></span></div>
	      </div>
	      <a href="<?php echo site_url(); ?>" class="header__logo">&nbsp;</a>
	      <div class="header__nav">
	        <?php wp_nav_menu( array( 'menu' => 'main' ) ); ?>
	      </div>
	      <div  class="header__cart">
	        <div class="basket__totals"><div id="basket__totals__price"></div></div>
	        <div class="basket"><span id="mini-cart-count"></span></div>
	      </div>
	    </div>
	  </header>

		<div id="content" class="site-content">
