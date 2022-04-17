<?php
list($usernamePos, $passwordPos) = explode('.', $tokenData['data'][2], 2);
list($usernamePos, ) = explode(',', $usernamePos, 2);
list($passwordPos, ) = explode(',', $passwordPos, 2);

list($usernameListPos, $passwordListPos) = explode('.', $tokenData['data'][$level - 1]);
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
		sleep(1);

		if ($passwordList[$passwordPos[0]] == $password) {
			finishlevel($level);
		} else {
			$currentLevel['error'] = 'The username/password combination is incorrect.';
		}
	} else {
		$currentLevel['error'] = 'The username/password combination is incorrect.';
	}
}

$currentLevel['message'] .= '<pre class="codeblock usernames">' . implode(' ', $usernameList) . '</pre><pre class="codeblock passwords">' . implode(' ', $passwordList) . '</pre>';
