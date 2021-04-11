<?php 
class Todo 
{
  private $db;

  const DATABASE = 'php_todo';
  const USERNAME = 'root';
  const PASSWORD = '';

  /**
  * Class constructor
  * 
  * @author mohammad
  * @param string $con
  */
  function __construct() 
  {
    $this->db = mysqli_connect("localhost", self::USERNAME, self::PASSWORD, self::DATABASE);

    if( ! $this->db ) exit;
  }

  /**
  * Add new todo
  * 
  * @author mohammad
  * @param string $task
  */
  public function install() 
  {
    $query = "CREATE TABLE IF NOT EXISTS `todo` (`id` int(11) NOT NULL AUTO_INCREMENT, `todo` varchar(200) NOT NULL, `date` varchar(200) NOT NULL, `done` int(11) NOT NULL, PRIMARY KEY (`id`))";
    $run = mysqli_query($this->db, $query);
    if($run)
      echo 'Done<p><a href="/todo">Go to home</a></p>';
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
    $this->redirect("/todo");
  }

  /**
  * Show done todos
  * 
  * @author mohammad
  */
  public function doneTodos()
  {
    $query = "SELECT * FROM todo WHERE todo.done=1 ORDER BY `date` ASC";
    $doneTodos = $this->run_query_return($query);

    $num = 1;
    while( $row = mysqli_fetch_array($doneTodos) ):
      echo '<tr>';
        echo '<th scope="row">'.$num.'</th>';
        echo '<td>'.$row["todo"].'</td>';
        echo '<td>'.date('m/d/Y', $row["date"]).'</td>';
        echo '<td>'; 
          echo '<a href="?id='.$row["id"].'&action=return">Return</a>';
          echo ' &nbsp;<a href="?id='.$row["id"].'&action=edit&todo='.$row["todo"].'" class="text-success">Edit</a>';
          echo ' <a class="text-danger mx-2 d-inline-block" href="?id='.$row["id"].'&action=delete">Delete</a>';
        echo '</td>';
      echo '</tr>';
      $num++;
    endwhile;
  }

  /**
  * Show todos
  * 
  * @author mohammad
  */
  public function todos() 
  {
    $query = "SELECT * FROM todo WHERE todo.done=0 ORDER BY `date` ASC";
    $todos = $this->run_query_return($query);

    $num = 1;
    while( $row = mysqli_fetch_array($todos) ):
      echo '<tr>';
        echo '<th scope="row">'.$num.'</th>';
        echo '<td>'.$row["todo"].'</td>';
        echo '<td>'.date('m/d/Y', $row["date"]).'</td>';
        echo '<td>'; 
          echo ($row["done"]==0) ? '<a href="?id='.$row["id"].'&action=done">Done</a>' : '';
          echo ' &nbsp;<a href="?id='.$row["id"].'&action=edit&todo='.$row["todo"].'" class="text-success">Edit</a>';
          echo ' <a class="text-danger mx-2 d-inline-block" href="?id='.$row["id"].'&action=delete">Delete</a>';
        echo '</td>';
      echo '</tr>';
      $num++;
    endwhile;
  }
  
  /**
  * Run sql query and return result
  * 
  * @author mohammad
  * @param string $query
  */
  private function run_query_return($query) 
  {
    return mysqli_query($this->db, $query);
  }

  /**
	 * Simple redirect function.
	 * @param string $url optional
	 */
	public function redirect($url='') {
		header('Location: '.$url);
	}
}

$todo = new Todo();