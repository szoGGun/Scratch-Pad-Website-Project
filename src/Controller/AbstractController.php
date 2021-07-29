<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request;
use App\View;
use App\Database;
use App\Exception\ConfigurationException;

abstract class AbstractController
{
  protected const DEFAULT_ACTION = 'list';

  private static array $configuration = [];

  protected Database $database;
  protected Request $request;
  protected View $view;

  public static function initConfiguration(array $configuration): void
  {
    self::$configuration = $configuration;
  }

  public function __construct(Request $request)
  {
    if (empty(self::$configuration['db'])) {
      throw new ConfigurationException('Configuration error');
    }
    $this->database = new Database(self::$configuration['db']);

    $this->request = $request;
    $this->view = new View();
  }

  public function run(): void
  {
    $action = $this->action() . 'Action';
    if (!method_exists($this, $action)) {
      $action = self::DEFAULT_ACTION . 'Action';
    }

    $this->$action();
  }

  private function action(): string
  {
    return $this->request->getParam('action', self::DEFAULT_ACTION);
  }
}
