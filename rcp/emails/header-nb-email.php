<?php
/**
 * Email Header for the Default Template
 *
 * For modifying this template, please see: http://docs.restrictcontentpro.com/article/1738-template-files
 *
 * @package     Restrict Content Pro
 * @subpackage  Templates/Emails/Header
 * @copyright   Copyright (c) 2017, Restrict Content Pro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       2.7
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

global $rcp_options;

$header_img  = isset( $rcp_options['email_header_img'] ) ? trim( $rcp_options['email_header_img'] ) : '';
$header_text = isset( $rcp_options['email_header_text'] ) ? trim( $rcp_options['email_header_text'] ) : '';
?>


<html lang="en-US" style="margin:0;padding:0">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="telephone=no" />
	
	<title><?php echo get_bloginfo( 'name' ); ?></title>
	
<style type="text/css">
		@media screen and (max-width: 480px) {
			.nn_button {width:100% !important;}
		}
  @media screen and (max-width: 599px) {
			.nn_header {
				padding: 10px 20px;
			}
			.nn_button {
				width: 100% !important;
				padding: 5px 0 !important;
				box-sizing:border-box !important;
			}
			div, .nn_cols-two, .nn_cols-three {
				max-width: 100% !important;
			}
		}
</style>
	<!--[if !mso]><![endif]--><link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,700,700i" rel="stylesheet" /><!--<![endif]-->
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="margin:0;padding:0;background-color:#f1cb60">
<table class="nn_template" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
  <tbody> 
	<tr>
	  <td class="nn_preheader" style="border-collapse:collapse;display:none;visibility:hidden;mso-hide:all;font-size:1px;color:#333333;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden;-webkit-text-size-adjust:none" height="1">
	  	<?php echo $header_text; ?>
	  </td>
	</tr>
	<tr>
	  <td align="center" class="mailpoet-wrapper" valign="top" style="border-collapse:collapse;background-color:#f1cb60">
		<!--[if mso]>
		<table align="center" border="0" cellspacing="0" cellpadding="0" width="660">
		  <tr>
			<td class="nn_content-wrapper" align="center" valign="top" width="660">
			<![endif]-->
			<table class="nn_content-wrapper" border="0" width="660" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#fcfbff;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;max-width:660px;width:100%">
			  <tbody>              
				  <tr>
					<td class="nn_content" align="center" style="border-collapse:collapse;background:#ffffff url(https://www.trainingdoulas.com/wp-content/uploads/sites/4/2017/12/floral_bg_yellow_home.png) no-repeat center/cover;background-color:#ffffff;background-image:url(https://www.trainingdoulas.com/wp-content/uploads/sites/4/2017/12/floral_bg_yellow_home.png);background-repeat:no-repeat;background-position:center;background-size:cover">
					  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
						<tbody>
						  <tr>
							<td style="border-collapse:collapse;padding-left:0;padding-right:0">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="nn_cols-one" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0">
								<tbody>
								  <tr>
									<td class="nn_spacer" bgcolor="#f1cb60" height="26" valign="top" style="border-collapse:collapse"></td>
								  </tr>
								  <tr>
									<td class="nn_image nn_padded_vertical nn_padded_side" align="center" valign="top" style="border-collapse:collapse;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px">
									  <img src="https://www.trainingdoulas.com/wp-content/uploads/sites/4/2017/05/NBDT-Logo-2017-Final.png" width="400" alt="NBDT-Logo-2017-Final" style="height:auto;max-width:100%;-ms-interpolation-mode:bicubic;border:0;display:block;outline:none;text-align:center" />
									</td>
								  </tr>
								</tbody>
							  </table>
							</td>
						  </tr>
						</tbody>
					  </table>
					</td>
				  </tr>
				  <tr>
					<td class="nn_content" align="center" style="border-collapse:collapse;background-color:#ac1b5c!important" bgcolor="#ac1b5c">
					  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
						<tbody>
						  <tr>
							<td style="border-collapse:collapse;padding-left:0;padding-right:0">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="nn_cols-one" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0">
								<tbody>
								  <tr>
									<td class="nn_text nn_padded_vertical nn_padded_side" valign="top" style="border-collapse:collapse;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;word-break:break-word;word-wrap:break-word">
									  <h3 style="margin:0 0 6px;mso-ansi-font-size:20px;color:#fcfbff;font-family:Raleway,\'Century Gothic\',CenturyGothic,AppleGothic,sans-serif;font-size:20px;line-height:32px;mso-line-height-alt:32px;margin-bottom:0;text-align:center;padding:0;font-style:normal;font-weight:normal"><!--empty header--></h3>
									</td>
								  </tr>
								  <tr>
									<td class="nn_spacer" bgcolor="#fcfbff" height="40" valign="top" style="border-collapse:collapse"></td>
								  </tr>
								</tbody>
							  </table>
							</td>
						  </tr>
						</tbody>
					  </table>
					</td>
				  </tr>
				  <tr> 
				  <td class="nn_content" align="center" style="border-collapse:collapse">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
					  <tbody>
						<tr>
						  <td style="border-collapse:collapse;padding-left:0;padding-right:0">
							<table width="100%" border="0" cellpadding="0" cellspacing="0" class="nn_cols-one" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0">
							  <tbody>
								<tr> 
									<td class="nn_text nn_padded_vertical nn_padded_side" valign="top" style="border-collapse:collapse;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;word-break:break-word;word-wrap:break-word; font-family:Raleway,CenturyGothic,AppleGothic,sans-serif;">
									 	<!-- end HEADER TEMPLATE -->