<?php
define('SESSION_COOKIE_NAME', 'id');
define('SESSION_COOKIE_EXP', 24 * 60 * 60);
define('SECRET_KEY', '_SECRET_KEY_');

define('HOSTADDR', 'http://example.com');
define('BASE_URI', '/');

error_reporting(E_ALL);
ini_set('display_errors', FALSE);

$commonUsernames = array(
	'info',
	'sales',
	'admin',
	'dir',
	'finance',
	'director',
	'contact',
	'support',
	'contactus',
	'mail',
	'adm',
	'manager',
	'billing',
	'home',
	'bank',
	'account',
	'job',
	'business'
);

$commonPasswords = array(
	'password', 
	'123456', 
	'12345678', 
	'abc123', 
	'qwerty', 
	'monkey', 
	'letmein', 
	'dragon', 
	'111111', 
	'baseball', 
	'iloveyou', 
	'trustno1', 
	'1234567', 
	'sunshine', 
	'master', 
	'123123', 
	'welcome', 
	'shadow', 
	'ashley', 
	'football', 
	'jesus', 
	'michael', 
	'ninja', 
	'mustang', 
	'password1', 
	'seinfeld', 
	'winner', 
	'purple', 
	'sweeps', 
	'contest', 
	'princess', 
	'maggie', 
	'9452', 
	'peanut', 
	'ginger', 
	'buster', 
	'tigger', 
	'cookie', 
	'george', 
	'summer', 
	'taylor', 
	'bosco', 
	'bailey'
);

$userAgents = array(
	'InternalBrowser/1.1',
	'InternalBrowser/1.2',
	'InternalBrowser/2.0',
	'InternalBrowser/2.1',
	'InternalBrowser/3.0',
	'IntranetBrowser/1.1',
	'IntranetBrowser/1.2',
	'IntranetBrowser/2.0',
	'IntranetBrowser/2.1',
	'IntranetBrowser/3.0'
);

// IANA language tags
$languages = array(
	'ar-sa',
	'en-nz',
	'en-bz',
	'es-gt',
	'es-pa',
	'es-do',
	'es-pr',
	'es-ni',
	'es-hn',
	'es-co'
);

$privateIPsRange = array(
	'10.0.0.1|10.0.0.255',
	'10.0.1.1|10.0.1.255',
	'10.0.2.1|10.0.2.255',
	'10.0.3.1|10.0.3.255',
	'10.0.4.1|10.0.4.255',
	'10.0.5.1|10.0.5.255',
	'10.0.6.1|10.0.6.255',
	'10.0.7.1|10.0.7.255',
	'10.0.8.1|10.0.8.255',
	'10.0.9.1|10.0.9.255',
	'192.168.0.1|192.168.0.255',
);

