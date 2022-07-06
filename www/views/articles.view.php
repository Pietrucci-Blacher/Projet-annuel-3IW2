<main>
      <div class="main container">
        <div
          class="row justify-content-between main__header align-items-center"
        >
          <h1>Articles</h1>
          <svg class="main__header--logo vector" width="56" height="68" viewBox="0 0 56 68" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.8 0C15.9965 0 14.2669 0.716427 12.9917 1.99167C11.7164 3.26692 11 4.99653 11 6.8H41.6C43.4035 6.8 45.1331 7.51643 46.4083 8.79167C47.6836 10.0669 48.4 11.7965 48.4 13.6V54.4C50.2035 54.4 51.9331 53.6836 53.2083 52.4083C54.4836 51.1331 55.2 49.4035 55.2 47.6V6.8C55.2 4.99653 54.4836 3.26692 53.2083 1.99167C51.9331 0.716427 50.2035 0 48.4 0L17.8 0Z" fill="black"/>
            <path d="M38.2001 68C40.0035 68 41.7331 67.2835 43.0084 66.0083C44.2836 64.733 45 63.0034 45 61.1999V17C45 15.1965 44.2836 13.4669 43.0084 12.1916C41.7331 10.9164 40.0035 10.2 38.2001 10.2H7.60005C5.79658 10.2 4.06697 10.9164 2.79172 12.1916C1.51648 13.4669 0.800049 15.1965 0.800049 17V61.1999C0.800049 63.0034 1.51648 64.733 2.79172 66.0083C4.06697 67.2835 5.79658 68 7.60005 68H38.2001ZM24.6 17H38.2001V34H24.6V17ZM7.60005 17H21.2001V20.4H7.60005V17ZM7.60005 23.8H21.2001V27.2H7.60005V23.8ZM7.60005 30.6H21.2001V34H7.60005V30.6ZM7.60005 37.4H38.2001V40.7999H7.60005V37.4ZM7.60005 44.2H38.2001V47.5999H7.60005V44.2ZM7.60005 51H38.2001V54.3999H7.60005V51Z" fill="black"/>
          </svg>
        </div>
        <div class="row justify-content-center">
          <a href="/dashboard/articles/new"><button class="button">Ajouter un article</button></a>
        </div>
        <div style="overflow-x:scroll">

            <table id="articles_table" class="text-center">
              <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Catégorie</th>
                <th>Commentaires</th>
                <th>Likes</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
              <?php foreach ($articles as $key => $article): ?>
              <tr>
                <td><?= $article->getTitle() ?></td>
                <td><?= $article->getAutor() ?></td>
                <td><?= $article->getCategories() ?></td>
                <td><?= $article->getComments() ?></td>
                <td><?= $article->getLikes() ?></td>
                <td><?= $article->getDate() ?></td>
                <td>
                    <a href="see?<?= $article->getArticleId() ?>">Voir |</a>
                    <a href="#">Modifier |</a>
                    <a href="#">Supprimer</a>
                </td>
              </tr>
              <?php  endforeach ;?>

            </table>
        </div>
      </div>
    </main>
