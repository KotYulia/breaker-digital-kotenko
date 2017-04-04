<?php
/*
 * Template Name: Directors
 */

get_header(); ?>

<main class="main-content">
    <div class="main-page-title">
        <h1 class="container page-title">
            <?php wp_title(''); ?>
        </h1>
    </div>
    <?php
        $args = array(
            'taxonomy'      => array( 'directors' ),
            'fields'        => 'all',
        );

        $directors_query = new WP_Term_Query( $args );

        if ( $directors_query->terms ) :?>
            <ul class="directors-works-list" >
                <?php foreach( $directors_query->terms as $directors ){
                    ?>
                    <li class="directors-works-item">
                        <div class="container" >
                            <div class="row directors-works-content">
                                <div class="col-sm-3 directors-name">
                                    <h2><?php echo $directors->name; ?></h2>
                                </div>
                                    <?php
                                    $args_video = array(
                                        'post_type' => 'films-reviews',
                                        'posts_per_page' => 1,
                                        'directors'    => $directors ->slug,
                                        'meta_key'  => 'add-film',
                                    );
                                    $film = new WP_Query($args_video);

                                    while ( $film->have_posts() ) : $film->the_post();?>
                                        <div class="col-sm-6 directors-video">
                                            <a class="popup-youtube-link" href="<?php echo get_the_excerpt();?>">
                                                <?php the_post_thumbnail() ?>
                                            </a>
                                        </div>
                                        <div class="col-sm-3 directors-link-page">
                                            <a href="<?php echo get_term_link($directors);?>">
                                                <?php
                                                $title = get_post_custom_values('name');
                                                foreach( $title as $key => $value ) {
                                                    echo "$value";
                                                }
                                                ?>
                                                <span class="fa fa-long-arrow-right"></span>
                                            </a>
                                        </div>
                                    <?php endwhile;

                                    wp_reset_postdata();
                                    ?>



                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php endif;?>
    <?php wp_reset_postdata();?>
</main>

<?php get_footer(); ?>