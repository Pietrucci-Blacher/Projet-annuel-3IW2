<section class="categories">
  <h1>Editer une catégorie</h1>
  <?php if (isset($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
      <p class="alert alert--danger">
        <?= $error ?><br>
      </p>
    <?php endforeach; ?>
  <?php endif; ?>
  <?php $this->includePartial("form", $categoryModel->getFormCategory($category)) ?>
</section>