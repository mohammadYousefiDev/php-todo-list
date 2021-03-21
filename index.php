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
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>TODO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  </head>

  <body>

  <div class="col-md-6 mx-auto mt-5">
    <form action="" method="post">
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
    

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Todo</th>
          <th scope="col">Date</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td colspan="2">Larry the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>
  </div>
  

  </body>

</html>