<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Vi_Wad_Draft_Product' ) ) {
	class Vi_Wad_Draft_Product {

		public function __construct() {
			add_action( 'init', array( $this, 'init' ) );

		}

		public function init() {
			/*Register post type*/
			$this->register_post_type();
			self::register_post_status();
		}
		public static function register_post_status() {
				register_post_status( 'override', array(
					'label'                     => _x( 'Override', 'Order status', 'woo-alidropship' ),
					'public'                    => true,
					'exclude_from_search'       => false,
					'show_in_admin_all_list'    => false,
					'show_in_admin_status_list' => false,
					/* translators: %s: number of orders */
					'label_count'               => '',
				) );
		}

		/**
		 * Register post type email
		 */
		protected function register_post_type() {
			if ( post_type_exists( 'vi_wad_draft_product' ) ) {
				return;
			}
			$labels = array(
				'name'               => __( 'Draft product', 'woo-alidropship' ),
				'singular_name'      => __( 'Draft product', 'woo-alidropship' ),
				'edit_item'          => __( 'Edit', 'woo-alidropship' ),
				'view_item'          => __( 'View', 'woo-alidropship' ),
				'all_items'          => __( 'All products', 'woo-alidropship' ),
				'search_items'       => __( 'Search product', 'woo-alidropship' ),
				'not_found'          => __( 'No draft product found.', 'woo-alidropship' ),
				'not_found_in_trash' => __( 'No draft product found in Trash.', 'woo-alidropship' )
			);
			$args   = array(
				'labels'              => $labels,
				'public'              => false,
				'publicly_queryable'  => false,
				'show_ui'             => false,
				'show_in_menu'        => false,
				'query_var'           => true,
//				'rewrite'             => array( 'slug' => 'email-subscribe' ),
				'capability_type'     => 'post',
				'capabilities'        => array(
					'create_posts' => false,
				),
				'map_meta_cap'        => true,
				'has_archive'         => false,
//				'taxonomies'          => array( 'wcb_email_campaign' ),
				'hierarchical'        => false,
				'menu_position'       => 2,
				'supports'            => array( 'title' ),
//				'menu_icon'           => "dashicons-products",
				'exclude_from_search' => true,
				'can_export' => false,
			);
			register_post_type( 'vi_wad_draft_product', $args );
		}
	}
}

new Vi_Wad_Draft_Product();