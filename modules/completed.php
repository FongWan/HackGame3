<?php
if (!isset($tokenData) || 12 > sizeof($tokenData['starttime'])) {
	// Game has not started, return to home
	location('');
}

function generateSlug($slug) {
	$cyrylicFrom = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
	$cyrylicTo   = array('A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh', 'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd', 'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '', 'e', 'iu', 'ia'); 

	$from = array('Á', 'À', 'Â', 'Ä', 'Ă', 'Ā', 'Ã', 'Å', 'Ą', 'Æ', 'Ć', 'Ċ', 'Ĉ', 'Č', 'Ç', 'Ď', 'Đ', 'Ð', 'É', 'È', 'Ė', 'Ê', 'Ë', 'Ě', 'Ē', 'Ę', 'Ə', 'Ġ', 'Ĝ', 'Ğ', 'Ģ', 'á', 'à', 'â', 'ä', 'ă', 'ā', 'ã', 'å', 'ą', 'æ', 'ć', 'ċ', 'ĉ', 'č', 'ç', 'ď', 'đ', 'ð', 'é', 'è', 'ė', 'ê', 'ë', 'ě', 'ē', 'ę', 'ə', 'ġ', 'ĝ', 'ğ', 'ģ', 'Ĥ', 'Ħ', 'I', 'Í', 'Ì', 'İ', 'Î', 'Ï', 'Ī', 'Į', 'Ĳ', 'Ĵ', 'Ķ', 'Ļ', 'Ł', 'Ń', 'Ň', 'Ñ', 'Ņ', 'Ó', 'Ò', 'Ô', 'Ö', 'Õ', 'Ő', 'Ø', 'Ơ', 'Œ', 'ĥ', 'ħ', 'ı', 'í', 'ì', 'i', 'î', 'ï', 'ī', 'į', 'ĳ', 'ĵ', 'ķ', 'ļ', 'ł', 'ń', 'ň', 'ñ', 'ņ', 'ó', 'ò', 'ô', 'ö', 'õ', 'ő', 'ø', 'ơ', 'œ', 'Ŕ', 'Ř', 'Ś', 'Ŝ', 'Š', 'Ş', 'Ť', 'Ţ', 'Þ', 'Ú', 'Ù', 'Û', 'Ü', 'Ŭ', 'Ū', 'Ů', 'Ų', 'Ű', 'Ư', 'Ŵ', 'Ý', 'Ŷ', 'Ÿ', 'Ź', 'Ż', 'Ž', 'ŕ', 'ř', 'ś', 'ŝ', 'š', 'ş', 'ß', 'ť', 'ţ', 'þ', 'ú', 'ù', 'û', 'ü', 'ŭ', 'ū', 'ů', 'ų', 'ű', 'ư', 'ŵ', 'ý', 'ŷ', 'ÿ', 'ź', 'ż', 'ž');
	$to   = array('A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'C', 'C', 'C', 'C', 'D', 'D', 'D', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'G', 'G', 'G', 'G', 'G', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'c', 'c', 'c', 'c', 'd', 'd', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'g', 'g', 'g', 'g', 'g', 'H', 'H', 'I', 'I', 'I', 'I', 'I', 'I', 'I', 'I', 'IJ', 'J', 'K', 'L', 'L', 'N', 'N', 'N', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'CE', 'h', 'h', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'ij', 'j', 'k', 'l', 'l', 'n', 'n', 'n', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'R', 'R', 'S', 'S', 'S', 'S', 'T', 'T', 'T', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'W', 'Y', 'Y', 'Y', 'Z', 'Z', 'Z', 'r', 'r', 's', 's', 's', 's', 'B', 't', 't', 'b', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'w', 'y', 'y', 'y', 'z', 'z', 'z');

	$from = array_merge($from, $cyrylicFrom);
	$to   = array_merge($to, $cyrylicTo);

	$slug = str_replace($from, $to, $slug);
	$slug = preg_replace('~[^\\pL\d]+~u', '-', $slug);
	$slug = strtolower($slug);
	$slug = preg_replace('~[^-%\w]+~', '', $slug);
	$slug = preg_replace('|-{2,}}|', '-', $slug);

	return trim($slug, '-');
}

$completenessMeter['class'] = 'completed';
$completenessMeter['message'] = 'Completed!<span id=buttons><a href={base_uri}reset title="Reset your all progress">Reset</a></span>';

$snippet = file_get_contents(TPLPATH . 'pages/completed_snippet.html');
$recordRows = array();
$totalTime = 0;
foreach ($levels as $number => $each) {
	$time = $tokenData['endtime'][$number] - $tokenData['starttime'][$number];
	$totalTime += $time;

	$current = array(
		'{row_class}'  => ($number + 1) % 2 ? 'even' : 'odd',
		'{level_name}' => '<b>' . ($number + 1) . '.</b> ' . $each['title'],
		'{seconds}'       => $time . '&Prime;'
	);
	$currentSnippet = str_replace(array_keys($current), $current, $snippet);

	array_push($recordRows, $currentSnippet);
}

if (isset($_POST['name'])) {
	$name = trim($_POST['name']);
	$slug = trim($tokenData['starttime'][0] . '-' . generateSlug($name), '-');
	$filename = $slug . '.html';

	$minutes = (int) ($totalTime/60);
	$seconds = (int) ($totalTime%60);

	$secondsText = 'second';
	if (1 < $seconds) {
		$secondsText .= 's';
	}

	$minutesText = 'minute';
	if (1 < $minutes) {
		$minutesText .= 's';
	}

	$displayText = array();
	if ($minutes) {
		array_push($displayText, $minutes . ' ' . $minutesText);
	}
	if ($seconds) {
		array_push($displayText, $seconds . ' ' . $secondsText);
	}

	$replacer = array(
		'{completeness_meter}' => '',
		'{html_prefix}' => ' prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"',
		'{opengraph}' => file_get_contents(TPLPATH . 'pages/record_opengraph.html'),
		'{title}' => htmlentities($name, ENT_QUOTES, 'UTF-8') . '\'s time record',
		'{content}' => file_get_contents(TPLPATH . 'pages/record.html'),
		'{name}' => htmlentities($name, ENT_QUOTES, 'UTF-8'),
		'{finish_date}' => date('Y M d', $tokenData['endtime'][sizeof($tokenData['endtime']) - 1]),
		'{finish_date_utc}' => date('Y-m-d\TH:i:s\Z', $tokenData['endtime'][sizeof($tokenData['endtime']) - 1]),
		'{total_time}' => implode(' and ', $displayText),
		'{record_rows}' => implode('', $recordRows),
		'{total_seconds}' => $totalTime . '&Prime;',
		'{server_time_utc}' => date('Y-m-d\TH:i:s\Z', $_SERVER['REQUEST_TIME']),
		'{base_uri}' => BASE_URI,
		'{full_base_uri}' => HOSTADDR . BASE_URI,
		'{full_uri}' => HOSTADDR . BASE_URI . $filename
	);
	$output = file_get_contents(TPLPATH . 'template.html');
	$output = str_replace(array_keys($replacer), $replacer, $output);
	$output = str_replace(array("\r", "\n", "\t"), '', $output);

	// Write standard data
	$file = ABSPATH . 'cache/' . $slug . '.json';
	$fp = fopen($file, 'w');
	if ($fp) {
		fwrite($fp, json_encode($tokenData));
		fclose($fp);
	}

	// Write standard cache
	$file = ABSPATH . 'cache/' . $filename;
	$fp = fopen($file, 'w');
	if ($fp) {
		fwrite($fp, $output);
		fclose($fp);
	}

	// Write gziped cache
	$fp = fopen($file . '.gz', 'w');
	if ($fp) {
		fwrite($fp, gzencode($output, 9));
		fclose($fp);
	}

	setcookie(SESSION_COOKIE_NAME, '', 1, BASE_URI, '', false, true);
	location($slug . '.html');
}

$tpl = file_get_contents(TPLPATH . 'pages/completed.html');
$tpl = str_replace('{record_rows}', implode('', $recordRows), $tpl);
$tpl = str_replace('{total_seconds}', $totalTime . '&Prime;', $tpl);

$title = 'Congratulation!';
array_push($content, $tpl);
