<section class="users">
  <h1>Users</h1>
  <?php $this->includePartial("message") ?>
  <table id="usersTable" class="styled-table">
    <thead>
      <tr>
        <?php foreach ($headers as $header) :  ?>
          <th><?= $header ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) : ?>
        <tr class="styled-row" onclick="redirectToEdit(<?= $user->getId() ?>)">
          <td><?= $user->getId() ?> </td>
          <td><?= $user->getFirstname() ?></td>
          <td><?= $user->getLastname() ?></td>
          <td><?= $user->getEmail() ?></td>
          <td><?= $user->getStatus() == 1 ? "Oui" : "Non" ?></td>
          <td><?= $user->getRole() ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>
<script>
  $(document).ready(function() {
    $('#usersTable').DataTable();
  });

  function redirectToEdit(userId) {
    if (userId) {
      window.location.href = `/admin/users/edit?id=${userId}`;
    }
  }
</script>