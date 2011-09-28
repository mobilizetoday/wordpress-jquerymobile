<?php get_header(); ?>
<div class="right">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
			<div class="entry">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
			</div>
			<?php edit_post_link('Edit this entry', '<p>', '</p>'); ?>
		</div>
		<?php comments_template(); ?>
	<?php endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
