<?php
include("dbconnect.php");
include("controller.php");
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>TODO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  </head>

  <body>

  <div class="col-md-6 mx-auto mt-5">
    <form action="" method="post" autocomplete="off">
      <div class="mb-3">
        <input autofocus required type="text" name="task" class="form-control" name id="task" placeholder="write a task ...">
        <?php 
          if(isset($seccessAdded)) {
            echo '<div class="mt-3 alert alert-success" role="alert"> Task added successfully. </div>';
          }
        ?>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3">Add</button>
      </div>
    </form>
    
    <?php 
    $results = mysqli_query($con, "SELECT * FROM todo WHERE todo.done=0 ORDER BY `date` ASC");
    $results1 = mysqli_query($con, "SELECT * FROM todo WHERE todo.done=1 ORDER BY `date` ASC");
    ?>
    <h3>Todos: </h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Todo</th>
          <th scope="col">Date</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
      <?php 
      $num = 1;
      while( $row = mysqli_fetch_array($results) ):
        echo '<tr>';
          echo '<th scope="row">'.$num.'</th>';
          echo '<td>'.$row["todo"].'</td>';
          echo '<td>'.date('m/d/Y', $row["date"]).'</td>';
          echo '<td>'; 
            echo ($row["done"]==0) ? '<a href="?id='.$row["id"].'&status=done">Done</a>' : '';
            echo ' <a class="text-danger mx-2 d-inline-block" href="?id='.$row["id"].'&status=delete">Delete</a>';
          echo '</td>';
        echo '</tr>';
        $num++;
      endwhile;
      ?>
      </tbody>
    </table>

    <br />
    <h3>Done: </h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Todo</th>
          <th scope="col">Date</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
      <?php 
      $num = 1;
      while( $row = mysqli_fetch_array($results1) ):
        echo '<tr>';
          echo '<th scope="row">'.$num.'</th>';
          echo '<td>'.$row["todo"].'</td>';
          echo '<td>'.date('m/d/Y', $row["date"]).'</td>';
          echo '<td>'; 
            echo ($row["done"]==0) ? '<a href="?id='.$row["id"].'&status=done">Done</a>' : '';
            echo ' <a class="text-danger mx-2 d-inline-block" href="?id='.$row["id"].'&status=delete">Delete</a>';
          echo '</td>';
        echo '</tr>';
        $num++;
      endwhile;
      ?>
      </tbody>
    </table>
  </div>
  

  </body>

</html>