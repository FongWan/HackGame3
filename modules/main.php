<?php
if (isset($tokenData)) {
	// Game has started
	$lastLevel = sizeof($tokenData['starttime']);
	$startButtonText = 'Continue';

	if (12 > $lastLevel) {
		$completenessMeter['class'] = 'level' . $lastLevel;
	} else {
		$completenessMeter['class'] = 'completed';
	}
	$completenessMeter['message'] = 'Continue&hellip;';
} else {
	// Game has not started
	$lastLevel = 1;
	$startButtonText = 'Start';
}

if (isset($_POST['start'])) {
	nextlevel($lastLevel - 1);
}

$tpl = file_get_contents(TPLPATH . 'pages/main.html');
$tpl = str_replace('{start_button_text}', $startButtonText, $tpl);

$title = 'HackGame3';
array_push($content, $tpl);
