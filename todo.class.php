<?php 
class Todo 
{
  private $db;

  /**
  * Class constructor
  * 
  * @author mohammad
  * @param string $con
  */
  function __construct($con) 
  {
      $this->db = $con;
  }

  /**
  * Add new todo
  * 
  * @author mohammad
  * @param string $task
  */
  public function add_todo($task) 
  {
    $date = time();
    $query = "INSERT INTO todo (todo, date, done) VALUES ('$task', '$date', '0')";
    
    $this->run_query($query);
  }

  /**
  * Delete todo
  * 
  * @author mohammad
  * @param int $id
  */
  public function delete_todo($id)
  {
    $query = "DELETE FROM todo WHERE todo.id='$id'";
    $this->run_query($query);
  }

  /**
  * Return todo to undone
  * 
  * @author mohammad
  * @param int $id
  */
  public function return_todo($id)
  {
    $now = time();

    $data = [ 'done' => 0, 'date' => $now ];
    $where = [ 'id' => $id ];

    $this->update_sql_query($data, $where, $table='todo');
  }

  /**
  * Done todo
  * 
  * @author mohammad
  * @param int $id
  */
  public function done_todo($id)
  {
    $now = time();

    $data = [ 'done' => 1, 'date' => $now ];
    $where = [ 'id' => $id ];

    $this->update_sql_query($data, $where, $table='todo');
  }

  /**
  * Update todo
  * 
  * @author mohammad
  * @param int $id
  * @param string $task
  */
  public function update_todo($id, $task)
  {
    $task = $_POST['task'];

    $data = [ 'todo' => $task ];
    $where = [ 'id' => $id ];

    $this->update_sql_query($data, $where, $table='todo');
  }

  /**
  * Sql query and run for todo update
  * 
  * @author mohammad
  * @param array $data
  * @param array $where
  * @param string $table
  */
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

    $query = "UPDATE $table SET " . implode(', ', $cols) . " WHERE " . implode(', ', $wheres);
 
    $this->run_query($query);
  }

  /**
  * Run sql query and header to home
  * 
  * @author mohammad
  * @param string $query
  */
  private function run_query($query) 
  {
    mysqli_query($this->db, $query);
    header("location:/todo");
  }
}