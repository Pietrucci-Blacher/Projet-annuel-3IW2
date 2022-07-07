<head>
  <script src="https://cdn.tiny.cloud/1/0mk3rsjvbp97f7vt8o8v8cxddvvw2e0scrd95a7964x664dq/tinymce/6/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

</head>

<section class="register bg-login">
    <div class="register__container">
        <h1 class="text-center">Créer un article</h1>
        <?php $this->includePartial("form", $article->getFormArticle()) ?>
        <?php if (isset($errors)) : ?>
            <?php foreach ($errors as $error) : ?>
                <p class="alert alert--danger">
                    <?= $error ?><br>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
<script>

const formulaire = document.querySelector(".articleCreate");
formulaire.addEventListener('submit', (e) => {
    e.preventDefault();
    console.log("test1");
})
const button = document.getElementById('buttonValidate');
button.addEventListener('click', async () => {
    console.log("test2");
    //create init for fetch with the input value
    const data = new FormData(formulaire);
    for (var pair of data.entries()) {
    console.log(pair[0]+ ', ' + pair[1]);
                }
    const init = {
        headers : {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        method: 'POST',
        body: data,
    };
    //fetch the url with the init
    const response = await fetch('/articles', init);
    console.log("test3");
    //get the json from the response
    const json = await response.json();
    if(json.success) {
        window.location.href = '/articles';
        console.log("test4");
    }

});
</script>
