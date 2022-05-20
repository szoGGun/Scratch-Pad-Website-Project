<?php

declare(strict_types=1);

namespace App\Controller;

class NoteController extends AbstractController
{
    private const PAGE_SIZE = 10;

    public function createAction(): void
    {
        if ($this->request->hasPosted()) {
            $noteData = [
                'title' => $this->request->postParam('title'),
                'content' => $this->request->postParam('content')
            ];
            $this->noteModel->create($noteData);
            $this->redirect('/', ['before' => 'created']);
        }

        $this->view->render('create');
    }

    public function showAction(): void
    {

        $this->view->render(
            'show',
            ['notes' => $this->getNote()]
        );
    }

    public function listAction(): void
    {
        $phrase = $this->request->getParam('phrase');
        $pageNumber = (int) $this->request->getParam('page', 1);
        $pageSize = (int) $this->request->getParam('pagesize', self::PAGE_SIZE);
        $sortBy = $this->request->getParam('sortby', 'title');
        $sortOrder = $this->request->getParam('sortorder', 'desc');

        if (!in_array($pageSize, [1, 5, 10, 25])) {
            $pageSize = self::PAGE_SIZE;
        }

        if($phrase) {
            $noteList = $this->noteModel->search($phrase, $pageNumber, $pageSize, $sortBy, $sortOrder);
            $notes = $this->noteModel->searchCount($phrase);
        } else {
            $noteList = $this->noteModel->list($pageNumber, $pageSize, $sortBy, $sortOrder);
            $notes = $this->noteModel->count();
        }

        $this->view->render(
            'list',
            [
                'page' => [
                    'number' => $pageNumber,
                    'size' => $pageSize,
                    'pages' => (int) ceil($notes / $pageSize)
                    ],
                'phrase' => $phrase,
                'sort' => ['by' => $sortBy, 'order' => $sortOrder],
                'notes' => $noteList,
                'before' => $this->request->getParam('before'),
                'error' => $this->request->getParam('error'),
            ]
        );
    }

    public function editAction(): void

        // TODO add date change after edit
    {
        if ($this->request->isPost()) {
            $noteId = (int)$this->request->postParam('id');
            $noteData = [
                'title' => $this->request->postParam('title'),
                'content' => $this->request->postParam('content')
            ];
            $this->noteModel->edit($noteId, $noteData);
            $this->redirect('/', ['before' => 'edited']);
        }

        $note = $this->getNote();

        $this->view->render(
            'edit',
            ['notes' => $this->getNote()]
        );
    }

    public function deleteAction(): void
    {
        if ($this->request->isPost()) {
            $id = (int)$this->request->postParam('id');
            $this->noteModel->delete($id);
            $this->redirect('/', ['before' => 'deleted']);
        }

        $this->view->render(
            'delete',
            ['notes' => $this->getNote()]
        );
    }

    private function getNote(): array
    {
        $noteId = (int)$this->request->getParam('id');
        if (!$noteId) {
            $this->redirect('/', ['error' => 'missingNodeId']);
        }

        $note = $this->noteModel->get($noteId);

        return $note;
    }

    public function registerAction(): void
    {
        if ($this->request->hasPosted()) {
            $loginData = [
                'username' => $this->request->postParam('username'),
                'email' => $this->request->postParam('email'),
                'password' => $this->request->postParam('password'),
            ];
            $this->noteModel->register($loginData);
        }

        $this->view->render('register');
    }

    public function loginAction(): void
    {
        if ($this->request->hasPosted()) {
            $loginData = [
                'username' => $this->request->postParam('username'),
                'password' => $this->request->postParam('password'),
            ];
            $this->noteModel->login($loginData);
        }

        $this->view->render('login');
    }

    public function logoutAction(): void
    {
        $this->view->render('logout');
    }

    public function uploadAction(): void
    {
        if ($this->request->hasPosted()) {
            $data = [
                'file' => $this->request->postParam('file'),
            ];
            $this->noteModel->upload($data);
        }

        $this->view->render('upload');
    }

    public function galleryAction(): void
    {
        $this->view->render(
            'gallery',
            [

            ]
        );
    }

    public function contactAction(): void
    {
        if ($this->request->hasPosted()) {
            $contactData = [
                'email' => $this->request->postParam('email'),
                'topic' => $this->request->postParam('topic'),
                'question' => $this->request->postParam('question')
            ];
            $this->noteModel->contact($contactData);
        }

        $this->view->render('contact');
    }

    public function messagesAction(): void
    {
        $messages = $this->noteModel->messages();

        $this->view->render(
            'messages',
            [
                'questions' => $messages,
                'beforeQuestions' => $this->request->getParam('beforeQuestions')
            ]
        );
    }

    public function adminAction(): void
    {
        $usersList = $this->noteModel->admin();

        $this->view->render(
            'admin',
            [
                'users' => $usersList,
                'beforeAdmin' => $this->request->getParam('beforeAdmin')
            ]
        );
    }

    public function deleteAdminAction(): void
    {
        if ($this->request->isPost()) {
            $usersID = (int)$this->request->postParam('usersID');
            $this->noteModel->deleteAdmin($usersID);
            $this->redirect('/', ['beforeAdmin' => 'deleted']);
        }
    }
}
