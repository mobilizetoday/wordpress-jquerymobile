<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1.0, user-scalable=0" />
	<?php if (is_search()): ?><meta name="robots" content="noindex, nofollow" /><?php endif; ?>
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>" type="text/css" />
</head>

<body <?php body_class(); ?>>
	<div data-role="page" id="jqm-home">
		<div data-role="header">
			<h1><?php if (is_home()) echo get_bloginfo('name'). " | ". get_bloginfo('description'); else wp_title('',true); ?></h1>
		</div>
		<div data-role="content">