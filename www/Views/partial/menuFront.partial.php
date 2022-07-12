<nav class="sidebar close">
  <header>
    <div class="image-text">
      <span class="image">
        <img src="https://via.placeholder.com/100" alt="">
      </span>

      <div class="text logo-text">
        <span class="name">Chiperz</span>
      </div>
    </div>
    <i class='bx bx-chevron-right toggle'></i>
  </header>

  <div class="menu-bar">
    <div class="menu">

      <ul class="menu-links">
        <?php foreach ($navigation as $navLink) : ?>
        <li class="nav-link">
          <a href="/pages?id=<?= $navLink['id'] ?>">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text"><?= $navLink['name'] ?></span>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="bottom-content">
      <li class="">
        <a href="/logout">
          <i class='bx bx-log-out icon'></i>
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


toggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
})

modeSwitch.addEventListener("click", () => {
  body.classList.toggle("dark");

  if (body.classList.contains("dark")) {
    modeText.innerText = "Light mode";
  } else {
    modeText.innerText = "Dark mode";

  }
});
</script>