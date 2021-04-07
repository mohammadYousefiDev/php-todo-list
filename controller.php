<?php

if( isset($_POST['addNew']) ) {
  $task = $_POST['task'];
  $date = time();

  $query = "INSERT INTO todo (todo, date, done) VALUES ('$task', '$date', '0')";
  $done = mysqli_query($con, $query);

  header("location:/todo");
}

if( isset($_POST['updateLast']) ) {
  $task = $_POST['task'];
  $date = time();
  $id = $_POST['task_id'];

  $query = "UPDATE todo SET todo.todo='$task' WHERE todo.id='$id'";
  $done = mysqli_query($con, $query);

  header("location:/todo");
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
    case 'return':
      $query = "UPDATE todo SET todo.done=0, todo.date='$now' WHERE todo.id='$id'";
      break;
  }
  
  $done = mysqli_query($con, $query);

  header("location:/todo");
}