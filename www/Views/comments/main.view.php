<section class="comments">
  <h1>Comments</h1>

  <table id="commentsTable" class="styled-table" style="width:100%">
    <thead>
      <tr>
        <?php foreach ($headersComments as $header) :  ?>
          <th><?= $header ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($comments as $comment) : ?>
        <tr class="styled-row">
          <td><?= $comment->getCreatedAt() ?></td>
          <td><?= $comment->getProductName() ?></td>
          <td><?= $comment->getText() ?></td>
          <td><?= $comment->getUserName() ?></td>
          <td>
            <?php
              $reportsCount = count($reportModel->findAll([
                "comment_id" => $comment->getId()
              ]));
              echo $reportsCount;
            ?>
          </td>
          <td>
            <form method="post">
              <input type="hidden" name="id" value="<?= $comment->getId() ?>">
              <input type="submit" value="Supprimer" class="btn btn--alert">
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>

<script>
  $(document).ready(function() {
    $('#commentsTable').DataTable({
      responsive: true,
    });
  });
</script>