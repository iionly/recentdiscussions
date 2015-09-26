<?php

/**
 * Elgg RecentDiscussions
 *
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jean-Baptiste Perriot <jb@perriot.fr>
 *
 * for Elgg 1.9 and newer by iionly
 * (c) iionly 2012
 * iionly@gmx.de
 */

$widget = elgg_extract("entity", $vars);

// get widget settings
$max_topics = (int) $widget->recentdiscussions_count;
if ($max_topics < 1) {
	$max_topics = 10;
}

$sortedposts = array();

$lastposts = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'discussion',
	'order_by' => 'e.last_action desc',
	'limit' => $max_topics,
));

if ($lastposts) {
	foreach ($lastposts as $lastpost) {
		$topicid = $lastpost->getGUID();
		$container = $lastpost->getContainerEntity();

		if ($container) {
			$containerid = $container->getGUID();

			if (!array_key_exists($containerid, $sortedposts)) {
				$sortedposts[$containerid] = array();
			}
			array_push($sortedposts[$containerid], $lastpost);
		}
	}
}

// Pass it to the view
echo elgg_view("recentdiscussions/topic", array("discussionposts" => $sortedposts));
