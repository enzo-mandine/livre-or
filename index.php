<?php
session_start();
if (isset($_GET["logout"])) {
    session_destroy();
    header("location:index.php");
}
$connect = mysqli_connect("localhost", "root", "", "livreor");
$request = "SELECT * FROM commentaires";
$query = mysqli_query($connect, $request);
$result = mysqli_fetch_all($query);
$max = count($result) - 1;
$idx1 = random_int(0, $max);
$com1 = $result[$idx1]; // commentaire à afficher //
$result[$idx1] = $result[$max];
$max = $max - 1;
$idx2 = random_int(0, $max);
$com2 = $result[$idx2];
$result[$idx2] = $result[$max];
$max = $max - 1;
$idx3 = random_int(0, $max);
$com3 = $result[$idx3];
$result[$idx3] = $result[$max];
//var_dump($com1, $com2, $com3);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Caveat|Open+Sans|Roboto&display=swap" rel="stylesheet">
    <title>Accueil</title>
</head>

<body>
    <header class="mp0 flexr rowstart">
        <nav class="mt15">
            <ul class="mp0 flexr">
                <li class="mr10 navfont"> <a href="index.php">Accueil</a></li>
                <li class="mr10 navfont"> <a href="livre-or.php">Livre d'or</a></li>
            </ul>
        </nav>
        <section class="mt15">
            <ul class="mp0 flexr">
                <li class="mr10 navfont">
                    <?php if (isset($_SESSION["isconnected"])) {
                        echo "<a href='profil.php'>Mon compte</a>";
                    } else {
                        echo "<a href='connexion.php'>Connexion</a>";
                    } ?>
                </li>
                <a class="navfont mr10" href="index.php?logout=true">Deconnexion</a>
            </ul>
        </section>
    </header>
    <main class="flexr">
        <section id="index_left">
            <article id="index_logo"></article>
            <p id="index_intro">La Plateforme Marseille, une école et un lieu unique pour des formations d’excellence
                aux
                métiers du numérique, mais aussi une source intarissable de phrases cultes !</p>
        </section>
        <section id="index_right" class="flexc">
            <div class="center">
                <!-- Insert random number to print citation -->
                <p class="citation"><?php echo "$com1[1]" ?></p>
                <p class="citation"><?php echo "$com2[1]" ?></p>
                <p class="citation"><?php echo "$com3[1]" ?></p>
            </div>
            <a class="center" href="livre-or.php">
                <input id="index_button" type="button" value="Acceder au livre d'or">
            </a>
        </section>
    </main>
    <footer>
    </footer>
</body>

</html>