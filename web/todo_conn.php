<?php
class ToDo {
  // (A) CONSTRUCTOR - CONEXIÓN A LA BBDD
  private $pdo = null;
  private $stmt = null;
  public $error = "";
  function __construct () {
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  // (B) DESTRUCTOR - CIERRA CONEXIÓN BBDD
  function __destruct () {
    if ($this->stmt!==null) { $this->stmt = null; }
    if ($this->pdo!==null) { $this->pdo = null; }
  }

  // (C) HELPER - EJECUTA CONSULTAS SQL
  function query ($sql, $data=null) : void {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
  }

  // (D) GUARDA TAREA TO-DO
  function save ($task, $status, $id=null) {
    if ($id===null) {
      $sql = "INSERT INTO `todo` (`todo_task`, `todo_status`) VALUES (?,?)";
      $data = [$task, $status];
    } else {
      $sql = "UPDATE `todo` SET `todo_task`=?, `todo_status`=? WHERE `todo_id`=?";
      $data = [$task, $status, $id];
    }
    $this->query($sql, $data);
    return true;
  }

  // (E) OBTIENE TODAS LAS TAREAS
  function getAll () {
    $this->query("SELECT * FROM `todo`");
    return $this->stmt->fetchAll();
  }

  // (F) ELIMINA TAREA 
  function del ($id) {
    $this->query("DELETE FROM `todo` WHERE `todo_id`=?", [$id]);
    return true;
  }
}

// (G) PARÁMEROS DE LA BASE DE DATOS - CAMBIAR SI SE CAMBIA EL ARCHIVO .env
define("DB_HOST", "db");
define("DB_NAME", "miBBDD");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "raul");
define("DB_PASSWORD", "profesor");

// (H) NUEVO OJBETO TO-DO
$TODO = new ToDo();