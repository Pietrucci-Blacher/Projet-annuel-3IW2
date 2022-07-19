<h1>Home</h1>

<div class="product-list">
    <h1>Liste des produits</h1>
    <?php if(count($products) > 0) : ?>

        <div class="product-list__cards">
            <?php foreach ($products as $product) : ?>
                <div class="product-list__card card">
                    <div class="card__image">
                        <?php if (is_null($product->getImage())) : ?>
                            <img src="https://dummyimage.com/1000/e4e9f7/000000.png&text=No+image" alt="No image" />
                        <?php else : ?>
                            <img src="data:image;base64,<?= $product->getImage() ?>" alt="<?= $product->getName() ?>">
                        <?php endif; ?>
                    </div>
                    <div class="card__body">
                        <div class="card__title">
                            <h2><?= $product->getName() ?></h2>
                            <p class="card__price"><?= $product->getPrice() ?> €</p>
                        </div>
                        <p class="card__description"><?= $product->getDescription() ?></p>
                        <a href="/product?id=<?= $product->getId() ?>" class="card__link btn btn--blue">Voir le produit</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>Aucun produit n'est disponible</p>
    <?php endif; ?>
</div>

<?php if (isset($productDetail)) : ?>
    <?php $this->includePartial("modalProduct", [
        "productDetail" => $productDetail,
        "comments" => $comments
    ]); ?>
<?php endif; ?>

<script>
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>