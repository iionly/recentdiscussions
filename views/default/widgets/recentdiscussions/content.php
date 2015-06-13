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

$max_topics = $vars['entity']->num_display;
if (!$max_topics) {
	$max_topics = 10;
}

$ownerid = $vars['entity']->owner_guid;
$sortedposts = array();

$lastposts = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'groupforumtopic',
	'owner_guid' => $ownerid,
	'order_by' => 'e.last_action desc',
	'limit' => $max_topics,
));

if ($lastposts) {
	foreach ($lastposts as $lastpost) {
		$topicid = $lastpost->getGUID();
		$group = $lastpost->getContainerEntity();

		if ($group) {
			$groupid = $group->getGUID();

			if (!array_key_exists($groupid, $sortedposts)) {
				$sortedposts[$groupid] = array();
			}
			array_push($sortedposts[$groupid], $lastpost);
		}
	}
}

// Pass it to the view
echo elgg_view("recentdiscussions/topic", array("groupsposts" => $sortedposts));
