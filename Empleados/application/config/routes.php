<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Welcome/login';
$route['Welcome/cancelar_pedido/(:num)'] = 'Welcome/cancelar_pedido/$1';
$route['Welcome/entregar_pedido/(:num)'] = 'Welcome/entregar_pedido/$1';
$route['404_override'] = '';
$route['admin'] = 'Welcome/admin';
$route['translate_uri_dashes'] = FALSE;
