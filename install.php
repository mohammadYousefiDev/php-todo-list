<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet" />
  <title>TODO Installer</title>
</head>
<body>
  <div class="col-md-6 mx-auto mt-5 bg-white shadow rounded p-4">
    <p>Beginning installation...</p>
    <?php
      require("todo.class.php");
      $todo->install();
    ?>
  </div>
  
</body>
</html>

