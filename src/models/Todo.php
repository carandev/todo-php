<?php

namespace Carandev\Todo\models;

use \Carandev\Todo\lib\Database;
use PDO;

class Todo extends Database
{

  private string $uuid;

  public function __construct(private string $title, private string $content)
  {
    parent::__construct();
    $this->uuid = uniqid();
  }

  public function save()
  {
    $query = $this->connect()->prepare("INSERT INTO todos (uuid, title, content, updated) VALUES (:uuid, :title, :content, NOW())");
    $query->execute(['title' => $this->title, 'uuid' => $this->uuid, 'content' => $this->content]);
  }

  public function update()
  {
    $query = $this->connect()->prepare("UPDATE todos SET title = :title, content = :content, updated = NOW() WHERE uuid = :uuid");
    $query->execute(['title' => $this->title, 'content' => $this->content, 'uuid' => $this->uuid]);
  }

  public static function get($uuid): Todo
  {
    $db = new Database();
    $query = $db->connect()->prepare("SELECT * FROM todos WHERE uuid = :uuid");
    $query->execute(['uuid' => $uuid]);

    return Todo::createFromArray($query->fetch(PDO::FETCH_ASSOC));
  }

  public static function getAll(): array
  {

    $todos = [];
    $db = new Database();
    $query = $db->connect()->query("SELECT * FROM todos");

    while ($record = $query->fetch(PDO::FETCH_ASSOC)) {
      $todo = Todo::createFromArray($record);
      array_push($todos, $todo);
    }

    return $todos;
  }

  public static function createFromArray($arr): Todo
  {
    $todo = new Todo($arr['title'], $arr['content']);
    $todo->setUuid($arr['uuid']);

    return $todo;
  }

  public static function deleteByUuid($uuid)
  {
    $db = new Database();
    $query = $db->connect()->prepare("DELETE FROM todos WHERE uuid = :uuid");
    $query->execute(['uuid' => $uuid]);
  }

  /**
   * @return string
   */
  public function getUuid(): string
  {
    return $this->uuid;
  }

  /**
   * @param string $uuid
   */
  public function setUuid(string $uuid): void
  {
    $this->uuid = $uuid;
  }

  /**
   * @return string
   */
  public function getTitle(): string
  {
    return $this->title;
  }

  /**
   * @param string $title
   */
  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  /**
   * @return string
   */
  public function getContent(): string
  {
    return $this->content;
  }

  /**
   * @param string $content
   */
  public function setContent(string $content): void
  {
    $this->content = $content;
  }
}
