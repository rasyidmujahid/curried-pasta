<?php
/**
 * The default searchform template file.
 *
 * @package WordPress
 * @subpackage Core Framework
 */
?>

<div class="search-form">
    <form name="search_form" method="get" action="<?php echo home_url(); ?>" class="search_form">
    	<input type="text" name="s" placeholder="<?php _e('Search the site...', CORE_THEME_NAME); ?>" title="Search the site..." class="field_search">
    </form>
</div>