<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bsfriel
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="header">
		<div class="hero">
			<div class="hero__headline"><?php bloginfo( 'name' ); ?></div>
			<div class="social">
			<?php
				$socialicons = get_theme_mod( 'bsf_socialicons_setting' );
				if ($socialicons) {
					foreach ( $socialicons as $icon => $link ) {
						if ($link <> '') {
							echo '<a class="social__link" href="'.$link.'"><i class="fab fa-'.$icon.'"></i></a>';
						}
					}
				}
			?>
			</div>
			<?php
				wp_nav_menu( array(
					'theme_location'	=> 'menu-1',
					'menu_id'   			=> 'primary-menu',
					'menu_class' 			=> 'navbar navbar--vertical',
					'items_wrap'			=> '<div id="%1$s" class="%2$s">%3$s</div>',
					'walker'					=> new Bsfriel_Navwalker()
				) );
			?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
