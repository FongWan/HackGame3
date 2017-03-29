<?php
list($usernamePos, $passwordPos) = explode('.', $tokenData['data'][$level - 1], 2);
list($usernamePos, ) = explode(',', $usernamePos, 2);
list($passwordPos, ) = explode(',', $passwordPos, 2);

if (isset($_POST['username'], $_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if ($commonUsernames[$usernamePos] == $username && $commonPasswords[$passwordPos] == $password) {
		finishlevel($level);
	}
}

$password = $commonPasswords[$passwordPos];
$output = '';
for ($x = 0, $y = strlen($password), $charCode; $x < $y; ++$x) {
  $charCode = ord($password[$x]);
  if (128 > $charCode) {
    $charCode += 128;
  } elseif (127 < $charCode) {
    $charCode -= 128;
  }
  
  $charCode = 255 - $charCode;

  $output .= sprintf("%02x", $charCode);
}

$currentLevel['error'] = 'The username/password combination is incorrect.';
$currentLevel['username'] = $commonUsernames[$usernamePos];
$currentLevel['footer'] = <<< EOT
<script>
/**
 * Pseudo hash function
 * @param {string} string
 * @param {string} method The function method, can be 'ENCRYPT' or 'DECRYPT'
 * @return {string}
 */
function pseudoHash(string, method) {
    // Default method is encryption
    if (!('ENCRYPT' == method || 'DECRYPT' == method)) {
        method = 'ENCRYPT';
    }

    // Run algorithm with the right method
    if ('ENCRYPT' == method) {
        // Variable for output string
        var output = '';

        // Algorithm to encrypt
        for (var x = 0, y = string.length, charCode, hexCode; x < y; ++x) {
            charCode = string.charCodeAt(x);

            if (128 > charCode) {
                charCode += 128;
            } else if (127 < charCode) {
                charCode -= 128;
            }

            charCode = 255 - charCode;

            hexCode = charCode.toString(16);

            if (2 > hexCode.length) {
                hexCode = '0' + hexCode;
            }

            output += hexCode;
        }

        // Return output
        return output;
    } else if ('DECRYPT' == method) {
        // TODO: DECODE
        // Return ASCII value of character
        return string;
    }
}

document.getElementById('password').value = pseudoHash('{$output}', 'DECRYPT');
</script>
EOT;
