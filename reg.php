<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'head.php' ?>
</head>

<body>
    <?php include 'header.php' ?>
    <main class="main">
        <section class="section__reg reg">
            <div class="container reg__container">
                <div class="login__wrapper">
                    <h2 class="reg__header">Регистрация</h2>
                    <p class="reg__account">
                        Есть аккаунт? <a href="auth.php" class="reg__link">Войдите</a>
                    </p>
                    <form action="" class="reg__form form" method="POST">
                        <label for="first-name">Имя:</label>
                        <input class="reg__input" type="text" name="first-name" id="first-name">
                        <label for="surname">Фамилия:</label>
                        <input class="reg__input" type="text" name="surname" id="surname">
                        <label for="login">Логин:</label>
                        <input class="reg__input" type="text" name="login" id="login" required>
                        <label for="password">Пароль:</label>
                        <input class="reg__input" type="password" name="password" id="password" required>
                        <input type="submit" name="submitreg" class="reg__submit btn">
                    </form>

                    <?php

                    if (isset($_POST['submitreg'])) {
                        $login = $_POST['login'];
                        $firstName = $_POST['first-name'];
                        $surname = $_POST['surname'];
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $userInsertion = "INSERT INTO `user` (`first-name`, `surname`, `login`, `password`) VALUES ('$firstName', '$surname', '$login', '$password')";
                        if ($conn->query($userInsertion)) {
                            echo "<p class='reg__paragraph'>" . "Регистрация прошла успешно, Перенаправляем..." . "</p>";
                            ?>
                            <script>
                                setTimeout(() => {
                                    document.location.replace("http://concertsite-new/index.php");
                                }, 2000);
                            </script>
                            <?php
                        } else {
                            echo "<p>" . "Ошибка:" . $conn->error . "</p>";
                        }
                    }

                    ?>
                </div>

            </div>
        </section>
    </main>
</body>

</html>