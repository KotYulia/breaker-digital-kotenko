<?php
// Creates Movie Reviews Custom Post Type Films
function films_reviews_init() {
    $args = array(
        'label' => 'Films',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => true,
        'query_var' => true,
        'taxonomies' => array('directors'),
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',)
    );
    register_post_type( 'films-reviews', $args );
}
add_action( 'init', 'films_reviews_init' );

// hook into the init action and call create_taxonomy when it fires
add_action( 'init', 'create_taxonomy');

// create taxonomy for post type "films"
function create_taxonomy()
{
    //Link: https://codex.wordpress.org/Function_Reference/register_taxonomy
    $labels = array(
        'name' => __('Directors', 'directors'),
        'singular_name' => __('Director', 'directors'),
        'search_items' => __('Search Directors', 'directors'),
        'all_items' => __('All Directors', 'directors'),
        'parent_item' => __('Parent Director', 'directors'),
        'parent_item_colon' => __('Parent Director:', 'directors'),
        'edit_item' => __('Edit Director', 'directors'),
        'update_item' => __('Update Director', 'directors'),
        'add_new_item' => __('Add New Director', 'directors'),
        'new_item_name' => __('New Director Name', 'directors'),
        'menu_name' => __('Directors', 'directors'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'label' => '',
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => true,
        'public'                => true,
        'show_tagcloud'         => true,
        'update_count_callback' => '',
        'capabilities'          => array(),
        '_builtin'              => false,
    );

    register_taxonomy('directors', array('films-reviews'), $args);
}

/**
 * Adding img meta_box
 */

// Add term page
function pippin_taxonomy_add_new_meta_field($term) {
// this will add the custom meta field to the add new term page
    ?>
    <div class="form-field">
        <label for="term_meta[directors-photo]">Url directors photo:</label>
        <input type="text" id="term_meta[directors-photo]" name="term_meta[directors-photo]" value="<?php echo get_term_meta($term->term_id, 'directors-photo', 1); ?>" />
    </div>
    <?php
}
add_action( 'directors_add_form_fields', 'pippin_taxonomy_add_new_meta_field', 10, 2 );

// Edit term page
function pippin_taxonomy_edit_meta_field($term) {?>

    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="term_meta[directors-photo]">Add url photo:</label>
        </th>
        <td>
            <input type="text" id="term_meta[directors-photo]" name="term_meta[directors-photo]" value="<?php echo get_term_meta($term->term_id, 'directors-photo', 1); ?>" />
        </td>
    </tr>

    <?php
}
add_action( 'directors_edit_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        foreach( $_POST['term_meta'] as $key=>$value ){
            if( empty($value) ){
                delete_term_meta( $term_id, $key); // Delete the field if the value is empty
                continue;
            }

            update_term_meta($term_id, $key, $value); // add_post_meta()
        }
    }

    return $term_id;
}
add_action( 'edited_directors', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_directors', 'save_taxonomy_custom_meta', 10, 2 );

