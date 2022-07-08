<?php include("includes/menu.view.php"); ?>
  <?php //include "menu.php"; ?>
    <main class="home">
      <div class="main container">
        <div
          class="row justify-content-between main__header align-items-center"
        >
          <h1>Médias</h1>


          <svg class="main__header--logo vector" width="69" height="62" viewBox="0 0 69 62" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M27.2 37.7999H40.8V17.3999H51L34 0.399902L17 17.3999H27.2V37.7999ZM65.7492 43.0087C65.0352 42.2471 60.2718 37.1505 58.9118 35.8211C57.9587 34.9075 56.6891 34.3982 55.369 34.3999H49.3952L59.8128 44.5795H47.7632C47.5994 44.5765 47.4377 44.6167 47.2945 44.6961C47.1512 44.7755 47.0314 44.8912 46.9472 45.0317L44.1728 51.3999H23.8272L21.0528 45.0317C20.968 44.8917 20.8481 44.7763 20.7049 44.697C20.5618 44.6177 20.4004 44.5772 20.2368 44.5795H8.18716L18.6014 34.3999H12.631C11.2812 34.3999 9.99256 34.9405 9.08816 35.8211C7.72816 37.1539 2.96476 42.2505 2.25076 43.0087C0.58816 44.7801 -0.32644 46.1911 0.10876 47.9353L2.01616 58.3869C2.45136 60.1345 4.36556 61.5693 6.27296 61.5693H61.7338C63.6412 61.5693 65.5554 60.1345 65.9906 58.3869L67.898 47.9353C68.3264 46.1911 67.4152 44.7801 65.7492 43.0087Z" fill="black"></path>
          </svg>

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
