<?php

$sortedposts = array();

$lastposts = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'groupforumtopic',
	'order_by' => 'e.last_action desc',
	'limit' => 10,
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
