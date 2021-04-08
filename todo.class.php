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

    $data = [ 'done' => 0, 'date' => $now ];
    $where = [ 'id' => $id ];
    $query = $this->update_sql_query($data, $where, $table='todo');

    $this->run_query($query);
  }

  public function done_todo($id)
  {
    $now = time();

    $data = [ 'done' => 1, 'date' => $now ];
    $where = [ 'id' => $id ];
    $query = $this->update_sql_query($data, $where, $table='todo');

    $this->run_query($query);
  }

  public function update_todo($id, $task)
  {
    $task = $_POST['task'];

    $data = [ 'todo' => $task ];
    $where = [ 'id' => $id ];
    $query = $this->update_sql_query($data, $where, $table='todo');

    $this->run_query($query);
  }

  public function update_sql_query($data, $where, $table='todo') 
  {
    $cols = [];
    foreach($data as $key=>$val) {
        $cols[] = $table.".$key = '$val'";
    }

    $wheres = [];
    foreach($where as $key=>$val) {
      $wheres[] = $table.".$key = '$val'";
    }

    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE " . implode(', ', $wheres);
 
    return($sql);
  }

  private function run_query($query) 
  {
    mysqli_query($this->db, $query);
    header("location:/todo");
  }
}