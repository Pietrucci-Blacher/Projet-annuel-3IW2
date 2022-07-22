<section class="products">
  <h1>Editer un produit</h1>
  <?php if (isset($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
      <p class="alert alert--danger">
        <?= $error ?><br>
      </p>
    <?php endforeach; ?>
  <?php endif; ?>
  <?php $this->includePartial("form", $productModel->getFormProduct($product)) ?>
  <?php $this->includePartial("form", $productModel->getFormProduct($product, "delete")) ?>

</section>