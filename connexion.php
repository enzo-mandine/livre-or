<?php
session_start();
if (isset($_GET["logout"])) {
    session_destroy();
    header("location:index.php");
}
if (isset($_POST["submit"])) {
    $connect = mysqli_connect("localhost", "root", "", "livreor");
    if (mysqli_connect_errno()) {
        echo "Failed to connect" . mysqli_connect_error();
    }
    $request = "SELECT login, password FROM utilisateurs WHERE login = '" . $_POST["login"] . "'";
    $query = mysqli_query($connect, $request);
    $result = mysqli_fetch_all($query);
    $password_state = "Password";
    $login_state = "Login";
    if (isset($result[0]) && ($_POST["login"] == $result[0][0]) && password_verify($_POST["password"], $result[0][1])) {
        $_SESSION["isconnected"] = $_POST["login"];
        header("location:index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Caveat|Open+Sans|Roboto&display=swap" rel="stylesheet">
    <title>Connexion</title>
</head>

<body>
    <header class="mp0 flexr rowstart">
        <nav class="mt15 mr80">
            <ul class="mp0 flexr">
                <li class="mr10 navfont"> <a href="index.php">Accueil</a></li>
                <li class="mr10 navfont"> <a href="livre-or.php">Livre d'or</a></li>
                <li class="mr10 navfont">
                    <?php if (isset($_SESSION["isconnected"])) {
                        echo "<a href='profil.php'>Mon compte</a>";
                    } else {
                        echo "<a class='loginfont' href='connexion.php'>Connexion</a>";
                    }
                    ?>
                </li>
                <li>
                    <?php if (isset($_SESSION["isconnected"])) {
                        echo "<a class='logoutfont mr10' href='index.php?logout=true'>Deconnexion</a>";
                    }
                    ?>

                </li>
            </ul>
        </nav>
        <div></div>
    </header>
    <main>
        <div id="alignlogin" class="flexc">
            <section id="loginbox" class="flexr">
                <form class="flexc center" action="connexion.php" method="POST">
                    <div id="userimage"></div>
                    <label for="login">Login</label>
                    <input class="login_input" type="text" name="login" placeholder="Login" required>
                    <label for="password">Password</label>
                    <input class="login_input" type="password" name="password" placeholder="******" required>
                    <input id="index_button" class="center" name="submit" type="submit" value="connexion">
                </form>
            </section>
        </div>
    </main>
</body>
<footer>
    <div class="center">
        <p class="footertxt">Livre d'or - Laplateforme</p>
    </div>
</footer>

</html>