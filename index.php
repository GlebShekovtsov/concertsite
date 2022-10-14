<?php
include 'connect.php';
if (!$conn) {
    die("Ошибка: " . mysqli_connect_error());
} else {
    echo "<div class='container'>";
    $concertSelect = "SELECT * FROM `concerti`";
    $concertSelectResult = mysqli_query($conn, $concertSelect);
    $concertSelectRow = mysqli_fetch_array($concertSelectResult, MYSQLI_ASSOC);
    echo "</div>";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php' ?>
    <main class="main">
        <section class="section concert сoncert__section">
            <div class="container concert__container">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div data-background="img/zal1.jpg" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div data-background="img/zal1.jpg" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div data-background="img/zal1.jpg" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div class=" content__wrapper">
                    <form action="" class="content__form" method="GET">
                        <label for="date" class="form__label">Выберите дату</label>
                        <input type="date" class="form__input" name="date" id="date">
                        <input type="submit" class="form__submit btn" value="Отправить">
                        <a href="index.php?showall=1" class="form__link">Показать все</a>
                    </form>
                    <div class="concert__wrapper">
                        <h1 class="container__header">
                            Список концертных залов
                        </h1>
                        <ul class="concert__list">
                            <?php
                            if (isset($_GET['date'])) {
                                $date = $_GET['date'];
                                $concertDateSelect = "SELECT * FROM `concerti` WHERE date = '$date'";
                                $concertDateSelectResult = mysqli_query($conn, $concertDateSelect);
                                $concertDateSelectRow = mysqli_fetch_array($concertDateSelectResult, MYSQLI_ASSOC);
                                foreach ($concertDateSelectResult as $concertDateRow) {
                                    echo "<li class='concert__item'>";
                                    echo "<img src='img/" . $concertDateRow['img'] . "' alt=''>";
                                    echo "<div class='concert__content__wrapper'>";
                                    echo
                                    "<h2 class='concert__header'>" .
                                        "<a href='#' class='concert__link'>" . $concertDateRow['name'] . "</a>" .
                                        "</h2>";
                                    echo "<time class='concert__time'>" . "Дата: " . "$concertDateRow[date]" . "</time>";
                                    echo "<span class='concert__span'>" . "Группа: " . "$concertDateRow[group_name]" . "</span>";
                                    echo "<span class='concert__span'>" . "Жанр: " . "$concertDateRow[genre]" . "</span>";
                                    echo "<p class='concert__descr'>" . "$concertDateRow[description]" . "</p>";
                                    echo "<div class='concert__about__wrapper'>";
                                    echo "<a href='index.php?concertid=" . $concertDateRow['id'] . "' class='concert__about'>" . "Просмотреть места" . "</a>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</li>";
                                }
                            } else if (isset($_GET['showall']) == 1 || !isset($_GET['date'])) {
                                foreach ($concertSelectResult as $concertRow) {
                                    echo "<li class='concert__item'>";
                                    echo "<img src='img/" . $concertRow['img'] . "' alt=''>";
                                    echo "<div class='concert__content__wrapper'>";
                                    echo
                                    "<h2 class='concert__header'>" .
                                        "<a href='#' class='concert__link'>" . $concertRow['name'] . "</a>" .
                                        "</h2>";
                                    echo "<time class='concert__time'>" . "Дата: " . "$concertRow[date]" . "</time>";
                                    echo "<span class='concert__span'>" . "Группа: " . "$concertRow[group_name]" . "</span>";
                                    echo "<span class='concert__span'>" . "Жанр: " . "$concertRow[genre]" . "</span>";
                                    echo "<p class='concert__descr'>" . "$concertRow[description]" . "</p>";
                                    echo "<div class='concert__about__wrapper'>";
                                    echo "<a href='concert.php?concertid=" . $concertRow['id'] . "' class='concert__about'>" . "Просмотреть места" . "</a>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</li>";
                                }
                            }


                            ?>
                        </ul>
                    </div>

                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="js/swiper_init.js"></script>
</body>

</html>