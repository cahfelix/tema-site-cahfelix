<?php get_header(); ?>
<?php
$qode_sidebar    = river_qode_get_sidebar_layout();
$qode_blog_query = river_qode_get_blog_query_posts();
?>

	<?php get_template_part( 'title' ); ?>
	<?php get_template_part( 'slider' ); ?>
    <div class="container">
    <div class="container_inner clearfix">
    <?php if(($qode_sidebar == "default")||($qode_sidebar == "")) : ?>
        <?php switch ($qode_options_river['blog_style']) {
            case 1: ?>
                <div class="blog_holder">
                    <?php if ( $qode_blog_query->have_posts() ) : while ( $qode_blog_query->have_posts() ) : $qode_blog_query->the_post(); ?>
                        <?php
                        get_template_part('blog_large_image', 'loop');
                        ?>
                    <?php endwhile; ?>
                    <?php else: ?>
                        <div class="entry">
                            <p><?php esc_html_e('No posts were found.', 'river'); ?></p>
                        </div>
                    <?php endif; ?>
	                <?php wp_reset_postdata(); ?>
	                <?php river_qode_get_blog_pagination( $qode_blog_query ); ?>
                </div>
                <?php
                break;
            case 2: ?>
                <div class="blog_holder small_images">
                    <?php if ( $qode_blog_query->have_posts() ) : while ( $qode_blog_query->have_posts() ) : $qode_blog_query->the_post(); ?>
                        <?php
                        get_template_part('blog_small_image', 'loop');
                        ?>
                    <?php endwhile; ?>
                    <?php else: //If no posts are present ?>
                        <div class="entry">
                            <p><?php esc_html_e('No posts were found.', 'river'); ?></p>
                        </div>
                    <?php endif; ?>
	                <?php wp_reset_postdata(); ?>
                </div>
	            <?php river_qode_get_blog_pagination( $qode_blog_query ); ?>
                <?php
                break;
            case 3: ?>
                <div class="blog_holder masonry">
                    <?php if ( $qode_blog_query->have_posts() ) : while ( $qode_blog_query->have_posts() ) : $qode_blog_query->the_post(); ?>
                        <?php
                        get_template_part('blog_masonry', 'loop');
                        ?>

                    <?php endwhile; ?>
                    <?php else: //If no posts are present ?>
                        <div class="entry">
                            <p><?php esc_html_e('No posts were found.', 'river'); ?></p>
                        </div>
                    <?php endif; ?>
	                <?php wp_reset_postdata(); ?>
                </div>
	            <?php river_qode_get_blog_pagination( $qode_blog_query ); ?>
                <?php
                break;
            case 4: ?>
                <div class="blog_holder">
                    <?php if ( $qode_blog_query->have_posts() ) : while ( $qode_blog_query->have_posts() ) : $qode_blog_query->the_post(); ?>
                        <?php
                        get_template_part('blog_large_image_whole_post', 'loop');
                        ?>
                    <?php endwhile; ?>
                    <?php else: //If no posts are present ?>
                        <div class="entry">
                            <p><?php esc_html_e('No posts were found.', 'river'); ?></p>
                        </div>
                    <?php endif; ?>
	                <?php wp_reset_postdata(); ?>
	                <?php river_qode_get_blog_pagination( $qode_blog_query ); ?>
                </div>
                <?php	break;

        } ?>
    <?php elseif($qode_sidebar == "1" || $qode_sidebar == "2"): ?>
        <div class="<?php if($qode_sidebar == "1"):?>two_columns_66_33<?php elseif($qode_sidebar == "2") : ?>two_columns_75_25<?php endif; ?> background_color_sidebar grid2 clearfix">
            <div class="column1">
                <div class="column_inner">
                    <?php switch ($qode_options_river['blog_style']) {
                        case 1: ?>
                            <div class="blog_holder">
                                <?php if ( $qode_blog_query->have_posts() ) : while ( $qode_blog_query->have_posts() ) : $qode_blog_query->the_post(); ?>
                                    <?php
                                    get_template_part('blog_large_image', 'loop');
                                    ?>
                                <?php endwhile; ?>
                                <?php else: ?>
                                    <div class="entry">
                                        <p><?php esc_html_e('No posts were found.', 'river'); ?></p>
                                    </div>
                                <?php endif; ?>
	                            <?php wp_reset_postdata(); ?>
	                            <?php river_qode_get_blog_pagination( $qode_blog_query ); ?>
                            </div>
                            <?php
                            break;
                        case 2: ?>
                            <div class="blog_holder small_images">
                                <?php if ( $qode_blog_query->have_posts() ) : while ( $qode_blog_query->have_posts() ) : $qode_blog_query->the_post(); ?>
                                    <?php
                                    get_template_part('blog_small_image', 'loop');
                                    ?>
                                <?php endwhile; ?>
                                <?php else: //If no posts are present ?>
                                    <div class="entry">
                                        <p><?php esc_html_e('No posts were found.', 'river'); ?></p>
                                    </div>
                                <?php endif; ?>
	                            <?php wp_reset_postdata(); ?>
                            </div>
	                        <?php river_qode_get_blog_pagination( $qode_blog_query ); ?>
                            <?php
                            break;
                        case 3: ?>
                            <div class="blog_holder masonry">
                                <?php if ( $qode_blog_query->have_posts() ) : while ( $qode_blog_query->have_posts() ) : $qode_blog_query->the_post(); ?>
                                    <?php
                                    get_template_part('blog_masonry', 'loop');
                                    ?>

                                <?php endwhile; ?>
                                <?php else: //If no posts are present ?>
                                    <div class="entry">
                                        <p><?php esc_html_e('No posts were found.', 'river'); ?></p>
                                    </div>
                                <?php endif; ?>
	                            <?php wp_reset_postdata(); ?>
                            </div>
	                        <?php river_qode_get_blog_pagination( $qode_blog_query ); ?>
                            <?php
                            break;
                        case 4: ?>
                            <div class="blog_holder">
                                <?php if ( $qode_blog_query->have_posts() ) : while ( $qode_blog_query->have_posts() ) : $qode_blog_query->the_post(); ?>
                                    <?php
                                    get_template_part('blog_large_image_whole_post', 'loop');
                                    ?>
                                <?php endwhile; ?>
                                <?php else: //If no posts are present ?>
                                    <div class="entry">
                                        <p><?php esc_html_e('No posts were found.', 'river'); ?></p>
                                    </div>
                                <?php endif; ?>
	                            <?php wp_reset_postdata(); ?>
	                            <?php river_qode_get_blog_pagination( $qode_blog_query ); ?>
                            </div>
                            <?php	break;

                    } ?>
                </div>
            </div>
            <div class="column2">
                <?php get_sidebar(); ?>
            </div>
        </div>
    <?php elseif($qode_sidebar == "3" || $qode_sidebar == "4"): ?>
        <div class="<?php if($qode_sidebar == "3"):?>two_columns_33_66<?php elseif($qode_sidebar == "4") : ?>two_columns_25_75<?php endif; ?> background_color_sidebar grid2 clearfix">
            <div class="column1">
                <?php get_sidebar(); ?>
            </div>
            <div class="column2">
                <div class="column_inner">
                    <?php switch ($qode_options_river['blog_style']) {
                        case 1: ?>
                            <div class="blog_holder">
                                <?php if ( $qode_blog_query->have_posts() ) : while ( $qode_blog_query->have_posts() ) : $qode_blog_query->the_post(); ?>
                                    <?php
                                    get_template_part('blog_large_image', 'loop');
                                    ?>
                                <?php endwhile; ?>
                                <?php else: ?>
                                    <div class="entry">
                                        <p><?php esc_html_e('No posts were found.', 'river'); ?></p>
                                    </div>
                                <?php endif; ?>
	                            <?php wp_reset_postdata(); ?>
	                            <?php river_qode_get_blog_pagination( $qode_blog_query ); ?>
                            </div>
                            <?php
                            break;
                        case 2: ?>
                            <div class="blog_holder small_images">
                                <?php if ( $qode_blog_query->have_posts() ) : while ( $qode_blog_query->have_posts() ) : $qode_blog_query->the_post(); ?>
                                    <?php
                                    get_template_part('blog_small_image', 'loop');
                                    ?>
                                <?php endwhile; ?>
                                <?php else: //If no posts are present ?>
                                    <div class="entry">
                                        <p><?php esc_html_e('No posts were found.', 'river'); ?></p>
                                    </div>
                                <?php endif; ?>
	                            <?php wp_reset_postdata(); ?>
                            </div>
	                        <?php river_qode_get_blog_pagination( $qode_blog_query ); ?>
                            <?php
                            break;
                        case 3: ?>
                            <div class="blog_holder masonry">
                                <?php if ( $qode_blog_query->have_posts() ) : while ( $qode_blog_query->have_posts() ) : $qode_blog_query->the_post(); ?>
                                    <?php
                                    get_template_part('blog_masonry', 'loop');
                                    ?>
                                <?php endwhile; ?>
                                <?php else: //If no posts are present ?>
                                    <div class="entry">
                                        <p><?php esc_html_e('No posts were found.', 'river'); ?></p>
                                    </div>
                                <?php endif; ?>
	                            <?php wp_reset_postdata(); ?>
                            </div>
	                        <?php river_qode_get_blog_pagination( $qode_blog_query ); ?>
                            <?php
                            break;
                        case 4: ?>
                            <div class="blog_holder">
                                <?php if ( $qode_blog_query->have_posts() ) : while ( $qode_blog_query->have_posts() ) : $qode_blog_query->the_post(); ?>
                                    <?php
                                    get_template_part('blog_large_image_whole_post', 'loop');
                                    ?>
                                <?php endwhile; ?>
                                <?php else: //If no posts are present ?>
                                    <div class="entry">
                                        <p><?php esc_html_e('No posts were found.', 'river'); ?></p>
                                    </div>
                                <?php endif; ?>
	                            <?php wp_reset_postdata(); ?>
	                            <?php river_qode_get_blog_pagination( $qode_blog_query ); ?>
                            </div>
                            <?php	break;

                    } ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div>
    </div>

<?php get_footer(); ?>