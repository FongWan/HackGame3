<?php
list($usernamePos, $passwordPos) = explode('.', $tokenData['data'][$level - 1], 2);
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

$currentLevel['footer'] = <<< EOT
<script>
function checkSubmit() {
    var username = document.getElementById('username');
    var password = document.getElementById('password');

    if ('undefined' != typeof username && 'undefined' != typeof password) {
        if ('{$commonUsernames[$usernamePos]}' == username.value && '{$commonPasswords[$passwordPos]}' == password.value) {
            return true;
        } else {
            alert('Error: The Username/Password combination is incorrect.');
        }
    }

    return false;
}

var loginform = document.getElementById('password-form');
if ('undefined' != typeof loginform) {
    loginform.onsubmit = checkSubmit;
}
</script>
EOT;
