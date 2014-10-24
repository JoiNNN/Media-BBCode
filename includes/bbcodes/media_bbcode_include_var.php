<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: media_bbcode_include_var.php
| Author: JoiNNNN
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Access Denied"); }

$__BBCODE__[] =
array(
	"description" => 'Displays multimedia content from different sites',
	"value" => "!media",
	"bbcode_start" => "[media]",
	"bbcode_end" => "[/media]",
	"usage" => "[media(=width,height)]Media link[/media]",
);

if (!empty($_GET['mediaSites'])) {
	function media_sites($sites) {
		$html = "";
		$last_key = array_keys($sites);
		$last_key = array_pop($last_key);
		foreach ($sites as $siteID => $link) {
			$html .= "<a href='$link' title='$link' target='_blank'>".ucfirst($siteID)."</a>".($last_key == $siteID ? "." : ", ");
		}

		return $html;
	}

	$last_key = array_keys($__BBCODE__);
	$last_key = array_pop($last_key);
	$__BBCODE__[$last_key]['html_start'] = form_modal('media', 'Media', '', array(	'button_class' => 'bbcode',
																					'button_img' => 'entypo video',
																					'button_text' => '',
																					'hide_footer' => '1',
																					'htmlcode' => 'Insert media URL: <input type="text" id="media_input" class="form-control textbox" /><div class="well">You may insert content from these websites: '.media_sites($_GET['mediaSites']).'</div><hr><button id="insert_media" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Insert</button>'
																				)
											);
	$__BBCODE__[$last_key]['includejscript'] = "media_bbcode_include_js.js";
}

?>
