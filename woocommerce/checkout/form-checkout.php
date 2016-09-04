<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

//do_action( 'woocommerce_before_checkout_form', $checkout );

?>
	
	
	<ul class="pmsc_tabs">

	<?php 
	
		
		if(!is_user_logged_in()):$pmsc_no_login = "class='selected'";
		else:$pmsc_login = "none";$pmsc_select_div = "class='selected'";
		endif;?>	
		
		<li style="display:<?php echo (isset($pmsc_login) && !empty($pmsc_login))?$pmsc_login:''; ?>;" <?php echo (isset($pmsc_no_login) && !empty($pmsc_no_login))?$pmsc_no_login:'';?> data-step="0"><?php _e( 'Login', 'multi-step-ckeckout-for-woocommerce' ); ?></li>
		
		<li <?php echo (isset($pmsc_select_div) && !empty($pmsc_select_div))?$pmsc_select_div:''; ?> data-step='1'><?php _e( 'Billing', 'multi-step-ckeckout-for-woocommerce' ); ?></li>
			
		<li  data-step='2'><?php _e( 'Shipping', 'multi-step-ckeckout-for-woocommerce' ); ?></li>
		
		<li  data-step='3'><?php _e( 'Order Info', 'multi-step-ckeckout-for-woocommerce' ); ?></li>
		
		<li  data-step='4'><?php _e( 'Payment Info', 'multi-step-ckeckout-for-woocommerce' ); ?></li>

	</ul>
	
	<div class="login_form" id="pmsc_0">
			
		<?php 
			
			do_action('phoen_before_checkout_login_form');
		?>
	
	</div>
	
	<?php
	
		if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
			echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
			return;
		}
		
		?>
			
		<div class="pmsc_coupan_form" style="display:none;"> 
			
			<?php do_action('phoen_before_checkout_coupan_form');?>
		
		</div>
		

		<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
			
			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
				
				
				<div class="col-1_billing ui-tabs-panel" id='pmsc_1' style="display:none">
		
					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
			   
				</div>

				<div class="col-2_shipping ui-tabs-panel ui-tabs-hide" id="pmsc_2" style="display:none">
				
					<?php
				   
					do_action( 'woocommerce_before_checkout_shipping_form' );
					do_action( 'woocommerce_checkout_shipping' );
					do_action( 'woocommerce_checkout_after_customer_details' );
				   
				   ?>
			   </div>

				<?php endif; ?>

				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			   <div id="pmsc_3" class="woocommerce-checkout-review-order" style="display:none">
				   
				   <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
				   
				   <div class="coupan_form">
						
						<?php do_action( 'phoen_checkout_order_review' ); ?>

					</div>
					
					
					
					<input type="checkbox" name="payment_method" value="" data-order_button_text="" style="display: none;" />
				</div>
				
				<div class="ui-tabs-panel ui-tabs-hide " id="pmsc_4" style="display:none">
					
					<h3 id="phoen_order_review_heading"><?php _e( 'Payment Info', 'woocommerce' ); ?></h3>
					
					<?php do_action( 'phoen_checkout_order_payment' ); ?>
					
					
				</div>
			 
				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			
			
		</form>
		
		<div>
			<button name="prev" style="display:none" class="phoen_checkout_button_prev"><?php _e( 'Previous', 'multi-step-ckeckout-for-woocommerce' ); ?></button>
			<button name="next" class="phoen_checkout_butt_next"><?php _e( 'Continue', 'multi-step-ckeckout-for-woocommerce' ); ?></button>
		</div>
		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<style>	
	
	.selected{
		color:red;
	}

</style>