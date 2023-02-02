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


if(isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['birthdate']) && isset($_POST['phone']) && isset($_POST['mail']) ) {
  $lastname = $_POST['lastname'];
  $firstname = $_POST['firstname'];
  $birthdate = $_POST['birthdate'];
  $phone = $_POST['phone'];
  $mail = $_POST['mail'];
  $sqlQuery = 'INSERT INTO patients(lastname, firstname, birthdate, phone, mail) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
  $insertPatient = $dataBase->prepare($sqlQuery);
  $insertPatient->execute([
    'lastname' => $lastname,
    'firstname' => $firstname,
    'birthdate' => $birthdate,
    'phone' => $phone,
    'mail' => $mail 
  ]);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
<body>
<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="index.php">Home Page</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="patient-add.php">Add a Patient</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="patient-list.php">List</a>
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
<div class="container text-center w-25 mt-2">
  <h1 class="text-light">Welcome Dear User!</h1> <br>
  <h2 class="text-light">Please provide Your information below</h2>
<form action="patient-add.php" method="POST" class="mt-5">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white">Lastname</label>
    <input type="text" name="lastname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label text-white">Firstname</label>
    <input type="text" name="firstname" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white">Birthdate</label>
    <input type="date" name="birthdate" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white">Phone</label>
    <input type="tel" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label text-white">E-mail</label>
    <input type="email" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>