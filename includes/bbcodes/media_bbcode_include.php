<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: media_bbcode_include.php
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

// Check if this file was included already
if (!defined('MEDIA')) {
	define('MEDIA', TRUE);

	define('NUM', '[0-9]+');
	define('ALPHA', '[a-zA-Z]+');
	define('ALPHANUM', '[a-zA-Z0-9_-]+');

	$sites = array();
	$_GET['mediaSites'] = array();

	// Generates a regex name subpattern
	function id($name, $regex) {
		return "(?P<$name>$regex)";
	}

	// Add media sites to the array
	function insert_media_bbcode($array) {
		global $sites;

		$sites[] = $array;
	}

	// Include media bbcode extensions
	$enabled_media_bbcodes = array('youtube', 'vimeo', 'dailymotion', 'liveleak', 'soundcloud');
	if (!empty($enabled_media_bbcodes)) {
		foreach ($enabled_media_bbcodes as $bbcode) {
			if (preg_match('/[a-z0-9_-]+/i', $bbcode) && file_exists(INCLUDES.'bbcodes/'.$bbcode.'_media_bbcode.php')) {
				include_once(INCLUDES.'bbcodes/'.$bbcode.'_media_bbcode.php');
			}
		}
	}

	// The function that does all the magic stuff
	function replace_media($text) {
		global $sites;

		if (!empty($sites)) {
			// Loop through all media plugins
			foreach ($sites as $site) {
				foreach ($site as $siteID => $data) {
					//var_dump($data);
					// If there are more urls combine them into one to avoid looping over each url
					if (is_array($data['baseUrl'])) {
						foreach ($data['baseUrl'] as $key => $baseUrl) {
							$data['baseUrl'][$key] = preg_quote($data['baseUrl'][$key], "/");
						}
						$data['baseUrl'] = implode("|", $data['baseUrl']);
					} else {
						$data['baseUrl'] = preg_quote($data['baseUrl'], "/");
					}
					// Build the complete regex
					$media_regex = "#\[media(=".id('width', NUM)."(,".id('height', NUM).")?)?\](http(s)?:\/\/)?(".$data['baseUrl'].")(".$data['uriRegex'].")\[\/media\]#iU";

					//var_dump($media_regex);
					$_GET['mediaSites'][$siteID] = $data['mainSite'];
					if (function_exists('replace_'.$siteID.'_template')) {
						$text = preg_replace_callback($media_regex, 'replace_'.$siteID.'_template', $text);
					}
				}
			}
		}

		return $text;
	}
}

$text = replace_media($text);
?>