<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: vimeo_media_bbcode.php
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

// Vimeo
insert_media_bbcode(
	array(
		'vimeo' => array(
			'mainSite' => 'http://vimeo.com',
			'baseUrl' => 'vimeo.com/', 
			'uriRegex' => id('videoid', ALPHANUM)
		)
	)
);
// Output replacement template
function replace_vimeo_template($m) {
	$width = (!empty($m["width"]) && $m["width"] < 854) ? $m["width"] : "560";
	$height = (!empty($m["height"]) && $m["height"] < 481) ? $m["height"] : "315";
	return "<iframe width='".$width."' height='".$height."' src='//player.vimeo.com/video/".$m["videoid"]."' frameborder='0' allowfullscreen></iframe>";
}

?>