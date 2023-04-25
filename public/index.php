<?php
ini_set("session.cookie_secure", 1);
session_set_cookie_params(0, NULL, NULL, TRUE, NULL);
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
include_once('../app/bootstrap.php');
include_once('../app/config/config.php');
$app = new App(APP_PATH,APPLICATION_ENV,$config);
$app->run();