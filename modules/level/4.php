<?php
list(, $passwordPos) = explode('.', $tokenData['data'][$level - 1], 2);
list($passwordPos, ) = explode(',', $passwordPos, 2);

if (isset($_POST['username'], $_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if ('dev' == $username && $commonPasswords[$passwordPos] == $password) {
		finishlevel($level);
	} else {
		$currentLevel['error'] = 'The username/password combination is incorrect.';
	}
}

$password = $commonPasswords[$passwordPos];

$currentLevel['footer'] = <<< EOT
<!--
    TODO: Remove this comment before publishing
    User: dev
    Pass: {$password}
-->
EOT;
