<!-- Début entête commun -->
<?php
include "Classes/ConnectBD.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta label="viewport" content="width=device-width, initial-scale=1.0" />
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
              <a class="nav-link text-uppercase active" aria-current="page" href="list-tasks.php">
                <i class="fa-solid fa-border-none"></i>
                Mes Tâches
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-uppercase" href="create-task.php">
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
          La modification a été réalisée avec succès !
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>-->
    <div class="container">
      <!-- Fin entête commun  -->
      <?php
      include "Classes/ConnectBD.php";

      if (isset($_POST['submit'])) {
        if (isset($_POST['id'], $_POST['label'], $_POST['duration']) && !empty($_POST['id']) && !empty($_POST['label']) && !empty($_POST['duration'])) {
          $id = strip_tags($_POST['id']);
          $label = strip_tags($_POST['label']);
          $duration = strip_tags($_POST['duration']);

          $sql = "UPDATE TASKS SET label=:label, duration=:duration WHERE id=:id;";

          $query = $base->prepare($sql);

          $query->bindValue(':label', $label, PDO::PARAM_STR);
          $query->bindValue(':duration', $duration, PDO::PARAM_STR);
          $query->bindValue(':id', $id, PDO::PARAM_INT);

          $query->execute();

          header('Location: list-tasks.php?msg=Modification réalisée avec succès ! ');
          exit();
        }
      }

      if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = strip_tags($_GET['id']);
        $sql = "SELECT * FROM `tasks` WHERE `id`=:id;";

        $query = $base->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch();
      }
      ?>

      <div class="row h-100 justify-content-center align-items-center px-2">
        <div class="col-md-5 shadow p-4">
          <h1 class="text-center display-4">Modifier la tâche</h1>
          <form action="" method="post">
            <div class="mb-3">
              <label for="label">Intitulé</label>
              <input class="form-control" type="text" name="label" id="label" value="<?= $result['label'] ?>" required />
            </div>
            <div class="mb-3">
              <label for="duration">Durée</label>
              <input class="form-control" type="number" step="10" min="0" name="duration" id="duration" value="<?= $result['duration'] ?>" required />
              <div id="durationHelp" class="form-text">
                La durée doit être exprimée en minutes et par multiples de 10min.
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-dark" type="submit" name="submit">
                Enregister les modifications
              </button>
              <input type="hidden" name="id" value="<?= $result['id'] ?>">
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