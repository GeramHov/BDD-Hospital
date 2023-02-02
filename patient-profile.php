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

if(isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['birthdate']) && isset($_POST['phone']) && isset($_POST['mail']) ) {
  $lastname = $_POST['lastname'];
  $firstname = $_POST['firstname'];
  $birthdate = $_POST['birthdate'];
  $phone = $_POST['phone'];
  $mail = $_POST['mail'];
  $id = $_POST['id'];
  $update = $dataBase->prepare("UPDATE patients SET lastname = :lastname, firstname = :firstname, birthdate = :birthdate, phone = :phone, mail = :mail WHERE id = :id");
  $update->execute([
    'lastname' => $lastname,
    'firstname' => $firstname,
    'birthdate' => $birthdate,
    'phone' => $phone,
    'mail' => $mail,
    'id' => $id
  ]);
}

$sqlApps = $dataBase->query('SELECT * FROM appointments' );
$apps = $sqlApps->fetchAll();

if(isset($_POST['dateHour']) && isset($_POST['idPatients']) && isset($_POST['id'])) {
  $dateHour = $_POST['dateHour'];
  $idPatients = $_POST['idPatients'];
  $id = $_POST['id'];
  $update = $dataBase->prepare("UPDATE appointments SET dateHour = :dateHour, idPatients = :idPatients WHERE id = :id");
  $update->execute([
    'dateHour' => $dateHour,
    'idPatients' => $idPatients,
    'id' => $id
  ]);
}




?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient Profile</title>
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
          <a class="nav-link text-white" href="patient-list.php">List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="patient-profile.php">Profile</a>
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
<div class="container-fluid d-flex justify-content-center flex-wrap text-light my-5">

<?php

foreach ($patients as $patient) {
  echo '<form action="patient-profile.php" method="POST" class="mt-5">
  <div class="mb-3 mx-2">
    <input type="hidden" value= "'. $patient['id'] . '" name="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 mx-2">
    <label for="exampleInputEmail1" class="form-label text-white">Lastname</label>
    <input type="text" value= "'. $patient['lastname'] . '" name="lastname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 mx-2">
    <label for="exampleInputPassword1" class="form-label text-white">Firstname</label>
    <input type="text" value="'. $patient['firstname'] . '" name="firstname" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 mx-2">
    <label for="exampleInputEmail1" class="form-label text-white">Birthdate</label>
    <input type="date" value="'. $patient['birthdate'] . '" name="birthdate" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 mx-2">
    <label for="exampleInputEmail1" class="form-label text-white">Phone</label>
    <input type="tel" value="'. $patient['phone'] . '" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 mx-2">
    <label for="exampleInputEmail1" class="form-label text-white">E-mail</label>
    <input type="email" value="'. $patient['mail'] . '" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <button type="submit" class="btn btn-primary">Modify</button>
</form>';

}

?>
</div>
<div class="container d-flex justify-content-center text-light my-5 w-25">
<?php

foreach ($apps as $app) {
  echo '<form action="all-apps.php" method="POST" class="mt-5">
  <div class="mb-3 mx-2">
    <input type="hidden" value= "'. $app['0'] . '" name="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 mx-2">
    <label for="exampleInputEmail1" class="form-label text-white">App Time</label>
    <input type="text" value= "'. $app['1'] . '" name="dateHour" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 mx-2">
    <label for="exampleInputEmail1" class="form-label text-white">Patient ID</label>
    <input type="text" value= "'. $app['2'] . '" name="idPatients" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <button type="submit" class="btn btn-primary">Modify</button>
</form>';

}

?>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>