
<?php
/*
Template Name: About template
*/

get_header(); ?>

    <section class="title-banner" style="background: url('<?php echo get_theme_mod('img-upload');?>') center/cover no-repeat;">
        <div class="container">
            <p>
                <?php
                if (is_front_page()){
                    the_title();
                } else {
                    wp_title('');
                }
                ?>
            </p>
        </div>
    </section>

    <section class="about-us">
        <div class="container about-us-content">
            <div class="row">
                <?php if ( have_posts() ) : ?>
                    <?php
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                endif; ?>
            </div>

            <?php if(!dynamic_sidebar('about-skills-sidebar')) : ?>

            <?php endif; ?>
            <ul class="row our-skills-info">
                <?php
                $skills = array();
                $string = get_post_custom_values('skills', $post->ID );
                $arr = explode('|', $string[0]);
                foreach($arr as $str) {
                    list($key, $value) = explode(':', $str);
                    $skills[$key] = $value;
                }
                foreach ( $skills as $key => $value ) {?>
                    <li class="col-xs-12 col-sm-6 col-md-6 col-lg-offset-1 col-lg-5">
                        <span class="percent-value"> <?php echo $value . "%" ?></span>
                        <div class="full-space">
                            <span class="name-skill" style="width: <?php echo $value . "%" ?>">
                                <?php echo $key ?>
                            </span>
                        </div>
                    </li>
                <?php } ?>
            </ul>

            <?php if(!dynamic_sidebar('about-team-sidebar')) : ?>

            <?php endif; ?>
            <ul class="row team-content">
                <?php
                $query = new WP_Query( array('post_type' => 'team-reviews', 'posts_per_page' => 100 ) );
                if ($query->have_posts()):?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <li class="col-xs-12 col-sm-4 col-md-3">
                            <?php the_post_thumbnail('full', 'class=img-responsive'); ?>
                            <span class="name-member">
                                <?php
                                    $job = get_post_custom_values('job');
                                    foreach( $job as $key => $value ) {
                                        echo "$value";
                                    }
                                ?>
                            </span>
                        </li>
                    <?php endwhile; ?>
                <?php endif; wp_reset_postdata(); ?>
                <li class="col-xs-12 col-sm-4 col-md-3 cv-link">
                    <a href='<?php echo '<img src="http://kot.local/wp-content/uploads/2017/03/team-icon-2.png" />'; ?>' >send cv</a>
                </li>
            </ul>
        </div>


    </section>

<?php get_footer(); ?>