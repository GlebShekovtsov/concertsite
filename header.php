<header class="header">
    <div class="container header__container">
        <nav class="header__nav">
            <ul class="header__menu">
                <li class="header__item">
                    <a href="index.php" class="header__link">Главная</a>
                </li>
                <li class="header__item">
                    <a href="#" class="header__link">О нас</a>
                </li>
                <li class="header__item">
                    <a href="#" class="header__link">Контакты</a>
                </li>
            </ul>
        </nav>
        <ul class="cabinet header__cabinet">
            <?php
            if (!isset($_SESSION["userid"])) {
            ?>
                <li class="cabinet__item"><a href="auth.php" class="cabinet__link">Войти</a></li>
                <li class="cabinet__item"><a href="reg.php" class="cabinet__link">Зарегистрироваться</a></li>
            <?php
            }
            else {
                $userlogin = $_SESSION["login"];
                echo "<li class='cabinet__item'>" . "<p class='cabinet__link'>" . "Привет, $userlogin, " . "<a href='exit.php' class='exit__link'>Выйти?</a>" . "</li>";
            }

            ?>

        </ul>
    </div>
</header>