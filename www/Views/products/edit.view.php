<section class="products">
  <h1>Editer un produit</h1>
  
  <?php $this->includePartial("form", $productModel->getFormProduct($product)) ?>
  <?php $this->includePartial("form", $productModel->getFormProduct($product, "delete")) ?>

</section>