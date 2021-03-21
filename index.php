<?php
include("dbconnect.php");

if( isset($_POST['task']) ) {
  $task = $_POST['task'];
  $date = time();

  $query = "INSERT INTO todo (todo, date, done) VALUES ('$task', '$date', '0')";
  $done = mysqli_query($con, $query);
  if( $done ) {
    $seccessAdded = 1;
  }
}

if( isset($_GET['status']) ) {
  $id = $_GET['id'];
  $query = "UPDATE todo SET todo.done=1 WHERE todo.id='$id'";
  $done = mysqli_query($con, $query);
}
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
        <label for="task" class="form-label">Enter Task</label>
        <input required type="text" name="task" class="form-control" name id="task" placeholder="">
        <?php 
          if(isset($seccessAdded)) {
            echo '<div class="mt-3 alert alert-success" role="alert"> Task added successfully. </div>';
          }
        ?>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3">Save</button>
      </div>
    </form>
    
    <?php 
    $results = mysqli_query($con, "SELECT * FROM todo ORDER BY `date` DESC");
    ?>

    <table class="table">
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
      while( $row = mysqli_fetch_array($results) ):
        echo '<tr>';
          echo '<th scope="row">'.$row["id"].'</th>';
          echo '<td>'.$row["todo"].'</td>';
          echo '<td>'.date('m/d/Y', $row["date"]).'</td>';
          echo '<td>'; 
            echo ($row["done"]==0) ? '<a href="?id='.$row["id"].'&status=done">Done</a>' : '';
          echo '</td>';
        echo '</tr>';
      endwhile;
      ?>
      </tbody>
    </table>
  </div>
  

  </body>

</html>