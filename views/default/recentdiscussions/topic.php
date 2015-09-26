<?php

$discussionposts = $vars['discussionposts'];

$info = '';
if ($discussionposts) {
	$info .= "<ul class='recentdiscussions-list'>";
	foreach (array_keys($discussionposts) as $containerid) {
		$info .= "<li class='mts'>";
		$container = get_entity($containerid);
		if (elgg_instanceof($container, 'object')) {
			$info .= "<h3><a href='" . $container->getURL() . "'>" . $container->title . "</a></h3>";
		} else {
			$info .= "<h3><a href='" . $container->getURL() . "'>" . $container->name . "</a></h3>";
		}

		$info .= "<ul class='recentdiscussions-list mll'>";
		foreach ($discussionposts[$containerid] as $topic) {
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
