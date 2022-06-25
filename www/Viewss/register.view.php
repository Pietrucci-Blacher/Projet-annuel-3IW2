<section class="register bg-login">
    <div class="register__container">
        <h1 class="text-center">Créer un compte</h1>
        <p class="text-center">Déjà inscrit ? <a href="/login">Connectez-vous</a></p>
        <?php $this->includePartial("form", $user->getFormRegister()) ?>
    </div>
</section>
