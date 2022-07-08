<nav class="sidebar close">
    <header>
        <div class="image-text">
                <span class="image">
                    <img src="https://png.pngitem.com/pimgs/s/49-497482_random-cartoon-png-transparent-png.png" alt="">
                </span>

            <div class="text logo-text">
                <span class="name">Chiperz</span>
                <span class="tag">Console de Gestion</span>
            </div>
        </div>
        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">

            <ul class="menu-links">
                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-home-alt icon' ></i>
                        <span class="text nav-text">Dashboard</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-book-open icon' ></i>
                        <span class="text nav-text">Articles</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-file icon'></i>
                        <span class="text nav-text">Médias</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-windows icon' ></i>
                        <span class="text nav-text">Pages</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-message-rounded-dots icon' ></i>
                        <span class="text nav-text">Commentaires</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-user icon' ></i>
                        <span class="text nav-text">Utilisateurs</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-bar-chart-alt-2 icon' ></i>
                        <span class="text nav-text">Statistiques</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-mail-send icon' ></i>
                        <span class="text nav-text">E-mailing <i class="bx bx-right-arrow-alt"></i></span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-cart icon' ></i>
                        <span class="text nav-text">Marketing</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-wallet icon' ></i>
                        <span class="text nav-text">Paiement</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-brush icon' ></i>
                        <span class="text nav-text">Customisation</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='bx bx-cog icon' ></i>
                        <span class="text nav-text">Paramètres</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="bottom-content">
            <li class="">
                <a href="#">
                    <i class='bx bx-log-out icon' ></i>
                    <span class="text nav-text">Logout</span>
                </a>
            </li>

            <li class="mode">
                <div class="sun-moon">
                    <i class='bx bx-moon icon moon'></i>
                    <i class='bx bx-sun icon sun'></i>
                </div>
                <span class="mode-text text">Dark mode</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>

        </div>
    </div>
</nav>


<script>
    const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector(".toggle"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = body.querySelector(".mode-text");


    toggle.addEventListener("click" , () =>{
        sidebar.classList.toggle("close");
    })

    modeSwitch.addEventListener("click" , () =>{
        body.classList.toggle("dark");

        if(body.classList.contains("dark")){
            modeText.innerText = "Light mode";
        }else{
            modeText.innerText = "Dark mode";

        }
    });
</script>