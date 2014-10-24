<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: liveleak_media_bbcode.php
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

// Liveleak
insert_media_bbcode(
	array(
		'liveleak' => array(
			'mainSite' => 'http://www.liveleak.com',
			'baseUrl' => array(
				'www.liveleak.com/view?i=',
				'www.liveleak.com/e/'
			),
			'uriRegex' => id('videoid', ALPHANUM)
		)
	)
);
// Output replacement template
function replace_liveleak_template($m) {
	$width = (!empty($m["width"]) && $m["width"] < 854) ? $m["width"] : "560";
	$height = (!empty($m["height"]) && $m["height"] < 481) ? $m["height"] : "315";
	return "<iframe width='".$width."' height='".$height."' src='http://www.liveleak.com/e/".$m["videoid"]."' frameborder='0' allowfullscreen></iframe>";
}

?>