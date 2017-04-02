<?php
list($usernamePos, $passwordPos) = explode('.', $tokenData['data'][$level - 1], 2);
list($usernamePos, ) = explode(',', $usernamePos, 2);
list($passwordPos, ) = explode(',', $passwordPos, 2);

if (isset($_COOKIE['token_username'], $_COOKIE['token_password'], $_COOKIE['token_logged'])) {
	$username = trim($_COOKIE['token_username']);
	$password = trim($_COOKIE['token_password']);
	$token = trim($_COOKIE['token_logged']);

	if ($commonUsernames[$usernamePos] == $username && md5($commonPasswords[$passwordPos]) == $password && 'true' == $token) {
		removeCookie('token_username');
		removeCookie('token_password');
		removeCookie('token_logged');
		finishlevel($level);
	}
} else {
	setcookie('token_username', $commonUsernames[$usernamePos], 0, BASE_URI, '', false, true);
	setcookie('token_password', md5($commonPasswords[$passwordPos]), 0, BASE_URI, '', false, true);
	setcookie('token_logged', 'false', 0, BASE_URI, '', false, true);
	location('level12');
}

if (isset($_POST['username'], $_POST['password'])) {
	$currentLevel['error'] = 'The username/password combination is incorrect.';
}
