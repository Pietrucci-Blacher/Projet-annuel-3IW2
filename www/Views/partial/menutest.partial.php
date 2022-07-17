<header class="header">
  <div class="header__container">
    <span>Chiperz</span>
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
        </ul>
      </nav>
    </div>
  </div>
</header>