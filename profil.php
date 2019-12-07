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
$userconnected = $_SESSION["isconnected"];
$login = mysqli_connect("localhost", "root", "", "livreor");
$request = "SELECT * FROM utilisateurs WHERE login = '" . $userconnected . "'";
$query = mysqli_query($login, $request);
$result = mysqli_fetch_all($query);
$pass = $result[0][2];
if (isset($_POST["submit"])) {
    if ($_POST["password"] == $_POST["passwordconfirm"]) {
        if (password_verify($_POST["password"], $pass)) {
            $editrequest = "UPDATE utilisateurs SET login = '" . $_POST["login"] . "' WHERE login = '" . $userconnected . "'";
            mysqli_query($login, $editrequest);
            mysqli_close($login);
            header("location:index.php");
            $_SESSION["isconnected"] = $_POST["login"];
        } else {
            echo "ERROR hash";
        }
    } else {
        echo "ERROR";
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
        <nav class="mt15">
            <ul class="mp0 flexr">
                <li class="mr10 navfont"> <a href="index.php">Accueil</a></li>
                <li class="mr10 navfont"> <a href="livre-or.php">Livre d'or</a></li>
                <li class="mr10 navfont">
                    <?php if (!isset($_SESSION["isconnected"])) {
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
                <form class="flexc center" action="profil.php" method="POST">
                    <label for="login">Login</label>
                    <input class="login_input" type="text" name="login" placeholder=<?php foreach ($result as $row) {
                                                                                        echo $row[1];
                                                                                    } ?> required>
                    <label for="password">Password</label>
                    <input class="login_input" type="password" name="password" placeholder="******">
                    <label for="passwordconfirm">Confirmez le password</label>
                    <input class="login_input" type="password" name="passwordconfirm" placeholder="******">
                    <input id="index_button" class="center" name="submit" type="submit" value="Valider">
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