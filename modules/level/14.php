<?php
list($languagePos, ) = explode('.', $tokenData['data'][$level - 1], 2);
list($languagePos, ) = explode(',', $languagePos, 2);

if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
	$acceptLangs = explode(',', trim($_SERVER['HTTP_ACCEPT_LANGUAGE']));
	foreach ($acceptLangs as $lang) {
		list($lang,) = explode(';', trim($lang), 2);

		if ($languages[$languagePos{0}] == trim(strtolower($lang))) {
			finishlevel($level);
		}
	}
}

$currentLevel['message'] = str_replace('{browser_lang}', $languages[$languagePos{0}], $currentLevel['message']);
$currentLevel['error'] = 'You are not allowed to see this page.';
