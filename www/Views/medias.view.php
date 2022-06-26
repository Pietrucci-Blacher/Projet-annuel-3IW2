
  <?php //include "menu.php"; ?>
    <main>
      <div class="main container">
        <div
          class="row justify-content-between main__header align-items-center"
        >
          <h1>Médias</h1>
          <img
            class="main__header--logo vector"
            src="./assets/img/articles.png"
            alt="dashboard"
          />
        </div>
        <div class="row justify-content-center">
          <a href="#demo"><button class="button">Ajouter un document</button></a>

            <div id="demo" class="modal">
              <div class="modal_content">
                <h3>Ajouter votre fichier</h3><br>

        <div style="overflow-x:scroll">

            <table id="articles_table" class="text-center">
              <tr>
                <th>Nom</th>
                <th>Auteur</th>
                <th>Extension</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
              <?php
              foreach ($medias as $key => $media):?>
              <tr>
                <td><?= $media->getMedia_name() ?></td>
                <td><?= $media->getUserId() ?></td>
                <td><?= $media->getMedia_url() ?></td>
                <td><?= $media->getDate() ?></td>
                <td>
                    <a href="<?= $media->getMedia_url() ?>" target="_blank">Voir |</a>
                    <a href="medias.php?supprime=<?= $media->getUserId() ?>">Supprimer</a>
                </td>
              </tr>
            <?php  endforeach ;?>

            </table>
        </div>
      </div>
    </main>
