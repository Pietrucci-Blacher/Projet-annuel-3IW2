<?php if (isset($_SESSION["messages"])) : ?>
    <?php foreach ($_SESSION["messages"] as $message) : ?>
        <?php foreach ($message as $key => $value) : ?>
            <?php if ($value[0]["type"] == "success") : ?>
                <div class="alert alert--success">
                    <?= $value[0]["text"]; ?>
                </div>
            <?php elseif ($value[0]["type"] == "error") : ?>
                <div class="alert alert--danger">
                    <?= $value[0]["text"]; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
    <?php unset($_SESSION["messages"]); ?>
<?php endif; ?>