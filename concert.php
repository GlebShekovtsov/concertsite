<?php include 'connect.php' ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'head.php' ?>
</head>

<body>
    <?php include 'header.php' ?>
    <main class="main">
        <section class="section concert-about concert-about__section">
            <div class="container concert-about__container">
                <?
                $concert = $_GET['concertid'];
                $concertIDSelect = "SELECT * FROM `raspisanie`
                INNER JOIN concerti ON raspisanie.id_concert=concerti.id 
                WHERE id_raspisanie = '$concert'";
                $concertIDSelectResult = mysqli_query($conn, $concertIDSelect);
                $concertIDSelectRow = mysqli_fetch_array($concertIDSelectResult, MYSQLI_ASSOC);
                $concertZalSelect = "SELECT * FROM `sits`
                INNER JOIN raspisanie ON sits.id_raspisanie=raspisanie.id_raspisanie
                INNER JOIN direction ON sits.id_direction=direction.id
                WHERE sits.id_raspisanie = '$concert' AND sit_status = 'свободное'";
                $concertZalSelectResult = mysqli_query($conn, $concertZalSelect);
                $concertZalAssoc = mysqli_fetch_assoc($concertZalSelectResult);
                if (isset($_SESSION["login"])) {

                    echo "<div class='concert-about__wrapper'>";
                    echo "<img src='img/" . $concertIDSelectRow['img'] . "' class='concert__image' alt=''>";
                    echo "<div class='concert-about__content__wrapper'>";
                    echo
                    "<h2 class='concert-about__header'>" .
                        "<a href='#' class='concert-about__link'>" . $concertIDSelectRow['name'] . "</a>" .
                        "</h2>";
                    echo "<time class='concert-about__time'>" . "Дата: " . "$concertIDSelectRow[date]" . "</time>";
                    echo "<span class='concert-about__span'>" . "Группа: " . "$concertIDSelectRow[group_name]" . "</span>";
                    echo "<span class='concert-about__span'>" . "Жанр: " . "$concertIDSelectRow[genre]" . "</span>";
                    echo "<p class='concert-about__descr'>" . "$concertIDSelectRow[description]" . "</p>";
                    echo "</div>";
                    echo "</div>";
                } else if (!isset($_SESSION["login"])) {
                    echo "<p class='sit__no-auth'>" . "Войдите чтобы отобразить места" . "<p>";
                }
                echo "<h2 class='concert-about__header'>Места</h2>";
                if (empty($concertZalAssoc) && !isset($_GET['placeid']) && isset($_SESSION["login"])) {
                    echo "<p class='sit__empty'>" . "Мест нет!" . "<p>";
                }
                if (isset($_GET['placeid'])) {
                    $placeid = $_GET['placeid'];
                    $concertid = $_GET['concertid'];
                    $action = "бронь";
                    $placeupdate = "UPDATE `sits` SET `sit_status` = 'занятое' WHERE id_sit = '$placeid'";
                    $historyupdate = "INSERT INTO `user_history` (`id`, `action`, `date`, `id_concert`, `id_sit`, `action_by`)
                    VALUES (NULL, '$action', NOW(), '$concertid', '$placeid', '$userlogin')";
                    $bookingQuery = "INSERT INTO `booking` (`id_booking`, `id_raspisanie`,`id_user`, `id_sits`) VALUES (NULL, '$concertid', '$userlogin', '$placeid')";
                    if ($conn->query($placeupdate)) {
                        echo "<p class='sit__update'> Место зарезервировано </p>";
                ?>

                    <?php
                    }
                    if ($conn->query($historyupdate)) {
                    ?>

                    <?php
                    }
                    if ($conn->query($bookingQuery)) {
                    ?>
                        <script>
                            setTimeout(() => {
                                document.location.replace("http://concertsite-new/profile.php");
                            }, 1000);
                        </script>
                <?php
                    } else {
                        echo "<p class='sit__update'> Место зарезервировано" . $conn->error  . "</p>";
                    }
                } else {
                    echo "<ul class='sit__list sit'>";
                    foreach ($concertZalSelectResult as $concertZalRow) {

                        echo "<li class='sit__item'>";
                        echo "<h3 class='sit__header'>" . "Номер места: " . "$concertZalRow[sit_num]" . "</h3>";
                        echo "<p class='sit__paragraph'>" . "Цена места: " . "$concertZalRow[sit_price] " . "&#8381" . "</p>";
                        echo "<p class='sit__paragraph'>" . "Расположение: " . "$concertZalRow[direction_name]" . "</p>";
                        echo "<p class='sit__paragraph'>" . "Ряд: " . "$concertZalRow[id_row]" . "</p>";
                        echo "<a href='concert.php?concertid=" . $concertZalRow['id_raspisanie'] . "&placeid=" . $concertZalRow['id_sit'] . "' class='sit__link'>" . "[Забронировать]" . "</a>";
                        echo "</li>";
                    }
                    echo "</ul>";
                }

                ?>
            </div>
        </section>
    </main>
</body>

</html>