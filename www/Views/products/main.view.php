<section class="products">
  <h1>Produits</h1>
  <?php $this->includePartial("message") ?>
  <a class="btn btn--blue" href="/admin/product/new">Ajouter un produit</a>

  <table id="productsTable" class="styled-table" style="width:100%">
    <thead>
      <tr>
        <?php foreach ($headersProducts as $header) :  ?>
          <th><?= $header ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) : ?>
        <tr class="styled-row" onclick="redirectToEdit('product', <?= $product->getId() ?>)">
          <td>
            <a href="/admin/product?id=<?= $product->getId() ?>"><?= $product->getName() ?></a>
          </td>
          <td><?= $product->getDescription() ?></td>
          <td><?= $product->getCategoryName() ?></td>
          <td><?= $product->getPrice() ?> €</td>
          <td><?= $product->getQuantity() ?></td>
          <td><?= $product->getIsPublished() === 0 ? "Non" : "Oui" ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h1>Catégories de produit</h1>
  <a class="btn btn--blue" href="/admin/category/new">Ajouter une catégorie</a>

  <table id="categoriesTable" class="styled-table" style="width:100%">
    <thead>
      <tr>
        <?php foreach ($headersCategories as $header) :  ?>
          <th><?= $header ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($categories as $category) : ?>
        <tr class="styled-row" onclick="redirectToEdit('category', <?= $category->getId() ?>)">
          <td>
            <a href="/admin/category?id=<?= $category->getId() ?>"><?= $category->getName() ?></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>

<script>
  $(document).ready(function() {
    $('#productsTable').DataTable();
    $('#categoriesTable').DataTable();
  });

  function redirectToEdit(type, id) {
    switch (type) {
      case "product":
        window.location.href = "/admin/product?id=" + id;
        break;
      case "category":
        window.location.href = "/admin/category?id=" + id;
        break;
      default:
        break;
    }
  }
</script>