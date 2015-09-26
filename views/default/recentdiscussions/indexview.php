<?php

$sortedposts = array();

$lastposts = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'discussion',
	'order_by' => 'e.last_action desc',
	'limit' => 10,
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
