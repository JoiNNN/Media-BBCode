<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: dailymotion_media_bbcode.php
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

// Dailymotion
insert_media_bbcode(
	array(
		'dailymotion' => array(
			'mainSite' => 'http://www.dailymotion.com',
			'baseUrl' => array(
				'dai.ly/',
				'www.dailymotion.com/video/'
			),
			'uriRegex' => id('videoid', ALPHANUM)."((&|&amp;|\?)start=".id('start', NUM).")?"
		)
	)
);
// Output replacement template
function replace_dailymotion_template($m) {
	$width = (!empty($m["width"]) && $m["width"] < 854) ? $m["width"] : "560";
	$height = (!empty($m["height"]) && $m["height"] < 481) ? $m["height"] : "315";
	$start = (isset($m["start"])) ? "?start=".$m["start"] : "";
	return "<iframe width='".$width."' height='".$height."' src='//www.dailymotion.com/embed/video/".$m["videoid"].$start."' frameborder='0' allowfullscreen></iframe>";
}

?>