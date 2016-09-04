<?php
/*
** Plugin Name: Multi Step Checkout For Woocommerce
** Plugin URI: www.phoeniixx.com
** Version:1.0
** Author: phoeniixx
** Text Domain: multi-step-ckeckout-for-woocommerce
** Author URI: http://www.phoeniixx.com/
** Description: Convert your checkout page into multisteps- Login, Billing, Shipping, Review Orders, Payments
*/


	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
	{
		
		add_action('wp_head','phoen_frontend_assestss');
		
		function phoen_frontend_assestss(){
				
			wp_enqueue_script( 'phoen-multi-checkout-script-name', plugin_dir_url(__FILE__)."assets/js/phoen_multi_checkout.js" , array( 'jquery' ),true );
			
			if(is_user_logged_in()):?>
				<script>
					var pmsc_user_login = 'user_login';
				
				</script>
			<?php else: ?>		
				<script>
					
					var pmsc_user_login = '';
				
				</script>
			<?php endif;

			?>
				<style >
					.woocommerce ul.pmsc_tabs li {
						    display: inline-block;
						    list-style: outside none none;
						    padding: 0 19px 0 0;
					}

					.woocommerce ul.pmsc_tabs li.selected {
					    color: #22b5fb;
					}

				</style>
			<?php
			
		}
		
		function pmsc_activate() {

			$phoen_checkout_enable_settings = get_option('phoen_checkout_enable');
			
			if($phoen_checkout_enable_settings == ''){
				
				update_option('phoen_checkout_enable',1);
				
			}
		}
		
		register_activation_hook( __FILE__, 'pmsc_activate' );
		
		
		function phoen_multistep_checkout_plug_dir() { 
 
		  // gets the absolute path to this plugin directory
		 
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		 
		}
			
		$phoen_checkout_enable_settings = get_option('phoen_checkout_enable');
		
		if(isset($phoen_checkout_enable_settings) && $phoen_checkout_enable_settings == 1)
		{
			add_filter( 'woocommerce_locate_template', 'phoen_multistep_checkout_plug_locate_template', 20, 3 );
		
		}
 
			function phoen_multistep_checkout_plug_locate_template( $template, $template_name, $template_path ) {
			 
			  global $woocommerce;
			 
			  $_template = $template;
			 
			  if ( ! $template_path ) $template_path = $woocommerce->template_url;
			 
			  $plugin_path  = phoen_multistep_checkout_plug_dir() . '/woocommerce/';

			  // Look within passed path within the theme - this is priority
			 
			  $template = locate_template(
			 
				array(
			 
				  $template_path . $template_name,
			 
				  $template_name
			 
				)
			 
			  );
			 
				$path = WP_PLUGIN_DIR;
				
				$results = scandir($path);
					
					
				if ( file_exists( $plugin_path . $template_name ) )
				{

					$template = $plugin_path . $template_name;
					
				}
				else if(!$template)
				{

						foreach ($results as $result) {
						
							if( $result != 'woocommerce' )
							{
								if ($result === '.' or $result === '..') continue;

									if (is_dir($path . '/' . $result)) {
										
											if ( file_exists( WP_PLUGIN_DIR.'/'.$result.'/woocommerce/'.$template_name ) )
											{

												$template =WP_PLUGIN_DIR.'/'.$result.'/woocommerce/'.$template_name;
												
												break;
												
											}
											else if ( file_exists( WP_PLUGIN_DIR.'/'.$result.'/templates/'.$template_name ) )
											{
												
												//echo 'if';
												
												$template =WP_PLUGIN_DIR.'/'.$result.'/templates/'.$template_name;
												
												break;
												
											}
											else
											{
											
												$template = ABSPATH.str_replace(site_url()."/","",plugins_url())."/".'woocommerce/templates/' . $template_name;
												
											}
										
									}
								
							}
						
						}
				}
				else
				{

					$template;
					
				}
				
				return $template;
			 
			}
			
			

		remove_action('woocommerce_before_checkout_form','woocommerce_checkout_login_form',10);
		remove_action('woocommerce_before_checkout_form','woocommerce_checkout_coupon_form',10);
		
		remove_action('woocommerce_checkout_order_review','woocommerce_order_review',10);
		remove_action('woocommerce_checkout_order_review','woocommerce_checkout_payment',20);
		
		add_action('phoen_before_checkout_login_form','woocommerce_checkout_login_form',10);
		add_action('phoen_before_checkout_coupan_form','woocommerce_checkout_coupon_form',10);
		
		add_action( 'phoen_checkout_order_review', 'woocommerce_order_review', 10 );
		add_action( 'phoen_checkout_order_payment', 'woocommerce_checkout_payment', 20 );
		
		add_action('admin_menu', 'phoe_checkout_menu');
		
		function phoe_checkout_menu() {
		   
			add_menu_page('muli_step_checkout', 'Multi Step Checkout' ,'manage_options','muli_step_checkout','phoe_multi_step_checkout', plugin_dir_url( __FILE__ ).'assets/images/aa2.png');
		   
		}
		
		function phoe_multi_step_checkout(){
		?>
			<div id="profile-page" class="wrap">
    
				<?php
					
				if(isset($_GET['tab']))
						
				{
					$tab = sanitize_text_field( $_GET['tab'] );
					
				}
				
				else
					
				{
					
					$tab="";
					
				}
				
				?>
				<h2> <?php _e('General Settings','multi-step-ckeckout-for-woocommerce'); ?></h2>
				
				<?php $tab = (isset($_GET['tab']))?$_GET['tab']:'';?>
				
				<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
				
					<a class="nav-tab <?php if($tab == 'phoe_checkout_setting' || $tab == ''){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=muli_step_checkout&amp;tab=phoe_checkout_setting"><?php _e('Setting','multi-step-ckeckout-for-woocommerce'); ?></a>
					
					<a class="nav-tab <?php if($tab == 'premium_setting' ){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=muli_step_checkout&amp;tab=premium_setting"><?php _e('Premium','multi-step-ckeckout-for-woocommerce'); ?></a>
					
					
				</h2>
				
			</div>
        
			<?php
			
			if($tab=='phoe_checkout_setting'|| $tab == '' )
			{
				
			  include_once(plugin_dir_path(__FILE__).'includes/phoen_checkout_settings.php');
										
			}
			
			if($tab=='premium_setting' )
			{
				
			   include_once(plugin_dir_path(__FILE__).'includes/phoen_premium_settings.php');
									 
			}
			
        
			
		}
	
	}else{
		
		_e("Woocommerce Plugin Not Activated",'multi-step-ckeckout-for-woocommerce'); 
		
	}
	
	
	
?>
