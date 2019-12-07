<?php
session_start();
if (isset($_GET["logout"])) {
    session_destroy();
    header("location:index.php");
}
$login = mysqli_connect("localhost", "root", "", "livreor");
$request = "SELECT * FROM utilisateurs INNER JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur";
$query = mysqli_query($login, $request);
$result = mysqli_fetch_all($query);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Caveat|Open+Sans|Roboto&display=swap" rel="stylesheet">
    <title>Livre d'or</title>
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
        <p class="aligncenter citation">Livre d'or</p>
        <section>
            <?php
            $i = 0;
            while ($i < count($result)) {
                if ($i % 2 != 0) {
                    echo "<article class='comunpair center'><p class='citation_livreor'>" . $result[$i][4] . "</p><p class='postinfo txtalighl'>Fait le " . $result[$i][6] . " par " . $result[$i][1] . "</article></p>";
                } else {
                    echo "<article class='compair center'><p class='citation_livreor'>" . $result[$i][4] . "</p><p class='postinfo txtalighr'>Fait le " . $result[$i][6] . " par " . $result[$i][1] . "</article></p>";
                }
                $i++;
            }
            ?>
        </section>
    </main>
</body>
<footer>
    <div class="center">
        <p class="footertxt">Livre d'or - Laplateforme</p>
    </div>
</footer>

</html>