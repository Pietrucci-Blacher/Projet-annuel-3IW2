<section class="login bg-login">
    <div class="login__container">
        <h1 class="text-center">Se connecter</h1>
        <p class="text-center">Vous êtes nouveau ? <a href="/register">Inscrivez-vous !</a></p>
        <?php $this->includePartial("form", $user->getFormLogin()) ?>
        <?php if (isset($errors)) : ?>
            <?php foreach ($errors as $error) : ?>
                <p class="alert alert--danger">
                    <?= $error ?><br>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>