<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
    /**
	* Class CPF_CPT.
	*/
	class CFP_metabox {
		/**
		*  Constructor.
		*/
        public function __construct() {
            add_action("add_meta_boxes", array($this, "cfp_metabox_cpt_movies"));
            add_action("save_post", array($this, "cfp_metabox_cpt_movies_value_save"),10,2);
        }
        /**
		*  Register Metabox Function FOr CPT Movies.
		*/
        public function cfp_metabox_cpt_movies(){
            add_meta_box( "cpt-id", "Actores Details", array($this,"wpl_actor_call"),"movie","side","high");
        }

        public function wpl_actor_call($post){ ?>
        <p> <label> Name </label>
        <?php  $name = get_post_meta($post->ID,"wpl_actore_name",true) ?>
        <input type="text" value="<?php echo $name ?>" name="TxtActoreName" placeholder="name"/>
        </p>
        <p>
        <label> Email </label>
        <?php  $email = get_post_meta($post->ID,"wpl_actore_email",true) ?>
        <input type="email" value="<?php echo $email ?>" name="TxtActoreEmail" placeholder="email"/>
        </p> <?php
        }
        /**
		*  Getting data from metabox actore details (cpt movies)
		*/
        public function cfp_metabox_cpt_movies_value_save($post_id, $post){
            $TxtActoreName = isset($_POST['TxtActoreName'])?$_POST['TxtActoreName']:"";
            $TxtActoreEmail = isset($_POST['TxtActoreEmail'])?$_POST['TxtActoreEmail']:"";
        
            update_post_meta( $post_id,"wpl_actore_name",$TxtActoreName);
            update_post_meta( $post_id,"wpl_actore_email",$TxtActoreEmail);
        } }
    new CFP_metabox();
?>


