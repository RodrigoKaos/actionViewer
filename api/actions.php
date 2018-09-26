<?php

require_once('helpers.php');
require_once('action/action_helper.php');

header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];

if ( $method === "GET" )
	get_actions_api();