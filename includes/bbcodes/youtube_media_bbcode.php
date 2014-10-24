<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: youtube_media_bbcode.php
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

// Youtube
insert_media_bbcode(
	array(
		'youtube' => array(
			'mainSite' => 'http://www.youtube.com',
			'baseUrl' => array(
				'www.youtu.be/',
				'www.youtube.com/v/',
				'www.youtube.com/watch?v='
			),
			'uriRegex' => id('videoid', ALPHANUM)."((&|&amp;|\?)start=".id('start', NUM).")?"
		)
	)
);
// Output replacement template
function replace_youtube_template($m) {
	//var_dump($m);
	$width = (!empty($m["width"]) && $m["width"] < 854) ? $m["width"] : "560";
	$height = (!empty($m["height"]) && $m["height"] < 481) ? $m["height"] : "315";
	$start = (isset($m["start"])) ? "?start=".$m["start"] : "";

	return "<iframe width='".$width."' height='".$height."' src='//www.youtube.com/v/".$m["videoid"].$start."' frameborder='0' allowfullscreen></iframe>";
}

?>