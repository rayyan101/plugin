<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
    /**
	* Class CPF_SHORTCODE.
	*/
	class CFP_shortcode {
		/**
		 *  Constructor.
		 */
        public function __construct() {
            add_shortcode( 'movie_list',array($this, "shortcode_movie_post_type") );
        }
        /**
		 *  Shortcode Function.
		 */
        public function shortcode_movie_post_type()
        {
            $curentpage = get_query_var('paged');
            $args = array(
                            'post_type'      => 'movie',
                            'posts_per_page' => '2',
                            'publish_status' => 'published',
                            'paged' => $curentpage
                    );
            $query = new WP_Query($args); 
        
            $result = '';
            if($query->have_posts()) :   
                while($query->have_posts()) :
                    $query->the_post();  
                    $result = $result . "<h2>" . get_the_title() . "</h2>";
                    $result = $result . get_the_post_thumbnail();
                    $result = $result . "<p>" . get_the_content() . "</p>";
                endwhile;
        
                echo paginate_links(array(
                    'total' => $query->max_num_pages
                )); 
            endif;   
            return $result;          
        } }
    new CFP_shortcode();
?>


