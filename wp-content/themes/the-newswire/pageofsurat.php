<?php
/**
 * Template Name: Page for Surat
 * Description: Page for Surat
 */
get_header(); ?>

    <div id="content" class="clearfix full-width-content">
        
        <div id="main" class="clearfix" role="main">

                <?php 
                /* The loop: the_post retrieves the content
                 * of the new Page you created to list the posts,
                 * e.g., an intro describing the posts shown listed on this Page..
                 */
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();

                      // Display content of page
                      get_template_part( 'content', 'page' ); 
                      wp_reset_postdata();
          
                    endwhile;
                endif;
                ?>

                <div id="grid-wrap" class="clearfix">

                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                $args = array(
                    // Change these category SLUGS to suit your use.
                    'category_name' => 'surat', 
                    'paged' => $paged
                );

                $list_of_posts = new WP_Query( $args );
                
                if ( $list_of_posts->have_posts() ) : ?>

                    <?php while ( $list_of_posts->have_posts() ) : $list_of_posts->the_post(); ?>
                        <div class="grid-box masonry-brick>
                        <?php
                            /* Include the Post-Format-specific template for the content.
                             * If you want to overload this in a child theme then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'content', 'suratpage' );
                            // get_template_part( 'content', get_post_format() );
                        ?>
                        </div>
                    <?php endwhile; ?>

                <?php else : ?>
                    <?php get_template_part( 'content', 'none' ); ?>
                <?php endif; ?>

            </div>
        </div>

<?php get_footer(); ?>