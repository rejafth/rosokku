<?php

defined('BASEPATH') or exit('No direct script access allowed');

/* ROUTES UTAMA */
$route['default_controller'] = 'auth/index';
$route['404_override'] = 'errors/error_404';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
