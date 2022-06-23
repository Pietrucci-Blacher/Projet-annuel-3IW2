<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding: 12px 16px;
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>

<div>
    <span class="nav-item dropdown" id="translate">
        <a class="nav-link dropdown-toggle french" id="navbarDropdownlang" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-language="french"><span class="fi fi-fr"><span>Français</span></a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><button class="dropdown-item english" id="itemsecond" data-language="english"><span class="flag flag-gb"></span><span>English</span></button></li>
            <li><button class="dropdown-item spanish" id="itemthird" data-language="spanish"><span class="flag flag-es"></span><span>Español</span></button></li>
        </ul>
    </span>
</div>


<div>

</div>


<h1 data-translation="hello">Hello World!</h1>
<p data-translation="paragraph">This is a simple paragraph.</p>
