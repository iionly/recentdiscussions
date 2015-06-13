<?php

$groupsposts = $vars['groupsposts'];

$info = '';
if ($groupsposts) {
	$info .= "<ul class='recentdiscussions-list'>";
	foreach (array_keys($groupsposts) as $groupid) {
		$info .= "<li class='mts'>";
		$group = get_entity($groupid);
		$info .= "<h3><a href='" . $group->getURL() . "'>" . elgg_echo('group') . " " . $group->name . "</a></h3>";

		$info .= "<ul class='recentdiscussions-list mll'>";
		foreach ($groupsposts[$groupid] as $topic) {
			$info .= "<li class='mts pbs'><a href='" . elgg_get_site_url() . "discussion/view/" . $topic->guid . "'>" . $topic->title . "</a></li>";
		}
		$info .= "</ul>";
		$info .= "</li>";
	}
	$info .= "</ul>";
} else {
	$info = '<p>' . elgg_echo('recentdiscussions:none') . '</p>';
}

echo $info;
