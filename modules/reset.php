<?php
// Remove token
setcookie(SESSION_COOKIE_NAME, '', 1, BASE_URI, '', false, true);
location('');
