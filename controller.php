<?php

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
  $now = time();

  switch($_GET['status']){
    case 'done':
      $query = "UPDATE todo SET todo.done=1, todo.date='$now' WHERE todo.id='$id'";
      break;
    case 'delete':
      $query = "DELETE FROM todo WHERE todo.id='$id'";
      break;
  }
  
  $done = mysqli_query($con, $query);
}