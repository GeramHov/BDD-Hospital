<?php

$dns = 'mysql:host=localhost;dbname=hospitale2n;charset=utf8';
$id = 'root';
$pass = '';

try
{
	$dataBase = new PDO($dns, $id, $pass);
}
  catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

$sqlTable = $dataBase->query('SELECT * FROM patients' );
$patients = $sqlTable->fetchAll();



if(isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['birthdate']) && isset($_POST['phone']) && isset($_POST['mail']) && isset($_POST['id'])) {
  $lastname = $_POST['lastname'];
  $firstname = $_POST['firstname'];
  $birthdate = $_POST['birthdate'];
  $phone = $_POST['phone'];
  $mail = $_POST['mail'];
  $id = $_POST['id'];
  $delete = $dataBase->prepare("DELETE FROM patients WHERE id = :id");
  $delete->execute([
    'id' => $id
  ]);
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand active text-white" href="index.php">Home Page</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="patient-add.php">Add a Patient</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="patient-list.php">List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="patient-profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="set-app.php">Set an appointment</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="app-list.php">Appointment List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="all-apps.php">All appointments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="rendez-vous.php">Rendez-vous!</a>
        </li>
    </div>
  </div>
</nav>  
<div class="container w-25 ">
<div class="card bg-light">
  <div class="card-body">
    <?php
      foreach ($patients as $patient) {
        echo '<li>' . $patient[1] . ' ' . $patient[2] . '</li>';
        echo '<br>';
          }
    ?>
  
  </div>
</div>
<h3 class="text-light mt-4">
  < Search a patient >
</h3>
</div>
<div class="container d-flex justify-content-evenly">
<form action="patient-list.php" method="post">
  <input type="text" name="search" placeholder="Search a patient">
  <input type="submit" value="Search">
</form>
</div>
<div class="container text-center my-5">
  <li>
    <h3 class="text-light">
      <?php
        if (isset($_POST['search'])) {
          $search = $_POST['search'];
          $query = $dataBase->prepare("SELECT * FROM patients WHERE lastname LIKE :search OR firstname LIKE :search");
          $query->execute(array(':search' => '%' . $search . '%'));
          $patients = $query->fetchAll();
          if (count($patients) > 0) {
            foreach ($patients as $patient) {
              echo $patient['lastname'] . " " . $patient['firstname'] . '<br>';
            }
          } else {
            echo "Aucun résultat trouvé pour '$search'";
          }
        } else {
          $sqlTable = $dataBase->query('SELECT * FROM patients');
          $patients = $sqlTable->fetchAll();
        }
      ?>
    </h3>
  </li>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>