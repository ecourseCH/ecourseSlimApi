<?php
header("Access-Control-Allow-Origin: *");
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

require 'config.php';


$app = new \Slim\App(['settings' => $config]);

require 'dependencies.php';

require 'routes.php';



$app->run();

?>