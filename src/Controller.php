<?php

declare(strict_types=1);

namespace App;

require_once("src/Exception/ConfigurationException.php");

use App\Exception\ConfigurationException;

require_once("View.php");
require_once("Database.php");

class Controller
{
    private const DEFAULT_ACTION = 'list';

    private static array $configuration = [];

    private Database $database;
    private array $request;
    private View $view;

    public static function initConfiguration(array $configuration): void
    {
        self::$configuration = $configuration;
    }

    public function __construct(array $request)
    {
        if (empty(self::$configuration['db'])) {
            throw new ConfigurationException('Configuration Error');
        }
        $this->database = new Database(self::$configuration['db']);
        $this->request = $request;
        $this->view = new View();

    }

    public function run(): void
    {
        $view = new View();
        $viewParams = [];

        switch ($this->action()) {
            case 'create':
                $page = 'create';

                $data = $this->getRequestPost();
                if (!empty($data)) {
                    $noteData = [
                        'title' => $data['title'],
                        'content' => $data['content'],
                    ];

                    $this->database->createNote($noteData);
                    header('Location: /?before=created');
                }
                break;
            case 'show':
                break;
            default:
                $page = 'list';

                $data = $this->getRequestGet();

                $viewParams['before'] = $data['before'] ?? null;
                break;
        }

        $this->view->render($page, $viewParams);
    }

    private function action(): string
    {
        $data = $this->getRequestGet();
        return $data['action'] ?? self::DEFAULT_ACTION;
    }

    private function getRequestGet(): array
    {
        return $this->request['get'] ?? [];
    }

    private function getRequestPost(): array
    {
        return $this->request['post'] ?? [];
    }


}