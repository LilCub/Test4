<?php

require('../vendor/autoload.php');

require('../shopify.php');
define("SHOPIFY_API_KEY", getenv("SHOPIFY_API_KEY"));
define("SHOPIFY_SECRET", getenv("SHOPIFY_SECRET"));
define("SHOPIFY_SCOPE", getenv("SHOPIFY_SCOPE"));

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Our web handlers

$app->match('/', function(Request $request) use($app) {
  $app['monolog']->addDebug('logging output.');

  include('index.inc.php');
  //return new Response($res, 200);
});

$app->match('/rates', function(Request $request) use($app) {
  $app['monolog']->addDebug('logging output.');

  include('rates.inc.php');
  //return new Response($res, 200);
});

$app->run();

