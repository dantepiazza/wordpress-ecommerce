<?php
	// @version 2.5.0

	if(!defined('ABSPATH')){ exit; }

	echo("= ".$email_heading." =\n\n");

	if($order -> has_status('pending')){
		echo('Se te ha generado un pedido en '.get_bloginfo('name', 'display').'. Para pagarlo, utiliza el siguiente enlace: '.$order -> get_checkout_payment_url().'\n\n');
	}

	echo("=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n");

	//@hooked WC_Emails::order_details() Shows the order details table.
	//@hooked WC_Structured_Data::generate_order_data() Generates structured data.
	//@hooked WC_Structured_Data::output_structured_data() Outputs structured data.

	do_action('woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email);

	echo("\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n");

	//@hooked WC_Emails::order_meta() Shows order meta data.

	do_action('woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email);

	//@hooked WC_Emails::customer_details() Shows customer details
	//@hooked WC_Emails::email_address() Shows email address

	do_action('woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email);

	echo("\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n");

	echo(apply_filters('woocommerce_email_footer_text', get_option('woocommerce_email_footer_text')));