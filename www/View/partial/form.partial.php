Création du formulaire
<form method="<?= $config["config"]["method"]??"POST" ?>" action="<?= $config["config"]["action"]??""?>" enctype="<?= $config["config"]["uploadform"]? "multipart/form-data" : ""?>">

    <?php foreach ($config["inputs"] as $name => $input) : ?>
        <?php if ($name == "textarea") : ?>
            <textarea placeholder="<?= $input["placeholder"] ?>" rows="<?= $input["rows"] ?>" cols="<?= $input["cols"] ?>"></textarea>
        <?php elseif ($name == "captcha") : ?>
            <div class="<?= $input["class"] ?>" data-sitekey="<?= $input["sitekey"] ?>"</div>
        <?php elseif ($name == "radiobuttons"): ?>
            <div id="<?= $input["id"] ?>" class="<?= $input["class"] ?>">
                <?php foreach($input["items"] as $key => $value): ?>
                    <input type="<?= $input["type"] ?>" id="<?= $value["id"] ?>" name="<?= $value["name"] ?>" value="<?= $value["value"] ?>"
                        <?= (!empty($input["required"])) ? 'required="required"' : '' ?>
                        <?= $key == 0 ? 'checked' : '' ?>
                    />
                    <label for="<?= $value["id"] ?>"><?= $value["label"] ?></label>
                    <br>
                <?php endforeach; ?>
            </div>
        <?php elseif ($name == "select") : ?>

            <select>
                <?php foreach($input["options"] as $key => $value) : ?>
                    <option value="<?= $value["value"] ?>"><?= $value["label"] ?></option>
                <?php endforeach; ?>

            </select>

        <?php elseif ($name == "checkboxes"): ?>

            <?php foreach($input["items"] as $key => $value) : ?>
                <input type="<?= $input["type"] ?>" id="<?= $value["id"] ?>" name="<?= $value["name"] ?>" value="<?= $value["value"] ?>"
                    <?= (!empty($input["required"])) ? 'required="required"' : '' ?>
                    <?= $key == 0 ? 'checked' : '' ?>
                />
                <label for="<?= $value["id"] ?>"><?= $value["label"] ?></label>
                <br>
            <?php endforeach; ?>

        <?php else : ?>

            <input name="<?= $name ?>" id="<?= $input["id"] ?>" type="<?= $input["type"] ?>" class="<?= $input["class"] ?>" <?= (!empty($input["placeholder"])) ? 'placeholder="' . $input["placeholder"] . '"' : '' ?> <?= (!empty($input["required"])) ? 'required="required"' : '' ?>>

        <?php endif; ?>
        <br>
    <?php endforeach; ?>
    <input type="submit" value="<?= $config["config"]["submit"]??"Valider" ?>">
</form>



