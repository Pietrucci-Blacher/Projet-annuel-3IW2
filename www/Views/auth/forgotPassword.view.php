<section class="login bg-login">
    <div class="login__container">
        <h1 class="text-center">Mot de passe oublié</h1>
        <?php
            $emailSent
                ? $this->includePartial("form", $user->getFormNewPassword())
                : $this->includePartial("form", $user->getFormResetPassword())
        ?>

        <?php if (isset($errors)) : ?>
            <?php foreach ($errors as $error) : ?>
                <p class="alert alert--danger">
                    <?= $error ?><br>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($emailSentMsg)) : ?>
            <p class="alert alert--success"><?= $emailSentMsg ?></p>
        <?php endif; ?>
        <?php if (isset($emailConfirmed)) : ?>
            <p class="alert alert--success"><?= $emailConfirmed ?></p>
        <?php endif; ?>
    </div>
</section>