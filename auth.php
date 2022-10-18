<?php
include 'connect.php';
?>
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
        <section class="section__reg reg">
            <div class="container reg__container">
                <div class="login__wrapper">
                    <h2 class="login__header">Авторизация</h2>
                    <p class="login__account">
                        Нет аккаунта? <a href="reg.php" class="login__link">Зарегистрируйтесь</a>
                    </p>
                    <form action="" class="login__form form" method="POST">
                        <label for="login">Логин:</label>
                        <input class="login__input" type="text" name="login" id="login" required>
                        <label for="password">Пароль:</label>
                        <input class="login__input" type="password" name="password" id="password" required>
                        <input type="submit" name="submitlog" class="reg__submit btn">
                    </form>

                    <?php

                    if (isset($_POST['submitlog'])) {
                        $login = $_POST["login"];
                        $auth = "SELECT * FROM `user` WHERE login='$login'";
                        $authResult = mysqli_query($conn, $auth);
                        $authAssoc = mysqli_fetch_assoc($authResult);
                        if (!empty($authAssoc)) {
                            $hash = $authAssoc['password'];
                            if (password_verify($_POST['password'], $hash)) {
                                $userid = $authAssoc['id'];
                                $userlogin = $authAssoc['login'];
                                $userFirstName = $authAssoc['first-name'];
                                $_SESSION["login"] = $userlogin;
                                $_SESSION["userid"] = $userid;
                                $_SESSION["first-name"] = $userFirstName;
                                echo "<p>Вход успешно выполнен, перенаправляем на главную...</p>";
                    ?>
                                <script>
                                    setTimeout(() => {
                                        document.location.replace("http://concertsite-new/index.php");
                                    }, 2000);
                                </script>
                    <?php
                            } else {
                                echo "<p>Пароль неверный</p>";
                            }
                        } else {
                            echo "<p>Пользователя с таким логином не существует</p>";
                        }
                    }

                    ?>
                </div>

            </div>
        </section>
    </main>
</body>

</html>