<section class="register bg-login">
    <div class="register__container">
        <h1 class="text-center">Upload un media</h1>
        <?php $this->includePartial("form", $media->getFormMedia()) ?>
        <?php if (isset($errors)) : ?>
            <?php foreach ($errors as $error) : ?>
                <p class="alert alert--danger">
                    <?= $error ?><br>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
