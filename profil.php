<?php
session_start();
if (!isset($_SESSION["isconnected"])) {
    header("location:connexion.php");
    die;
}
if (isset($_GET["logout"])) {
    session_destroy();
    header("location:index.php");
}
$login = mysqli_connect("localhost", "root", "", "livreor");
$request = "SELECT * FROM `utilisateurs`WHERE login = '" . $_SESSION["isconnected"] . "'";
$query = mysqli_query($login, $request);
$result = mysqli_fetch_all($query);
foreach ($result as $row)

    if (isset($_POST["submit"])) {
        if ($_POST["password"] == $_POST["passwordconfirm"]) {
            $editrequest = "UPDATE utilisateurs SET login = '" . $_POST["login"] . "', password = '" . password_hash($_POST["password"], PASSWORD_DEFAULT) . "' WHERE login = '" . $row[1] . "'";
            mysqli_query($login, $editrequest);
            mysqli_close($login);
            header("location:profil.php");
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
    <title>Profil</title>
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
                <p id="regtxt" class="center">Veuillez renseignez les champ pour modifier votre profil</p>
                <form class="flexc center" action="" method="POST">
                    <label for="login">Login</label>
                    <input class="login_input" type="text" name="login" placeholder=<?php echo $row[1] ?> required>
                    <label for="password">Password</label>
                    <input class="login_input" type="password" name="password" placeholder="******">
                    <label for="password_confirm">Confirmez le password</label>
                    <input class="login_input" type="password" name="password_confirm" placeholder="******">
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