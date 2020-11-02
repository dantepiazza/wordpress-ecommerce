<?php
	// @version 2.5.0

	if(!defined('ABSPATH')){ exit; }

	//@hooked WC_Emails::email_header() Output the email header

	do_action('woocommerce_email_header', $email_heading, $email);
?>

<p>Tu pedido est&aacute; en espera hasta que confirmemos que se ha recibido el pago. Los detalles del mismo se muestran a continuaci&oacute;n:</p>

<?php
	//@hooked WC_Emails::order_details() Shows the order details table.
	//@hooked WC_Structured_Data::generate_order_data() Generates structured data.
	//@hooked WC_Structured_Data::output_structured_data() Outputs structured data.

	do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email);

	//@hooked WC_Emails::order_meta() Shows order meta data.

	do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email);

	//@hooked WC_Emails::customer_details() Shows customer details
	//@hooked WC_Emails::email_address() Shows email address

	do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email);

	//@hooked WC_Emails::email_footer() Output the email footer

	do_action( 'woocommerce_email_footer', $email);	
?>