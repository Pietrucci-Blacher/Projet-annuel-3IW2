<section class="products">
  <h1>Ajouter un produit</h1>
  <?php if (isset($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
      <p class="alert alert--danger">
        <?= $error ?><br>
      </p>
    <?php endforeach; ?>
  <?php endif; ?>
  <?php $this->includePartial("form", $product->getFormProduct()) ?>
</section>