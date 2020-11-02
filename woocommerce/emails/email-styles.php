<?php
	// @version 2.3.0
	
	if ( ! defined( 'ABSPATH' ) ) exit;

	$bg = get_option('woocommerce_email_background_color');
	$body = get_option('woocommerce_email_body_background_color');
	$base = get_option('woocommerce_email_base_color');
	$base_text = wc_light_or_dark( $base, '#202020', '#ffffff');
	$text = get_option('woocommerce_email_text_color');

	$bg_darker_10 = wc_hex_darker($bg, 10);
	$body_darker_10 = wc_hex_darker($body, 10);
	$base_lighter_20 = wc_hex_lighter($base, 20);
	$base_lighter_40 = wc_hex_lighter($base, 40);
	$text_lighter_20 = wc_hex_lighter($text, 20);
?>

#body_content {
	font-family: Roboto, "Helvetica Neue", Helvetica, Arial, sans-serif;
	background-color: <?php echo(esc_attr($body)); ?>;
	font-size:14px;
	font-weight:300;
	line-height: 150%;
}
#body_content table.td{
	border:none;
	font-size:12px;
	color:<?php echo(esc_attr($text_lighter_20)); ?>;
}
#body_content table.td thead tr th,
#body_content table.td thead tr td,
#body_content table.td tfoot tr th,
#body_content table.td tfoot tr td {
	background-color:#eee;
	border:none;
}
#body_content table.td tbody tr th,
#body_content table.td tbody tr td{
	border:none !important;
}
#body_content table.td tr th,
#body_content table.td tr td{
	padding: 13px;
}

#body_content td ul.wc-item-meta {
	font-size: small;
	margin:15px 0;
	padding:0;
	list-style: none;
}
#body_content td ul.wc-item-meta li {
	margin:0;
	padding:0 5px;
}
#body_content td ul.wc-item-meta li p {
	margin: 0;
}

#body_content p {
	margin: 0 0 16px;
}

#body_content_inner {
	color:<?php echo(esc_attr($text_lighter_20)); ?>;
	
	text-align: <?php echo(is_rtl() ? 'right' : 'left'); ?>;
}
.td{
	border:none;
}
.text {
	color:<?php echo(esc_attr($text)); ?>;
	font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
}

.link {
	color:<?php echo(esc_attr($base)); ?>;
}

#header_wrapper{
	padding: 36px 48px;
	display: block;
}
h1{
	color: <?php echo(esc_attr($base)); ?>;
	font-family:Roboto, Arial, sans-serif;
	font-size:25px;
	font-weight:300;
	line-height:150%;
	margin:30px 0 0;
	text-align:<?php echo(is_rtl() ? 'right' : 'left'); ?>;
	text-shadow:0 1px 0 <?php echo(esc_attr($base_lighter_20)); ?>;
	-webkit-font-smoothing: antialiased;
}
h2{
	color:<?php echo(esc_attr($base)); ?>;
	display: block;
	font-family:Roboto, Arial, sans-serif;
	font-size:20px;
	font-weight:300;
	line-height:130%;
	margin: 40px 0 8px;
	text-align:<?php echo(is_rtl() ? 'right' : 'left'); ?>;
}
h3{
	color: <?php echo(esc_attr($base)); ?>;
	display: block;
	font-family:Roboto,Arial,sans-serif;
	font-size:16px;
	font-weight:300;
	line-height:130%;
	margin:16px 0 8px;
	text-align: <?php echo(is_rtl() ? 'right' : 'left'); ?>;
}
a{
	color:<?php echo(esc_attr($base)); ?>;
	font-weight: normal;
	text-decoration: underline;
}
img{
	border: none;
	display: inline;
	font-size: 14px;
	font-weight: bold;
	height: auto;
	line-height: 100%;
	outline: none;
	text-decoration: none;
	text-transform: capitalize;
}