<?php
$conn = mysqli_connect("localhost", "root", "root", "concertdb");
if (!$conn) {
    die("Ошибка: " . mysqli_connect_error());
} else {
    echo "<div class='container'>";
    $concertSelect = "SELECT * FROM `concerti`";
    $concertSelectResult = mysqli_query($conn, $concertSelect);
    $concertSelectRow = mysqli_fetch_array($concertSelectResult, MYSQLI_ASSOC);
    echo "</div class='container'>";
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Концертный зал имени Джорджа Флойда</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <div class="container header__container">
            <nav class="header__nav">
                <ul class="header__menu">
                    <li class="header__item">
                        <a href="#" class="header__link">Главная</a>
                    </li>
                    <li class="header__item">
                        <a href="#" class="header__link">Информация</a>
                    </li>
                    <li class="header__item">
                        <a href="#" class="header__link">О нас</a>
                    </li>
                </ul>
            </nav>
            <ul class="cabinet header__cabinet">
                <li class="cabinet__item"><a href="#" class="cabinet__link">Войти</a></li>
                <li class="cabinet__item"></li>
            </ul>
        </div>
    </header>
    <main class="main">
        <section class="section">
            <div class="container main__container">
                <h1 class="container__header">
                    Список концертных залов
                </h1>
                <div class="concert content__wrapper">
                    <form action="" class="content__form" method="GET">
                        <label for="date" class="form__label">Выберите дату</label>
                        <input type="date" class="form__input" name="date" id="date">
                        <input type="submit" class="form__submit btn" value="Отправить">
                    </form>
                    <div class="concert__wrapper">
                        <ul class="concert__list">
                                <?php
                                foreach ($concertSelectResult as $concertRow) {
                                    echo "<li class='concert__item'>";
                                    echo "<img src='img/" . $concertRow['img'] . "' alt=''>";
                                    echo "<div class='concert__content__wrapper'>";
                                    echo
                                    "<h2 class='concert__header'>" .
                                        "<a href='index.php?name=' class='concert__link'>" . $concertRow['name'] . "</a>" .
                                        "</h2>";
                                    echo "<time class='concert__time'>" . "Дата: " . "$concertRow[date]" . "</time>";
                                    echo "<span class='concert__span'>" . "Группа: " . "$concertRow[group_name]" . "</span>";
                                    echo "<span class='concert__span'>" . "Жанр: " . "$concertRow[genre]" . "</span>";
                                    echo "<p class='concert__descr'>" . "$concertRow[description]" . "</p>";
                                    echo "</div>";
                                    echo "</li>";
                                }
                                ?>
                            
                        </ul>
                    </div>

                </div>
            </div>
        </section>
    </main>

</body>

</html>