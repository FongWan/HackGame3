<?php
list($userAgentPos, ) = explode('.', $tokenData['data'][$level - 1], 2);
list($userAgentPos, ) = explode(',', $userAgentPos, 2);

if (isset($_SERVER['HTTP_USER_AGENT']) && FALSE !== strpos($_SERVER['HTTP_USER_AGENT'], $userAgents[$userAgentPos{0}])) {
	finishlevel($level);
}

$currentLevel['message'] = str_replace('{user_agent}', $userAgents[$userAgentPos{0}], $currentLevel['message']);
$currentLevel['error'] = 'You are not allowed to see this page.';