<?php
/*
Plugin Name: Tucker Toys Awards
Plugin URI:
Description: Add custom post type to allow for adding and organizing of awards won
Version: 0.1
Author: Kevin J. McMahon Jr.
Author URI:
License:GPLv2
*/
?>
<?php
// Register Custom Post Type
function tucker_toys_awards_post_type() {

	$labels = array(
		'name'                  => _x( 'Awards', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Award', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Awards', 'text_domain' ),
		'name_admin_bar'        => __( 'Awards', 'text_domain' ),
		'archives'              => __( '', 'text_domain' ),
		'parent_item_colon'     => __( '', 'text_domain' ),
		'all_items'             => __( 'Awards', 'text_domain' ),
		'add_new_item'          => __( 'Add New Award', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Award', 'text_domain' ),
		'edit_item'             => __( 'Edit Award', 'text_domain' ),
		'update_item'           => __( 'Update Award', 'text_domain' ),
		'view_item'             => __( 'View Award', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Award', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this award', 'text_domain' ),
		'items_list'            => __( 'Awards list', 'text_domain' ),
		'items_list_navigation' => __( 'Awards list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter awards list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'					=> 'awards',
		'with_front'			=> true,
		'pages'					=> true,
		'feeds'					=> true,
	);
	$capabilities = array(
		'edit_post'             => 'edit_post',
		'read_post'             => 'read_post',
		'delete_post'           => 'delete_post',
		'edit_posts'            => 'edit_posts',
		'edit_others_posts'     => 'edit_others_posts',
		'publish_posts'         => 'publish_posts',
		'read_private_posts'    => 'read_private_posts',
	);
	$args = array(
		'label'                 => __( 'Award', 'text_domain' ),
		'description'           => __( 'Tucker Toys Awards', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes' ),
		'taxonomies'            => array( 'toysawareded' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-awards',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'				=> $rewrite,
		'capabilities'          => $capabilities,
	);
	register_post_type( 'tucker_awards', $args );

}

add_action( 'init', 'tucker_toys_awards_post_type', 0 );


// Register Custom Taxonomy
function tucker_toys_awards_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Toys Awarded', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Toy Awarded', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Toy Awarded', 'text_domain' ),
		'all_items'                  => __( 'Toys', 'text_domain' ),
		'parent_item'                => __( 'Parent Toy', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Toy:', 'text_domain' ),
		'new_item_name'              => __( 'New Toy Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Toy', 'text_domain' ),
		'edit_item'                  => __( 'Edit Toy', 'text_domain' ),
		'update_item'                => __( 'Update Toy', 'text_domain' ),
		'view_item'                  => __( 'View Toy', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'toysawareded', array( 'tucker_awards' ), $args );

}
add_action( 'init', 'tucker_toys_awards_taxonomy', 0 );

add_action( 'init', 'register_tucker_toys_awards_shortcodes' );

function register_tucker_toys_awards_shortcodes(){
	add_shortcode( 'tucker_awards', 'tucker_toys_awards_shortcode' );
	add_shortcode( 'tucker_awards_page', 'tucker_toys_awards_page_shortcode' );
}

function tucker_toys_awards_shortcode(){
	$loop = new WP_Query(
		array(
			'post_type' => 'tucker_awards',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => -1,
		)
	);
	
	if ( $loop->have_posts() ){?>
		<ul id="tucker-awards-list">
        <?php
		while ( $loop->have_posts() ) : $loop->the_post(); ?>
        	<?php if ( has_post_thumbnail() ) : ?>
			<li><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?><h3><?php the_title(); ?></h3></a></li>
            <?php endif; ?>
		<?php endwhile; ?>
        <?php
		echo '</ul>';
	}
	else{
		$output = '<p>Awards</p>';
	}
	return $output;
}

function tucker_toys_awards_page_shortcode(){
	$loop = new WP_Query(
		array(
			'post_type' => 'tucker_awards',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => -1,
		)
	);
	
	if ( $loop->have_posts() ){?>
		<ul id="tucker-awards-page-list">
        <?php
		while ( $loop->have_posts() ) : $loop->the_post(); ?>
        	<?php if ( has_post_thumbnail() ) : ?>
			<li><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?><h3><?php the_title(); ?></h3></a></li>
            <?php endif; ?>
		<?php endwhile; ?>
        <?php
		echo '</ul>';
	}
	else{
		$output = '<p>Awards</p>';
	}
	return $output;
}

/* function add_award_templates_live_composer_support( $cpt ) {

	$cpt['tucker_awards'] = 'Award';

	return $cpt;

} add_filter( 'dslc_post_templates_post_types', 'add_award_templates_live_composer_support' ); */
