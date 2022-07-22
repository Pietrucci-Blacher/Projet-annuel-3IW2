<section class="pages">
  <h1>Pages</h1>

  <script>
  function redirectToEdit(pageId) {
    if (pageId) {
      window.location.href = `/admin/pages/edit?id=${pageId}`;
    }
  }

  function redirectToAdd() {
    window.location.href = `/admin/pages/add`;
  }
  </script>

  <table id="pagesTable" class="styled-table">
    <thead>
      <tr>
        <?php foreach ($tableHeaders as $header) :  ?>
        <th><?= $header ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($pages)) : ?>
      <?php foreach ($pages as $page) : ?>

      <tr class="styled-row" onclick="redirectToEdit(<?= $page->getId() ?>)">
        <td><?= $page->getId() ?> </td>
        <td><?= $page->getName() ?></td>
      </tr>
      <?php endforeach; ?>
      <?php endif ?>
    </tbody>
  </table>
  <div class="add-row">
    <button class="btn btn--blue" onclick="redirectToAdd()">Ajouter une page</button>
  </div>

</section>
<script>
$(document).ready(function() {
  $('#pagesTable').DataTable();
});
</script>