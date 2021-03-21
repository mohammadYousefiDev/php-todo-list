<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <title>TODO Installer</title>
</head>
<body>
  <div class="col-md-6 mx-auto mt-5 shadow rounded p-4">
    <p>Beginning installation...</p>
    <?php
      echo "<p>1. Connecting database...<br/>";
      include("dbconnect.php");
      echo "Done</p>";

      echo "<p>2. Creating table... <br/>";
      $query1 = "CREATE TABLE IF NOT EXISTS `todo` (`id` int(11) NOT NULL AUTO_INCREMENT, `desc` varchar(200) NOT NULL, `date` date NOT NULL, `done` int(11) NOT NULL, PRIMARY KEY (`id`))";
      $x = mysqli_query($con, $query1);

      if($x==1){
        echo "Done <p>";

        echo '<p><a href="/todo">Go to home</a></p>';
      }
      else{
        echo "Error during installation <br>";
      }

      mysqli_close($con);
    ?>
  </div>
  
</body>
</html>

