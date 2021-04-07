<?php 
class Todo 
{
  private $db;

  function __construct($con){
      $this->db = $con;
  }

  public function add_todo($task) 
  {
    $date = time();
    $query = "INSERT INTO todo (todo, date, done) VALUES ('$task', '$date', '0')";
    
    $this->run_query($query);
  }

  public function delete_todo($id)
  {
    $query = "DELETE FROM todo WHERE todo.id='$id'";
    $this->run_query($query);
  }

  public function return_todo($id)
  {
    $now = time();
    $query = "UPDATE todo SET todo.done=0, todo.date='$now' WHERE todo.id='$id'";
    $this->run_query($query);
  }

  public function done_todo($id)
  {
    $now = time();
    $query = "UPDATE todo SET todo.done=1, todo.date='$now' WHERE todo.id='$id'";
    $this->run_query($query);
  }

  private function run_query($query) 
  {
    mysqli_query($this->db, $query);
    header("location:/todo");
  }
}