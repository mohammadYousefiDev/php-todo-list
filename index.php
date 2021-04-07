<?php
include("dbconnect.php");
include("controller.php");
include("functions.php");
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>TODO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  </head>

  <body>

  <div class="col-md-5 mx-auto mt-5">
    <form action="" class="input-group-append" method="post" autocomplete="off">
      <div class="input-group mb-3">
      <input required type="text" value="<?php echo isset($_GET['action']) && $_GET['action'] == 'edit' ? $_GET['todo'] : ''; ?>" name="task" class="form-control" name id="task" placeholder="write a task ...">
        <div class="input-group-append">
        <input name="<?php echo isset($_GET['action']) && $_GET['action'] == 'edit' ? 'updateLast' : 'addNew'; ?>" type="submit" value="<?php echo isset($_GET['action']) && $_GET['action'] == 'edit' ? 'Edit' : 'Add'; ?>" class="btn btn-primary" />
        <input type="hidden" type="submit" value="<?php echo isset($_GET['action']) && $_GET['action'] == 'edit' ? $_GET['id'] : ''; ?>" name="task_id"/>
        </div>
      </div>
    </form>
  
    <h3 class="mt-4">Todos: </h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Task</th>
          <th scope="col">Date</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      Todos();
      ?>
      </tbody>
    </table>

    <br />
    <h3>Done: </h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Task</th>
          <th scope="col">Date</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      doneTodos();
      ?>
      </tbody>
    </table>
  </div>
  

  </body>

</html>