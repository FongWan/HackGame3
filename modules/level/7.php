<?php
list($usernamePos, $passwordPos) = explode('.', $tokenData['data'][$level - 2], 2);
list($usernamePos, ) = explode(',', $usernamePos, 2);
list($passwordPos, ) = explode(',', $passwordPos, 2);

if (isset($_POST['username'], $_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if ($commonUsernames[$usernamePos] == $username && $commonPasswords[$passwordPos] == $password) {
		finishlevel($level);
	} else {
		$currentLevel['error'] = 'The username/password combination is incorrect.';
	}
}

$currentLevel['username'] = $commonUsernames[$usernamePos];
$currentLevel['password'] = $commonPasswords[$passwordPos];
$currentLevel['footer'] = <<< EOT
<script>
function checkSubmit() {
    alert('Error: You cannot try to log in.');
    return false;
}

var loginform = document.getElementById('password-form');
if ('undefined' != typeof loginform) {
    loginform.onsubmit = checkSubmit;
}
</script>
EOT;
