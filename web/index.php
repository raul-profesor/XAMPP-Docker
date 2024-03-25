<!DOCTYPE html>
<html>
  <head>
    <title>Lista "To Do" simple</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="3b-todo.css">
    <script src="todo.js"></script>
  </head>
  <body>
    <?php
    // (A) AÑADIR/ACTUALIZAR/ELIMINAR TAREA SI SE ENVÍA FORMULARIO
    require "todo_conn.php";
    if (isset($_POST["action"])) {
      // (A1) GUARDAR TAREA
      if ($_POST["action"]=="save") {
        $pass = $TODO->save($_POST["task"], $_POST["status"], (isset($_POST["id"])?$_POST["id"]:null));
      }

      // (A2) ELIMINAR TAREA
      else { $pass = $TODO->del($_POST["id"]); }

      // (A3) MOSTRAR RESULTADOS
      echo "<div class='notify'>";
      echo $pass ? "OK" : $TODO->error ;
      echo "</div>";
    }
    ?>

    <!-- (B) ELIMINAR FORMULARIO -->
    <form id="ninForm" method="post">
      <input type="hidden" name="action" value="del">
      <input type="hidden" name="id" id="ninID">
    </form>

    <div id="tasks">
      <!-- (C) AÑADIR NUEVA TAREA -->
      <form method="post">
        <input type="hidden" name="action" value="save">
        <input type="text" id="taskadd" name="task" placeholder="Tarea" required>
        <select name="status">
          <option value="0">Pendiente</option>
          <option value="1">Hecho</option>
          <option value="2">Cancelado</option>
        </select>
        <input type="submit" value="Añadir">
      </form>

      <!-- (D) LISTAR TAREAS -->
      <?php
      $tasks = $TODO->getAll();
      if (count($tasks)!=0) { foreach ($tasks as $t) { ?>
      <form method="post">
        <input type="button" value="X" onclick="deltask(<?=$t["todo_id"]?>)">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?=$t["todo_id"]?>">
        <input type="text" name="task" placeholder="Tarea" value="<?=$t["todo_task"]?>">
        <select name="status">
          <option value="0"<?=$t["todo_status"]==0?" selected":""?>>Pendiente</option>
          <option value="1"<?=$t["todo_status"]==1?" selected":""?>>Hecho</option>
          <option value="2"<?=$t["todo_status"]==2?" selected":""?>>Cancelado</option>
        </select>
        <input type="submit" value="Guardar">
      </form>
      <?php }} ?>
    </div>
  </body>
</html>