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
      break;
    case 'Return':
      $todo->return_todo( $id );
      break;
    case 'Done':
      $todo->done_todo( $id );
      break;
  }
}

if( isset($_POST['updateLast']) ) 
{
  $task = $_POST['task'];
  $id = $_POST['task_id'];

  $todo->update_todo( $id, $task );
}