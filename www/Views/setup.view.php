<div class="container">
    <form action="/setup" method="post" class="formSetup">
        <!-- Progress bar -->
        <div class="progressbar">
            <div class="progress" id="progress"></div>
            <div class="progress-step progress-step-active" data-title="Informations générales"></div>
            <div class="progress-step" data-title="Base de Données"></div>
        </div>
        <!-- Steps -->
        <div class="form-step form-step-active">
            <div class="col-12 column justify-content-center">
                <div class="input-group col-4">
                    <label for="websitename">Nom du site</label>
                    <input type="text" name="websitename" id="websitename">
                </div>
                <div class="input-group col-4">
                    <label for="emailadmin">Email de l'administrateur</label>
                    <input type="text" name="emailadmin" id="emailadmin" />
                </div>
                <div class="input-group col-4">
                    <label for="position">Mot de passe </label>
                    <input type="password" name="pwd" id="pwd" />
                </div>
                <div class="input-group col-4">
                    <label for="position"> Confirmation mot de passe </label>
                    <input type="password" name="confpass" id="confpass" />
                </div>
                <div class="justify-content-center">
                    <button class="btn btn-next width-50 ml-auto">Suivant</button>
                </div>
            </div>
        </div>
        <div class="form-step">
            <h2>Base de données</h2>
            <div class="col-12 column justify-content-center">
                <div class="input-group col-4">
                    <label for="dbname">Nom de la base de données</label>
                    <input type="text" name="dbname" id="dbname">
                </div>
                <div class="input-group col-4">
                    <label for="dblogin">Identifiant</label>
                    <input type="text" name="dblogin" id="dblogin" />
                </div>
                <div class="input-group col-4">
                    <label for="dbpwd">Mot de passe</label>
                    <input type="password" name="dbpwd" id="dbpwd" />
                </div>
                <div class="input-group col-4">
                    <label for="dbadress">Adresse de la base de données</label>
                    <input id="dbadress" type="text" name="dbadress"/>
                </div>
                <div class="input-group col-4">
                    <label for="dbport">Port de la base de données</label>
                    <input id="dbport" type="number" name="dbport"/>
                </div>
                <div class="input-group col-4">
                    <label for="dbprefix"> Préfixe des tables</label>
                    <input type="text" name="dbprefix" id="dbprefix" />
                </div>
                <div class="btns-group">
                    <button class="btn btn-prev">Previous</button>
                    <input type="submit" value="Submit" class="btn btn-submit" />
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    :root {
        --primary-color: rgb(11, 78, 179);
    }
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }
    body {
        font-family: Montserrat, "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        display: grid;
        place-items: center;
        min-height: 100vh;
    }
    /* Global Stylings */
    label {
        display: block;
        margin-bottom: 0.5rem;
    }
    input {
        display: block;
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
    }
    .width-50 {
        width: 50%;
    }
    .ml-auto {
        margin-left: auto;
    }
    .text-center {
        text-align: center;
    }
    /* Progressbar */
    .progressbar {
        position: relative;
        display: flex;
        justify-content: space-between;
        counter-reset: step;
        margin: 2rem 0 4rem;
    }
    .progressbar::before,
    .progress {
        content: "";
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        height: 4px;
        width: 100%;
        background-color: #dcdcdc;
        z-index: -1;
    }
    .progress {
        background-color: var(--primary-color);
        width: 0%;
        transition: 0.3s;
    }
    .progress-step {
        width: 2.1875rem;
        height: 2.1875rem;
        background-color: #dcdcdc;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .progress-step::before {
        counter-increment: step;
        content: counter(step);
    }
    .progress-step::after {
        content: attr(data-title);
        position: absolute;
        top: calc(100% + 0.5rem);
        font-size: 0.85rem;
        color: #666;
    }
    .progress-step-active {
        background-color: var(--primary-color);
        color: #f3f3f3;
    }
    /* Form */
    .form {
        width: 90%;
        margin: 0 auto;
        padding: 1.5rem;
    }
    .form-step {
        display: none;
        transform-origin: top;
        animation: animate 0.5s;
    }
    .form-step-active {
        display: block;
    }
    .input-group {
        margin: 2rem 0;
    }
    @keyframes animate {
        from {
            transform: scale(1, 0);
            opacity: 0;
        }
        to {
            transform: scale(1, 1);
            opacity: 1;
        }
    }
    /* Button */
    .btns-group {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    .btn {
        padding: 0.75rem;
        display: block;
        text-decoration: none;
        background-color: var(--primary-color);
        color: #f3f3f3;
        text-align: center;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn:hover {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--primary-color);
    }
</style>