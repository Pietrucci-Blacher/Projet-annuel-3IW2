<header class="header">
  <div class="header__container">
    <a href="/">Chiperz</a>
    <div class="header__menu menu">
      <div class="menu__icon">
        <span></span>
      </div>
      <nav data-sub_menu_auto_close="true" class="menu__body">
        <ul class="menu__list">
          <?php foreach ($navigation as $navLink) : ?>
            <li>
              <a href="/pages?id=<?= $navLink['id'] ?>" class="menu__sub-link">
                <?= $navLink['name'] ?>
              </a>
            </li>
          <?php endforeach; ?>
          <?php if(isset($_SESSION['user'])) : ?>
            <li>
              <a href="/logout" class="menu__sub-link">
                Déconnexion
              </a>
            </li>
          <?php else : ?>
            <li>
              <a href="/login" class="menu__sub-link">
                Connexion
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>
</header>