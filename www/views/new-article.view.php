<head>
  <script src="https://cdn.tiny.cloud/1/0mk3rsjvbp97f7vt8o8v8cxddvvw2e0scrd95a7964x664dq/tinymce/6/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

</head>

<section class="register bg-login">
    <div class="register__container">
        <h1 class="text-center">Créer un article</h1>
        <?php $this->includePartial("form", $article->getFormArticle()) ?>
        <?php if (isset($errors)) : ?>
            <?php foreach ($errors as $error) : ?>
                <p class="alert alert--danger">
                    <?= $error ?><br>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
