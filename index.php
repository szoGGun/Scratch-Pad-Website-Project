<?php

declare(strict_types=1);

namespace App;

require_once("src/Utils/debug.php");
require_once("src/NoteController.php");
require_once("src/Exception/AppException.php");
require_once("src/Request.php");

use App\Request;
use App\Exception\AppException;
use App\Exception\ConfigurationException;
use Throwable;

$configuration = require_once("config/config.php");

$request = new Request($_GET, $_POST);

try {
    AbstractController::initConfiguration($configuration);

    $controller = new NoteController($request);
    $controller->run();

} catch (ConfigurationException $e){
    echo '<h1>Application Error</h1>';
    echo "<h3>Problem with configuration. Please contact administrator</h3>";
} catch (AppException $e) {
    echo '<h1>Application Error</h1>';
    echo '<h3>' . $e->getMessage() . '</h3>';
} catch (Throwable $e) {
    echo '<h1>Application Error</h1>';
    dump($e);
}
