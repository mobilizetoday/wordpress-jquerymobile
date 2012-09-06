<form action="<?php echo home_url(); ?>" id="searchform" method="get">
    <div data-role="fieldcontain">
	    <input type="search" name="s" id="search" value="<?php the_search_query(); ?>" />
	</div>
</form>