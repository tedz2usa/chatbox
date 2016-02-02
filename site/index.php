<?php

echo 'Hello!';

require_once('../logs/constants.php');

$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

echo 'Connected';


