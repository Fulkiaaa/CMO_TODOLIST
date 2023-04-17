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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
  <script defer src="/assets/js/script.js"></script>
  <script src="js/jquery-3.2.1.min.js"></script>
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
    <div class="container">
      <!-- <div class="toast align-items-center text-white bg-success border-0 position-fixed top-2 end-0 me-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            La suppression a été réalisée avec succès !
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>-->
      <!-- Fin entête commun  -->
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h1 class="text-center display-4 mb-4">Mes Tâches</h1>
          <?php
          include "Classes/ConnectBD.php";

          // Vérifier si un message est présent dans l'URL
          if (isset($_GET['msg'])) {
            $message = htmlspecialchars($_GET['msg']);
          } else {
            $message = '';
          }

          // Afficher le message de confirmation
          if (!empty($message)) {
            echo '<div class="toast align-items-center text-white bg-success border-0 position-fixed top-2 end-0 me-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body">'.$message.'</div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>';
          }
          $sqlresultat = $base->query('SELECT id,label, duration, created_at, completed from Tasks');
          $sqlresultat->setFetchMode(PDO::FETCH_OBJ);
          ?>
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Intitulé</th>
                <th class="text-center">Date de création</th>
                <th class="text-center">Durée</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody class="tasks-list">
              <?php $i = 1; ?>
              <?php while ($objetTasks = $sqlresultat->fetch()) : ?>
                <tr data-id="<?= $objetTasks->id ?>">
                  <td class="align-middle">
                    <?php if ($objetTasks->completed) { ?>
                      <input type="checkbox" data-todo-id="<?= $objetTasks->id ?>" class="check-box" checked />
                    <?php } else { ?>
                      <input type="checkbox" data-todo-id="<?= $objetTasks->id ?>" class="check-box" />
                    <?php } ?>
                  </td>
                  <td class="w-25 align-middle" id="task-label"><?= $objetTasks->label ?></td>
                  <td class="text-center align-middle"><?= $objetTasks->created_at ?></td>
                  <td class="text-center align-middle"><?= $objetTasks->duration ?> min</td>
                  <td class="w-25 align-middle">
                    <div class="d-flex justify-content-evenly">
                      <a href="edit-task.php?id=<?= $objetTasks->id ?>" class="badge bg-warning p-2 btn " id="btn-edit-<?= $objetTasks->id ?>">
                        <i class="fa-regular fa-pen-to-square"></i>
                      </a>
                      <a href="#" class="badge bg-danger delete p-2 btn " data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $objetTasks->id ?>" id="btn-del-<?= $objetTasks->id ?>">
                        <i class="fa-solid fa-trash"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endwhile; ?>
            </tbody>
          </table>
          <!-- Modal de confirmation de suppression -->
          <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="deleteModalLabel">
                    Supprimer ?
                  </h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Êtes-vous sûr de vouloir supprimer la tâche ?</p>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

                  <a href="delete-task.php?id=" class="btn btn-primary" id="delete-link">Supprimer</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Fin Modal de confirmation -->
          <!-- Message à afficher si aucune tâche n'est trouvée -->
          <p>
            <?php
            $sqlCount = 'SELECT COUNT(id) FROM tasks';
            $reponse = $base->query($sqlCount);
            $res = $reponse->fetch();
            $count = $res["COUNT(id)"];

            if ($count >= 1) {
              echo '<a href="create-task.php">Ajouter une tâche</a>';
            } else if ($count == 0) {
              echo 'Vous n\'avez aucune tâche dans votre liste. <a href="create-task.php">Créer une tâche</a>';
            }
            ?>
          </p>
        </div>
      </div>
  </main>
  <script>
    $(".check-box").click(function(e) {
      const id = $(this).attr('data-todo-id');

      $.post('update-tasks-completed.php', {
          id: id
        },
        (data) => {
          if (data != 'error') {
            const td = $(this).next();
            if (data === '1') {
              td.removeClass('checked');
            } else {
              td.addClass('checked');
            }
          }
        }
      );
    });
  </script>
  <!-- Début bas de page commun -->
  <footer id="site-footer" class="bg-dark text-light py-3">
    <div class="container">
      <p class="m-0">&copy; 2023</p>
    </div>
  </footer>
</body>

</html>
<!-- Fin bas de page commun -->