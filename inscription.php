<?php
if (isset($_GET["logout"])) {
    session_destroy();
    header("location:index.php");
}
if (isset($_POST["regsubmit"])) {
    if ($_POST["password"] == $_POST["passwordconfirm"]) {
        $login = mysqli_connect("localhost", "root", "", "livreor");
        $request = "SELECT * FROM `utilisateurs`";
        $query = mysqli_query($login, $request);
        $result = mysqli_fetch_all($query);
        $connectstate = true;
        $i = 0;
        while ($i < count($result)) {
            if ($result[$i][1] == $_POST["login"]) {
                $connectstate = false;
                header("location:inscription.php");
                break;
            }
            ++$i;
        }
        if ($connectstate == true) {
            $request = "INSERT INTO utilisateurs (`id`, `login`, `password`) VALUES (NULL, '" . $_POST["login"] . "', '" . password_hash($_POST["password"], PASSWORD_DEFAULT) . "');";
            mysqli_query($login, $request);
            mysqli_close($login);
            header("location:connexion.php");
        }
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
    <title>Inscription</title>
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
            <section id="loginbox" class="flexc center">
                <p id="regtxt" class="center">Veuillez vous enregistrer pour consulter et/ou rédigez sur le live d'or
                </p>
                <form class="flexc center" action="" method="POST">
                    <label for="login">Login</label>
                    <input class="login_input" type="text" name="login" placeholder="Login" required>
                    <label for="password">Password</label>
                    <input class="login_input" type="password" name="password" placeholder="******" required>
                    <label for="passwordconfirm">Confirmez le password</label>
                    <input class="login_input" type="password" name="passwordconfirm" placeholder="******" required>
                    <div class="alignh flexr justifycenter">
                        <input name="regsubmit" id="" class="alignh" type="submit" value="Inscription">
                    </div>
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