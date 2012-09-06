<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1.0, user-scalable=0" />
	<?php if (is_search()): ?><meta name="robots" content="noindex, nofollow" /><?php endif; ?>
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<script type="text/javascript">
		var ui_widget_content = '<?php echo jqmobile_get_ui('widget_content'); ?>';
		var ui_form_comment = '<?php echo jqmobile_get_ui('form_comment'); ?>';
	</script>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>" type="text/css" />
</head>

<body <?php body_class(); ?>>
	<div data-role="page" id="jqm-home"<?php jqmobile_ui('body');?>>
		<div data-role="header"<?php jqmobile_ui('header');?>>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-icon="home" data-iconpos="notext"><?php bloginfo( 'name' ); ?></a>
			<h1 role="heading"><?php if (is_home()) echo get_bloginfo('name'). " | ". get_bloginfo('description'); else wp_title('',true); ?></h1>
		</div>
		<div data-role="content">