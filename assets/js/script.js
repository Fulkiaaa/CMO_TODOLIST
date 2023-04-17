(function () {
  ('use strict');

  // Trigger des toasts bootstrap via javascript
  window.addEventListener('DOMContentLoaded', () => {
    const toastElList = [].slice.call(document.querySelectorAll('.toast'));
    const toastList = toastElList.map(function (toastEl) {
      return new bootstrap.Toast(toastEl, { delay: 2000 });
    });
    toastList.forEach((toast) => toast.show());
  });

  /**
   * Traitement de la confirmation de la suppression d'une tâche.
   */
  // TODO 
  // On sélectionne l'élément de lien de suppression et le modal de confirmation de suppression
  var deleteLink = document.getElementById('delete-link');
  var deleteModal = document.getElementById('deleteModal');
  
  // On ajoute un événement "show.bs.modal" au modal de confirmation de suppression
  deleteModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var taskId = button.getAttribute('data-id');

    // On met à jour le lien de suppression avec l'id de la tâche correspondante
    deleteLink.setAttribute('href', 'delete-task.php?id=' + taskId);
  });
  
  /**
   * On joue la fonction lorsque une interaction avec un checkbox est détecté.
   */
  // On sélectionne tous les éléments de type "checkbox" dans le document
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
checkboxes.forEach((checkbox) => {
  // On ajoute un événement "change" à chaque case à cocher
  checkbox.addEventListener('change', (event) => {
    const row = event.target.closest('tr');
    const edit = document.querySelector(`#btn-edit-${row.dataset.id}`);
    const del = document.querySelector(`#btn-del-${row.dataset.id}`);
    const checkboxId = `checkbox-${row.dataset.id}`;

     // Si la case à cocher est cochée
    if (event.target.checked) {
      row.style.textDecoration = 'line-through';
      edit.classList.add('disabled');
      del.classList.add('disabled');
      localStorage.setItem(checkboxId, 'checked');
    } else {
      row.style.textDecoration = 'none';
      edit.classList.remove('disabled');
      del.classList.remove('disabled');
      localStorage.removeItem(checkboxId);
    }
  });

  // On récupère la ligne, les boutons d'édition et de suppression et l'id de la tâche correspondante à la case à cocher
  const row = checkbox.closest('tr');
  const edit = document.querySelector(`#btn-edit-${row.dataset.id}`);
  const del = document.querySelector(`#btn-del-${row.dataset.id}`);
  const checkboxId = `checkbox-${row.dataset.id}`;

  // Si la case à cocher a été cochée auparavant (stockage local), on restaure son état et on désactive les boutons d'édition et de suppression
  if (localStorage.getItem(checkboxId) === 'checked') {
    checkbox.checked = true;
    row.style.textDecoration = 'line-through';
    edit.classList.add('disabled');
    del.classList.add('disabled');
  }
});



/**
 * Cette fonction est utilisée pour faire une requête AJAX en réponse au clic sur une checkbox de la tâche.
 * Elle récupère l'id de la tâche depuis son attribut 'data' et envoie une requête POST à l'URL 'update-tasks-completed.php' pour mettre à jour l'état de la tâche.
 * Si la réponse est positive, elle met à jour le DOM pour refléter l'état actuel de la tâche.
 */
function ajaxCall() {
  //Elle est placée dans la page list-tasks.php ligne 163
  //Je n'ai pas réussi à l'appeler
  }
})();
