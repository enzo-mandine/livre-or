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

if (isset($_POST["txtareacom"]) && (isset($_SESSION["isconnected"]))) {
    $login = mysqli_connect("localhost", "root", "", "livreor");
    $com = mysqli_escape_string($login, $_POST["txtareacom"]);
    $request = "SELECT `id` FROM `utilisateurs` WHERE login = '" . $_SESSION["isconnected"] . "'";
    $query = mysqli_query($login, $request);
    $result = mysqli_fetch_all($query);
    if (isset($_POST["submit"])) {
        $request2 = "INSERT INTO commentaires (`id`, `commentaire`, `id_utilisateur`, `date`) VALUES (NULL, '" . $com . "', '" . $result[0][0] . "', curdate())";
        $query2 = mysqli_query($login, $request2);
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
    <title>Commentaire</title>
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
        <section>
            <p class="citation">Livre d'or</p>
            <p class="citation">Ajoutez vôtre pierre à l'édifice</p>
        </section>
        <section class="com center">
            <form action="commentaire.php" method="POST">
                <div class="flexr justifycenter mb15">
                    <textarea required name="txtareacom" id="txtareacom"></textarea>
                </div>
                <div class="flexr justifycenter">
                    <input class="center mb15" id="index_button" type="submit" name="submit" value="Envoyer">
                </div>
            </form>
        </section>
    </main>
</body>
<footer>
    <div class="center">
        <p class="footertxt">Livre d'or - Laplateforme</p>
    </div>
</footer>

</html>