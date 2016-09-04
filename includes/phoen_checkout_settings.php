<?php
	
if ( ! empty( $_POST ) && check_admin_referer( 'phoen_checkout_function', 'phoen_checkout_nonce_field' ) ) {
	
	if(isset($_POST['phoen_set_checkout']) && $_POST['phoen_set_checkout'] == 'Save changes')
	{
		
		if(isset($_POST['phoen_checkouts_enable'])){
			
			$phoen_enable = sanitize_text_field($_POST['phoen_checkouts_enable']);
			
			
		}else{
			
			$phoen_enable = '';
		}
		
		update_option('phoen_checkout_enable',$phoen_enable);	
	}
	
}
		
$phoen_checkout_enable_settings = get_option('phoen_checkout_enable');
		
?>
		
<form method="post">

	<?php wp_nonce_field( 'phoen_checkout_function', 'phoen_checkout_nonce_field' ); ?>

	<table class="form-table">

		<tbody>
		
			<tr class="phoen-user-user-login-wrap">
			
				<th><label for="phoen_checkout_enable_settings"><?php _e("Enable Checkout Plugin",'multi-step-ckeckout-for-woocommerce'); ?></label></th>
			
				<td>
				
					<input type="checkbox" value="1" <?php echo(isset($phoen_checkout_enable_settings) && $phoen_checkout_enable_settings == '1')?'checked':'';?> name="phoen_checkouts_enable">
					
				</td>
			
			</tr>
			
			
		</tbody>
		
	</table>
	<br />
	<input type="submit" value="Save changes" class="button-primary" name="phoen_set_checkout">
	
</form>
		
<style>

	.form-table th {
	
		width: 270px;
		
		padding: 25px;
		
	}
	
	.form-table td {
	
		padding: 20px 10px;
	}
	
	.form-table {
	
		background-color: #fff;
	}
	
	h3 {
	
		padding: 10px;
		
	}

</style>
	