<?php


namespace JB_SIF;


function print_admin_field() {
	/**
	 * @var \WC_Product
	 * @see https://docs.woocommerce.com/wc-apidocs/source-class-WC_Meta_Box_Product_Data.html#42
	 */
	global $product_object; // @see https://docs.woocommerce.com/wc-apidocs/source-class-WC_Meta_Box_Product_Data.html#42

	//	@todo: Make sure this is a Simple product.
	
	if( $product_object->get_type() == 'simple' ) {
	

		$field = [
			'id' 			=> 'sif_ships_in',
			'label'			=> __('Ships In', 'jb-sif'),
			'placeholder' 	=> __('example: 1-2 days', 'jb-sif'),
			'value'			=> get_post_meta( $product_object->get_id(), '_sif_ships_in', true ),
			'description'   => __( 'Add a "Ships in X" message below the Product Meta on the single-product page.', 'jb-sif'),
			'desc_tip'		=> true
		];

		\woocommerce_wp_text_input( $field );
	}
}

add_action( 'woocommerce_product_options_shipping', 'JB_SIF\print_admin_field');


function save( $post_id ) {

	// check nonce
	if( ! ( isset( $_POST['woocommerce_meta_nonce'], $_POST['sif_ships_in'] ) || wp_verify_nonce( sanitize_key( $_POST['woocommerce_meta_nonce'] ), 'woocommerce_save_data' ) ) ) {
		return false;
	}

	update_post_meta( $post_id, '_sif_ships_in', sanitize_text_field( $_POST['sif_ships_in'] ) );

}
add_action( 'woocommerce_process_product_meta_simple', 'JB_SIF\save' );



function print_output() {

	global $product;
		//		get_post_meta( $product->get_id(), '_sif_ships_in', true )
	$ships_in = get_post_meta( $product->get_id(), '_sif_ships_in', true );


	if( !empty( $ships_in )): ?>
		<div class="product_meta"><?php echo sprintf( __( 'Ships in %s.', 'jb-sif' ), $ships_in ); ?></div>

	<?php endif;

}
add_action( 'woocommerce_single_product_summary', 'JB_SIF\print_output', 45 );