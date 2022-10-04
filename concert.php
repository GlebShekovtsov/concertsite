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
                $concertIDSelect = "SELECT * FROM `concerti` WHERE id = '$concert'";
                $concertIDSelectResult = mysqli_query($conn, $concertIDSelect);
                $concertIDSelectRow = mysqli_fetch_array($concertIDSelectResult, MYSQLI_ASSOC);
                $concertZalSelect = "SELECT * FROM `concert_zal` WHERE id_concert = '$concert' AND sit_status = 'свободное'";
                $concertZalSelectResult = mysqli_query($conn, $concertZalSelect);
                $concertZalAssoc = mysqli_fetch_assoc($concertZalSelectResult);
                foreach ($concertIDSelectResult as $concertIDRow) {
                    echo "<div class='concert-about__wrapper'>";
                    echo "<img src='img/" . $concertIDRow['img'] . "' class='concert__image' alt=''>";
                    echo "<div class='concert-about__content__wrapper'>";
                    echo
                    "<h2 class='concert-about__header'>" .
                        "<a href='#' class='concert-about__link'>" . $concertIDRow['name'] . "</a>" .
                        "</h2>";
                    echo "<time class='concert-about__time'>" . "Дата: " . "$concertIDRow[date]" . "</time>";
                    echo "<span class='concert-about__span'>" . "Группа: " . "$concertIDRow[group_name]" . "</span>";
                    echo "<span class='concert-about__span'>" . "Жанр: " . "$concertIDRow[genre]" . "</span>";
                    echo "<p class='concert-about__descr'>" . "$concertIDRow[description]" . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "<h2 class='concert-about__header'>Места</h2>";
                if (empty($concertZalAssoc) && !isset($_GET['placeid'])) {
                    echo "<p class='sit__empty'>" . "Мест нет!" . "<p>";
                }
                if (isset($_GET['placeid'])) {
                    $placeid = $_GET['placeid'];
                    $concertid = $_GET['concertid'];
                    $action = "бронь";
                    $placeupdate = "UPDATE `concert_zal` SET `sit_status` = 'занятое', `reserved_by_id` = '$userlogin' WHERE id = '$placeid'";
                    $historyupdate = "INSERT INTO `user_history` (`action`, `date`, `concert_id`, `sit_id`) VALUES ('$action', NOW(), `$concertid`, `$placeid`)";
                    if ($conn->query($placeupdate)) {
                        echo "<p class='sit__update'> Место зарезервировано </p>";
                ?>
                        <script>
                            setTimeout(() => {
                                document.location.replace("http://concert/concertsite/profile.php");
                            }, 2000);
                        </script>
                    <?php
                    }
                    if ($conn->query($historyupdate)) {
                    ?>

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
                        echo "<p class='sit__paragraph'>" . "Расположение места: " . "$concertZalRow[sit_direction]" . "</p>";
                        echo "<a href='concert.php?concertid=" . $concertZalRow['id_concert'] . "&placeid=" . $concertZalRow['id'] . "' class='sit__link'>" . "[Забронировать]" . "</a>";
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