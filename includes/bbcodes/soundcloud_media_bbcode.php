<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: soundcloud_media_bbcode.php
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

// Soundcloud
insert_media_bbcode(
	array(
		'soundcloud' => array(
			'mainSite' => 'http://soundcloud.com',
			'baseUrl' => 'soundcloud.com/',
			'uriRegex' => id('userid', ALPHANUM)."\/".id('videoid', ALPHANUM)
		)
	)
);
// Output replacement template
function replace_soundcloud_template($m) {
	$width = (!empty($m["width"]) && $m["width"] < 600) ? $m["width"] : "600";
	$height = (!empty($m["height"]) && $m["height"] < 450) ? $m["height"] : "126";
	// Old method of embeding, is cleaner but no width and height support for this one
	return "<object width='100%' height='81'><param name='movie' value='http://player.soundcloud.com/player.swf?url=".urlencode("https://soundcloud.com/".$m["userid"]."/".$m["videoid"])."'></param><param name='allowscriptaccess' value='always'></param><embed width='100%' height='81' src='http://player.soundcloud.com/player.swf?url=".urlencode("https://soundcloud.com/".$m["userid"]."/".$m["videoid"])."' allowscriptaccess='always' type='application/x-shockwave-flash'></embed></object>";
	// The new iframe embeding method
	//return "<iframe width='".$width."' height='".$height."' scrolling='no' frameborder='no' src='https://w.soundcloud.com/player/?show_artwork=false&url=".urlencode("https://soundcloud.com/".$m["userid"]."/".$m["videoid"])."'></iframe>";
}

?>