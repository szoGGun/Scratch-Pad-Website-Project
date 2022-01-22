<?php

declare(strict_types=1);

namespace App\Model;

use App\Exception\StorageException;
use App\Exception\NotFoundException;
use PDO;
use Throwable;

class NoteModel extends AbstractModel implements ModelInterface
{

    public function list(int $pageNumber, int $pageSize, string $sortBy, string $sortOrder): array
    {
        return $this->findBy(null, $pageNumber, $pageSize, $sortBy, $sortOrder);
    }

    public function search(
        string $phrase,
        int    $pageNumber,
        int    $pageSize,
        string $sortBy,
        string $sortOrder
    ): array
    {
        return $this->findBy($phrase, $pageNumber, $pageSize, $sortBy, $sortOrder);
    }

    public function count(): int
    {
        try {
            $query = "
                SELECT count(*) AS cnt
                FROM notes
                ";
            $result = $this->conn->query($query);
            $result = $result->fetch(PDO::FETCH_ASSOC);
            if ($result === false) {
                throw new StorageException('Information on the number of notes could not be retrieved', 400);
            }

            return (int)$result['cnt'];
        } catch (Throwable $e) {
            dump($e);
            throw new StorageException('Information on the number of notes could not be retrieved', 400, $e);
        }
    }

    public function searchCount(string $phrase): int
    {
        try {
            $phrase = $this->conn->quote('%' . $phrase . '%', PDO::PARAM_STR);
            $query = "
                SELECT count(*) AS cnt
                FROM notes
                WHERE title
                LIKE ($phrase)
                ";
            $result = $this->conn->query($query);
            $result = $result->fetch(PDO::FETCH_ASSOC);
            if ($result === false) {
                throw new StorageException('Information on the number of notes could not be retrieved', 400);
            }

            return (int)$result['cnt'];
        } catch (Throwable $e) {
            dump($e);
            throw new StorageException('Information on the number of notes could not be retrieved', 400, $e);
        }
    }

    public function get(int $id): array
    {

        try {
            $query = "SELECT * FROM notes WHERE id = $id";
            $result = $this->conn->query($query);
            $note = $result->fetch(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            throw new StorageException('Cannot download note', 400, $e);
        }

        if (!$note) {
            throw new NotFoundException("There is no note with id: $id");
        }

        return $note;
    }

    public function create(array $data): void
    {
        try {
            $title = $this->conn->quote($data['title']);
            $content = $this->conn->quote($data['content']);
            $created = $this->conn->quote(date('Y-m-d H:i:s'));

            $query = "INSERT INTO notes(title, content, created)
            VALUES($title, $content, $created)
            ";

            $this->conn->exec($query);
        } catch (Throwable $e) {
            throw new StorageException('Cannot create new note', 400, $e);
        }
    }

    public function edit(int $id, array $data): void
    {
        try {
            $title = $this->conn->quote($data['title']);
            $content = $this->conn->quote($data['content']);

            $query = "
            UPDATE notes
            SET title = $title, content = $content
            WHERE id = $id;
            ";

            $this->conn->exec($query);
        } catch (Throwable $e) {
            dump($e);
            throw new StorageException('Cannot edit note', 400, $e);
        }
    }

    public function delete(int $id): void
    {
        try {
            $query = "DELETE FROM notes WHERE id = $id LIMIT 1";
            $this->conn->exec($query);
        } catch (Throwable $e) {
            throw new StorageException('Cannot delete note', 400, $e);
        }
    }

    public function register(array $data): void
    {
        {
            try {
                $username = $this->conn->quote($data['username']);
                $email = $this->conn->quote($data['email']);
                $password = $this->conn->quote($data['password']);

                $query = "INSERT INTO users(login, email, password)
                VALUES($username, $email, $password)
                ";

                if ($_POST['password'] != $_POST['password2']) {
                    echo("Oops! Password did not match! Try again. ");
                } else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    dump($email);
                    echo("Email is not valid");
                } else {
                    echo("User registered");
                    $this->conn->exec($query);
                }

            } catch (Throwable $e) {
                throw new StorageException('Cannot register user', 400, $e);
            }
        }
    }

    public function login(array $data): void
    {
        try {
            session_start();

            if(isset($SESSION["user_login"])){
                header("index.php");
            }

            $username = $this->conn->quote($data['username']);
            $password = $this->conn->quote($data['password']);

            if ($username != "" && $password != "") {
                try {
                    $query = "SELECT * FROM users WHERE login = $username AND password = $password";
                    $result = $this->conn->query($query);
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    $count = $result->rowCount();
                    if ($count == 1 && !empty($row)) {
                        $_SESSION["user_login"] = $row["usersID"];
                        header("refresh:2; index.php");
                    } else {
                        dump("Brak użytkownika");
                    }
                } catch (PDOException $e) {
                    echo "Error : " . $e->getMessage();
                }
            } else {
                $msg = "Both fields are required!";
            }
        } catch (Throwable $e) {
            throw new StorageException('Cannot login user', 400, $e);
        }
    }


    private function findBy(
        ?string $phrase,
        int     $pageNumber,
        int     $pageSize,
        string  $sortBy,
        string  $sortOrder
    ): array
    {
        {
            try {
                $limit = $pageSize;
                $offset = ($pageNumber - 1) * $pageSize;

                if (!in_array($sortBy, ['created', 'title'])) {
                    $sortBy = 'title';
                }

                if (!in_array($sortOrder, ['asc', 'desc'])) {
                    $sortOrder = 'desc';
                }

                $wherePart = '';
                if ($phrase) {
                    $phrase = $this->conn->quote('%' . $phrase . '%', PDO::PARAM_STR);
                    $wherePart = "WHERE title LIKE ($phrase)";
                }


                $query = "
                    SELECT id, title, created
                FROM notes 
                $wherePart
                ORDER BY $sortBy $sortOrder
                LIMIT $offset, $limit
                ";
                $result = $this->conn->query($query);
                return $result->fetchAll(PDO::FETCH_ASSOC);
            } catch (Throwable $e) {
                throw new StorageException('Cannot download notes', 400, $e);
            }
        }
    }
}
