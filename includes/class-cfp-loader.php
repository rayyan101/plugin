<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
    /**
    * Class BTUC_Loader.
    */
    class CPF_Loader {
		/**
		 *  Constructor.
		 */
		public function __construct() {
			$this->includes();
			add_action( 'wp_enqueue_scripts', array( $this, 'btuc_enqueue_scripts' ) );
            add_action('wp_ajax_cpf_searching_data_cpt_movies' , array( $this, 'cpf_searching_data_cpt_movies'));
			add_action('wp_ajax_nopriv_cpf_searching_data_cpt_movies' , array( $this, 'cpf_searching_data_cpt_movies'));			
			add_action('wp_ajax_cpf_filter_data_cpt_movies' , array( $this, 'cpf_filter_data_cpt_movies'));
			add_action('wp_ajax_nopriv_cpf_filter_data_cpt_movies' , array( $this,'cpf_filter_data_cpt_movies'));
        }
		/**
		* Function for Including Files and Classes
        */
		public function includes() {
			include_once 'class-cfp-metabox.php';
            include_once 'class-cfp-cpt.php';
			include_once 'class-cfp-shortcode.php';
		}
        /**
		* Enqueue Script Files and Style Files .
        */
        public function btuc_enqueue_scripts() {
			wp_enqueue_script( 'custom_js',  plugin_dir_url( __DIR__ ). '/assets/js/custom.js',   array('jquery') , wp_rand() );
			wp_localize_script( 
				'custom_js', 
				'ajax_object', 
				array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) )
			);
			wp_enqueue_style( 'child-style', plugin_dir_url( __DIR__ ). '/assets/css/style.css');
			// wp_enqueue_style( 'parent_style', get_template_directory_uri() . '/style.css');
		}

		 /**
		*Ajax Post Seachring From CPT Movies
        */
		public function cpf_searching_data_cpt_movies() {
			$the_query = new WP_Query( array( 
				'posts_per_page' => 3, 
				's' => esc_attr( $_POST['keyword'] ), 
				'post_type' => array('movie') ) );
			if( $the_query->have_posts() ) :
				ob_start();
				while( $the_query->have_posts() ): $the_query->the_post();  ?>
					<div style="background-color: DBEFDB; border: 1px solid black; float:left; " class="col-4"> 
					<h1 style="text-align: center;"> <a style="align-items: center;" href=" <?php the_permalink(); ?> "> <?php the_title(); ?></a></h2></h1>
					<a href=" <?php the_permalink(); ?> ">  <?php the_post_thumbnail();?> </a>
					<p style="text-align: center;" ><?php the_content(); ?></p>
					<h5 style="text-align: center;"> <?php  $name = get_post_meta($post->ID,"wpl_actore_name",true) ?>
					<?php echo $name ?>
					</h5>
					<h6  style="text-align: center;"> <?php  $email = get_post_meta($post->ID,"wpl_actore_email",true) ?>
					<?php echo $email ?> </h6>  </div>  
				<?php  
				endwhile; 
				$output_string = ob_get_contents();
				ob_end_clean();
				wp_die($output_string); 
				wp_reset_postdata(); 
			endif;
			die();
		} 
		/**
		*Ajax Post Filter From CPT Movies
        */
		function cpf_filter_data_cpt_movies() { 
			$order = "ASC";
			$orderby = "title";	
		
			if($_POST["keyword"] == "asc") {
			$order = 'ASC';
			} 
			if($_POST["keyword"] == "desc") {
			$order = 'DESC';
			}  
			if($_POST["keyword"] == "old") {
				$orderby = 'date';
				$order = 'ASC';
			}
			if($_POST["keyword"] == "new") {
				$orderby = 'date';
				$order = 'DESC';
			} 
			
			$args = array( 
				'post_status' => 'publish',
				'orderby' => $orderby,
				'order' => $order,
				'posts_per_page' => '3',
				'post_type' => array('movie') );
		
			$the_query = new WP_Query( $args );
			if( $the_query->have_posts() ) :
				ob_start();
				while( $the_query->have_posts() ): $the_query->the_post();  ?>
				
					<div style="background-color: DBEFDB; border: 1px solid black; float:left; " class="col-4"> 
					<h1 style="text-align: center;"> <a style="align-items: center;" href=" <?php the_permalink(); ?> "> <?php the_title(); ?></a></h2></h1>
					<a href=" <?php the_permalink(); ?> ">  <?php the_post_thumbnail();?> </a>
					<p style="text-align: center;" ><?php the_content(); ?></p>
					<h5 style="text-align: center;"> <?php  $name = get_post_meta($post->ID,"wpl_actore_name",true) ?>
					<?php echo $name ?>
					</h5>
					<h6  style="text-align: center;"> <?php  $email = get_post_meta($post->ID,"wpl_actore_email",true) ?>
					<?php echo $email ?> </h6>  </div>  
				<?php  
				endwhile; 
				$output_string = ob_get_contents();
				ob_end_clean();
				wp_die($output_string); 
				wp_reset_postdata(); 
		
			endif;
			die();
			}
}
new CPF_Loader();
?>