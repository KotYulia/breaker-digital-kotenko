
<?php
/**
 * The template for displaying taxonomy
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package breaked
 */

get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );?>

<main class="main-content">
    <div class="main-page-title">
        <?php
            $args = array(
                'name' => 'directors'
            );
            $output = 'objects';
            $taxonomies = get_taxonomies( $args, $output );
            if( $taxonomies ) {
                foreach ( $taxonomies as $taxonomy ) {
                    echo '<h1 class="container page-title">' . $taxonomy->name . '</h1>';
                }
            }
        ?>
    </div>
    <article class="directors-info-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 directors-name">
                    <img class="img-responsive directors-photo" src="<?php echo get_term_meta( $term->term_id, 'directors-photo', 1 ); ?>">
                    <h2> <?php echo $term->name; ?> </h2>
                </div>
                <div class="col-sm-8 directors-info">
                    <p><?php echo $term->description; ?></p>
                    <?php
                    if ( have_posts() ) : ?>
                        <span class="directors-work">Work:</span>
                        <?php while ( have_posts() ) : the_post();?>
                            <a class="popup-youtube-link" href="<?php echo get_the_excerpt();?>">
                                <?php the_title();?>
                            </a>
                        <?php endwhile; ?>
                    <?php else :
                        get_template_part( 'template-parts/content', 'none' );
                    endif; ?>
                </div>
            </div>
        </div>

    </article>
</main>

<?php
get_footer();

