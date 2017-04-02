<?php
// Remove token
removeCookie(SESSION_COOKIE_NAME);
unset($tokenData);
if (isset($_POST['start'])) {
	nextlevel(0);
} else {
	location('');
}
