<?php

declare(strict_types=1);
session_start();

spl_autoload_register(function (string $ClassNamespace) {
    $path = str_replace(['\\', 'App/'], ['/', ''], $ClassNamespace);
    $path = "src/$path.php";
    require_once($path);
});

require_once("src/Utils/debug.php");
$configuration = require_once("config/config.php");

use App\Controller\AbstractController;
use App\Controller\NoteController;
use App\Request;
use App\Exception\AppException;
use App\Exception\ConfigurationException;



$request = new Request($_GET, $_POST, $_SERVER);
try {
    AbstractController::initConfiguration($configuration);

    $controller = new NoteController($request);
    $controller->run();

} catch (ConfigurationException $e){
    echo "<h1>Application Error</h1>";
    echo "<h3>Problem with configuration. Please contact administrator</h3>";
} catch (AppException $e) {
    echo '<h1>Application Error</h1>';
    echo '<h3>' . $e->getMessage() . '</h3>';
} catch (\Throwable $e) {
    echo '<h1>Application Error</h1>';
    dump($e);
}
