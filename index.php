<?php
// Define paths and get configuration
define('ABSPATH', dirname(__FILE__) . '/');
define('TPLPATH', ABSPATH . '/view/');
require(ABSPATH . 'config.php');

// Token required function
function base64url_encode($data) {
	return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
	return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function removeCookie($name) {
	global $_COOKIE;
	setcookie($name, '', 1, BASE_URI, '', false, true);
	setcookie($name, false, 0, BASE_URI, '', false, true);
	unset($_COOKIE[$name]);
}

function location($url) {
	header('Location:' . BASE_URI . $url, true, 303);
	exit;
}

function notfound() {
	http_response_code(404);
	readfile(ABSPATH . 'static/404.html');
	exit;
}

function nextlevel($currentLevel, $location = '') {
	global $tokenData;
	global $totalLevels;
	global $commonUsernames;
	global $commonPasswords;
	global $_SERVER;

	// Create original array if not exist
	if (!isset($tokenData) || !is_array($tokenData)) {
		$tokenData = array(
			'starttime' => array(),
			'endtime' => array(),
			'data' => array()
		);
	}

	$nextLevel = $currentLevel + 1;

	// Check whether finished all levels
	if ($totalLevels >= sizeof($tokenData['endtime'])) {
		// Level not finished
		// Check whether there is more level
		if ($totalLevels >= $nextLevel) { 
			// Not last level, generate random username/password combination and reset start time
			$usernameList = array_keys($commonUsernames);
			shuffle($usernameList);

			$passwordList = array_keys($commonPasswords);
			shuffle($passwordList);

			// Set the starttime if it is not setted, or reset starttime if the endtime is not setted
			if (!isset($tokenData['starttime'][$currentLevel], $tokenData['endtime'][$currentLevel])) {
				$tokenData['starttime'][$currentLevel] = $_SERVER['REQUEST_TIME'];
			}
			// Add data
			$tokenData['data'][$currentLevel] = implode(',', array_slice($usernameList, 0, 10)) . '.' . implode(',', array_slice($passwordList, 0, 10));
		}

		// Encode data
		$data = json_encode($tokenData);
		$sign = hash_hmac('SHA256', $data, SECRET_KEY);

		// Set cookie
		setcookie(SESSION_COOKIE_NAME, base64url_encode($data) . '.' . $sign, $_SERVER['REQUEST_TIME'] + SESSION_COOKIE_EXP, BASE_URI, '', false, true);
	}

	// Check whether the next level is beyond the total level
	if ($totalLevels >= $nextLevel) {
		// Not last level
		// Check whether the location is setted
		if (empty($location)) {
			// Location not setted, set default location
			$location = 'level' . $nextLevel;
		}
	} else {
		// Set to redirect to completed page
		$location = 'completed';
	}

	// Redirect
	location($location);
}

function finishlevel($currentLevel, $location = '') {
	global $tokenData;

	// Create original array if not exist
	if (!isset($tokenData) || !is_array($tokenData)) {
		$tokenData = array(
			'starttime' => array(),
			'endtime' => array(),
			'data' => array()
		);
	}

	$index = $currentLevel - 1;

	// Check whether the endtime is setted or the endtime is before the starttime
	if (!isset($tokenData['endtime'][$index]) || $tokenData['endtime'][$index] < $tokenData['starttime'][$index]) {
		// Add data
		$tokenData['endtime'][$index] = $_SERVER['REQUEST_TIME'];

		// Encode data
		$data = json_encode($tokenData);
		$sign = hash_hmac('SHA256', $data, SECRET_KEY);
	}

	// Jump to next level
	nextLevel($currentLevel, $location);
}

// Clean path and get the correct path
$requestURI = parse_url(preg_replace('/\/{2,}/', '/', $_SERVER['REQUEST_URI']));
$cleanURI = trim(substr($requestURI['path'], strlen(BASE_URI)), '/');

// Get token data if exist
if (isset($_COOKIE[SESSION_COOKIE_NAME], $_COOKIE[SESSION_COOKIE_NAME]{0})) {
	// Split data
	list($tokenData, $sign) = explode('.', $_COOKIE[SESSION_COOKIE_NAME], 2);
	$tokenData = base64url_decode($tokenData);

	// Check is all set
	if (isset($tokenData{0}, $sign{0}) && hash_hmac('SHA256', $tokenData, SECRET_KEY) == $sign) {
		// Decode data
		$tokenData = json_decode($tokenData, true);
	}

	// If tokendata cannot be decoded, destroy it.
	if (!is_array($tokenData)) {
		unset($tokenData);
	}
}

// Initialize variables
$totalLevels = sizeof($levels);
$completenessMeter = array(
	'class' => 'start',
	'message' => 'Waiting to start&hellip;'
);
$title = '';
$content = array();

// Check whether the module is in the available list
if (in_array($cleanURI, array('', 'completed', 'reset'))) {
	if (!isset($cleanURI{0})) {
		$module = 'main';
	} else {
		$module = $cleanURI;
	}

	$opengraph = file_get_contents(TPLPATH . 'opengraph.html');
} elseif ('level' == substr($cleanURI, 0, 5) && isset($cleanURI{5})) {
	// Check whether the player started the game
	if (isset($tokenData)) {
		// Game has started
		$level = substr($cleanURI, 5);
		if (is_numeric($level) && $level > 0 && $level <= $totalLevels) {
			$module = 'level';
		} else {
			// Level not found
			notfound();
		}
	} else {
		// Game has not started, return to home
		location('');
	}
} else {
	// Module not found
	notfound();
}

if (empty($cleanURI)) {
	$cleanURI = BASE_URI;
} else {
	$cleanURI = BASE_URI . $cleanURI;
}

// Check whether the path is correct format
$correctPath = $cleanURI;
if (isset($requestURI['query'])) {
	$correctPath .= '?' . $requestURI['query'];
}
if ($_SERVER['REQUEST_URI'] != $correctPath) {
	// Redirect to the correct path
	http_response_code(301);
	header('Location: ' . $correctPath);
	exit;
}
unset($correctPath);

// Load content
include(ABSPATH . 'modules/' . $module . '.php');

// Join all contents
$content = implode('', $content);

// Replace new line within user interaction zone to special mark
preg_match_all('/<!--[^\n-]*-->(.+?)<!--[^\n-]*-->/s', $content, $codeBlocks);
if ($codeBlocks) {
	foreach ($codeBlocks[1] as $codeBlock) {
		$tmpBlock = str_replace("\n", '\tmp-newline', $codeBlock);
		$content = str_replace($codeBlock, $tmpBlock, $content);
	}
}

// Obtain the template and replace the content
$tpl = file_get_contents(TPLPATH . 'template.html');

// Replace completeness meter
$tpl = str_replace('{completeness_meter}', file_get_contents(TPLPATH . 'completeness-meter.html'), $tpl);
foreach ($completenessMeter as $placeholder => $replace) {
	$tpl = str_replace('{completeness_meter_' . $placeholder . '}', $replace, $tpl);
}

// Generate level list
$levelList = array();
$levelListSnippet = file_get_contents(TPLPATH . 'level-list.html');
for ($i = 0; $i < $totalLevels; ++$i) {
	if (isset($tokenData)) {
		$lastLevel = sizeof($tokenData['endtime']);
	} else {
		$lastLevel = 0;
	}

	if ($i < $lastLevel) {
		$status = 'unlocked';
		$time = ($tokenData['endtime'][$i] - $tokenData['starttime'][$i]) . '&Prime;';
		$href = 'href=' . BASE_URI . 'level' . ($i + 1);
	} else {
		if (isset($tokenData) && $i == $lastLevel) {
			$status = 'current';
			$href = 'href=' . BASE_URI;
		} else {
			$status = 'locked';
			$href = '';
		}
		$time = '---';
	}

	$levelListItem = str_replace('{index}', $i + 1, $levelListSnippet);
	$levelListItem = str_replace('{status}', $status, $levelListItem);
	$levelListItem = str_replace('{href}', $href, $levelListItem);
	$levelListItem = str_replace('{time}', $time, $levelListItem);
	array_push($levelList, $levelListItem);
}
$tpl = str_replace('{level_list}', implode('', $levelList), $tpl);

if (isset($opengraph)) {
	$opengraph = array(' prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"', $opengraph);
} else {
	$opengraph = '';
}

$tpl = str_replace(array('{html_prefix}', '{opengraph}'), $opengraph, $tpl);
$tpl = str_replace('{title}', $title, $tpl);
$tpl = str_replace('{content}', $content, $tpl);
$tpl = str_replace('{server_time_utc}', date('Y-m-d\TH:i:s\Z', $_SERVER['REQUEST_TIME']), $tpl);
$tpl = str_replace('{base_uri}', BASE_URI, $tpl);
$tpl = str_replace('{full_base_uri}', HOSTADDR . BASE_URI, $tpl);
$tpl = str_replace('{full_uri}', HOSTADDR . $cleanURI, $tpl);
$tpl = str_replace('{current_uri}', $_SERVER['REQUEST_URI'], $tpl);
$tpl = str_replace(array("\r", "\n", "\t"), '', $tpl);

// Replace special mark to new line
$tpl = str_replace('\tmp-newline', "\n", $tpl);
$tpl = str_replace('    ', "\t", $tpl);


// All fine, output content
echo $tpl;
