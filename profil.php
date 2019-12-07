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
$connectstate = true;
$login = mysqli_connect("localhost", "root", "", "livreor");
$request = "SELECT * FROM utilisateurs WHERE login = '" . $userconnected . "'";
$query = mysqli_query($login, $request);
$result = mysqli_fetch_all($query);
$pass = $result[0][2];
$request2 = "SELECT id FROM utilisateurs WHERE login = '" . $_SESSION["isconnected"] . "'";
$query2 = mysqli_query($login, $request2);
$checklogin = mysqli_num_rows($query2);
if (isset($_POST["submit"])) {
    if ($checklogin < 1) {
        if ($_POST["password"] == $_POST["passwordconfirm"]) {
            if (password_verify($_POST["oldpassword"], $pass)) {
                $editrequest = "UPDATE utilisateurs SET login = '" . $_POST["login"] . "', password = '" . password_hash($_POST["password"], PASSWORD_DEFAULT) . "' WHERE login = '" . $userconnected . "'";
                mysqli_query($login, $editrequest);
                mysqli_close($login);
                header("location:index.php");
                $_SESSION["isconnected"] = $_POST["login"];
            }
        } else {
            echo "ERROR hash";
            $connectstate = false;
        }
    } else {
        $connectstate = false;
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
                <p id="regtxt" class="center">Veuillez renseignez les champ pour modifier vos informations</p>
                <form class="flexc center" action="profil.php" method="POST">
                    <label for="login">Login</label>
                    <input class="login_input" type="text" name="login" placeholder=<?php foreach ($result as $row) {
                                                                                    echo $row[1];
                                                                                } ?> required>
                    <label for="oldpassword">Ancient Password</label>
                    <input class="login_input" type="password" name="oldpassword" placeholder="******">
                    <label for="password">Nouveau Password</label>
                    <input class="login_input" type="password" name="password" placeholder="******">
                    <label for="passwordconfirm">Confirmez le password</label>
                    <input class="login_input" type="password" name="passwordconfirm" placeholder="******">
                    <input id="index_button" class="center" name="submit" type="submit" value="Valider">
                    <?php if ($connectstate == false) {
                        echo "<p class='footertxt'>Login existant</p>";
                    }
                    ?>
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