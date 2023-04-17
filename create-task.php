<!-- Début entête commun -->
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mes tâches</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script defer src="/assets/js/script.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
  <header role="presentation">
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark text-light">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="https://getbootstrap.com/docs/5.2/assets/brand/bootstrap-logo.svg" alt="Bootstrap" width="30" height="24" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-transform-uppercase active" aria-current="page" href="list-tasks.php">
                <i class="fa-solid fa-border-none"></i>
                Mes Tâches
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-transform-uppercase" href="create-task.php">
                <i class="fa-regular fa-square-plus"></i>
                Nouvelle Tâche
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main class="flex-grow-1 pt-4">
    <!--<div class="toast align-items-center text-white bg-success border-0 position-fixed top-2 end-0 me-2" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          L'enregistrement a été réalisé avec succès !
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>-->
    <div class="container">
      <!-- Fin entête commun  -->
      <?php
      require_once "Classes/ConnectBD.php";

      // Vérifier si le formulaire a été soumis
      if (isset($_POST["submit"])) {

        // Vérifier que les champs requis ont été remplis
        if (isset($_POST['label'], $_POST['duration']) && !empty($_POST['label']) && !empty($_POST['duration'])) {

          // Récupérer les données du formulaire
          $label = $_POST["label"];
          $duration = $_POST["duration"];

          // Préparer la requête SQL avec des paramètres nommés
          $sqlInsert = "INSERT INTO TASKS (label, duration, created_at) VALUES (:label, :duration, NOW())";
          $stmt = $base->prepare($sqlInsert);

          // Lier les paramètres nommés aux valeurs des variables
          $stmt->bindParam(':label', $label);
          $stmt->bindParam(':duration', $duration);

          // Exécuter la requête et vérifier le résultat
          if ($stmt->execute()) {
            // Rediriger l'utilisateur vers la page "list-tasks.php"
            header("Location: list-tasks.php?msg=Enregistrement réalisé avec succès");
          } else {
            echo "Une erreur s'est produite lors de l'ajout de la tâche à la base de données";
            //$errorInfo = $stmt->errorInfo();
            //echo "<pre>";
            //print_r($errorInfo);
            //echo "</pre>";
            //var_dump($sqlInsert);
          }
        } else {
          echo "Veuillez remplir tous les champs obligatoires";
        }
      }
      ?>

      <div class="row h-100 justify-content-center align-items-center px-2">
        <div class="col-md-5 shadow p-4">
          <h1 class="text-center display-4">Nouvelle Tâche</h1>
          <form method="post">
            <div class="mb-3">
              <label for="label">Intitulé</label>
              <input class="form-control" type="label" name="label" id="label" placeholder="Réserver des billets" required />
            </div>
            <div class="mb-3">
              <label for="duration">Durée</label>
              <input class="form-control" type="number" step="10" min="0" name="duration" id="duration" placeholder="20" value="10" required />
              <div id="durationHelp" class="form-text">
                La durée doit être exprimée en minutes et par multiples de
                10min.
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-dark" name="submit" type="submit">Enregister</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </main>
  <!-- Début bas de page commun -->
  <footer id="site-footer" class="bg-dark text-light py-3">
    <div class="container">
      <p class="m-0">&copy; 2023</p>
    </div>
  </footer>
</body>

</html>
<!-- Fin bas de page commun -->