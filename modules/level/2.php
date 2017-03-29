<?php
if (isset($_GET['logged'])) {
	$logged = $_GET['logged'];

	if (!isset($tokenData['endtime'][0])) {
		finishlevel($level - 1, 'level2?logged=' . $logged);
	}

	if ('true' == $logged) {
		finishlevel($level);
	}

	if (isset($_POST['username'], $_POST['password'])) {
		$currentLevel['error'] = 'The username/password combination is incorrect.';
	}
} else {
	finishlevel($level - 1, 'level2?logged=false');
}
