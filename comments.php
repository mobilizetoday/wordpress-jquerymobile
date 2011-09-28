<?php
	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	
	<h2 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?></h2>

	<ul class="commentlist" data-role="listview" data-inset="true">
		<?php wp_list_comments( array( 'max_depth' => 1, 'callback' => 'jquerymobile_comment' ) ); ?>
	</ul>

	<div class="navigation" data-role="controlgroup">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<p>Comments are closed.</p>

	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<?php comment_form(); ?>

<?php endif; ?>
