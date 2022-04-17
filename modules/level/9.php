<?php
list($usernamePos, $passwordPos) = explode('.', $tokenData['data'][0], 2);
list($usernamePos, ) = explode(',', $usernamePos, 2);
list($passwordPos, ) = explode(',', $passwordPos, 2);

list($usernameListPos, $passwordListPos) = explode('.', $tokenData['data'][$level - 1], 2);
$usernameListPos = explode(',', $usernameListPos);
$passwordListPos = explode(',', $passwordListPos);

// Get usernames list
$usernameList = array();
foreach ($usernameListPos as $pos) {
	array_push($usernameList, $commonUsernames[$pos]);
}

// Get passwords list
$passwordList = array();
foreach ($passwordListPos as $pos) {
	array_push($passwordList, $commonPasswords[$pos]);
}

if (isset($_POST['username'], $_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if ($usernameList[$usernamePos[0]] == $username) {
		if ($passwordList[$passwordPos[0]] == $password) {
			finishlevel($level);
		} else {
			$currentLevel['username'] = $username;
			$currentLevel['error'] = 'Password is incorrect.';
		}
	} else {
		$currentLevel['error'] = 'The user does not exist.';
	}
}

$currentLevel['message'] .= '<pre class="codeblock usernames">' . implode(' ', $usernameList) . '</pre><pre class="codeblock passwords">' . implode(' ', $passwordList) . '</pre>';
