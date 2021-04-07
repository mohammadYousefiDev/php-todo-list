<?php

function run_query($query) 
{
  global $con;
  return mysqli_query($con, $query);
}

function doneTodos()
{
  $query = "SELECT * FROM todo WHERE todo.done=1 ORDER BY `date` ASC";
  $doneTodos = run_query($query);

  $num = 1;
  while( $row = mysqli_fetch_array($doneTodos) ):
    echo '<tr>';
      echo '<th scope="row">'.$num.'</th>';
      echo '<td>'.$row["todo"].'</td>';
      echo '<td>'.date('m/d/Y', $row["date"]).'</td>';
      echo '<td>'; 
        echo '<a href="?id='.$row["id"].'&status=return">Return</a>';
        echo ' &nbsp;<a href="?id='.$row["id"].'&action=edit&todo='.$row["todo"].'" class="text-success">Edit</a>';
        echo ' <a class="text-danger mx-2 d-inline-block" href="?id='.$row["id"].'&status=delete">Delete</a>';
      echo '</td>';
    echo '</tr>';
    $num++;
  endwhile;
}

function todos() 
{
  $query = "SELECT * FROM todo WHERE todo.done=0 ORDER BY `date` ASC";
  $todos = run_query($query);

  $num = 1;
  while( $row = mysqli_fetch_array($todos) ):
    echo '<tr>';
      echo '<th scope="row">'.$num.'</th>';
      echo '<td>'.$row["todo"].'</td>';
      echo '<td>'.date('m/d/Y', $row["date"]).'</td>';
      echo '<td>'; 
        echo ($row["done"]==0) ? '<a href="?id='.$row["id"].'&status=done">Done</a>' : '';
        echo ' &nbsp;<a href="?id='.$row["id"].'&action=edit&todo='.$row["todo"].'" class="text-success">Edit</a>';
        echo ' <a class="text-danger mx-2 d-inline-block" href="?id='.$row["id"].'&status=delete">Delete</a>';
      echo '</td>';
    echo '</tr>';
    $num++;
  endwhile;
}
  