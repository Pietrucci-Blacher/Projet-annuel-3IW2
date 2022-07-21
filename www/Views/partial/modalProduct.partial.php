<div id="myModal" class="modal">
    <div class="modal__container">
        <span class="close">&times;</span>
        <div class="modal__image">
            <?php if (is_null($config["productDetail"]["image"])) : ?>
                <img src="https://dummyimage.com/1000x1000/e4e9f7/000000.png&text=No+image" alt="No image" />
            <?php else : ?>
                <img src="data:image;base64,<?= $config["productDetail"]["image"] ?>" alt="<?= $config["productDetail"]["name"] ?>">
            <?php endif; ?>
        </div>

        <div class="modal__data">
            <h2 class="modal__data__name"><?= $config["productDetail"]["name"]; ?></h2>
            <p class="modal__data__price"><?= $config["productDetail"]["price"]; ?> €</p>
            <p class="modal__data__description"><?= $config["productDetail"]["description"]; ?></p>
        </div>


        <div class="modal__comments">
            <?php foreach ($config["comments"] as $comment) : ?>
                <div class="modal__comment">
                    <p class="modal__comment__author"><?= $comment->getUserName(); ?></p>
                    <p class="modal__comment__date"><?= $comment->getCreatedAt(); ?></p>
                    <p class="modal__comment__text"><?= $comment->getText(); ?></p>
                    <div class="modal__comment__actions">
                        <?php if ($_SESSION["user"]["role"] == "admin") : ?>
                            <form method="post">
                                <input type="hidden" name="id" value="<?= $comment->getId() ?>">
                                <input type="submit" value="Supprimer" class="small-btn small-btn--alert">
                            </form>

                        <?php endif; ?>
                        <?php
                        $reportFind = $config["reportModel"]->find([
                            "comment_id" => $comment->getId(),
                            "user_id" => $_SESSION["user"]["id"]
                        ]);
                        ?>
                        <?php if (empty($reportFind)) : ?>
                            <form method="post">
                                <input type="hidden" name="reportCommentId" value="<?= $comment->getId() ?>">
                                <input type="hidden" name="reportUserId" value="<?= $_SESSION["user"]["id"] ?>">
                                <input type="submit" value="Signaler" class="small-btn small-btn--alert">
                            </form>
                        <?php endif; ?>

                    </div>
                    <!-- <p><?= $comment->getId(); ?></p>
                    <p><?= $config["productDetail"]["id"] ?></p> -->
                    <hr>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (isset($_SESSION["user"])) : ?>
            <div class="modal__comments__form">
                <?php $this->includePartial("form", $config["commentModel"]->getFormAddComment()); ?>
            </div>
        <?php endif; ?>
    </div>

</div>
</div>