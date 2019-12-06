<?php
$login = mysqli_connect("localhost", "root", "", "livreor");
$request = "SELECT * FROM utilisateurs INNER JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur";
$query = mysqli_query($login, $request);
$result = mysqli_fetch_all($query);
var_dump($result);
?>



<?php
$i = 0;
while ($i < count($result)) {
    if ($i % 2 != 0) {
        echo "<article class='comunpair center'><p class='citation_livreor'>" . $result[$i][4] . "</p><p class='postinfo txtalighl'>Fait le " . $result[$i][6] . " par " . $result[$i][1] . "</article></p>";
    } else {
        echo "<article class='compair center'><p class='citation_livreor'>" . $result[$i][4] . "</p><p class='postinfo txtalighl'>Fait le " . $result[$i][6] . " par " . $result[$i][1] . "</article></p>";
    }
    $i++;
}
?>