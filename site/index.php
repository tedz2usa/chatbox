<?php

session_start();

echo 'Hello!';

require_once('../logs/constants.php');

$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

echo 'Connected';

pre($_SESSION);

$settings = get_app_settings();

pre($settings);

if (is_logged_in()) {
	echo 'You are logged in!';
} else {
	echo 'You are not logged in!';
}


function is_logged_in() {
	return (isset($_SESSION['user_id']));
}


function pre($obj) {
	echo '<pre>';
	var_dump($obj);
	echo '</pre>';
}

function get_app_settings() {
	global $mysqli;


	$settings = array(
		// Default values.
		'application_name' => 'My Chatroom'
	);

	$res = $mysqli->query('SELECT * FROM settings');
	while( $row = $res->fetch_assoc() ) {
		$settings[$row['name']] = $row['value'];
	}

	return $settings;
}

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel='shortcut icon' href='favicon.ico' />
		<title><?php echo $settings['application_name']; ?></title>
	</head>
	<body>
		
	</body>
</html>

