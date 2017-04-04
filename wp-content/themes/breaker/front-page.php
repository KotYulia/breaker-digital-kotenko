<?php
/**
 * The template for displaying front page
 * Created by PhpStorm.
 * User: Yuliya
 * Date: 25.03.2017
 * Time: 12:50
 */

get_header(); ?>

<main class="main-content">
    <section class="container main-info">
        <?php if ( have_posts() ) : ?>
            <?php
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        endif; ?>
    </section>
    <section class="media-content">
<!--        <h1 class="container main-title">-->
<!--            --><?php
//            $title = get_post_custom_values('title-section');
//            foreach( $title as $key => $value ) {
//                echo "$value";
//            }
//            ?>
<!--        </h1>-->
        <div class="media-block">
            <div class="container">
                <ul class="row media-list">
                    <?php
                    $query = new WP_Query( array('post_type' => 'films-reviews', 'posts_per_page' => 6 ) );
                    if ($query->have_posts()):?>
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <li class="col-sm-6 col-md-4">
                                <a class="popup-youtube-link" href="<?php echo get_the_excerpt(); ?>"><?php the_post_thumbnail('full', 'class=img-responsive'); ?></a>
                                <span><?php the_post_thumbnail_caption(); ?></span>
                            </li>
                        <?php endwhile; ?>
                    <?php endif; wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>