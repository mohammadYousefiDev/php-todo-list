<?php

if( isset($_POST['addNew']) )
  $todo->add_todo( $_POST['task'] );

if( isset($_GET['action']) ) 
{
  $id = $_GET['id'];
  switch( $_GET['action'] ) 
  {
    case 'delete':
      $todo->delete_todo( $id );
    case 'return':
      $todo->return_todo( $id );
    case 'done':
      $todo->done_todo( $id );
  }
}
  

if( isset($_POST['updateLast']) ) {
  $task = $_POST['task'];
  $date = time();
  $id = $_POST['task_id'];

  $query = "UPDATE todo SET todo.todo='$task' WHERE todo.id='$id'";
  $done = mysqli_query($con, $query);

  header("location:/todo");
}