$levels = array(
	array(
		'label' => 'one',
		'title' => 'Beware your URL',
		'message' => 'Do you notice something on the URL? Try to access directly to level 2!',
		'lesson' => 'Remember to check the credentials of user before granting access on each private page.'
	),
	array(
		'label' => 'two',
		'title' => 'Avoid parameter modification of sensible data',
		'message' => 'Was level one too easy? Try again with something different!',
		'lesson' => 'Do not verifies successful log in on the basis of a fixed value parameters, because a user could modify these parameters to gain access to the protected areas without providing valid credentials.'
	),
	array(
		'label' => 'three',
		'title' => 'Modify your default credential',
		'message' => 'Very good! Do you know some default username/password combination?',
		'lesson' => 'Remember to modify the default username and password of your application (and also your router default username/password combination).'
	),
	array(
		'label' => 'four',
		'title' => 'Remove comments before publishing your website',
		'message' => 'Do you know how to read source code?',
		'lesson' => 'Do not leave back doors to easily access the application, and remember to remove all comments before publishing your website.'
	),
	array(
		'label' => 'five',
		'title' => 'Avoid client-side only validation',
		'message' => 'Great job! Try it again!',
		'lesson' => 'Never trust client-side validation.'
	),
	array(
		'label' => 'six',
		'title' => 'Javascript hidding technique',
		'message' => 'So, you look like a javascript expert. How about now?',
		'lesson' => 'Never trust client-side validation, even by hiding it.'
	),
	array(
		'label' => 'seven',
		'title' => 'Avoid blocking only by client-side',
		'message' => 'Are you bored? Play with this paradox. Use the same username and password of level six.',
		'lesson' => 'Again, never trust anything by client-side.'
	),
	array(
		'label' => 'eight',
		'title' => 'Reverse engineering',
		'message' => 'You have a very solid client-side knowledge! Let me try your logic ability.',
		'lesson' => 'Reverse engineering is important for most tasks.'
	),
	array(
		'label' => 'nine',
		'title' => 'Error message leak',
		'message' => 'Enough client-side! This is a common username and password list, get the right combination.',
		'lesson' => 'An application should respond with a generic error message regardless of whether the user ID or password was incorrect. It should also give no indication to the status of an existing account.'
	),
	array(
		'label' => 'ten',
		'title' => 'Error status leak',
		'message' => 'This is still the common username and password list, get the right combination.',
		'lesson' => 'Even though a generic error page is shown to a user, the HTTP response code may differ which can leak information about whether the account is valid or not.'
	),
	array(
		'label' => 'eleven',
		'title' => 'Timing leak',
		'message' => 'Again, this is the common username and password list, get the right combination.',
		'lesson' => 'Be careful about the delay of checking the validity of user and password.'
	),
	array(
		'label' => 'twelve',
		'title' => 'Cookie information leakage',
		'message' => 'Some user just logged out on your computer, can you figure how to log in without the password?',
		'lesson' => 'A common mistake is to include specific data in the cookie instead of issuing a generic value and referencing real data at the server side.'
	),
	array(
		'label' => 'thirteen',
		'title' => 'Bypass the user-agent limitation',
		'message' => 'Great! You logged successfully with the modified cookie, but you can only access this page with <code class=codeblock>{user_agent}</code>, can you bypass it?',
		'lesson' => 'Do not trust the browser user-agent string because is prone to modification.'
	),
	array(
		'label' => 'fourteen',
		'title' => 'Bypass the language limitation',
		'message' => 'This page can only be viewed in language defined as <code class=codeblock>{browser_lang}</code>, do you know how it works?',
		'lesson' => 'Accept-Language is also prone to modification.'
	),
	array(
		'label' => 'fifteen',
		'title' => 'Beware of IP address spoofing',
		'message' => 'This page is limited to internal IP address on a range between <code class=codeblock>{ip_range_start}</code> - <code class=codeblock>{ip_range_end}</code>, try to fool the server.',
		'lesson' => 'You should trust the directly connected IP address only.'
	)
);

if (!function_exists('http_response_code')) {
	function http_response_code($code = NULL) {
		if ($code !== NULL) {
			switch ($code) {
				case 100: $text = 'Continue'; break;
				case 101: $text = 'Switching Protocols'; break;
				case 200: $text = 'OK'; break;
				case 201: $text = 'Created'; break;
				case 202: $text = 'Accepted'; break;
				case 203: $text = 'Non-Authoritative Information'; break;
				case 204: $text = 'No Content'; break;
				case 205: $text = 'Reset Content'; break;
				case 206: $text = 'Partial Content'; break;
				case 300: $text = 'Multiple Choices'; break;
				case 301: $text = 'Moved Permanently'; break;
				case 302: $text = 'Moved Temporarily'; break;
				case 303: $text = 'See Other'; break;
				case 304: $text = 'Not Modified'; break;
				case 305: $text = 'Use Proxy'; break;
				case 400: $text = 'Bad Request'; break;
				case 401: $text = 'Unauthorized'; break;
				case 402: $text = 'Payment Required'; break;
				case 403: $text = 'Forbidden'; break;
				case 404: $text = 'Not Found'; break;
				case 405: $text = 'Method Not Allowed'; break;
				case 406: $text = 'Not Acceptable'; break;
				case 407: $text = 'Proxy Authentication Required'; break;
				case 408: $text = 'Request Time-out'; break;
				case 409: $text = 'Conflict'; break;
				case 410: $text = 'Gone'; break;
				case 411: $text = 'Length Required'; break;
				case 412: $text = 'Precondition Failed'; break;
				case 413: $text = 'Request Entity Too Large'; break;
				case 414: $text = 'Request-URI Too Large'; break;
				case 415: $text = 'Unsupported Media Type'; break;
				case 500: $text = 'Internal Server Error'; break;
				case 501: $text = 'Not Implemented'; break;
				case 502: $text = 'Bad Gateway'; break;
				case 503: $text = 'Service Unavailable'; break;
				case 504: $text = 'Gateway Time-out'; break;
				case 505: $text = 'HTTP Version not supported'; break;
				default:
				exit('Unknown http status code "' . htmlentities($code) . '"');
				break;
			}

			$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
			header($protocol . ' ' . $code . ' ' . $text);
			$GLOBALS['http_response_code'] = $code;
		} else {
			$code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);
		}

		return $code;
	}
}
