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
        <section class="profile__section">
            <div class="container profile__container">
                <?php
                if (!isset($_SESSION['userid'])) {
                ?>
                    <script>
                        document.location.replace('http://concert/concertsite/auth.php')
                    </script>
                <?php
                }
                ?>
                <div class="profile-info__wrapper info">
                    <?php
                    $userSelect = "SELECT * FROM `user` WHERE login='$userlogin'";
                    $userSelectResult = mysqli_query($conn, $userSelect);
                    $userSelectAssoc = mysqli_fetch_assoc($userSelectResult);
                    foreach ($userSelectResult as $userRow) {
                        echo "<h3 class='info__header'>" . $userRow['first-name'] . " " . $userRow['surname'] . "</h3>";
                    }
                    echo "
                    <p class='info__descr'>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta at expedita accusamus vero,
                        eaque ipsum natus reiciendis ab excepturi exercitationem sapiente ad alias, cupiditate provident fugit.
                        Blanditiis dolor repudiandae officia. Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta at expedita accusamus vero,
                        eaque ipsum natus reiciendis ab excepturi exercitationem sapiente ad alias, cupiditate provident fugit.
                        Blanditiis dolor repudiandae officia.
                    </p>
                    "
                    ?>

                </div>
                <div class="profile-concert__wrapper concert-info">
                    <h2 class="concert-info__header">Ваши места</h2>
                    <?php
                    $sitSelect = "SELECT * FROM `concert_zal`  WHERE reserved_by_id='$userlogin'";
                    $sitSelectResult = mysqli_query($conn, $sitSelect);
                    echo "<ul class='sit__list sit'>";
                    foreach ($sitSelectResult as $sitRow) {
                        echo "<li class='sit__item'>";
                        // echo "<h3 class='sit__header'>" . "Название концерта: " . "$sitRow[name]" . "</h3>";
                        echo "<h3 class='sit__header'>" . "Номер места: " . "$sitRow[sit_num]" . "</h3>";
                        echo "<p class='sit__paragraph'>" . "Цена места: " . "$sitRow[sit_price] " . "&#8381" . "</p>";
                        echo "<p class='sit__paragraph'>" . "Расположение места: " . "$sitRow[sit_direction]" . "</p>";
                        echo "<a href='profile.php?concertid=" . $sitRow['id_concert'] . "&placeid=" . $sitRow['id'] . "' class='sit__link'>" . "[Cнять бронь]" . "</a>";
                        echo "</li>";
                    }
                    echo "</ul>";
                    echo "<h2 class='concert-info__header'>История</h2>";
                    echo "<ul class='action__list action'>";

                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }
                    $size_page = 4;
                    $offset = ($pageno - 1) * $size_page;
                    $count_sql = "SELECT COUNT(*) FROM `user_history`";
                    $result = mysqli_query($conn, $count_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $size_page);
                    $actionSelect = "SELECT * FROM `user_history` INNER JOIN concerti ON concerti.id=user_history.concert_id WHERE action_by='$userlogin' LIMIT $offset, $size_page";
                    $actionSelectResult = mysqli_query($conn, $actionSelect);
                    foreach ($actionSelectResult as $actionRow) {
                        echo "<li class='action__item'>";
                        echo "<h3 class='action__header'>" . "Название концерта: " . "$actionRow[name]" . "</h3>";
                        echo "<p class='action__paragraph'>" . "Действие: " . "$actionRow[action]" . "</p>";
                        echo "<p class='action__paragraph'>" . "Дата: " . "$actionRow[date]" . "</p>";
                        echo "<p class='action__paragraph'>" . "Место: " . "$actionRow[sit_id]" . "</p>";
                        echo "</li>";
                    }
                    echo "</ul>";

                    ?>

                    <ul class="pagination">
                        <li><a href="?pageno=1">Первая страница</a></li>
                        <li class="<?php if ($pageno <= 1) {
                                        echo 'disabled';
                                    } ?>">
                            <a href="<?php if ($pageno <= 1) {
                                            echo '#';
                                        } else {
                                            echo "?pageno=" . ($pageno - 1);
                                        } ?>">Назад</a>
                        </li>
                        <li class="<?php if ($pageno >= $total_pages) {
                                        echo 'disabled';
                                    } ?>">
                            <a href="<?php if ($pageno >= $total_pages) {
                                            echo '#';
                                        } else {
                                            echo "?pageno=" . ($pageno + 1);
                                        } ?>">Вперед</a>
                        </li>
                        <li><a href="?pageno=<?php echo $total_pages; ?>">Последняя страница</a></li>
                    </ul>

                    <?php

                    if (isset($_GET['concertid']) && isset($_GET['placeid'])) {
                        $concertid = $_GET['concertid'];
                        $placeid = $_GET['placeid'];
                        $actiondis = "снятие брони";
                        $placeupdate = "UPDATE `concert_zal` SET `sit_status` = 'свободное', `reserved_by_id` = '' WHERE id = '$placeid'";
                        $historydisupdate = "INSERT INTO `user_history` (`id`, `action`, `date`, `concert_id`, `sit_id`, `action_by`) VALUES (NULL, '$actiondis', NOW(), '$concertid', '$placeid', '$userlogin')";
                        if ($conn->query($placeupdate)) {
                    ?>


                        <?php
                        } else {
                            echo "<p class='sit__update'> Место зарезервировано" . $conn->error  . "</p>";
                        }

                        if ($conn->query($historydisupdate)) {
                        ?>
                            <script>
                                setTimeout(() => {
                                    document.location.replace("http://concert/concertsite/profile.php");
                                }, 100);
                            </script>
                    <?php
                        }
                    }


                    ?>
                </div>
            </div>
        </section>
        <section class="section__concert-profile concert-profile">
            <div class="container concert-profile__container">
                <h2 class="concert-profile__header">Предложения</h2>
                <div class="concert-profile__wrapper">
                    <ul class="concert-profile__list">
                        <?php
                        $concertRandSelect = "SELECT * FROM `concerti` ORDER BY rand() limit 3";
                        $concertRandSelectResult = mysqli_query($conn, $concertRandSelect);
                        foreach ($concertRandSelectResult as $concertRandRow) {
                            echo "<li class='concert-profile__item'>";
                            echo "<img src='img/" . $concertRandRow['img'] . "' alt=''>";
                            echo "<div class='concert-profile__content__wrapper'>";
                            echo
                            "<h3 class='concert-profile__header'>" .
                                "<a href='#' class='concert__link'>" . $concertRandRow['name'] . "</a>" .
                                "</h3>";
                            echo "<time class='concert-profile__time'>" . "Дата: " . "$concertRandRow[date]" . "</time>";
                            echo "<span class='concert-profile__span'>" . "Группа: " . "$concertRandRow[group_name]" . "</span>";
                            echo "<span class='concert-profile__span'>" . "Жанр: " . "$concertRandRow[genre]" . "</span>";
                            echo "<div class='concert-profile__about__wrapper'>";
                            echo "<a href='concert.php?concertid=" . $concertRandRow['id'] . "' class='concert-profile__about'>" . "Просмотреть места" . "</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</li>";
                        }

                        ?>
                    </ul>
                </div>
            </div>
        </section>

    </main>
</body>

</html>