<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
get_header();
?>

<?php single_cat_title(); ?>

<table class="pure-table pure-table-horizontal">
    <thead>
        <tr>
            <th>No.</th>
            <th>Judul Surat</th>
            <th>Keterangan</th>
        </tr>
    </thead>

    <tbody>
    	<?php $number = 1; ?>
    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <tr>
            <td><?php $number; ?></td>
            <td>
            	<h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
            </td>
            <td>
            	
            </td>
        </tr>
        <?php $number += 1; ?>
        <?php endwhile; else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
    </tbody>
</table>


<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>

<?php get_footer(); ?>
