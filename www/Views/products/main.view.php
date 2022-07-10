<section class="products">
  <h1>Produits</h1>
  <a class="btn btn--blue" href="/admin/product/new">Ajouter un produit</a>

  <table id="example" class="display" style="width:100%">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Catégorie</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Publié</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) : ?>
        <tr class="cursor" onclick="redirectToEdit(<?= $product->getId() ?>)">
          <td>
            <a href="/admin/product?id=<?= $product->getId() ?>"><?= $product->getName() ?></a>
          </td>
          <td><?= $product->getDescription() ?></td>

          <td>category</td>
          <td><?= $product->getPrice() ?> €</td>
          <td><?= $product->getQuantity() ?></td>
          <td><?= $product->getIsPublished() === 0 ? "Non" : "Oui" ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Catégorie</th>
        <th>Prix</th>
        <th>Quantité</th>
      </tr>
    </tfoot>
  </table>
</section>

<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });

  function redirectToEdit(productId) {
    if (productId) {
      window.location.href = `/admin/product?id=${productId}`;
    }
  }
</script>