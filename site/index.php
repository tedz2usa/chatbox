<?php

session_start();

echo 'Hello!';

require_once('../logs/constants.php');

$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

echo 'Connected';

pre($_SESSION);

$settings = get_app_settings();
$users = get_app_users();


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
		'application_name' => 'My Chatroom',
		'login_title' => 'Team Collaboration'
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
	$res =$mysqli->query('SELECT * FROM users ORDER BY last_name');
	while ( $row = $res->fetch_assoc() ) {
		$users[] = new User($row);
	}
	return $users;
}


class User {

	public $id;
	public $username;
	public $first_name;
	public $last_name;
	public $pin;
	public $image_name;

	function __construct($row_record) {
		foreach ($row_record as $key => $value ) {
			$this->$key = $value;
		}
	}

	function display_name() {
		return $this->first_name . ' ' . $this->last_name;
	}

	function image_url() {
		return '/images/profile/' . $this->image_name;
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
	</head>
	<body>
		<div class='main'>

		<?php 

		if (!is_logged_in()) {

			?>
			<div class='login'>
				<h1><?php echo $settings['login_title']; ?></h1>
				<p class='login-caption'>Please Log In</p>
				<div class='login-userlist'>
				<?php
				foreach ($users as $user) {
					?>
					<div class='login-userlist-user'>
						<div class='login-userlist-user-pic' 
							style='background-image: url("<?php echo $user->image_url(); ?>")'>
						</div>
						<div class='login-userlist-user-name'><?php echo $user->display_name(); ?></div>
					</div>
					<?php
				}
				?>
				</div>
			</div>
			<?php


		} else {

		}

		?>


		</div>

<br><br><br><br>
<br><br><br><br>
<br><br><br><br>

<?php

pre($settings);
pre($users);

?>
		
	</body>
</html>

