<section class="login bg-login">
    <div class="login__container">
        <h1 class="text-center">Se connecter</h1>
        <p class="text-center">Vous êtes nouveau ? <a href="/register">Inscrivez-vous !</a></p>

        <?php $this->includePartial("form", $user->getFormLogin()) ?>
    </div>
</section>

