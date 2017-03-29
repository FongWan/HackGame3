<?php
if (isset($_POST['username'], $_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if ('admin' == $username && 'admin' == $password) {
		finishlevel($level);
	} else {
		$currentLevel['error'] = 'The username/password combination is incorrect.';
	}
}
