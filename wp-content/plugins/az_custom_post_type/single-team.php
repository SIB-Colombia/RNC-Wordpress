<?php get_header(); 

$options = get_option('klaus');

?>

<?php az_page_header_team($post->ID); ?>

<div id="content">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <?php //edit_post_link( __('Edit', 'textdomain'), '<span class="edit-post">[', ']</span>' ); ?>
        <?php the_content(); ?>
        
        <?php if( !empty($options['enable-comment-team-area']) && $options['enable-comment-team-area'] == 1) { ?>
        <!-- Comments Template Area -->
        <section class="comment-area">
			<div class="container">
            	<div class="row">
                	<div class="col-md-12">
						<?php comments_template('', true); ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Comments Template Area -->
        <?php } ?>

        <!-- Navigation Area -->
        <section class="post-type-navi">
            <div class="prev"><?php previous_post_link(('%link'), '<span>'.__('Prev', 'textdomain').'</span>') ?></div>
            <div class="next"><?php next_post_link(('%link'), '<span>'.__('Next', 'textdomain').'</span>') ?></div>
        </section>
        <!-- End Navigation Area -->

        <!-- Navigation Area Mobile -->
        <section class="main-content-navi team mobile default-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navigation-projects">
                            <ul>
                                <li class="prev"><?php previous_post_link(('%link'), '<i class="font-icon-arrow-left-simple-round"></i>'.__('Prev', 'textdomain').'') ?></li>
                                <li class="next"><?php next_post_link(('%link'), '<i class="font-icon-arrow-right-simple-round"></i>'.__('Next', 'textdomain').'') ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Navigation Area Mobile -->
        
    <?php endwhile; endif; ?>

    
</div>
            
<?php get_footer(); ?>