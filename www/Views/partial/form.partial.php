<form id="form" method="<?= $config["config"]["method"] ?? "POST" ?>" action="<?= $config["config"]["action"] ?? "" ?>" enctype="<?= $config["config"]["uploadform"] ? "multipart/form-data" : "" ?>">
    <?php foreach ($config["inputs"] as $name => $input) : ?>

        <?php if (isset($input["label"])) : ?>
            <label class="label" for="<?= $input["id"] ?>"><?= $input["label"] ?></label>
        <?php endif ?>
        <?php if ($name == "textarea") : ?>
            <textarea placeholder="<?= $input["placeholder"] ?>" rows="<?= $input["rows"] ?>" cols="<?= $input["cols"] ?>"></textarea>
        <?php elseif ($name == "captcha") : ?>
            <div class="<?= $input["class"] ?>" data-sitekey="<?= $input["sitekey"] ?>"></div>
        <?php elseif ($name == "radiobuttons") : ?>
            <div id="<?= $input["id"] ?>" class="<?= $input["class"] ?>">
                <?php foreach ($input["items"] as $key => $value) : ?>
                    <input type="<?= $input["type"] ?>" id="<?= $value["id"] ?>" name="<?= $value["name"] ?>" value="<?= $value["value"] ?>" <?= (!empty($input["required"])) ? 'required="required"' : '' ?> <?= $key == 0 ? 'checked' : '' ?> />
                    <label for="<?= $value["id"] ?>"><?= $value["label"] ?></label>
                    <br>
                <?php endforeach; ?>
            </div>
        <?php elseif ($name == "upload") : ?>
            <?php if (!empty($input["data"])) : ?>
                <img height="250px" width="250px" src="data:image;base64,<?= $input["data"]; ?>" />
            <?php endif; ?>
            <input type="<?= $input["type"] ?>" id="<?= $input["id"] ?>" name="<?= $input["name"] ?>" <?= (!empty($input["required"])) ? 'required="required"' : '' ?> />
        <?php elseif ($name == "select") : ?>

            <select name="<?= $input["id"] ?>" id="<?= $input["id"] ?>" class="inputText">
                <?php foreach ($input["options"] as $key => $value) : ?>
                    <option value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                <?php endforeach; ?>
            </select>
        <?php elseif ($name == "checkboxes") : ?>
            <?php foreach ($input["items"] as $key => $value) : ?>
                <input type="<?= $input["type"] ?>" id="<?= $value["id"] ?>" name="<?= $value["name"] ?>" value="<?= $value["value"] ?>" <?= (!empty($input["required"])) ? 'required="required"' : '' ?> <?= $key == 0 ? 'checked' : '' ?> />
                <label for="<?= $value["id"] ?>"><?= $value["label"] ?></label>
                <br>
            <?php endforeach; ?>

        <?php elseif($input["type"] == "hidden") : ?>
            <input type="<?= $input["type"] ?>" name="<?= $name ?>" value="<?= $input["value"] ?? "" ?>">


        <?php elseif ($name == "wysiwyg") : ?>
            <div id="richEditor"></div>
            <textarea name="<?= $name ?>" style="display:none" id="hiddenRichEditorArea"></textarea>
            <script>
                var quill = new Quill('#richEditor', {
                    theme: 'snow',
                    placeholder: '<?= $input["placeholder"] ?>'
                });
            </script>

        <?php else : ?>
            <input <?= (isset($input["value"])) ? 'value="' . $input["value"] . '"' : '' ?> <?= (!empty($input["step"])) ? 'step="' . $input["step"] . '"' : '' ?> name="<?= $name ?>" id="<?= $input["id"] ?>" type="<?= $input["type"] ?>" class="<?= $input["class"] ?> inputText" <?= (!empty($input["placeholder"])) ? 'placeholder="' . $input["placeholder"] . '"' : '' ?> <?= (!empty($input["required"])) ? 'required="required"' : '' ?>>
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" value="<?= $config["config"]["submit"] ?? "Valider" ?>" class="btn <?= $config["config"]["class"] == "delete" ? "btn--alert" : "btn--blue" ?> ">
</form>

<script>
    $("#form").on("submit", function() {
        var html = quill.container.firstChild.innerHTML;
        $("#hiddenRichEditorArea").val(html);
    })
</script>