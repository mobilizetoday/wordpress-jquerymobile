<?php get_header(); ?>

	<div class="right">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

				<div class="entry">
					
					<?php the_content(); ?>

					<?php wp_link_pages(array('before' => '<p class="pages">Pages: ', 'after' => '</p>', 'link_before' => '<span>', 'link_after' => '</span>', 'next_or_number' => 'number')); ?>
					
					<?php the_tags( '<p class="tags">Tags: ', ' ', '</p>'); ?>

				</div>
				
				<?php edit_post_link('Edit this entry','',''); ?>
				
			</div>

		<?php comments_template(); ?>

		<?php endwhile; endif; ?>
	</div>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>