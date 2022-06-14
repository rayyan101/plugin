<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
    /**
	 * Class CPF_CPT.
	 */
	class CFP_CPT {

		/**
		 *  Constructor.
		 */
		public function __construct() {

            add_action( 'init', array( $this, 'cpf_movies_post_type'));
            add_filter( 'archive_template',  array( $this, 'cfp_movies_archive_template') ) ;
            add_filter('single_template', array( $this, 'cfp_movies_single_template'));
        }
        /**
		*  Custom Post Type Function.
		*/
        public function cpf_movies_post_type(){
            $labels = array(
                'name'                  => __( 'movies'),
                'singular_name'         => __( 'movie'),
                'menu_name'             => __( 'movies'),
                'name_admin_bar'        => __( 'movie'),
                'add_new'               => __( 'Add New'),
                'add_new_item'          => __( 'Add New movie'),
                'new_item'              => __( 'New movie'),
                'edit_item'             => __( 'Edit movie'),
                'view_item'             => __( 'View movie'),
                'all_items'             => __( 'All movies'),
                'search_items'          => __( 'Search movies'),
                'parent_item_colon'     => __( 'Parent movies:'),
                'not_found'             => __( 'No movies found.'),
                'not_found_in_trash'    => __( 'No movies found in Trash.'),
                'featured_image'        => __( 'movie Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'movie' ),
                'set_featured_image'    => __( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'movie' ),
                'remove_featured_image' => __( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'movie' ),
                'use_featured_image'    => __( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'movie' ),
                'archives'              => __( 'movie archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'movie' ),
                'insert_into_item'      => __( 'Insert into movie', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'movie' ),
                'uploaded_to_this_item' => __( 'Uploaded to this movie', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'movie' ),
                'filter_items_list'     => __( 'Filter movies list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'movie' ),
                'items_list_navigation' => __( 'movies list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'movie' ),
                'items_list'            => __( 'movies list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'movie' ),
            );     
            $args = array(
                'labels'             => $labels,
                'description'        => 'movie custom post type.',
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'movie' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => 20,
                'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
                'taxonomies'         => array( 'category', 'post_tag' ),
                'show_in_rest'       => true
            );
            register_post_type( 'movie', $args );
        } 
        /**
        *  Path of Archive Page For CPT Movie.
		*/ 
        public function cfp_movies_archive_template( $archive_template ) {
        if ( is_post_type_archive ( 'movie' ) ) {
            $archive_template = CPF_ABSPATH . '/templete/archive-movie.php';
            }
            return $archive_template;
        }
        /**
        *  Path of SIngle Page For CPT Movie.
		*/ 
        function cfp_movies_single_template($single) {
         global $post;
        /* Checks for single template by post type */
        if ( $post->post_type == 'movie' ) {
        if ( file_exists( CPF_ABSPATH . '/templete/single-movie.php' ) ) {
            return CPF_ABSPATH . '/templete/single-movie.php';
        }
    }
    return $single;
}     
    }
    new CFP_CPT();
?>