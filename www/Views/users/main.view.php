<section class="users">
  <h1>Users</h1>

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
          <td><?= $user->getStatus() ?></td>
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