<?php
// Avoid caching
header('Cache-Control: no-cache, no-store, must-revalidate, pre-check=0, post-check=0, max-age=0, s-maxage=0');

// Redirect to the last unsolved level
$lastLevel = sizeof($tokenData['starttime']);
if ($lastLevel > 1 && $lastLevel != $level) {
	notfound();
}

$currentLevel = $levels[$level - 1];

// Include level specific action
include(ABSPATH . 'modules/level/' . $level . '.php');

if (isset($currentLevel['error'])) {
	$currentLevel['error'] = '<p id=error-message>' . $currentLevel['error'];
} else {
	$currentLevel['error'] = '';
}

if (!isset($currentLevel['username'])) {
	$currentLevel['username'] = '';
}

if (!isset($currentLevel['password'])) {
	$currentLevel['password'] = '';
}

if (!isset($currentLevel['footer'])) {
	$currentLevel['footer'] = '';
}

$completenessMeter['class'] = 'level' . $level;
$completenessMeter['message'] = 'You completed <strong>' . ($level - 1) . '</strong> out of <strong>' . $totalLevels . '</strong> levels' . '<span id=buttons><a href={base_uri} title="Return to homepage to take a break.">Take a break</a> <a href={base_uri}reset title="Reset your progress">Reset</a></span>';

$tpl = file_get_contents(TPLPATH . 'pages/level.html');
$tpl = str_replace('{message}' , $currentLevel['message'], $tpl);
$tpl = str_replace('{error}' , $currentLevel['error'], $tpl);
$tpl = str_replace('{username_value}' , $currentLevel['username'], $tpl);
$tpl = str_replace('{password_value}' , $currentLevel['password'], $tpl);
$tpl = str_replace('{lesson}' , $currentLevel['lesson'], $tpl);
$tpl = str_replace('{footer}' , $currentLevel['footer'], $tpl);

$title = 'Level <em id=level-number>' . $currentLevel['label'] . '</em>: ' . $currentLevel['title'];
array_push($content, $tpl);
