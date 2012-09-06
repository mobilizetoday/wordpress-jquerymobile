<ul class="meta" data-role="listview" data-inset="true"<?php jqmobile_ui('post');?>>
	<li>
		<a href="<?php the_permalink(); ?>">
			<p class="ui-li-aside"><?php the_time('Y-m-d'); ?></p>
			<h3><?php the_title(); ?></h3>
			<p><strong><?php the_author(); ?></strong></p>
			<div><?php the_excerpt(); ?></div>
			<?php if (comments_open()): ?>
				<span class="ui-li-count"><?php comments_number('0', '1', '%' );?></span>
			<?php endif; ?>
		</a>
	</li>
</ul>



