<?php
list($ipPos, ) = explode('.', $tokenData['data'][$level - 1], 2);
list($ipPos, ) = explode(',', $ipPos, 2);

if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	list($ip,) = explode(',', trim($_SERVER['HTTP_X_FORWARDED_FOR']), 2);
	$ip = trim($ip);
} else {
	$ip = trim($_SERVER['REMOTE_ADDR']);
}

$privateIPRange = explode('|', $privateIPsRange[$ipPos[0]], 2);

if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
	$longIP = ip2long($ip);
	if (-1 != $longIP) {
		if (ip2long($privateIPRange[0]) <= $longIP && ip2long($privateIPRange[1]) >= $longIP) {
			finishlevel($level);
		}
	}
}

$currentLevel['message'] = str_replace('{ip_range_start}', $privateIPRange[0], $currentLevel['message']);
$currentLevel['message'] = str_replace('{ip_range_end}', $privateIPRange[1], $currentLevel['message']);
$currentLevel['error'] = 'You are not allowed to see this page.';
