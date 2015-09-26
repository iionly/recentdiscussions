<?php

/**
 * This plugin adds a widget that lists all the group discussions in which a user recently took part in.
 *
 * @package ElggOnline
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @Author Jean-Baptiste Perriot <jb@perriot.fr>
 *
 * for Elgg 1.9 and newer by iionly
 * (c) iionly 2012
 * iionly@gmx.de
 */

elgg_register_event_handler('init','system','recentdiscussions_init');

function recentdiscussions_init() {

	elgg_extend_view('css/elgg', 'recentdiscussions/css');

	//add a widget
	elgg_register_widget_type('recentdiscussions', elgg_echo('recentdiscussions:title'), elgg_echo('recentdiscussions:widget:description'));

	//add a index widget for Widget Manager plugin
	elgg_register_widget_type('index_recentdiscussions', elgg_echo('recentdiscussions:title'), elgg_echo('recentdiscussions:widget:description'), array("index"));
	
	//register title urls for widgets
	elgg_register_plugin_hook_handler("entity:url", "object", "recentdiscussions_widget_urls");

	// Register for index page
	elgg_extend_view('index/recentdiscussions', 'recentdiscussions/indexview');
}

function recentdiscussions_widget_urls($hook_name, $entity_type, $return_value, $params){
	$result = $return_value;
	$widget = $params["entity"];

	if(empty($result) && ($widget instanceof ElggWidget)) {
		$owner = $widget->getOwnerEntity();
		switch($widget->handler) {
			case "recentdiscussions":
				$result = "discussion/owner/" . $owner->guid;
				break;
			case "index_recentdiscussions":
				$result = "discussion/all";
				break;
		}
	}
	return $result;
}
