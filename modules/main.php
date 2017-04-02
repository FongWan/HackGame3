<?php
if (isset($tokenData)) {
	// Game has started
	$lastLevel = sizeof($tokenData['endtime']);
	$startButtonText = 'Continue';

	if ($totalLevels > $lastLevel) {
		$completenessMeter['class'] = 'level' . $lastLevel;
	} else {
		$completenessMeter['class'] = 'completed';
	}
	$completenessMeter['message'] = 'Continue&hellip;<span id=buttons><a href={base_uri}reset id=reset-button title="Reset your all progress">Reset</a></span>';
} else {
	// Game has not started
	$lastLevel = 0;
	$startButtonText = 'Start';
}

if (isset($_POST['start'])) {
	if (isset($_COOKIE['token_username'], $_COOKIE['token_password'], $_COOKIE['token_logged'])) {
		removeCookie('token_username');
		removeCookie('token_password');
		removeCookie('token_logged');
	}
	nextlevel($lastLevel);
}

// Display top 10 ranking
$rankings = array();
$rankingCacheFile = ABSPATH . 'cache/rank';
if (file_exists($rankingCacheFile)) {
	array_push($rankings, file_get_contents($rankingCacheFile));
}

// Check whether cache is read
if (1 > sizeof($rankings)) {
	// No cache, create ranking
	$maxRows = 15;
	$rankingPath = ABSPATH . 'cache/ranking/';
	$rankingSnippet = file_get_contents(TPLPATH . 'pages/main_ranking.html');
	if (false !== ($rankingFiles = scandir($rankingPath))) {
		$i = 0;
		sort($rankingFiles, SORT_NUMERIC);
		foreach ($rankingFiles as $rankingFile) {
			if ('.' != $rankingFile && '..' != $rankingFile) {
				list($time, $href) = explode('-', $rankingFile, 2);
				$ranking = str_replace('{index}', ++$i, $rankingSnippet);
				$ranking = str_replace('{href}', ' href=/' . $href . '/', $ranking);
				$ranking = str_replace('{name}', file_get_contents($rankingPath . $rankingFile), $ranking);
				$ranking = str_replace('{time}', $time . '&Prime;', $ranking);
				array_push($rankings, $ranking);

				if ($maxRows <= $i) {
					break;
				}
			}
		}
	}

	// Fill empty ranking space
	for ($i = sizeof($rankings); $i < $maxRows; ) {
		$ranking = str_replace('{index}', ++$i, $rankingSnippet);
		$ranking = str_replace('{href}', '', $ranking);
		$ranking = str_replace('{name}', 'No name', $ranking);
		$ranking = str_replace('{time}', '---', $ranking);
		array_push($rankings, $ranking);
	}

	// Write cache
		// Write cache
	$fp = fopen($rankingCacheFile, 'w');
	if ($fp) {
		fwrite($fp, implode('', $rankings));
		fclose($fp);
	}
}

$tpl = file_get_contents(TPLPATH . 'pages/main.html');
$tpl = str_replace('{start_button_text}', $startButtonText, $tpl);
$tpl = str_replace('{ranking}', implode('', $rankings), $tpl);

$title = 'HackGame3';
array_push($content, $tpl);
