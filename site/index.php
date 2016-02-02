<?php


session_start();
// session_destroy();

require_once('../logs/constants.php');

$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if (isset($_POST['username'])) {
	if (authenticate_password($_POST['username'], $_POST['password'])) {
		$_SESSION['username'] = $_POST['username'];
	} else {
		// echo 'Not Authenticated!';
	}
}




$settings = get_app_settings();
$users = get_app_users();
$page_mode = get_page_mode();

$current_user;



if (is_logged_in()) {
	$current_user = User::find_by_username($_SESSION['username']);
} 


function is_logged_in() {
	return (isset($_SESSION['username']));
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
		'application_name' => 'My Chatroom',
		'application_name_long' => 'Team Collaboration'
	);

	$res = $mysqli->query('SELECT * FROM settings');
	while( $row = $res->fetch_assoc() ) {
		$settings[$row['name']] = $row['value'];
	}

	return $settings;
}

function get_app_users() {
	global $mysqli;
	$users = [];
	$res = $mysqli->query('SELECT * FROM users ORDER BY last_name');
	while ( $row = $res->fetch_assoc() ) {
		$users[] = new User($row);
	}
	return $users;
}


function authenticate_password($username, $password) {
	global $mysqli;
	$res = $mysqli->query('SELECT * FROM users WHERE username="' . $username . '" AND pin="' . $password . '"');
	if ( $row = $res->fetch_assoc() ) {
		return true;
	} else {
		return false;
	}

}


class User {

	public $id;
	public $username;
	public $first_name;
	public $last_name;
	public $pin;
	public $image_name;

	private static $users_by_username = [];

	function __construct($row_record) {
		foreach ($row_record as $key => $value ) {
			$this->$key = $value;
		}
		User::$users_by_username[$this->username] = $this;
	}

	function display_name() {
		return $this->first_name . ' ' . $this->last_name;
	}

	function image_url() {
		return '/images/profile/' . $this->image_name;
	}

	public static function find_by_username($username) {
		return User::$users_by_username[$username];
	}

}

/* Page Modes:
 *

login-page
chat-page


 * 
 */

function get_page_mode() {
	if (is_logged_in()) {
		return 'chat-page';
	} else {
		return 'login-page';
	}
}


?>
<!DOCTYPE html>
<html>
	<head>
		<link rel='shortcut icon' href='favicon.ico' />
		<title><?php echo $settings['application_name']; ?></title>
		<link rel='stylesheet' href='styles.css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js'></script>
		<script src='chatbox.js'></script>
	</head>
	<body>
		<div class='jsdata' data-page-mode='<?php echo $page_mode; ?>'></div>
		<div class='main'>

		<?php 

		if (!is_logged_in()) {

			// USER IS NOT LOGGED IN.

			require_once('_includes/login-fragment.php');

		} else {

			// USER IS LOGGED INTO THE APP.
			
			require_once('_includes/appbar-fragment.php');
		
		}

		?>

		</div> <!-- End .main -->

<br><br><br><br>
<br><br><br><br>
<br><br><br><br>

<?php

// pre($_SESSION);ss
// pre($settings);
// pre($users);

?>
		
	</body>
</html>

