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
          <a href="#demo"><button class="button">Ajouter un utilisateur</button></a>

            <div id="demo" class="modal">
              <div class="modal_content">
                <h3>Ajouter un utilisateur</h3><br>

                <?php //include "mediasTest.php"; ?>

                <a href="#" class="modal_close">&times;</a>
              </div>
            </div>


        </div>
        <div style="overflow-x:scroll">

            <table id="articles_table" class="text-center">
              <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Statut</th>
                <th>Actions</th>
              </tr>
              <?php foreach ($users as $key => $user): ?>
              <tr>
                <td><?= $user->getId() ?></td>
                <td><?= $user->getFirstname() ?></td>
                <td><?= $user->getLastname() ?></td>
                <td><?= $user->getStatus() ?></td>
                <td>
                    <a href="#">Modifier |</a>
                    <a href="#">Bannir |</a>
                    <a href="#">Supprimer</a>
                </td>
              </tr>
              <?php  endforeach ;?>

            </table>
        </div>
      </div>
    </main>
