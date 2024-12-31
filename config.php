<?php
require_once "vendor/autoload.php";

$client = new Google_Client();
$client->setApplicationName('RestApiSRS');
$client->setClientId('326257208247-hg1hiuhljudvd555hdqeedouuobe8ur6.apps.googleusercontent.com');
$client->setClientSecret('GOCSPX-
WSMVIENOC8THTS_jdxGF6xF1R.Js9');

$client->setRedirectUri('https://www.tradingview.com/');

$client->addScope('email');
$client->addScope('profile');

session_start();

?>