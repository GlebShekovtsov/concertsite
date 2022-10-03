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
                    $sitSelect = "SELECT * FROM `concert_zal` INNER JOIN concerti ON concerti.id=concert_zal.id_concert WHERE reserved_by_id='$userlogin'";
                    // $sitSelect = "SELECT * FROM `concert_zal` WHERE reserved_by_id='$userlogin' ";
                    $sitSelectResult = mysqli_query($conn, $sitSelect);
                    echo "<ul class='sit__list sit'>";
                    foreach ($sitSelectResult as $sitRow) {

                        echo "<li class='sit__item'>";
                        echo "<h3 class='sit__header'>" . "Название концерта: " . "$sitRow[name]" . "</h3>";
                        echo "<h3 class='sit__header'>" . "Номер места: " . "$sitRow[sit_num]" . "</h3>";
                        echo "<p class='sit__paragraph'>" . "Цена места: " . "$sitRow[sit_price] " . "&#8381" . "</p>";
                        echo "<p class='sit__paragraph'>" . "Расположение места: " . "$sitRow[sit_direction]" . "</p>";
                        echo "<a href='profile.php?concertid=" . $sitRow['id_concert'] . "&placeid=" . $sitRow['id'] . "' class='sit__link'>" . "[Cнять бронь]" . "</a>";
                        echo "</li>";
                        
                    }
                    echo "</ul>";
                    if(isset($_GET['concertid']) && isset($_GET['placeid'])) {
                        $concertid = $_GET['concertid'];
                        $placeid = $_GET['placeid'];
                        $placeid = $_GET['placeid'];
                        $placeupdate = "UPDATE `concert_zal` SET `sit_status` = 'свободное', `reserved_by_id` = '' WHERE id = '$placeid'";
                        if($conn->query($placeupdate)) {
                            ?>
                            <script>
                                setTimeout(() => {
                                    document.location.replace("http://concert/concertsite/profile.php");
                                }, 100);
                            </script>
                            <?php
                        }
                        else {
                            echo "<p class='sit__update'> Место зарезервировано" . $conn->error  . "</p>";
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