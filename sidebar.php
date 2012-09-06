<div id="sidebar" data-role="collapsible-set" data-collapsed="true"<?php jqmobile_ui('widget'); ?>>
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar')) : else : ?>

		<div id="widget-search" class="widget widget_search"  data-role="collapsible">
			<h2>Search</h2>
			<?php get_search_form(); ?>
		</div>

		<div id="widget-pages" class="widget widget_pages"  data-role="collapsible">
			<h2>Pages</h2>
			<ul>
			<?php wp_list_pages('title_li=' ); ?>
			</ul>
		</div>

		<div id="widget-archives" class="widget widget_archive"  data-role="collapsible">
			<h2>Archives</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</div>

		<div id="widget-categories" class="widget widget_categories"  data-role="collapsible">
			<h2>Categories</h2>
			<ul>
			<?php wp_list_categories(array(
					'show_count' => true,
					'title_li' => '',
					'walker' => new Theme_Walker_Category
				)); ?>
			</ul>
		</div>

		<div id="widget-meta" class="widget widget_meta"  data-role="collapsible">
			<h2>Meta</h2>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
				<?php wp_meta(); ?>
			</ul>
		</div>
	<?php endif; ?>
</div>