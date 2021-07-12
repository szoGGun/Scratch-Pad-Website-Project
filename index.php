<?php

declare(strict_types=1);

namespace App;

use App\Exception\AppException;
use App\Exception\ConfigurationException;
use Throwable;

require_once("src/Utils/debug.php");
require_once("src/Controller.php");
require_once("src/Exception/AppException.php");

$configuration = require_once("config/config.php");

$request = [
    'get' => $_GET,
    'post' => $_POST
];

try {
    Controller::initConfiguration($configuration);

    $controller = new Controller($request);
    $controller->run();

} catch (ConfigurationException $e){
    echo '<h1>Application Error</h1>';
    echo "<h3>Problem with configuration. Please contact administrator</h3>";
} catch (AppException $e) {
    echo '<h1>Application Error</h1>';
    echo '<h3>' . $e->getMessage() . '</h3>';
    echo '<h3>' . $e->getPrevious() . '</h3>';
} catch (Throwable $e) {
    echo '<h1>Application Error</h1>';
    dump($e);
}
