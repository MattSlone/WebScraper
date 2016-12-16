<?php
require __DIR__.'/../vendor/autoload.php';

use Masterminds\HTML5;

/*Dependencies*/
$home = new Scraper\View(__DIR__.'/../src/resources/views/home.php');
$results = new Scraper\View(__DIR__.'/../src/resources/views/results.php');
$query = new Scraper\FormQuery($_POST);
$scraper = new Scraper\PageScraper;
$parser = new Scraper\PageParser(new HTML5);
$messenger = new Scraper\Messenger;
$validator = new Scraper\Validator($_POST);

/*Controllers*/
$homeController = new Scraper\Controllers\HomeController(
  $home,
  $scraper,
  $parser,
  $messenger,
  $validator,
  $query
);

$resultsController = new Scraper\Controllers\ResultsController($results);

/*Routes*/
$router = new AltoRouter();

$router->map('GET', '/', array($homeController, 'index'));
$router->map('POST', '/', array($homeController, 'create'));
$router->map('GET', '/results', array($resultsController, 'show'));

$match = $router->match();

if(!$match || !is_callable($match['target'])) {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo 'The requested page cannot be found.';
    die;
}

session_start();
call_user_func_array($match['target'], $match['params']);
